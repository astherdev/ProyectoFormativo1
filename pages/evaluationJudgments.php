<?php
include "../includes/session.php";
include '../db/connection.php';


// Variables de filtro
$fichaFiltro = $_GET['ficha'] ?? '';
$denominacionFiltro = $_GET['denominacion'] ?? '';
$aprobadosFiltro = $_GET['aprobados'] ?? '';




// Construir consulta SQL con filtros
$sql = "SELECT * FROM archivos WHERE estado = 'Activo'";
if (!empty($fichaFiltro)) {
    $fichaFiltro = $conn->real_escape_string($fichaFiltro);
    $sql .= " AND contenido LIKE '%$fichaFiltro%'";
}
if (!empty($denominacionFiltro)) {
    $denominacionFiltro = $conn->real_escape_string($denominacionFiltro);
    $sql .= " AND contenido LIKE '%$denominacionFiltro%'";
    
}

if (!empty($aprobadosFiltro)) {
    $aprobadosFiltro = $conn->real_escape_string($aprobadosFiltro);
    $sql .= " AND contenido LIKE '%$aprobadosFiltro%'";
}
$sql .= " ORDER BY id DESC";
$resultado = $conn->query($sql);

// Funciones auxiliares
function detectarDelimitador($linea) {
    if (strpos($linea, ';') !== false) return ';';
    if (strpos($linea, ',') !== false) return ',';
    if (strpos($linea, "\t") !== false) return "\t";
    return false;
}

function limpiar_clave($clave) {
    $clave = mb_strtolower($clave, 'UTF-8');
    $clave = str_replace(['á','é','í','ó','ú','ñ'], ['a','e','i','o','u','n'], $clave);
    $clave = preg_replace('/[^a-z0-9_]+/', '_', $clave);
    return trim($clave, '_');
}

function convertir_fecha($fecha) {
    $partes = explode('/', $fecha);
    if (count($partes) == 3) {
        return "{$partes[2]}-{$partes[1]}-{$partes[0]}";
    }
    return null;
}

// Mensaje por GET
$mensaje = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'ok') {
        $mensaje = "<p class='mensaje' style='color:green;'>Ficha insertada correctamente.</p>";
    } elseif ($_GET['msg'] === 'error') {
        $mensaje = "<p class='mensaje' style='color:red;'>Error al insertar la ficha.</p>";
    } elseif ($_GET['msg'] === 'faltan') {
        $faltantes = isset($_GET['faltantes']) ? urldecode($_GET['faltantes']) : '';
        $mensaje = "<p class='mensaje' style='color:orange;'>Faltan campos requeridos: " . htmlspecialchars($faltantes) . "</p>";
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
<body class="bg-gray-100 flex">
    <?php include '../includes/sidebar.php'; ?>
    <div class="flex-1 flex flex-col min-h-screen">
        <?php include '../includes/headerLogIn.php'; ?>
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
            <div>
              <label for="aprobados" class="block mb-1 text-sm font-medium text-gray-700">Filtrar por Aprendices Aprobados:</label>
              <select name="aprobados" id="aprobados" class="w-full p-2 border border-gray-300 rounded-md">
                  <option value="">Seleccione un porcentaje</option>
                  <option value="0"<?php if(isset($_GET['aprobados']) && $_GET['aprobados']<'75') echo ' selected'; ?>> No Aprobados</option>
                  <option value="75"<?php if(isset($_GET['aprobados']) && $_GET['aprobados']>'75') echo ' selected'; ?>>Aprobados</option>
              </select>
            </div>
          </div>
          <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Filtrar</button>
        </form>
                  
        <h2 class="text-2xl font-bold text-center">Juicios Evaluativos</h2>

        <!-- Botón y mini pestaña para agregar nuevo juicio -->
        <div class="mb-6">
          <button onclick="toggleFormulario()"  style="background-color: #39A900" class="px-4 py-2 text-white rounded hover:bg-green-700 text-sm">
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
              <button type="submit" style="background-color: #00324D"  class="text-white px-4 py-2 rounded hover:bg-blue-700">Convertir</button>
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
        <button onclick="toggleFormularioCSV()"  style="background-color: #39A900"  class="px-4 py-2  text-white rounded hover:bg-purple-700 text-sm">
          Subir Juicio y Ficha CSV
        </button>

        <div id="formularioJuicioCSV" class="mt-4 p-4 bg-gray-100 rounded-lg border border-gray-300 hidden max-w-md">
          <form action="upload.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
              <label class="block text-sm font-medium">Selecciona un archivo CSV o TXT:</label>
              <input type="file" name="archivo" id="archivo" accept=".txt,.csv" required class="w-full border border-gray-300 p-2 rounded">
            </div>
            <button type="submit" style="background-color: #00324D" class="text-white px-4 py-2 rounded hover:bg-purple-700">Subir archivo</button>
          </form>
        </div>
      </div>

      <script>
        function toggleFormularioCSV() {
          const form = document.getElementById('formularioJuicioCSV');
          form.classList.toggle('hidden');
        }
      </script>

        <?php
        while ($row = $resultado->fetch_assoc()) {
            $idArchivo = $row['id'];
            $paramNombre = $_GET['nombre_' . $idArchivo] ?? '';
            $nombreFiltro = strtoupper(trim($paramNombre));

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
                    echo "<div id='archivo_$idArchivo' class='mb-6 p-4 bg-gray-50 rounded border'>";
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

                    // Cabecera
                    $cabecera = str_getcsv(array_shift($lineas), $delimitador);
                    $cabecera[] = "Porcentaje_TyT";

                    // Calcular porcentajes de aprobados por aprendiz
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
                        if (count($campos) < 8) continue;
                        $nombreCompleto = strtoupper(trim($campos[2] . ' ' . $campos[3]));

                        if (!empty($nombreFiltro) && strpos($nombreCompleto, $nombreFiltro) === false) {
                            continue;
                        }

                        $total = $porcentajes[$nombreCompleto]['total'] ?? 0;
                        $aprobados = $porcentajes[$nombreCompleto]['aprobados'] ?? 0;
                        $porcentaje = $total > 0 ? round(($aprobados / $total) * 100, 2) : 0;

                        if ($aprobadosFiltro == '75' && $porcentaje < 74) {
                            continue;
                        }
                        if ($aprobadosFiltro == '0' && $porcentaje > 75) {
                            continue;
                        }

                        
                        $porcentajeTexto = $porcentaje . "%";
                        echo "<tr class='border-b border-gray-200'>";
                        foreach ($campos as $campo) {
                            echo "<td class='px-4 py-2 border border-gray-200'>" . htmlspecialchars($campo) . "</td>";
                        }
                        if($porcentaje < 75){
                            echo "<td class='px-4 py-2 border border-gray-200 font-bold text-red-600'>$porcentajeTexto No Aprueba a TyT</td>";
                        } else {
                            echo "<td class='px-4 py-2 border border-gray-200 font-bold text-green-600'>$porcentajeTexto Si Aprueba a TyT</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table></div>";
                }
            }
        }
        ?>
      </div>
    </div>
  </main>

  <?php include "../includes/footer.php"; ?>
</div>
<?php if (isset($_GET['ancla'])): ?>
<script>
    window.onload = function () {
        const anclaId = "<?php echo $_GET['ancla']; ?>";
        const elemento = document.getElementById(anclaId);
        if (elemento) {
            elemento.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    };
</script>
<?php endif; ?>



</body>
</html>
