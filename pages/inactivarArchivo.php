<?php
include '../../db/connection.php'; // Ajusta la ruta si es diferente

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "UPDATE archivos SET estado = 'Inactivo' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirige de vuelta con mensaje opcional
        header("Location: evaluationJudgments.php?msg=archivo_inactivado");
        exit;
    } else {
        echo "❌ Error al inactivar el archivo: " . $conn->error;
    }
} else {
    echo "❌ Solicitud no válida.";
}
?>