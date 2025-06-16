<?php include "../includes/session.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/editProfile.css">
    <title>Edit Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title>Create Intructors</title>
</head>
<body class="flex min-h-screen">

  <?php include "../includes/sidebar.php"; ?>

  <div class="flex-1 flex flex-col">
    <?php include "../includes/headerLogIn.php"; ?>


    <main>
    <button id="backpage" onclick="history.back()"><img id="backImg" src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png"></button>
    <div id = "generalDiv">
        <div id="infoAdminEditProfile">
            <h1>Información Administrador</h1>
            <div id="infoContent">
                <div class = "formLabel">
                    <img src="../assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Nombre</label>
                </div>
                <input type="text" placeholder="Yuly Paulín Sáenz" id = "nameInput">

                <div class = "formLabel">
                    <img src="../assets/icons/phone.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Número Telefonico</label>
                </div>
                <input type="text" placeholder="" id = "phoneInput">

                <div class = "formLabel">
                    <img src="../assets/icons/mail.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Correo</label>
                </div>
                <input type="text" placeholder="@gmail.com" id = "mailInput">

                <div class = "formLabel">
                    <img src="../assets/icons/documents.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Tipo de documento</label>
                </div>
                <select id = "documentType" name = "documentType" type="select" required>
                    <option value = "" disabled selected hidden>Selecciona una opción</option>
                    <option value = "CedulaCiudadania">Cedula de ciudadania</option>
                    <option value = "TarjetaIdentidad">Tarjeta de identidad</option>
                    <option value = "CedulaExtranjeria">Cedula de extranjeria</option>
                </select>

                <div class = "formLabel">
                    <img src="../assets/icons/seeDocuments.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Número de identificación</label>
                </div>
                <input type="text" placeholder="" id = "idInput">
                
                <button id = "Confirm_button" onclick="history.back()">Confirmar</button>
            </div>
        </div>
    </div>
    </main>
    <script src="/Sensli1/ProyectoFormativo/assets/js/ModePage.js"></script>
    <?php include "../includes/footer.php";?>
</body>
</html>