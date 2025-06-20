<?php 
include "../includes/session.php";
require_once "../db/connection.php";

$mostrar_modal = false; // bandera para saber si mostrar el modal

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $sql = "INSERT INTO instructores 
        (Nombre, Apellidos, No_Telefonico, Contrasena, Correo, Tipo_Documento, No_Documento, Cargo, tipoContrato, fechaIniContrato, fechaFinContrato)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssissss",
        $nombre, $apellidos, $telefono, $contrasena, $correo, $tipo_documento, $no_documento, $cargo, $tipo_contrato, $fecha_ini, $fecha_fin
    );
    if ($stmt->execute()) {
        $mostrar_modal = true;
    } else {
        echo "<script>alert('Error al crear instructor');</script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/createInstructor.css">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title>Create Instructors</title>
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
                                <input type="text" name="telefono" required>

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
                                <select name="cargo" id="cargo" required>
                                    <option value="" disabled selected hidden>Selecciona una opción</option>
                                    <option value="Instructor Transversal">Instructor Transversal</option>
                                    <option value="Instructor Tecnico">Instructor Técnico</option>
                                    <option value="Coordinador">Coordinador</option>
                                </select>
                                <div id="div_fecha_ini">
                                    <div class="formLabel">
                                        <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class="form_icon">
                                        <label>Fecha de Inicio de Contrato</label>
                                    </div>
                                    <input type="date" name="fecha_ini" id="fecha_ini" required>
                                </div>
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
<<<<<<< HEAD
                                <input type="text" name="no_documento" required>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Tipo de contrato</label>
=======
                                <input type="text" placeholder="" name="no_documento" required>
                                <div id = "div_tipo_contrato">
                                    <div class="formLabel">
                                        <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class="form_icon">
                                        <label>Tipo de contrato</label>
                                    </div>
                                    <select name="tipo_contrato" id="tipo_contrato" required>
                                        <option value="" disabled selected hidden>Selecciona una opción</option>
                                        <option value="Planta">Planta</option>
                                        <option value="Contratista">Contratista</option>
                                    </select>
>>>>>>> fc9e38c6d47d68b30ade8b7447d1b30d069dd749
                                </div>

                                <div id="div_fecha_fin">
                                    <div class="formLabel">
                                        <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class="form_icon">
                                        <label>Fecha Fin de Contrato</label>
                                    </div>
                                    <input type="date" name="fecha_fin" id="fecha_fin" required>
                                </div>
                            </div>
                        </div>
                        <button id="Confirm_button" type="submit">Confirmar</button>
                    </form>
                </div>
            </div>

            <!-- Modal -->
            <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-sm w-full">
                    <h2 class="text-xl font-bold mb-4 text-green-700">Instructor creado exitosamente</h2>
                    <button id="modalBtn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Aceptar</button>
                </div>
            </div>
        </main>

        <script src="/Sensli1/ProyectoFormativo/assets/js/ModePage.js"></script>
        <?php include "../includes/footer.php"; ?>

        <?php if ($mostrar_modal): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const modal = document.getElementById("modal");
                const btn = document.getElementById("modalBtn");
                modal.classList.remove("hidden");
                modal.classList.add("flex");

                btn.addEventListener("click", function () {
                    window.location.href = "instructors.php";
                });
            });
        </script>
        <?php endif; ?>
    </div>
    <script>
function actualizarCampos() {
    const cargo = document.getElementById('cargo').value;
    const tipoContrato = document.getElementById('tipo_contrato').value;
    const divTipoContrato = document.getElementById('div_tipo_contrato');
    const divFechaIni = document.getElementById('div_fecha_ini');
    const divFechaFin = document.getElementById('div_fecha_fin');
    const tipoContratoSelect = document.getElementById('tipo_contrato');
    const fechaIni = document.getElementById('fecha_ini');
    const fechaFin = document.getElementById('fecha_fin');

    if (cargo === 'Coordinador') {
        tipoContratoSelect.required = false;
        fechaIni.required = false;
        fechaFin.required = false;
        divTipoContrato.style.display = 'none';
        divFechaIni.style.display = 'none';
        divFechaFin.style.display = 'none';
    } else {
        divTipoContrato.style.display = '';
        // Si es instructor de planta, oculta fechas
        if (tipoContrato === 'Planta') {
            fechaIni.required = false;
            fechaFin.required = false;
            divFechaIni.style.display = 'none';
            divFechaFin.style.display = 'none';
        } else {
            fechaIni.required = true;
            fechaFin.required = true;
            divFechaIni.style.display = '';
            divFechaFin.style.display = '';
        }
        tipoContratoSelect.required = true;
    }
}

// Listeners
document.getElementById('cargo').addEventListener('change', actualizarCampos);
document.getElementById('tipo_contrato').addEventListener('change', actualizarCampos);

// Ejecuta al cargar
window.addEventListener('DOMContentLoaded', actualizarCampos);
</script>
</body>
</html>
