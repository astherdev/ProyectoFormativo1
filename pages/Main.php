<?php
require_once '../includes/Header.php';
require_once '../db/connection.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Sensli</title>
</head>
<body>
    <!-- <H1>Bienvenid@ <?php echo $admin_name; ?></H1> -->
     <h1>Bienvenid@</h1>


    <button type="button" class="IS" onclick="window.location.href='login.php'">Iniciar Sesión</button>

</body>
</html>
<?php
require_once '../includes/Footer.php';
?>