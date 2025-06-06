<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo//Sensli1/ProyectoFormativo/assets/css/header.css">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo//Sensli1/ProyectoFormativo/assets/css/footer.css">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo//Sensli1/ProyectoFormativo/assets/css/Admin/View_Profile.css">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
    <title>View Profile</title>
</head>
<body>
    <?php 
        
        require_once '/Sensli1/ProyectoFormativo//Sensli1/ProyectoFormativo/includes/headerLogIn.php';
    ?>
    <div id = "generalDiv">
        <div id="infoAdmin">
            <h1>Información Administrador</h1>
            <div id="infoContent">
                <div class = "formLabel">
                    <img src="/Sensli1/ProyectoFormativo//Sensli1/ProyectoFormativo/assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Nombre</label>
                </div>
                <input type="text" placeholder="Yuly Paulín Sáenz" id = "nameInput">

                <div class = "formLabel">
                    <img src="/Sensli1/ProyectoFormativo//Sensli1/ProyectoFormativo/assets/icons/phone.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Número Telefonico</label>
                </div>
                <input type="text" placeholder="" id = "phoneInput">

                <div class = "formLabel">
                    <img src="/Sensli1/ProyectoFormativo//Sensli1/ProyectoFormativo/assets/icons/mail.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Correo</label>
                </div>
                <input type="text" placeholder="@gmail.com" id = "mailInput">

                <div class = "formLabel">
                    <img src="/Sensli1/ProyectoFormativo//Sensli1/ProyectoFormativo/assets/icons/documents.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Tipo de documento</label>
                </div>
                <select id = "documentType" name = "documentType" type="select" required>
                    <option value = "" disabled selected hidden>Selecciona una opción</option>
                    <option value = "CedulaCiudadania">Cedula de ciudadania</option>
                    <option value = "TarjetaIdentidad">Tarjeta de identidad</option>
                    <option value = "CedulaExtranjeria">Cedula de extranjeria</option>
                </select>

                <div class = "formLabel">
                    <img src="/Sensli1/ProyectoFormativo//Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Número de identificación</label>
                </div>
                <input type="text" placeholder="" id = "idInput">
                
                <button id = "Edit_button">Editar</button>
            </div>
        </div>
    </div>

    <?php include "/Sensli1/ProyectoFormativo//Sensli1/ProyectoFormativo/includes/footer.php";?>
    <script src="/Sensli1/ProyectoFormativo/assets/js/ModePage.js"></script>

</body>
</html>