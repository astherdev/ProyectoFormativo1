<?php
// Conexión a la base de datos
include '../../db/connection.php'; // Ajusta la ruta si es necesario

// Verifica si se envió un archivo sin errores
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {

    // Obtener datos del archivo
    $nombreArchivo = $_FILES['archivo']['name'];
    $archivoTmp = $_FILES['archivo']['tmp_name'];
    $tipo = $_FILES['archivo']['type'];
    $tamano = $_FILES['archivo']['size'];

    // Validación del tipo de archivo (solo .txt y .csv)
    $extensionesPermitidas = ['text/plain', 'text/csv', 'application/vnd.ms-excel'];
    if (!in_array($tipo, $extensionesPermitidas)) {
        echo "Tipo de archivo no permitido. Solo se permiten archivos .txt o .csv.";
        exit;
    }

    // Leer el contenido del archivo
    $contenido = file_get_contents($archivoTmp);
    if ($contenido === false) {
        echo "No se pudo leer el archivo.";
        exit;
    }

    // Escapar el contenido para evitar errores SQL
    $contenido = $conn->real_escape_string($contenido);

    // Insertar en la base de datos
    $sql = "INSERT INTO archivos (nombre, contenido) VALUES ('$nombreArchivo', '$contenido')";
    if ($conn->query($sql)) {
        echo "<p>✅ Archivo subido y guardado exitosamente.</p>";
        echo "<p><a href='ver_archivos.php'>Ver archivos subidos</a></p>";
    } else {
        echo "❌ Error al guardar en la base de datos: " . $conn->error;
    }

} else {
    echo "❌ No se recibió ningún archivo válido.";
}
?>