<?php
include '../db/connection.php';

$sql = "SELECT * FROM archivos WHERE estado = 'Activo' ORDER BY id DESC";
$resultado = $conn->query($sql);

function detectarDelimitador($linea) {
    if (strpos($linea, ';') !== false) return ';';
    if (strpos($linea, ',') !== false) return ',';
    if (strpos($linea, "\t") !== false) return "\t";
    return false;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Juicios Evaluativos</title>
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/tables.css">
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
          <h2 class="text-2xl font-bold text-center">Juicios Evaluativos</h2>
          <a href="historialJudgments.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
            Ver Historial
          </a>
        </div>
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

                    // Mostrar información del encabezado (antes de la tabla)
                    while (count($lineas) > 0) {
                        $lineaActual = array_shift($lineas);

                        if ($lineaActual === null || trim($lineaActual) === '') continue;

                        $campos = str_getcsv($lineaActual, $delimitador);
                        $primerCampo = strtoupper(trim($campos[0] ?? ''));

                        // Detectar si ya estamos en la tabla de datos
                        if (
                            in_array("Nombre", $campos) ||
                            in_array("Nombres", $campos) ||
                            in_array("Juicio de Evaluación", $campos)
                        ) {
                            array_unshift($lineas, $lineaActual); // volver a poner la línea para procesarla luego
                            break;
                        }
                        if (!empty($primerCampo)) {
                            $etiqueta = rtrim($campos[0], " \t\n\r\0\x0B"); // limpia espacios
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

                    // Agrupar por nombre completo
                    $porcentajes = []; // clave: nombre_apellido => ['total'=>x, 'aprobados'=>y]

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
                echo "<p class='text-red-600'>Archivo vacío</p>'";
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
