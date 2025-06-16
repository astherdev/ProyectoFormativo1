<?php
include '../db/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['no_documento'])) {
    $documento = $conn->real_escape_string($_POST['no_documento']);

    $sql = "UPDATE instructores SET Estado = 'Activo' WHERE No_Documento = '$documento'";

    if ($conn->query($sql) === TRUE) {
        echo "OK";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Solicitud inválida.";
}
?>
