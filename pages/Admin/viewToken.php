<?php
  // conexión
  include '../../db/connection.php';

  if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
  }

  // Obtener aprendices
  $sql = "SELECT * FROM juicios_evaluativos";
  $resultado = $conn->query($sql);

  $datos = [];
  if ($resultado && $resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
      $datos[] = $fila;
    }
  }

  // Inactivar ficha
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE fichas SET Estado = 'Inactivo' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    echo 'OK';
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sensli</title>
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/tables.css">
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-gray-100">

<?php include "../../includes/sidebar.php"; ?>

<div class="flex-1 flex flex-col min-h-screen">
  <?php include "../../includes/headersLogIn/headerLogIn.php"; ?>

  <main class="flex-grow">
    <div class="w-full flex justify-start mb-0">
      <button id="backpage" onclick="history.back()">
        <img src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png" alt="Atrás" class="w-5 h-5" />
      </button>
    </div>

    <div class="flex justify-start items-start min-h-screen ml-[0px] mt-16">
      <div class="ficha-container bg-white p-6 shadow-lg rounded-lg w-full max-w-6xl">

        <h2 class="ficha-titulo text-center text-2xl font-bold mb-4">Juicios Evaluativos</h2>

        <div class="flex justify-center gap-5 mb-6">
          <select class="p-2 text-base rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#00324D]">
            <option selected disabled>Ficha 123456 (Diurna)</option>
          </select>
          <select class="p-2 text-base rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#00324D]">
            <option selected disabled>Programa de Formación</option>
          </select>
        </div>

        <div class="tabla-scroll overflow-x-auto mb-6">
          <table class="tabla-ficha w-full text-left border-collapse text-sm text-gray-700">
            <thead class="bg-gray-200">
              <tr>
                <th class="p-2">Tipo de documento</th>
                <th class="p-2">Número de Documento</th>
                <th class="p-2">Nombres</th>
                <th class="p-2">Apellidos</th>
                <th class="p-2">Estado</th>
                <th class="p-2">Competencia</th>
                <th class="p-2">Resultado de aprendizaje</th>
                <th class="p-2">Juicio de evaluación</th>
                <th class="p-2">Fecha y hora de juicio</th>
                <th class="p-2">Funcionario que registró el juicio</th>
                <th class="p-2">Porcentaje Aprobado</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($datos as $fila): ?>
              <tr>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['tipo_documento']) ?></td>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['No_Documento']) ?></td>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['Nombre']) ?></td>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['Apellido']) ?></td>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['Estado']) ?></td>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['Competencia']) ?></td>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['Resultado_Aprendizaje']) ?></td>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['Juicios_Evaluativos']) ?></td>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['Fecha_Hora_Juicio_Evaluado']) ?></td>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['Funcionario_Registro']) ?></td>
                <td class="p-2 border-t"><?= htmlspecialchars($fila['Porcentaje_Aprobado']) ?>%</td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="acciones mt-6 flex justify-center flex-wrap gap-4">
          <button class="btn verde px-6 py-2 rounded-md text-white bg-green-500 hover:bg-green-600">Subir Juicios</button>
          <button id="btn-inactivar" class="btn rojo px-6 py-2 rounded-md text-white bg-red-500 hover:bg-red-600" onclick="inactivarFicha(123)">Eliminar Juicios</button>
          <button class="btn azul px-6 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600">Subir Nuevos Juicios</button>
        </div>

      </div>
    </div>
  </main>

  <?php include "../../includes/Footer.php"; ?>
</div>

<script>
  function inactivarFicha(id) {
    if (confirm('¿Estás seguro de que deseas inactivar esta ficha?')) {
      fetch('inactivar_ficha.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + id
      })
      .then(response => response.text())
      .then(data => {
        if (data === 'OK') {
          alert('Ficha inactivada correctamente.');
          location.reload();
        } else {
          alert('Error al inactivar la ficha.');
        }
      });
    }
  }
</script>

</body>
</html>
