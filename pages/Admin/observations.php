<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/Admin/observations.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title></title>
</head>
<body>
    <?php

    include '../../includes/headersLogIn/headerLogIn.php';

    ?>
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
    <div id="containerObservations">
        <div id="leftContent">
            <h2 id="nameApprentice">Isaac Echeverrinche Garcia Lopez 1</h2>
            <div id="leftInformation">
                <p class="infoApprentice">
                    <span class="label">Correo: Ejemplo@gmail.com </span>
                    <span class="label">Tipo de documento: Cedula de ciudadania </span>
                    <span class="label">Número de identificación: 123456789 </span>
                    <span class="label">Número de teléfono: 1234567890 </span>
                </p>
            </div>
        </div>
        <div id="separationLine"></div>
        <div id="rightContent">
            <div id="rightTitle">
                <h2>Observaciones</h2>
            </div>
            <div id="rightInformation">
                <p class="infoObservation">Fecha: 2023-10-02 &nbsp;&nbsp;&nbsp;&nbsp; Descripción: Esta es otra observación de ejemplo.</p>
                <p class="infoObservation">Fecha: 2023-10-02 &nbsp;&nbsp;&nbsp;&nbsp; Descripción: Esta es otra observación de ejemplo.</p>
                <p class="infoObservation">Fecha: 2023-10-01 &nbsp;&nbsp;&nbsp;&nbsp; Descripción: Esta es una observación de ejemplo</p>
                <p class="infoObservation">Fecha: 2023-10-02 &nbsp;&nbsp;&nbsp;&nbsp; Descripción: Esta es otra observación de ejemplo.</p>
                <p class="infoObservation">Fecha: 2023-10-02 &nbsp;&nbsp;&nbsp;&nbsp; Descripción: Esta es otra observación de ejemplo.</p>
                <p class="infoObservation">Fecha: 2023-10-01 &nbsp;&nbsp;&nbsp;&nbsp; Descripción: Esta es una observación de ejemplo</p>
                <p class="infoObservation">Fecha: 2023-10-02 &nbsp;&nbsp;&nbsp;&nbsp; Descripción: Esta es otra observación de ejemplo.</p>
                <p class="infoObservation">Fecha: 2023-10-02 &nbsp;&nbsp;&nbsp;&nbsp; Descripción: Esta es otra observación de ejemplo.</p>
                
            </div>
            <div id="rightButton">
                <button id="addObservationButton" onclick="window.location.href = '/Sensli1/ProyectoFormativo/pages/Admin/CreateObservation'">Añadir Observación</button>
            </div>
    </div>
    <?php
    include '../../includes/footer.php';
    ?>
</body>
</html>