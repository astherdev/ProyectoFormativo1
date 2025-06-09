<?php
include "../../includes/headersLogIn/headerLogIn.php";
include '../../db/connection.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM fichas WHERE Estado = 'Activo'";
$resultado = $conn->query($sql);

$datos = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/tables.css">
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
  <style>
    .ficha-seleccionada {
      background-color: rgb(165, 0, 0);
    }
    tr {
      cursor: pointer;
    }
  </style>
  <title>Sensli</title>
</head>
<body>
  <div class="flex justify-start items-start min-h-screen ml-[250px] mt-16"> 
    <div class="ficha-container">
      <h2 class="ficha-titulo">Programas De Formación</h2>

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
              <th>Código Ficha</th>
              <th>Versión</th>
              <th>Denominación</th>
              <th>No Ficha</th>
              <th>Jefe de Grupo</th>
              <th>Modalidad</th>
              <th>Estado</th>
              <th>Fecha Inicio</th>
              <th>Fecha Fin</th>
              <th>Aprendices</th>
              <th>Etapa</th>
              <th>Tipo Oferta</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datos as $fila): ?>
              <tr id="ficha-<?= htmlspecialchars($fila['No_Ficha']) ?>" onclick="seleccionarFicha('<?= htmlspecialchars($fila['No_Ficha']) ?>')">
                <td><?= htmlspecialchars($fila['Codigo_Ficha']) ?></td>
                <td><?= htmlspecialchars($fila['Version']) ?></td>
                <td><?= htmlspecialchars($fila['Denominacion']) ?></td>
                <td><?= htmlspecialchars($fila['No_Ficha']) ?></td>
                <td><?= htmlspecialchars($fila['Jefe_Grupo']) ?></td>
                <td><?= htmlspecialchars($fila['Modalidad']) ?></td>
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
        <button class="btn verde" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/Admin/createFichas.php'">Crear Ficha</button>
        <button id="btn-inactivar" class="btn rojo" onclick="inactivarFicha()" disabled>Inactivar Ficha</button>
        <button class="btn gris" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/Admin/viewToken.php'">Ver Fichas</button>
      </div>
    </div>
  </div>

  <script>
    let fichaSeleccionadaId = null;

    function seleccionarFicha(id) {
     
      if (fichaSeleccionadaId === id) {
        // Remover la clase de selección
        document.getElementById('ficha-' + id).classList.remove('ficha-seleccionada');
        fichaSeleccionadaId = null;  // Deseleccionar la ficha
        document.getElementById('btn-inactivar').disabled = true;  // Desactivar el botón
      } else {
        // Deseleccionar la ficha previamente seleccionada
        document.querySelectorAll('.tabla-ficha tr').forEach(row => {
          row.classList.remove('ficha-seleccionada');
        });

        // Seleccionar una nueva ficha
        fichaSeleccionadaId = id;
        document.getElementById('ficha-' + id).classList.add('ficha-seleccionada');
        document.getElementById('btn-inactivar').disabled = false;  // Habilita el botón
      }
    }

    function inactivarFicha() {
      if (!fichaSeleccionadaId) return;

      fetch('../../backend/inactivarFicha.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(fichaSeleccionadaId)
      })
      .then(res => res.text())
      .then(response => {
        if (response === 'OK') {
          document.getElementById('ficha-' + fichaSeleccionadaId).remove();
          fichaSeleccionadaId = null;
          document.getElementById('btn-inactivar').disabled = true;
        } else {
          alert('Error al inactivar la ficha: ' + response);
        }
      });
    }
  </script>

  <?php require_once '../../includes/Footer.php'; ?>
</body>
</html>
