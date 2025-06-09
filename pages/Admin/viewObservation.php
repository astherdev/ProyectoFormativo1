<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/Admin/viewObservation.css">
    <title>Ver Observacion</title>
</head>
<body>
    <?php
        include "../../includes/headersLogIn/headerLogIn.php";
    ?>
    <button id="backpage" onclick="history.back()"><img id="backImg" src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png"></button>
    <div id = "generalDiv">
        <div id="infoAdmin">
            <h1>Ver Observación</h1>
            <div id="infoContent">
                <div class = "formLabel">
                    <label>Seleccionar Observación</label>
                </div>
                <select type="select" id = "selectObservation">
                    <option value = "" disabled selected hidden>Selecciona una opción</option>
                    <option value = "Observation">Ruido en el ambiente</option>
                    <option value = "Observation">Resultados de aprend no entregados</option>
                    <option value = "Observation">3era Oportunidad de test perdida</option>
                </select>

                <div class = "formLabel">
                    <label>Fecha de observación</label>
                </div>
                <div class = "infoObservation">
                    <p>15/06/2025</p>
                </div>

                <div class = "formLabel">
                    <label>Titulo de la Observación</label>
                </div>
                <div id = "observationTitle">
                    <p>Aquí va el Titulo de la Observación</p>
                </div>
                
                <div id = "detailLabel">
                    <label>Detalles de la observación</label>
                </div>
                <div id = "observationDescription">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta nunc massa, a feugiat lorem interdum ut. Proin aliquam urna vitae arcu tincidunt, sit amet vestibulum tellus lacinia. Sed nulla nibh, convallis sit amet purus eget, condimentum porta ligula. Fusce molestie ultricies arcu, ac dignissim sem ultrices at. Suspendisse fermentum diam dolor, vitae molestie risus efficitur vel. Nullam dapibus mollis libero. Praesent ullamcorper ut mauris sed pellentesque. Aenean tempor arcu mi, eleifend tempor lacus interdum id. Nam tristique arcu ut laoreet auctor. Nam at nisi quam. Donec id nibh ligula. Pellentesque volutpat mauris elementum, varius lacus nec, luctus felis. Fusce vulputate egestas sem, rhoncus sollicitudin eros blandit non. Duis sapien lacus, scelerisque quis interdum nec, molestie id augue. Etiam quis placerat tortor.

                    Cras in justo a massa volutpat condimentum. Mauris id consequat est. Nulla ultricies orci id ex suscipit, ac vestibulum massa sodales. Fusce non fringilla est, et mollis mi. Duis faucibus quis massa at varius. Donec mattis nisi consectetur nulla condimentum ultricies. Duis et venenatis sem, ut molestie risus. Nam suscipit erat non neque commodo mollis. Etiam blandit eu magna non sodales. Aenean eget lacinia lorem. Sed a auctor nibh. Aenean eget porta enim.

                    Praesent convallis tortor eget mi vestibulum, nec dapibus magna facilisis. Quisque et nibh vel mauris sollicitudin bibendum et at ante. Nullam imperdiet est a libero tempus, quis maximus augue consequat. Proin ac mi eu lectus semper euismod. Nullam lectus diam, pretium a dui et, imperdiet convallis turpis. Vivamus interdum lectus elit, ac sollicitudin ex feugiat id. Nam viverra ligula nec neque scelerisque, vitae auctor tellus imperdiet. Suspendisse porttitor augue vitae euismod sodales. Vivamus porttitor molestie massa. Sed vitae viverra risus. Integer sit amet odio at dui porta auctor.

                    Nunc sagittis magna in turpis dictum sodales. Duis pellentesque, mi vel malesuada elementum, sapien leo suscipit diam, posuere dapibus ipsum ligula vel nisi. Aenean vel elit vel nibh convallis maximus. Cras metus lectus, tincidunt quis facilisis et, varius tincidunt erat. Suspendisse massa tortor, scelerisque vel efficitur eu, dictum eget ipsum. Mauris mi dolor, posuere vel viverra non, vestibulum nec sem. Nam vel eros eu ligula varius mattis. Cras rhoncus orci sit amet neque porttitor porta. Nam dictum volutpat sapien vitae vulputate. Nunc sodales dolor venenatis purus euismod facilisis. Mauris fermentum neque sit amet tortor cursus volutpat. Phasellus dolor magna, volutpat nec sollicitudin eu, feugiat ac ex.

                    Mauris dictum, tellus id maximus tincidunt, lorem nisl volutpat lacus, sed venenatis orci libero varius purus. Mauris eu nibh ipsum. Vestibulum luctus tempor arcu ac vestibulum. Suspendisse ac sollicitudin neque. Proin commodo leo sit amet augue aliquet, ultricies sollicitudin nisl vehicula. Mauris urna arcu, tempor non gravida sit amet, lacinia mattis ante. Nulla pharetra augue massa, ac malesuada elit euismod in. Donec convallis porttitor tristique. Cras sed vulputate magna, non interdum tellus. Praesent sed euismod nunc. Proin neque risus, facilisis et lorem id, volutpat scelerisque nunc.</p>
                </div>
            </div>
        </div>
    </div>
    <?php include "../../includes/footer.php";?>
</body>
</html>