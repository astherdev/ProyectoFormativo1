<?php
include '../db/connection.php';

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

// Mostrar mensaje por GET (Post/Redirect/Get)
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo'])) {
    $archivo = $_FILES['archivo']['tmp_name'];

    // Sinónimos ampliados para mayor robustez
    $sinonimos = [
        'fecha_del_reporte' => 'fecha_del_reporte',
        'fecha del reporte' => 'fecha_del_reporte',
        'ficha_de_caracterizacion' => 'ficha_de_caracterizacion',
        'ficha de caracterizacion' => 'ficha_de_caracterizacion',
        'codigo' => 'codigo',
        'cogigo' => 'codigo', // Corrige errores comunes
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
        // Solo procesar las primeras 20 filas para evitar leer los datos de estudiantes
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

        // Verificar campos requeridos
        $faltantes = array_diff($requeridos, array_keys($datos_transformados));

        if (empty($faltantes)) {
            // Procesar valores finales
            $valores = [];
            foreach ($requeridos as $campo) {
                $valores[$campo] = isset($datos_transformados[$campo]) ? $datos_transformados[$campo] : '';
            }

            $fecha_reporte = convertir_fecha($valores['fecha_del_reporte']);
            $ficha_caracterizacion = (int) $valores['ficha_de_caracterizacion'];
            $codigo = (int) $valores['codigo'];
            $version = (int) $valores['version'];
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
                // PRG: Redirigir para evitar doble inserción por recarga
                header("Location: ".$_SERVER['PHP_SELF']."?msg=ok");
                exit;
            } else {
                header("Location: ".$_SERVER['PHP_SELF']."?msg=error");
                exit;
            }
        } else {
            // Pasar faltantes por GET
            header("Location: ".$_SERVER['PHP_SELF']."?msg=faltan&faltantes=" . urlencode(implode(', ', $faltantes)));
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
  <meta charset="UTF-8">
  <title>Gestión de Fichas</title>
    <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/style.css">
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/tokens.css">
  <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
</head>
<body class="body-container">
  <?php include "../includes/sidebar.php"; ?>
  <div class="main-container">
    <?php include "../includes/headerLogIn.php"; ?>
    <main class="content-area">
      <button id="backpage" onclick="history.back()" class="m-4">
        <img src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png" alt="Atrás" class="w-5 h-5" />
      </button>
      <button id="toggle" onclick="toggleForm()" class="button-cargar">
        Cargar Ficha de Caracterización
      </button>


      <div id="formSection" style="display: none;">
        <form class="form-container" method="post" enctype="multipart/form-data">
          <label class="label">Selecciona el archivo CSV :</label>
          <input type="file" name="archivo" accept=".csv" required class="input-file" />
          <button type="submit" class="submit-button">Subir</button>
          <?= $mensaje ?>
        </form>
      </div>

      <script>
        function toggleForm() {
          const form = document.getElementById('formSection');
          form.style.display = (form.style.display === 'none') ? 'block' : 'none';
        }
      </script>


      <h2 class="subtitle">Fichas Registradas</h2>
      <div class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <?php
              $th = ['Fecha Reporte','Ficha','Código','Versión','Denominación','Estado','Inicio','Fin','Modalidad','Regional','Centro'];
              foreach ($th as $h) echo "<th>$h</th>";
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $res = $conn->query("SELECT * FROM fichas ORDER BY fecha_registro DESC");
            if ($res && $res->num_rows) {
              while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['fecha_reporte']}</td>";
                echo "<td>{$row['ficha_caracterizacion']}</td>";
                echo "<td>{$row['codigo']}</td>";
                echo "<td>{$row['version']}</td>";
                echo "<td>{$row['denominacion']}</td>";
                echo "<td>{$row['estado']}</td>";
                echo "<td>{$row['fecha_inicio']}</td>";
                echo "<td>{$row['fecha_fin']}</td>";
                echo "<td>{$row['modalidad']}</td>";
                echo "<td>{$row['regional']}</td>";
                echo "<td>{$row['centro_formacion']}</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='11'>No hay fichas registradas.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>
    <?php include "../includes/footer.php"; ?>
  </div>
</body>
</html>
