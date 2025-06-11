<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/Admin/viewApprentice.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title>View Apprentice</title>
</head>
<body class="flex min-h-screen">

    <?php include "../../includes/sidebar.php"; ?>

    <div class="flex-1 flex flex-col">
        <?php include "../../includes/headersLogIn/headerLogIn.php"; ?>

        <main>
            <button id="backpage" onclick="history.back()"><img id="backImg" src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png"></button>
            <div id="viewApprentice-container">
                <h1 class="viewApprentice-title">Información del aprendiz</h1>

                <div class="viewApprentice-selects">
                    <select id="viewApprentice-ficha">
                        <option value="1">Ficha 1</option>
                        <option value="2">Ficha 2</option>
                        <option value="3">Ficha 3</option>
                    </select>
                    <select id="viewApprentice-aprendiz">
                        <option value="1">Aprendiz 1</option>
                        <option value="2">Aprendiz 2</option>
                        <option value="3">Aprendiz 3</option>
                    </select>
                </div>

                <div class="viewApprentice-inputs">
                    <div class="viewApprentice-column">
                        <div class="viewApprentice-group">
                            <label for="nombre"><img src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png" class="viewApprentice-icon">Nombre</label>
                            <input type="text" id="nombre" class="viewApprentice-input">
                        </div>
                        <div class="viewApprentice-group">
                            <label for="telefono"><img src="/Sensli1/ProyectoFormativo/assets/icons/phone.png" class="viewApprentice-icon">Número Telefónico</label>
                            <input type="text" id="telefono" class="viewApprentice-input">
                        </div>
                        <div class="viewApprentice-group">
                            <label for="tipoDocumento"><img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" class="viewApprentice-icon">Tipo de Documento</label>
                            <select id="tipoDocumento" class="viewApprentice-input">
                                <option value="CC">Cédula de Ciudadanía</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CE">Cédula de Extranjería</option>
                            </select>
                        </div>
                        <div class="viewApprentice-group">
                            <label for="documento"><img src="/Sensli1/ProyectoFormativo/assets/icons/documents.png" class="viewApprentice-icon">Número de Identificación</label>
                            <input type="text" id="documento" class="viewApprentice-input">
                        </div>
                    </div>

                    <div class="viewApprentice-column">
                        <div class="viewApprentice-group">
                            <label for="apellidos"><img src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png" class="viewApprentice-icon">Apellidos</label>
                            <input type="text" id="apellidos" class="viewApprentice-input">
                        </div>
                        <div class="viewApprentice-group">
                            <label for="correo"><img src="/Sensli1/ProyectoFormativo/assets/icons/mail.png" class="viewApprentice-icon">Correo</label>
                            <input type="text" id="correo" class="viewApprentice-input">
                        </div>
                        <div class="viewApprentice-group">
                            <label for="estado"><img src="/Sensli1/ProyectoFormativo/assets/icons/encendido.png" class="viewApprentice-icon">Estado</label>
                            <input type="text" id="estado" class="viewApprentice-input">
                        </div>
                        <div class="viewApprentice-group">
                            <label for="etapa"><img src="/Sensli1/ProyectoFormativo/assets/icons/pasador-de-ubicacion.png" class="viewApprentice-icon">Etapa de Formación</label>
                            <input type="text" id="etapa" class="viewApprentice-input">
                        </div>
                    </div>
                </div>

            <div class="viewApprentice-buttons">
                <button onclick="window.location.href='../pages/Admin/editApprentice.php'">Editar</button>
                <button id="viewApprentice-report">Generar Reporte</button>
            </div>
        </div>
    </main>

    <script src="/Sensli1/ProyectoFormativo/assets/js/ModePage.js"></script>
    <?php include '../../includes/footer.php'; ?>
</div>

</body>
</html>