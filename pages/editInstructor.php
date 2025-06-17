<?php 
include "../includes/session.php";
require_once "../db/connection.php";

$datos = [
    'nombre' => '',
    'apellidos' => '',
    'telefono' => '',
    'correo' => '',
    'tipo_documento' => '',
    'no_documento' => '',
    'cargo' => '',
    'tipo_contrato' => '',
    'fecha_ini' => '',
    'fecha_fin' => ''
];

$no_documento = isset($_GET['no_documento']) ? $_GET['no_documento'] : $_POST['no_documento'];

if (isset($_GET['no_documento'])) {
    $no_documento = $_GET['no_documento'];
    $sql = "SELECT * FROM instructores WHERE No_Documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $no_documento);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $datos = [
            'nombre' => $row['Nombre'],
            'apellidos' => $row['Apellidos'],
            'telefono' => $row['No_Telefonico'],
            'correo' => $row['Correo'],
            'tipo_documento' => $row['Tipo_Documento'],
            'no_documento' => $row['No_Documento'],
            'cargo' => $row['Cargo'],
            'tipo_contrato' => $row['tipoContrato'],
            'fecha_ini' => $row['fechaIniContrato'],
            'fecha_fin' => $row['fechaFinContrato']
        ];
    }
    $stmt->close();
}

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

    // UPDATE sin cambiar la contraseña
    $where_documento = isset($_GET['no_documento']) ? $_GET['no_documento'] : $no_documento;
    $sql = "UPDATE instructores SET 
        Nombre=?, Apellidos=?, No_Telefonico=?, Correo=?, Tipo_Documento=?, Cargo=?, tipoContrato=?, fechaIniContrato=?, fechaFinContrato=?
        WHERE No_Documento=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssi",
        $nombre, $apellidos, $telefono, $correo, $tipo_documento, $cargo, $tipo_contrato, $fecha_ini, $fecha_fin, $where_documento
    );
    if ($stmt->execute()) {
        echo "<script>alert('Instructor actualizado exitosamente'); window.location.href='instructors.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error al actualizar instructor');</script>";
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
    <title>Editar Instructor</title>
</head>
<body class="flex min-h-screen">
    <?php include "../includes/sidebar.php"; ?>
    <div class="flex-1 flex flex-col">
        <?php include "../includes/headerLogIn.php"; ?>
        <main>
            <button id="backpage" onclick="history.back()"><img id="backImg" src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png"></button>
            <div id="generalDiv">
                <div id="infoAdminInstructor">
                    <h1>Editar Instructor</h1>
                    <form method="POST" action="">
                        <div id="infoContentInstructor">
                            <div class="columna">
                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Nombre</label>
                                </div>
                                <input type="text" placeholder="Yuly Paulín Sáenz" name="nombre" value="<?php echo $datos['nombre']; ?>" required>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/phone.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Número Telefonico</label>
                                </div>
                                <input type="text" placeholder="" name="telefono" value="<?php echo $datos['telefono']; ?>" required>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Tipo de Documento</label>
                                </div>
                                <select name="tipo_documento" required>
                                    <option value="" disabled hidden>Selecciona una opción</option>
                                    <option value="CC" <?php if($datos['tipo_documento'] == 'CC') echo 'selected'; ?>>Cédula de Ciudadanía</option>
                                    <option value="CE" <?php if($datos['tipo_documento'] == 'CE') echo 'selected'; ?>>Cédula de Extranjería</option>  
                                </select>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Cargo</label>
                                </div>
                                <select name="cargo" required>
                                    <option value="" disabled hidden>Selecciona una opción</option>
                                    <option value="Instructor Transversal" <?php if($datos['cargo'] == 'Instructor Transversal') echo 'selected'; ?>>Instructor Transversal</option>
                                    <option value="Instructor Tecnico" <?php if($datos['cargo'] == 'Instructor Tecnico') echo 'selected'; ?>>Instructor Técnico</option>
                                    <option value="Coordinador" <?php if($datos['cargo'] == 'Coordinador') echo 'selected'; ?>>Coordinador</option>
                                </select>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Fecha de Inicio de Contrato</label>
                                </div>
                                <input type="date" name="fecha_ini" value="<?php echo $datos['fecha_ini']; ?>" required>
                            </div>
                            <div class="columna">
                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Apellidos</label>
                                </div>
                                <input type="text" placeholder="Apellidos" name="apellidos" value="<?php echo $datos['apellidos']; ?>" required>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/mail.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Correo</label>
                                </div>
                                <input type="email" placeholder="@gmail.com" name="correo" value="<?php echo $datos['correo']; ?>" required>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Número de Documento</label>
                                </div>
                                <input type="text" placeholder="" name="no_documento" value="<?php echo $datos['no_documento']; ?>" required readonly>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/prize.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Tipo de contrato</label>
                                </div>
                                <select name="tipo_contrato" required>
                                    <option value="" disabled hidden>Selecciona una opción</option>
                                    <option value="Planta" <?php if($datos['tipo_contrato'] == 'Planta') echo 'selected'; ?>>Planta</option>
                                    <option value="Contratista" <?php if($datos['tipo_contrato'] == 'Contratista') echo 'selected'; ?>>Contratista</option>
                                </select>

                                <div class="formLabel">
                                    <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class="form_icon">
                                    <label>Fecha Fin de Contrato</label>
                                </div>
                                <input type="date" name="fecha_fin" value="<?php echo $datos['fecha_fin']; ?>" required>
                            </div>
                        </div>
                        <button id="Confirm_button" type="submit">Aceptar</button>
                    </form>
                </div>
            </div>
        </main>
        <script src="/Sensli1/ProyectoFormativo/assets/js/ModePage.js"></script>
        <?php include "../includes/footer.php";?>
    </div>
</body>
</html>