<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/Admin/editProfile.css">
    <title>Edit Profile</title>
</head>
<body>
    <?php 
        include "../../includes/headersLogIn/headerProfile.php";
    ?>
    <div id = "generalDiv">
        <div id="infoAdmin">
            <h1>Información Administrador</h1>
            <div id="infoContent">
                <div class = "formLabel">
                    <img src="../../assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Nombre</label>
                </div>
                <input type="text" placeholder="Yuly Paulín Sáenz" id = "nameInput">

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
                    <img src="../../assets/icons/documents.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Tipo de documento</label>
                </div>
                <select id = "documentType" name = "documentType" type="select" required>
                    <option value = "" disabled selected hidden>Selecciona una opción</option>
                    <option value = "CedulaCiudadania">Cedula de ciudadania</option>
                    <option value = "TarjetaIdentidad">Tarjeta de identidad</option>
                    <option value = "CedulaExtranjeria">Cedula de extranjeria</option>
                </select>

                <div class = "formLabel">
                    <img src="../../assets/icons/seeDocuments.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Número de identificación</label>
                </div>
                <input type="text" placeholder="" id = "idInput">
                
                <button id = "Confirm_button">Confirmar</button>
            </div>
        </div>
    </div>
    <?php include "../../includes/footer.php";?>
</body>
</html>