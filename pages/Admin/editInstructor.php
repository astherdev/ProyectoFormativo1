<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/Admin/editInstructor.css">
    <title>Create Intructors</title>
</head>
<body>
    <?php
        include '../../includes/headersLogIn/headerInstructors.php';
    ?>
    <div id = "generalDiv">
        <div id="infoAdmin">
            <h1>Editar Instructor</h1>
            <div id="infoContent">
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="../../assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Nombre</label>
                    </div>
                    <input type="text" placeholder="Yuly" id = "nameInput">
    
                    <div class = "formLabel">
                        <img src="../../assets/icons/phone.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Número Telefonico</label>
                    </div>
                    <input type="text" placeholder="" id = "phoneInput">
    
                    <div class = "formLabel">
                        <img src="../../assets/icons/mail.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Correo</label>
                    </div>
                    <input type="text" placeholder="@gmail.com" id = "mailInput">
    
                    <div class = "formLabel">
                        <img src="../../assets/icons/seeDocuments.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Número de Documento</label>
                    </div>
                    <input type="text" placeholder="" id = "idInput">
                </div>
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="../../assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Apellidos</label>
                    </div>
                    <input type="text" placeholder="Paulín Sáenz" id = "lastNameInput">
    
                    <div class = "formLabel">
                        <img src="../../assets/icons/documents.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Tipo de documento</label>
                    </div>
                    <input type="text" placeholder="@gmail.com" id = "documentTypeInput">
    
                    <div class = "formLabel">
                        <img src="../../assets/icons/prize.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Cargo</label>
                    </div>
                    <select id = "selectedCharge" name = "selectedCharge" type="select" required>
                        <option value = "" disabled selected hidden>Selecciona una opción</option>
                        <option value = "InstructorTransversal">Instructor Transversal</option>
                        <option value = "InstructorTecnico">Instructor Tecnico</option>
                        <option value = "Coordinador">Coordinador</option>
                    </select>
                </div>
            </div>
            <button id = "Confirm_button">Aceptar</button>
        </div>
    </div>
    <?php include "../../includes/footer.php";?>
</body>
</html>