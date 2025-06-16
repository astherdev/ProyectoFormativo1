<?php
include '../db/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['no_documento'])) {
    $documento = trim($conn->real_escape_string($_POST['no_documento'])); // Trim extra spaces

    // Registrar en log del servidor
    error_log("Documento recibido para inactivar: " . $documento);

    // Verificamos si realmente existe en la base de datos
    $verificar = "SELECT * FROM instructores WHERE No_Documento = '$documento'";
    $verResult = $conn->query($verificar);

    if ($verResult && $verResult->num_rows > 0) {
        $sql = "UPDATE instructores SET Estado = 'Inactivo' WHERE No_Documento = '$documento'";

        if ($conn->query($sql) === TRUE) {
            echo "OK";
        } else {
            echo "Error al actualizar: " . $conn->error;
        }
    } else {
        echo "Instructor no encontrado.";
    }
} else {
    echo "Solicitud inválida.";
}
?>
