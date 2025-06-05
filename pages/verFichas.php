<?php
require_once '../includes/headerLogIn.php'; 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/tables.css">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
    <title>Sensli</title>
</head>

<body>

<div class="ficha-container">
  <h2 class="ficha-titulo">Programas De Formacion</h2>

  <div class="ficha-selectores">
    <select>
      <option selected disabled>Programa De Formación</option>
    </select>
  </div>

  <h3 class="subtitulo">Fichas</h3>

  <div class="tabla-scroll">
    <table class="tabla-ficha">
      <thead>
        <tr>
            <th>Numero De Ficha</th>
            <th>Instructor de Grupo</th>
            <th>Estado</th>
            <th>Fecha De Inicio</th>
            <th>Fecha De Fin</th>
            <th>Aprendices</th>
            <th>Etapa</th>
            <th>Tipo De Oferta</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $fila): ?>
            <tr>
                <td><?= htmlspecialchars($fila['No_Ficha']) ?></td>
                <td><?= htmlspecialchars($fila['Jefe_Grupo']) ?></td>
                <td><?= htmlspecialchars($fila['Estado']) ?></td>
                <td><?= htmlspecialchars($fila['Fecha_Inicio']) ?></td>
                <td><?= htmlspecialchars($fila['Fecha_Fin']) ?></td>
                <td><?= htmlspecialchars($fila['Aprendices']) ?></td>
                <td><?= htmlspecialchars($fila['Etapa']) ?></td>
                <td><?= htmlspecialchars($fila['Tipo_Oferta']) ?></td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
  </div>

  <div class="acciones">
    <button class="btn verde" onclick="window.location.href='Crear_Fichas.php'">Crear Ficha</button>
    <button class="btn gris" onclick="window.location.href='fichas.php'">Ver Fichas</button>

  </div>
</div>
<script src="/Sensli1/ProyectoFormativo/assets/js/ModePage.js"></script>
<?php require_once '../includes/Footer.php'; ?>
</body>
</html>
