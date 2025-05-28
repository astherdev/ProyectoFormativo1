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
  <h2 class="ficha-titulo">FICHA</h2>

  <div class="ficha-selectores">
    <select>
      <option selected disabled>Ficha 123456 (Diurna)</option>
    </select>
    <select>
      <option selected disabled>Programa de Formación</option>
    </select>
  </div>

  <h3 class="subtitulo">APRENDICES</h3>

  <div class="tabla-scroll">
    <table class="tabla-ficha">
      <thead>
        <tr>
            <th>Tipo de documento</th>
            <th>Número de Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Estado</th>
            <th>Competencia</th>
            <th>Resultado de aprendizaje</th>
            <th>Juicio de evaluación</th>
            <th>Fecha y hora de juicio</th>
            <th>Funcionario que registró el juicio</th>
            <th>Porcentaje Aprobado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $fila): ?>
            <tr>
                <td><?= htmlspecialchars($fila['tipo_documento']) ?></td>
                <td><?= htmlspecialchars($fila['numero_documento']) ?></td>
                <td><?= htmlspecialchars($fila['nombres']) ?></td>
                <td><?= htmlspecialchars($fila['apellidos']) ?></td>
                <td><?= htmlspecialchars($fila['estado']) ?></td>
                <td><?= htmlspecialchars($fila['competencia']) ?></td>
                <td><?= htmlspecialchars($fila['resultado_aprendizaje']) ?></td>
                <td><?= htmlspecialchars($fila['juicio_evaluacion']) ?></td>
                <td><?= htmlspecialchars($fila['fecha_juicio']) ?></td>
                <td><?= htmlspecialchars($fila['funcionario']) ?></td>
                <td><?= htmlspecialchars($fila['porcentaje_aprobado']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
  </div>

  <div class="acciones">
    <button class="btn verde">Crear Ficha</button>
    <button class="btn rojo">Inactivar</button>
    <button class="btn azul">Generar Reporte</button>
    <button class="btn gris">Editar</button>
    <button class="btn verde">Agregar Aprendiz</button>
    <button class="btn gris">Editar Juicios</button>
  </div>
</div>

<?php require_once '../includes/Footer.php'; ?>
</body>
</html>
