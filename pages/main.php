<?php
include '../db/connection.php';

$fichas = [];
$sql = "SELECT No_Ficha AS numero, Jefe_Grupo AS instructor, Estado AS estado, Fecha_Inicio AS inicio, Fecha_Fin AS fin, Aprendices AS cantidad, Denominacion AS tipo 
        FROM fichas 
        WHERE Estado = 'Activo'";

$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $fichas[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENSLI | Fichas Activas</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100">

    <?php include "../includes/sidebar.php"; ?>

    <div class="flex flex-col flex-1">

        <?php include "../includes/headersLogIn/headerLogIn.php"; ?>

        <main >
            <div class="w-full flex justify-start mb-0">
                <button id="backpage" onclick="history.back()">
                <img src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png" alt="Atrás" class="w-5 h-5" />
                </button>
            </div>
            <div class="principal-content">
                <h1 class="text-3xl font-bold mb-2">Bienvenid@ <span class="admin">[Admin]</span></h1>
                <p class="text-lg text-gray-700 mb-4">Ahora puedes navegar por el sistema <br> libremente</p>
                <h3 class="titulo-seccion">Fichas activas</h3>


                <div class="contenedor-modulos-scroll">
                    <?php foreach ($fichas as $ficha): ?>
                        <div class="modulo">
                            <h4 class="tipo-ficha"><?= htmlspecialchars($ficha['tipo']) ?></h4>
                            <div class="modulo-header">
                                <img src="../assets/img/Logo-Sena-Negativo.png" alt="SENA" class="logo-modulo">
                                <div class="datos">
                                    <strong><?= htmlspecialchars($ficha['numero']) ?></strong><br>
                                    Instructor de Grupo: <?= htmlspecialchars($ficha['instructor']) ?><br>
                                    Estado: <?= htmlspecialchars($ficha['estado']) ?><br>
                                    Fecha Inicio: <?= htmlspecialchars($ficha['inicio']) ?><br>
                                    Fecha Fin: <?= htmlspecialchars($ficha['fin']) ?><br>
                                    Aprendices: <?= htmlspecialchars($ficha['cantidad']) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
        <?php include '../includes/Footer.php'; ?>
    </div>
</body>
</html>
