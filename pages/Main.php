<?php
require_once '../db/connection.php';  
require_once '../includes/Header.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Sensli</title>
</head>
<body>
    <H1>Bienvenid@ admin</H1>

        <img src="../assets/img/image.png" alt="SENA">

    <button type="button" class="IS" onclick="window.location.href='login.php'">Iniciar Sesión</button>

</body>
</html>
<?php
require_once '../includes/Footer.php';
?>