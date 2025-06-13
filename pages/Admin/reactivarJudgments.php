<?php
include '../../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $sql = "UPDATE archivos SET estado = 'Activo' WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: historialJudgments.php");
        exit();
    } else {
        echo "Error al reactivar el archivo: " . $conn->error;
    }
} else {
    header("Location: historialJudgments.php");
    exit();
}
?>
