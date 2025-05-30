<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title>Sensli</title>
</head>

<body>

<div id="header">
    <div id="left-header">
        <img id="logoSena" src="/Sensli/ProyectoFormativo/assets/img/Logo-Sena-Negativo.png" alt="Logo" class="logo">
        <div id="titulo-header">
            <h2>Inicio</h2>
        </div>
    </div>

    <div id="right-header">
        <!-- Botón hamburguesa -->
        <div class="menu-toggle" id="menu-toggle">
            <img src="/Sensli/ProyectoFormativo/assets/img/hamburger-icon.png" alt="Abrir menú" class="icon icon-hamburger">
            <img src="/Sensli/ProyectoFormativo/assets/img/close-icon.png" alt="Cerrar menú" class="icon icon-close">
        </div>

        <!-- Imagen usuario -->
        <img id="user-img" src="/Sensli/ProyectoFormativo/assets/img/usuario.png" alt="Usuario">
    </div>

    <!-- Menú desplegable -->
    <nav class="menu" id="menu">
        <ul>
            <li><a href="/Sensli/ProyectoFormativo/pages/Main.php">Inicio</a></li>
            <li><a href="/Sensli/ProyectoFormativo/pages/Ver_fichas.php">Fichas</a></li>
            <li><a href="/Sensli/ProyectoFormativo/pages/Instructores.php">Instructores</a></li>
            <li><a href="/Sensli/ProyectoFormativo/auth/Index.php">Cerrar Sesion</a></li>
        </ul>
    </nav>
</div>


<!-- Asegura que el JS se cargue después del DOM -->
<script src="/Sensli/ProyectoFormativo/assets/js/hambur_menu.js" defer></script>

</body>
</html>
