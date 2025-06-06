<?php
    include "../../includes/headersLogIn/headerLogIn.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/ModePage.css">
    <title>Sensli</title>
</head>
<body>
    <div id="principal-content">
        <h1>¡Educación de Calidad<br>Futuro Brillante!</h1>
        <img src="../../assets/img/sena.png" alt="SENA">
    </div>
    <button type="button" class="IS" onclick="window.location.href='../auth/login.php'">
        Iniciar Sesión
    </button>
    <script src="../assets/js/ModePage.js"></script>
</body>
</html>
<?php
    require_once '../../includes/Footer.php';
?>
