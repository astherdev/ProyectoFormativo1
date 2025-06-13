<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/Admin/createInstructor.css">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title>Create Intructors</title>
</head>
<body class="flex min-h-screen">

    <?php include "../../includes/sidebar.php"; ?>

    <div class="flex-1 flex flex-col">
    <?php include "../../includes/headersLogIn/headerLogIn.php"; ?>


    <main>
    <button id="backpage" onclick="history.back()"><img id="backImg" src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png"></button>
    <div id = "generalDiv">
        <div id="infoAdminInstructor">
            <h1>Crear Instructor</h1>
            <div id="infoContentInstructor">
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
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Tipo de Documento</label>
                    </div>
                    <select id = "documentType" name = "documentType" type="select" required>
                        <option value = "" disabled selected hidden>Selecciona una opción</option>
                        <option value = "CedulaCiudadania">Cedula de Ciudadania</option>
                        <option value = "CedulaExtranjeria">Cedula de Extrangería</option>  
                    </select>

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

                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Fecha de Inicio de Contrato</label>
                    </div>
                    <input type="date" placeholder="" id = "idInput">

                </div>
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Apellidos</label>
                    </div>
                    <input type="text" placeholder="Yuly Paulín Sáenz" id = "nameInput">
    

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

                    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Tipo de contrato</label>
                    </div>
                    <select id = "documentType" name = "documentType" type="select" required>
                        <option value = "" disabled selected hidden>Selecciona una opción</option>
                        <option value = "planta">Planta</option>
                    </select>


                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Fecha Fin de Contrato</label>
                    </div>
                    <input type="date" placeholder="" id = "idInput">
                </div>
            </div>
            <button id = "Confirm_button" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/Admin/instructors.php'">Confirmar</button>
        </div>
    </div>
    </main>
    <script src="/Sensli1/ProyectoFormativo/assets/js/ModePage.js"></script>
    <?php include "../../includes/footer.php";?>
</body>
</html>