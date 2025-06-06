<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/Admin/createInstructor.css">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
    <title>Create Intructors</title>
</head>
<body>
    <?php 

         include '../../includes/headersLogIn/headerLogIn.php';
    ?>
    <div id = "generalDiv">
        <div id="infoAdmin">
            <h1>Crear Instructor</h1>
            <div id="infoContent">
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Nombre</label>
                    </div>
                    <input type="text" placeholder="Yuly Paulín Sáenz" id = "nameInput">
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/phone.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Número Telefonico</label>
                    </div>
                    <input type="text" placeholder="" id = "phoneInput">
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/mail.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Correo</label>
                    </div>
                    <input type="text" placeholder="@gmail.com" id = "mailInput">
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Número de Documento</label>
                    </div>
                    <input type="text" placeholder="" id = "idInput">
                </div>
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Apellidos</label>
                    </div>
                    <input type="text" placeholder="Yuly Paulín Sáenz" id = "nameInput">
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/lock.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Contraseña</label>
                    </div>
                    <input type="text" placeholder="" id = "phoneInput">
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/documents.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Tipo de documento</label>
                    </div>
                    <input type="text" placeholder="@gmail.com" id = "mailInput">
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Cargo</label>
                    </div>
                    <select id = "documentType" name = "documentType" type="select" required>
                        <option value = "" disabled selected hidden>Selecciona una opción</option>
                        <option value = "CedulaCiudadania">Instructor Transversal</option>
                        <option value = "CedulaExtranjeria">Instructor Tecnico</option>
                        <option value = "TarjetaIdentidad">Coordinador</option>
                    </select>
                </div>
            </div>
            <button id = "Confirm_button" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/Admin/instructors.php'">Confirmar</button>
        </div>
    </div>
    <script src="/Sensli1/ProyectoFormativo/assets/js/ModePage.js"></script>
    <?php include "../../includes/footer.php";?>
</body>
</html>