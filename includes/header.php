<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title></title>
</head>

<body>

<div id="header">
    <img id="logoSena" src="../assets/img/Logo-Sena-Negativo.png" alt="Logo" class="logo">
    
    <div id="titulo-header">
        <h2>Inicio</h2>
    </div>

    <!-- CUANDO SE HAGA EL BACKEND, HACER QUE ESTE MENU NO APAREZCA EN EL INICIO YA Q SOLO SE MUESTRA CUANDO INICIA SESION -->

    <!-- Botón hamburguesa debe ir ANTES que los links -->
    <div class="menu-toggle" id="menu-toggle">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>


    <div id="links-header">
        <a href="#" class="header_links"></a>
        <a href="#" class="header_links"></a>
    </div>

    <!-- Menú desplegable -->
    <nav class="menu" id="menu">
        <ul>
            <li><a href="../pages/Main.php">Inicio</a></li>
            <li><a href="../pages/fichas.php">Fichas</a></li>
            <li><a href="../pages/Instructores.php">Instructores</a></li>
            <li><a href="../pages/Index.php">Cerrar Sesion</a></li>
        </ul>
    </nav>
</div>


<!-- Asegura que el JS se cargue después del DOM -->
<script src="../assets/js/hambur_menu.js" defer></script>

</body>
</html>
