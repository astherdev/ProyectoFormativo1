<?php 
include "../includes/session.php";
require_once "../db/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $tipo_documento = $_POST['tipo_documento'];
    $no_documento = $_POST['no_documento'];
    $cargo = $_POST['cargo'];
    $tipo_contrato = $_POST['tipo_contrato'];
    $fecha_ini = $_POST['fecha_ini'];
    $fecha_fin = $_POST['fecha_fin'];
    $contrasena = $no_documento;

    // Prepara y ejecuta el INSERT
    $sql = "INSERT INTO instructores 
        (Nombre, Apellidos, No_Telefonico, Contrasena, Correo, Tipo_Documento, No_Documento, Cargo, tipoContrato, fechaIniContrato, fechaFinContrato)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssissss",
        $nombre, $apellidos, $telefono, $contrasena, $correo, $tipo_documento, $no_documento, $cargo, $tipo_contrato, $fecha_ini, $fecha_fin
    );
    if ($stmt->execute()) {
        echo "<script>alert('Instructor creado exitosamente'); window.location.href='instructors.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error al crear instructor');</script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/createInstructor.css">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
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
            <div id="generalDiv">
                <div id="infoAdminInstructor">
                    <h1>Crear Instructor</h1>
                    <form method="POST" action="">
                        <div id="infoContentInstructor">
                            <div class="columna">
                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Nombre</label>
                                </div>
                                <input type="text" placeholder="Yuly Paulín Sáenz" name="nombre" required>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/phone.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Número Telefonico</label>
                                </div>
                                <input type="text" placeholder="" name="telefono" required>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Tipo de Documento</label>
                                </div>
                                <select name="tipo_documento" required>
                                    <option value="" disabled selected hidden>Selecciona una opción</option>
                                    <option value="CC">Cédula de Ciudadanía</option>
                                    <option value="CE">Cédula de Extranjería</option>  
                                </select>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Cargo</label>
                                </div>
                                <select name="cargo" required>
                                    <option value="" disabled selected hidden>Selecciona una opción</option>
                                    <option value="Instructor Transversal">Instructor Transversal</option>
                                    <option value="Instructor Tecnico">Instructor Técnico</option>
                                    <option value="Coordinador">Coordinador</option>
                                </select>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Fecha de Inicio de Contrato</label>
                                </div>
                                <input type="date" name="fecha_ini" required>
                            </div>
                            <div class="columna">
                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Apellidos</label>
                                </div>
                                <input type="text" placeholder="Apellidos" name="apellidos" required>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/mail.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Correo</label>
                                </div>
                                <input type="email" placeholder="@gmail.com" name="correo" required>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Número de Documento</label>
                                </div>
                                <input type="text" placeholder="" name="no_documento" required>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Tipo de contrato</label>
                                </div>
                                <select name="tipo_contrato" required>
                                    <option value="" disabled selected hidden>Selecciona una opción</option>
                                    <option value="Planta">Planta</option>
                                    <option value="Contratista">Contratista</option>
                                </select>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Fecha Fin de Contrato</label>
                                </div>
                                <input type="date" name="fecha_fin" required>
                            </div>
                        </div>
                        <button id="Confirm_button" type="submit">Confirmar</button>
                    </form>
                </div>
            </div>
        </main>
        <script src="/Sensli1/ProyectoFormativo/assets/js/ModePage.js"></script>
        <?php include "../includes/footer.php";?>
    </div>
</body>
</html>