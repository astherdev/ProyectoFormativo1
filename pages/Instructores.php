<?php
require_once '../db/connection.php';  
require_once '../includes/Header.php'; 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/tables.css">
    <title>Sensli</title>
</head>

<body>

<div class="ficha-container">
  <h2 class="ficha-titulo">INSTRUCTORES</h2>

  <h3 class="subtitulo">Gestion De Personal</h3>

  <div class="tabla-scroll">
    <table class="tabla-ficha">
      <thead>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Tipo de documento</th>
            <th>Numero de Documento</th>
            <th>Cargo</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $fila): ?>
            <tr>
                <td><?= htmlspecialchars($fila['nombres']) ?></td>
                <td><?= htmlspecialchars($fila['apellidos']) ?></td>
                <td><?= htmlspecialchars($fila['Correo']) ?></td>
                <td><?= htmlspecialchars($fila['tipo_documento']) ?></td>
                <td><?= htmlspecialchars($fila['No_documento']) ?></td>
                <td><?= htmlspecialchars($fila['cargo']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
  </div>

  <div class="acciones">
    <button class="btn verde">Crear Instructor</button>
    <button class="btn rojo">Inactivar</button>
    <button class="btn azul">Generar Reporte</button>
    <button class="btn gris">Editar</button>
  </div>
</div>

<?php require_once '../includes/Footer.php'; ?>
</body>
</html>
