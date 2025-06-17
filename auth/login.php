<?php
session_start();
include "../db/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoDocu = $_POST['tipoDocu'];
    $no_documento = $_POST['no_documento'];
    $password = $_POST['password'];

    // Primero intenta buscar en la tabla de admin
    $sql_admin = "SELECT * FROM perfil WHERE Tipo_Documento=? AND No_Documento=? AND Contrasena=?";
    $stmt = $conn->prepare($sql_admin);
    $stmt->bind_param("sss", $tipoDocu, $no_documento, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Validar contraseña
        if ($password == $row['Contrasena']) {
            // Si es admin
            $_SESSION['usuario'] = $row['Correo'];
            $_SESSION['nombre'] = $row['Nombre'];
            $_SESSION['rol'] = 'admin';
            header("Location: ../pages/main.php");
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta');</script>";
        }
    } else {
        // Si no es admin, intenta buscar en instructores
        $sql_inst = "SELECT * FROM instructores WHERE Tipo_Documento=? AND No_Documento=? AND Contrasena=?";
        $stmt2 = $conn->prepare($sql_inst);
        $stmt2->bind_param("sss", $tipoDocu, $no_documento, $password);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($row2 = $result2->fetch_assoc()) {
            // Si es instructor
            $_SESSION['usuario'] = $row2['Correo'];
            $_SESSION['nombre'] = $row2['Nombre'];
            $_SESSION['rol'] = 'instructor';
            header("Location: ../pages/main.php");
            exit();
        } else {
            echo "<script>alert('Datos incorrectos');</script>";
        }
        $stmt2->close();
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title>login page</title>
</head>
<body>
    <div class="container-form">
    <form class="sign-in" action="../auth/login.php" method="POST">
        <h2>Iniciar Sesión</h2>
        <span>Usar correo y contraseña enviados a su gmail</span>
        <div class="container-select">
            <select name="tipoDocu" required>
                <option value="">Tipo de documento</option>
                <option value="TI">Tarjeta de Identidad</option>
                <option value="CC">Cédula de Ciudadanía</option>
                <option value="Nacionalidad">Nacionalidad</option>
                <option value="CE">Cédula de Extranjería</option>
            </select>
        </div>
        <div class="container-input">
            <ion-icon name="mail-unread-outline"></ion-icon>
            <input type="text" name="no_documento" placeholder="Número de documento">
        </div>
        <div class="container-input">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" name="password" placeholder="Password">
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>
    </div>
    <div class="container-welcome">
        <div class="welcome-sign-up welcome">
            <h3>¡Bienvenido!</h3>
            <p>Ingrese sus datos personales para usar todas las funciones del sitio </p>
            <div class="social-networks">
                <ion-icon name="logo-linkedin"></ion-icon>
                <ion-icon name="logo-whatsapp"></ion-icon>
                <ion-icon name="logo-instagram"></ion-icon>
                <ion-icon name="logo-facebook"></ion-icon>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>