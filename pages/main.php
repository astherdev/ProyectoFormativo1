<?php
require_once '../includes/headersLogIn/headerLogIn.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/main.css">
    <title>Sensli</title>
</head>
<body>
    <button id="backpage" onclick="history.back()"><img id="backImg" src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png"></button>
    <div class="principal-content">
        <h1>Bienvenid@ <span class="admin">[Admin]</span></h1>
        <p>Ahora puedes navegar por el sistema <br> libremente</p>
        <h3 class="titulo-seccion">Fichas activas</h3>
        <div class="contenedor-modulos-scroll">
            <?php foreach ($fichas as $ficha): ?>
            <div class="modulo">
                <h4 class="tipo-ficha"><?= $ficha['tipo'] ?></h4>
                <div class="modulo-header">
                    <img src="/Sensli1/ProyectoFormativo/assets/img/Logo-Sena-Negativo.png" alt="SENA" class="logo-modulo">
                    <div class="datos">
                        <strong><?= $ficha['numero'] ?></strong><br>
                        Instructor de Grupo: <?= $ficha['instructor'] ?><br>
                        Estado: <?= $ficha['estado'] ?><br>
                        Fecha Inicio: <?= $ficha['inicio'] ?><br>
                        Fecha Fin: <?= $ficha['fin'] ?><br>
                        Aprendices: <?= $ficha['cantidad'] ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

<?php require_once '../includes/footer.php'; ?>
