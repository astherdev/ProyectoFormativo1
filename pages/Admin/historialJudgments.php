<?php
include '../../db/connection.php';

$sql = "SELECT * FROM archivos WHERE estado = 'Inactivo' ORDER BY id DESC";
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
  <title>Historial de Juicios Evaluativos</title>
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/tables.css">
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-gray-100">

<?php include "../../includes/sidebar.php"; ?>

<div class="flex-1 flex flex-col min-h-screen">
  <?php include "../../includes/headersLogIn/headerLogIn.php"; ?>

  <main class="flex-grow">
    <div class="w-full flex justify-start mb-0">
      <button id="backpage" onclick="history.back()" class="m-4">
        <img src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png" alt="Atrás" class="w-5 h-5" />
      </button>
    </div>

    <div class="flex justify-center items-start min-h-screen px-4 mt-8">
      <div class="bg-white p-8 shadow-lg rounded-lg w-full max-w-7xl">
        <h2 class="text-center text-2xl font-bold mb-6">Historial de Juicios Evaluativos</h2>

        <?php
        if ($resultado->num_rows === 0) {
            echo "<p class='text-gray-600'>No hay archivos inactivos registrados.</p>";
        }

        while ($row = $resultado->fetch_assoc()) {
            echo "<div class='flex items-center justify-between mb-2'>";
            echo "<h3 class='text-lg font-semibold'>Archivo: " . htmlspecialchars($row['nombre']) . "</h3>";
            echo "<form method='POST' action='reactivarJudgments.php' onsubmit=\"return confirm('¿Deseas reactivar este archivo?');\">";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<button type='submit' class='ml-4 px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700'>Reactivar</button>";
            echo "</form></div>";


            $lineas = explode("\n", $row['contenido']);
            $lineas = array_filter($lineas);

            if (count($lineas) > 0) {
                $delimitador = detectarDelimitador($lineas[0]);

                if ($delimitador) {
                    echo "<div class='overflow-auto max-h-[700px] border border-gray-300 rounded-lg mb-10'>";
                    echo "<table class='min-w-full text-left text-sm text-gray-800 border border-gray-300 table-auto'>";

                    foreach ($lineas as $i => $linea) {
                        $campos = str_getcsv($linea, $delimitador);
                        echo "<tr class='border-b border-gray-200'>";
                        foreach ($campos as $campo) {
                            $campo = htmlspecialchars($campo);
                            echo $i === 0
                                ? "<th class='px-4 py-2 bg-gray-200 border border-gray-300 font-medium text-sm'>$campo</th>"
                                : "<td class='px-4 py-2 border border-gray-200'>$campo</td>";
                        }
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

  <?php include "../../includes/Footer.php"; ?>
</div>

</body>
</html>
