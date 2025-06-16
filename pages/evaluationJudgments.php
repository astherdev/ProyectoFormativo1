<?php
include "../includes/session.php";
include '../db/connection.php';

$fichaFiltro = $_GET['ficha'] ?? '';
$denominacionFiltro = $_GET['denominacion'] ?? '';

$sql = "SELECT * FROM archivos WHERE estado = 'Activo'";

if (!empty($fichaFiltro)) {
    $fichaFiltro = $conn->real_escape_string($fichaFiltro);
    $sql .= " AND contenido LIKE '%$fichaFiltro%'";
}

if (!empty($denominacionFiltro)) {
    $denominacionFiltro = $conn->real_escape_string($denominacionFiltro);
    $sql .= " AND contenido LIKE '%$denominacionFiltro%'";
}

$sql .= " ORDER BY id DESC";
$resultado = $conn->query($sql);

function detectarDelimitador($linea) {
    if (strpos($linea, ';') !== false) return ';';
    if (strpos($linea, ',') !== false) return ',';
    if (strpos($linea, "\t") !== false) return "\t";
    return false;
}
?>
<?php

function limpiar_clave($clave) {
    $clave = mb_strtolower($clave, 'UTF-8');
    $clave = str_replace(['á','é','í','ó','ú','ñ'], ['a','e','i','o','u','n'], $clave);
    $clave = preg_replace('/[^a-z0-9_]+/', '_', $clave);
    return trim($clave, '_');
}

// Función para convertir fechas de dd/mm/yyyy a yyyy-mm-dd
function convertir_fecha($fecha) {
    $partes = explode('/', $fecha);
    if (count($partes) == 3) {
        return "{$partes[2]}-{$partes[1]}-{$partes[0]}";
    }
    return null;
}

// Mostrar mensaje por GET
$mensaje = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'ok') {
        $mensaje = "<p class='mensaje' style='color:green;'> Ficha insertada correctamente.</p>";
    } elseif ($_GET['msg'] === 'error') {
        $mensaje = "<p class='mensaje' style='color:red;'> Error al insertar la ficha.</p>";
    } elseif ($_GET['msg'] === 'faltan') {
        $faltantes = isset($_GET['faltantes']) ? urldecode($_GET['faltantes']) : '';
        $mensaje = "<p class='mensaje' style='color:orange;'> Faltan campos requeridos: " . htmlspecialchars($faltantes) . "</p>";
    }
}

