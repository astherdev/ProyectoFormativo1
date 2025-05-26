<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <title>View Profile</title>
</head>
<body>
    <?php 
        
        require_once '../../includes/header.php';
    ?>
    <div id="infoAdmin">
        <h1>Información Administrador</h1>
        <div id="infoContent">
            <img src="../../assets/icons/avatar.png" alt="Icono_Usuario">
            <label>Nombre</label>
            <input type="text">
            <div id="infoTitle">
                
            </div>
            <div id="infoTable">

            </div>
            <div id="editButton">

            </div>
        </div>
    </div>

    <?php require_once ('../../includes/footer.php');?>
</body>
</html>