<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/editInstructor.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title>Edit Instructor</title>
</head>
<body class="flex min-h-screen">

  <?php include "../includes/sidebar.php"; ?>

  <div class="flex-1 flex flex-col">
    <?php include "../includes/headerLogIn.php"; ?>


    <main>
    <button id="backpage" onclick="history.back()"><img id="backImg" src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png"></button>
    <div id = "generalDiv">
        <div id="infoAdminEditInstructor">
            <h1>Editar Instructor</h1>
            <div id="infoContentInstructorEdit">
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="../assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Nombre</label>
                    </div>
                    <input type="text" placeholder="Yuly" id = "nameInput">
    
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
                        <img src="../assets/icons/seeDocuments.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Número de Documento</label>
                    </div>
                    <input type="text" placeholder="" id = "idInput">
                </div>
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="../assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Apellidos</label>
                    </div>
                    <input type="text" placeholder="Paulín Sáenz" id = "lastNameInput">
    
                    <div class = "formLabel">
                        <img src="../assets/icons/documents.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Tipo de documento</label>
                    </div>
                    <input type="text" placeholder="@gmail.com" id = "documentTypeInput">
    
                    <div class = "formLabel">
                        <img src="../assets/icons/prize.png" alt="Icono_Usuario" class = "form_icon">
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
            <button id = "Confirm_button" onclick="window.location.href = '/Sensli1/ProyectoFormativo/pages/instructors.php'">Aceptar</button>
        </div>
    </div>
    </main>
    <?php include "../includes/footer.php";?>
</body>
</html>