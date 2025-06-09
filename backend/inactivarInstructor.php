<?php
include '../../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['no_documento'])) {
    $no_documento = $_POST['no_documento'];

    // Actualizar el estado del instructor a 'Inactivo' (puedes agregar una columna 'Estado' en la base de datos)
    $sql = "UPDATE instructores SET Estado = 'Inactivo' WHERE No_Documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $no_documento);  // 's' es para string
    if ($stmt->execute()) {
        echo 'OK';  // Si la actualización fue exitosa, devolver 'OK'
    } else {
        echo 'Error al inactivar el instructor';
    }
}
?>