// Procesamiento de carga de archivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo'])) {
    $archivo = $_FILES['archivo']['tmp_name'];

    $sinonimos = [
        'fecha_del_reporte' => 'fecha_del_reporte',
        'fecha del reporte' => 'fecha_del_reporte',
        'ficha_de_caracterizacion' => 'ficha_de_caracterizacion',
        'ficha de caracterizacion' => 'ficha_de_caracterizacion',
        'codigo' => 'codigo',
        'cogigo' => 'codigo',
        'código' => 'codigo',
        'version' => 'version',
        'versión' => 'version',
        'denominacion' => 'denominacion',
        'denominación' => 'denominacion',
        'estado_de_la_ficha_de_caracterizacion' => 'estado_de_la_ficha_de_caracterizacion',
        'estado de la ficha de caracterizacion' => 'estado_de_la_ficha_de_caracterizacion',
        'fecha_inicio' => 'fecha_inicio',
        'fecha inicio' => 'fecha_inicio',
        'fecha_fin' => 'fecha_fin',
        'fecha fin' => 'fecha_fin',
        'modalidad_de_formacion' => 'modalidad_de_formacion',
        'modalidad de formacion' => 'modalidad_de_formacion',
        'modalidad de formación' => 'modalidad_de_formacion',
        'regional' => 'regional',
        'centro_de_formacion' => 'centro_de_formacion',
        'centro de formacion' => 'centro_de_formacion',
        'centro de formación' => 'centro_de_formacion'
    ];

    $requeridos = [
        'fecha_del_reporte',
        'ficha_de_caracterizacion',
        'codigo',
        'version',
        'denominacion',
        'estado_de_la_ficha_de_caracterizacion',
        'fecha_inicio',
        'fecha_fin',
        'modalidad_de_formacion',
        'regional',
        'centro_de_formacion'
    ];

    $datos_transformados = [];

    if (($gestor = fopen($archivo, "r")) !== false) {
        $contador = 0;
        while (($linea = fgetcsv($gestor, 1000, ",")) !== false && $contador < 20) {
            if (count($linea) >= 3 && !empty(trim($linea[0]))) {
                $clave_original = trim(str_replace([':', '"'], '', $linea[0]));
                $clave_limpia = limpiar_clave($clave_original);
                foreach ($sinonimos as $original => $estandar) {
                    if ($clave_limpia === limpiar_clave($original)) {
                        $valor = isset($linea[2]) ? trim($linea[2], " \"") : '';
                        $datos_transformados[$estandar] = $valor;
                        break;
                    }
                }
            }
            $contador++;
        }
        fclose($gestor);

        $faltantes = array_diff($requeridos, array_keys($datos_transformados));

        if (empty($faltantes)) {
            $valores = [];
            foreach ($requeridos as $campo) {
                $valores[$campo] = $datos_transformados[$campo] ?? '';
            }

            $fecha_reporte = convertir_fecha($valores['fecha_del_reporte']);
            $ficha_caracterizacion = (int)$valores['ficha_de_caracterizacion'];
            $codigo = (int)$valores['codigo'];
            $version = (int)$valores['version'];
            $denominacion = $conn->real_escape_string($valores['denominacion']);
            $estado = $conn->real_escape_string($valores['estado_de_la_ficha_de_caracterizacion']);
            $fecha_inicio = convertir_fecha($valores['fecha_inicio']);
            $fecha_fin = convertir_fecha($valores['fecha_fin']);
            $modalidad = $conn->real_escape_string($valores['modalidad_de_formacion']);
            $regional = $conn->real_escape_string($valores['regional']);
            $centro = $conn->real_escape_string($valores['centro_de_formacion']);

            $sql = "INSERT INTO fichas (
                        fecha_reporte, ficha_caracterizacion, codigo, version, denominacion,
                        estado, fecha_inicio, fecha_fin, modalidad, regional, centro_formacion
                    ) VALUES (
                        '$fecha_reporte', $ficha_caracterizacion, $codigo, $version, '$denominacion',
                        '$estado', '$fecha_inicio', '$fecha_fin', '$modalidad', '$regional', '$centro'
                    )";

            if ($conn->query($sql)) {
                header("Location: " . $_SERVER['PHP_SELF'] . "?msg=ok");
                exit;
            } else {
                header("Location: " . $_SERVER['PHP_SELF'] . "?msg=error");
                exit;
            }
        } else {
            header("Location: " . $_SERVER['PHP_SELF'] . "?msg=faltan&faltantes=" . urlencode(implode(', ', $faltantes)));
            exit;
        }
    } else {
        $mensaje = "<p class='mensaje' style='color:red;'> Error al procesar el archivo.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Juicios Evaluativos</title>
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/style.css">
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/tokens.css">
  <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-gray-100">

<?php include "../includes/sidebar.php"; ?>

<div class="flex-1 flex flex-col min-h-screen">
  <?php include "../includes/headerLogIn.php"; ?>

  <main class="flex-grow">
    <div class="w-full flex justify-start mb-0">
      <button id="backpage" onclick="history.back()" class="m-4">
        <img src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png" alt="Atrás" class="w-5 h-5" />
      </button>
    </div>

    <div class="flex justify-center items-start min-h-screen px-4 mt-8">
      <div class="bg-white p-8 shadow-lg rounded-lg w-full max-w-7xl">
        <div class="flex justify-between items-center mb-6">
          <a href="historialJudgments.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
            Ver Historial
          </a>
        </div>

        <!-- FORMULARIO DE FILTROS -->
        <form method="GET" class="mb-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="ficha" class="block mb-1 text-sm font-medium text-gray-700">Filtrar por Ficha:</label>
              <input type="text" name="ficha" id="ficha"
                    value="<?php echo htmlspecialchars($_GET['ficha'] ?? ''); ?>"
                    placeholder="Ingrese número de ficha"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200">
            </div>

            <div>
              <label for="denominacion" class="block mb-1 text-sm font-medium text-gray-700">Filtrar por Denominación:</label>
              <input type="text" name="denominacion" id="denominacion"
                    value="<?php echo htmlspecialchars($_GET['denominacion'] ?? ''); ?>"
                    placeholder="Ingrese denominación"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200">
            </div>
          </div>
          <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Filtrar</button>
        </form>
                  
        <h2 class="text-2xl font-bold text-center">Juicios Evaluativos</h2>

        <!-- Botón y mini pestaña para agregar nuevo juicio -->
        <div class="mb-6">
          <button onclick="toggleFormulario()" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
            Agregar Juicio de Excel a CSV
          </button>

          <div id="formularioJuicio" class="mt-4 p-4 bg-gray-100 rounded-lg border border-gray-300 hidden max-w-md">
            <form action="procesar_excel.php" method="post" enctype="multipart/form-data" class="space-y-4">
              <div>
                <label class="block text-sm font-medium">Nombre del archivo CSV (sin ".csv"):</label>
                <input type="text" name="nombre_csv" required class="w-full border border-gray-300 p-2 rounded">
              </div>
              <div>
                <label class="block text-sm font-medium">Sube el archivo Excel:</label>
                <input type="file" name="archivo_excel" accept=".xlsx, .xls" required class="w-full border border-gray-300 p-2 rounded">
              </div>
              <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Convertir</button>
            </form>
          </div>
        </div>

        <script>
          function toggleFormulario() {
            const form = document.getElementById('formularioJuicio');
            form.classList.toggle('hidden');
          }
        </script>

        <!-- Botón y mini pestaña para subir juicio CSV -->
      <div class="mb-6">
        <button onclick="toggleFormularioCSV()" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 text-sm">
          Subir Juicio CSV
        </button>

        <div id="formularioJuicioCSV" class="mt-4 p-4 bg-gray-100 rounded-lg border border-gray-300 hidden max-w-md">
          <form action="upload.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
              <label class="block text-sm font-medium">Selecciona un archivo CSV o TXT:</label>
              <input type="file" name="archivo" id="archivo" accept=".txt,.csv" required class="w-full border border-gray-300 p-2 rounded">
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Subir archivo</button>
          </form>
        </div>
      </div>

      <script>
        function toggleFormularioCSV() {
          const form = document.getElementById('formularioJuicioCSV');
          form.classList.toggle('hidden');
        }
      </script>

      <button  onclick="toggleForm()" class="bg-green-600 hover:bg-green-700 text-white font-bold text-sm py-2 px-4 rounded mb-4">
        Cargar Ficha de Caracterización
      </button>

      <div id="formSection" style="display: none;">
        <form class="flex flex-col gap-4 bg-white p-4 rounded shadow-md" method="post" enctype="multipart/form-data">
          <label class="font-semibold text-gray-700">Selecciona el archivo de la ficha CSV:</label>
          <input type="file" name="archivo" accept=".csv" required class="border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-green-500" />
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
            Subir Ficha
          </button>
          <?= $mensaje ?>
        </form>
      </div>


      <script>
        function toggleForm() {
          const form = document.getElementById('formSection');
          form.style.display = (form.style.display === 'none') ? 'block' : 'none';
        }
      </script>

        <!-- Resto del contenido (subida de archivos, resultados, tablas, etc.) -->
        <?php
        while ($row = $resultado->fetch_assoc()) {
            echo "<div class='flex items-center justify-between mb-2'>";
            echo "<h3 class='text-lg font-semibold'>Archivo: " . htmlspecialchars($row['nombre']) . "</h3>";
            echo "<form method='POST' action='inactivarArchivo.php' onsubmit=\"return confirm('¿Estás seguro de inactivar este archivo?');\">";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<button type='submit' class='ml-4 px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600'>Inactivar</button>";
            echo "</form></div>";

            $lineas = explode("\n", $row['contenido']);
            $lineas = array_filter($lineas);

            if (count($lineas) > 0) {
                $delimitador = detectarDelimitador($lineas[0]);

                if ($delimitador) {
                    echo "<div class='mb-6 p-4 bg-gray-50 rounded border'>";
                    echo "<h3 class='font-bold mb-2'>Información del Reporte:</h3><ul class='list-disc pl-5'>";

                    while (count($lineas) > 0) {
                        $lineaActual = array_shift($lineas);
                        if ($lineaActual === null || trim($lineaActual) === '') continue;
                        $campos = str_getcsv($lineaActual, $delimitador);
                        $primerCampo = strtoupper(trim($campos[0] ?? ''));

                        if (in_array("Nombre", $campos) || in_array("Nombres", $campos) || in_array("Juicio de Evaluación", $campos)) {
                            array_unshift($lineas, $lineaActual);
                            break;
                        }

                        if (!empty($primerCampo)) {
                            $etiqueta = rtrim($campos[0], " \t\n\r\0\x0B");
                            $etiqueta .= (str_ends_with($etiqueta, ':') ? '' : ':');
                            echo "<li><strong>" . htmlspecialchars($etiqueta) . "</strong> " . htmlspecialchars($campos[2] ?? '') . "</li>";
                        }
                    }

                    echo "</ul></div>";

                    if (count($lineas) === 0) {
                        echo "<p class='text-red-600'>No se encontraron datos evaluativos.</p>";
                        continue;
                    }

                    $cabecera = str_getcsv(array_shift($lineas), $delimitador);
                    $cabecera[] = "Porcentaje_TyT";

                    $porcentajes = [];
                    foreach ($lineas as $linea) {
                        $campos = str_getcsv($linea, $delimitador);
                        if (count($campos) < 8) continue;
                        $nombreCompleto = strtoupper(trim($campos[2] . ' ' . $campos[3]));
                        $juicio = strtoupper(trim($campos[7]));

                        if (!isset($porcentajes[$nombreCompleto])) {
                            $porcentajes[$nombreCompleto] = ['total' => 0, 'aprobados' => 0];
                        }

                        $porcentajes[$nombreCompleto]['total']++;
                        if ($juicio === 'APROBADO') {
                            $porcentajes[$nombreCompleto]['aprobados']++;
                        }
                    }

                    echo "<div class='overflow-auto max-h-[700px] border border-gray-300 rounded-lg mb-10'>";
                    echo "<table class='min-w-full text-left text-sm text-gray-800 border border-gray-300 table-auto'>";
                    echo "<tr class='border-b border-gray-200'>";
                    foreach ($cabecera as $campo) {
                        echo "<th class='px-4 py-2 bg-gray-200 border border-gray-300 font-medium text-sm'>" . htmlspecialchars($campo) . "</th>";
                    }
                    echo "</tr>";

                    foreach ($lineas as $linea) {
                        $campos = str_getcsv($linea, $delimitador);
                        $nombreCompleto = strtoupper(trim($campos[2] . ' ' . $campos[3]));
                        $total = $porcentajes[$nombreCompleto]['total'] ?? 0;
                        $aprobados = $porcentajes[$nombreCompleto]['aprobados'] ?? 0;
                        $porcentaje = $total > 0 ? round(($aprobados / $total) * 100, 2) . "%" : "0%";

                        echo "<tr class='border-b border-gray-200'>";
                        foreach ($campos as $campo) {
                            echo "<td class='px-4 py-2 border border-gray-200'>" . htmlspecialchars($campo) . "</td>";
                        }
                        echo "<td class='px-4 py-2 border border-gray-200 font-bold text-green-600'>$porcentaje</td>";
                        echo "</tr>";
                    }

                    echo "</table></div>";
                } else {
                    echo "<pre class='bg-gray-100 p-4 rounded'>Formato no compatible</pre>";
                }
            } else {
                echo "<p class='text-red-600'>Archivo vacío</p>";
            }
        }
        ?>
      </div>
    </div>
  </main>

  <?php include "../includes/footer.php"; ?>
</div>

</body>
</html>
