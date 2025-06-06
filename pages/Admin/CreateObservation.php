<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/Admin/CreateObservation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title></title>
</head>
<body>
    <?php
    include '../../includes/headersLogIn/headerLogIn.php';
    ?>
    <h1>Crear Observaciones</h1>
    <div class="Principal-cont">
        
            <div class="selects">
                <select name="ficha" id="ficha">
                    <option value="1">2895664(diurna)</option>
                    <option value="2">4633742(Nocturna)</option>
                    <option value="3">0937658(tarde)</option>
                </select>
                <select name="aprendiz" id="aprendiz">
                    <option value="1">Luis Carlos Hernandez Henao</option>
                    <option value="2">Johan Sebastian Mina</option>
                    <option value="3">Isaac Echeverri Garcia</option>
                </select>
            </div>
              <h5>Fecha de Observacion</h5>
            <div class="selects">
                <input type="date" id = "tokenEnd">
            </div>
            <h5>Asunto de la Observacion</h5>
            <div class="selects">
                <input name="observation-tittle" id="observation-tittle" placeholder="Ingrese elasunto de la observacion">
                </select>
            </div>
            <h5>Detalle de la Observacion</h5>
            <div class="selects">
                <textarea name="observation" id="observation" placeholder="Ingrese la descripción de la observación..."></textarea>
                </select>
            </div>
                <button class="confirm" onclick = "window.location.href = '/Sensli1/ProyectoFormativo/pages/Admin/observations'"> Confirmar</button>
    </div>
     <?php
    include '../../includes/footer.php';
    ?>
</body>
</html>