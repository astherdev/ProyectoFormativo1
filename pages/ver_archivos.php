<?php
include '../../db/connection.php';

$sql = "SELECT * FROM archivos ORDER BY id DESC";
$resultado = $conn->query($sql);

function detectarDelimitador($linea) {
    if (strpos($linea, ';') !== false) return ';';
    if (strpos($linea, ',') !== false) return ',';
    if (strpos($linea, "\t") !== false) return "\t";
    return false; // No delimitador encontrado
}

while ($row = $resultado->fetch_assoc()) {
    echo "<h3>Archivo: " . htmlspecialchars($row['nombre']) . "</h3>";

    // Convertir el contenido en líneas
    $lineas = explode("\n", $row['contenido']);
    $lineas = array_filter($lineas); // Eliminar líneas vacías

    if (count($lineas) > 0) {
        $delimitador = detectarDelimitador($lineas[0]);

        if ($delimitador) {
            echo "<div style='overflow-x:auto;'><table border='1' cellpadding='8' cellspacing='0' style='border-collapse: collapse; min-width: 300px;'>";

            foreach ($lineas as $i => $linea) {
                // Usamos str_getcsv para manejar campos con comas dentro de comillas
                $campos = str_getcsv($linea, $delimitador);

                echo "<tr>";
                foreach ($campos as $campo) {
                    $campo = htmlspecialchars($campo);
                    echo $i === 0
                        ? "<th style='background:#f0f0f0;'>$campo</th>" // Primera fila como encabezado
                        : "<td>$campo</td>";
                }
                echo "</tr>";
            }

            echo "</table></div><hr>";
        } else {
            // Mostrar como texto plano si no se detecta delimitador
            echo "<pre>" . htmlspecialchars($row['contenido']) . "</pre><hr>";
        }
    } else {
        echo "<p><em>Archivo vacío</em></p><hr>";
    }
}
?>
