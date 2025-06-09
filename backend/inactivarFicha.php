<?php
include '../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $noFicha = $_POST['id'];

    $stmt = $conn->prepare("UPDATE fichas SET Estado = 'Inactivo' WHERE No_Ficha = ?");
    $stmt->bind_param("s", $noFicha);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "ERROR: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ERROR: Datos no recibidos";
}
