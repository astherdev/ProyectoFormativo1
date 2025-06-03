<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/Admin/viewApprentice.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title></title>
</head>
<body>
    <?php 
        include "../../includes/headerLogOut.php";
    ?>
    <div id="container">
        <h1>Información del aprendiz</h1>
        <div class="selects">
            <select name="ficha" id="ficha">
                <option value="1">Ficha 1</option>
                <option value="2">Ficha 2</option>
                <option value="3">Ficha 3</option>
            </select>
            <select name="aprendiz" id="aprendiz">
                <option value="1">Aprendiz 1</option>
                <option value="2">Aprendiz 2</option>
                <option value="3">Aprendiz 3</option>
            </select>
        </div>
        <div class="container-input">
            <div class="columna">
                <div class="form-group">
                    <div class="label-group">
                        <label><img src="../../assets/icons/avatar.png" class="form_icon">Nombre</label>
                        <input type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label-group">
                        <label><img src="../../assets/icons/phone.png" class="form_icon">Numero Telefonico</label>
                        <input type="text">
                    </div>
                </div>

                <div class="form-group">
                    <div class="label-group">
                        <label><img src="../../assets/icons/seeDocuments.png" class="form_icon">Tipo de Documento</label>
                        <select name="tipoDocumento" id="tipoDocumento">
                            <option value="CC">Cédula de Ciudadanía</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CE">Cédula de Extranjería</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="label-group">
                        <label><img src="../../assets/icons/documents.png" class="form_icon">Número de Identificación</label>
                        <input type="text">
                    </div>
                </div>
            </div>

            <div class="columna">
                <div class="form-group">
                    <div class="label-group">
                        <label><img src="../../assets/icons/avatar.png" class="form_icon">Apellidos</label>
                        <input type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label-group">
                        <label><img src="../../assets/icons/mail.png" class="form_icon">Correo</label>
                        <input type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label-group">
                        <label><img src="../../assets/icons/encendido.png" class="form_icon">Estado</label>
                        <input type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label-group">
                        <label><img src="../../assets/icons/pasador-de-ubicacion.png" class="form_icon">Etapa de Formación</label>
                        <input type="text">
                    </div>
                </div>
            </div>
        </div>
        <div class="buttonsInfo">
            <button id="editar">Editar</button>
            <button id="generarR">Generar Reporte</button>
        </div>
    </div>
    
    <?php
    include '../../includes/footer.php';
    ?>
</body>
</html>