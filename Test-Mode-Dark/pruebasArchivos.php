<?php
include '../db/connection.php'; // conexión a la base de datos

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    $archivoTmp = $_FILES['archivo']['tmp_name'];
    $nombreArchivo = $_FILES['archivo']['name'];
    $contenido = file_get_contents($archivoTmp); // Leer contenido

    $contenido = $conn->real_escape_string($contenido); // Escapar contenido para SQL

    // Insertar en la base de datos
    $sql = "INSERT INTO archivos (nombre, contenido) VALUES ('$nombreArchivo', '$contenido')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Archivo subido correctamente.";
        echo "<a href='ver_archivos.php'>Ver contenido</a>";
    } else {
        echo "Error al guardar en la base de datos: " . $conn->error;
    }

} else {
    echo "Error al subir archivo.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="archivo">Selecciona un archivo plano:</label>
    <input type="file" name="archivo" id="archivo" accept=".txt,.csv" required>
    <button type="submit">Subir archivo</button>
</form>
</body>
</html>

