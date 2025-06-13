<?php
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
  <title>Sensli</title>
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/tables.css">
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100">

 
  <?php include "../../includes/sidebar.php"; ?>

 
  <div class="flex-1 flex flex-col">

    <?php include "../../includes/headersLogIn/headerLogIn.php"; ?>


    <main class ="flex-1">
      <div class="w-full flex justify-start mb-0">
          <button id="backpage" onclick="history.back()">
          <img src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png" alt="Atrás" class="w-5 h-5" />
          </button>
      </div>

      <div class="flex justify-start items-start min-h-screen ml-[0px] mt-16">
      <div class="ficha-container bg-white p-6 shadow-lg rounded-lg w-full max-w-6xl">

        <h2 class="ficha-titulo text-center text-2xl font-bold mb-4">FICHAS</h2>
        <h3 class="subtitulo text-center text-lg text-gray-700 mb-6">Gestión de Fichas</h3>

        <div class="ficha-selectores mb-4 text-center">
          <select class="p-2 border border-gray-300 rounded">
            <option selected disabled>Programa De Formación</option>
          </select>
        </div>

        <div class="tabla-scroll overflow-x-auto mb-6">
          <table class="tabla-ficha w-full text-left border-collapse text-sm text-gray-700">
            <thead class="bg-gray-200">
              <tr>
                <th class="p-2">Código Ficha</th>
                <th class="p-2">Versión</th>
                <th class="p-2">Denominación</th>
                <th class="p-2">No Ficha</th>
                <th class="p-2">Jefe de Grupo</th>
                <th class="p-2">Modalidad</th>
                <th class="p-2">Estado</th>
                <th class="p-2">Fecha Inicio</th>
                <th class="p-2">Fecha Fin</th>
                <th class="p-2">Aprendices</th>
                <th class="p-2">Etapa</th>
                <th class="p-2">Tipo Oferta</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($datos as $fila): ?>
                <tr id="ficha-<?= htmlspecialchars($fila['No_Ficha']) ?>" onclick="seleccionarFicha('<?= htmlspecialchars($fila['No_Ficha']) ?>')" >
                  <td class="p-2"><?= htmlspecialchars($fila['Codigo_Ficha']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['Version']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['Denominacion']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['No_Ficha']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['Jefe_Grupo']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['Modalidad']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['Estado']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['Fecha_Inicio']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['Fecha_Fin']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['Aprendices']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['Etapa']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($fila['Tipo_Oferta']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="acciones mt-6 flex justify-center flex-wrap gap-4">
          <button class="btn verde px-6 py-2 rounded-md text-white bg-green-500 hover:bg-green-600" >Crear Ficha</button>
          <button id="btn-inactivar" class="btn rojo px-6 py-2 rounded-md text-white bg-red-500 hover:bg-red-600">Inactivar</button>
          <button class="btn azul px-6 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600">Generar Reporte</button>
          <button class="btn azul px-6 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600">Editar</button>
          <button class="btn verde px-6 py-2 rounded-md text-white bg-green-500 hover:bg-green-600" >Agregar Aprendiz</button>
          <button class="btn azul px-6 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600">Editar Juicios</button>
        </div>

      </div>
    </div>
  </main>



    <?php include "../../includes/footer.php"; ?>
  </div>

  <script>
  let fichaSeleccionadaActual = null;

  function seleccionarFicha(noFicha) {
    const fila = document.getElementById(`ficha-${noFicha}`);

    if (fichaSeleccionadaActual === fila) {
      fila.classList.remove('ficha-seleccionada');
      fichaSeleccionadaActual = null;
    } else {
     
      const filas = document.querySelectorAll('tbody tr');
      filas.forEach(f => f.classList.remove('ficha-seleccionada'));
      
      fila.classList.add('ficha-seleccionada');
      fichaSeleccionadaActual = fila;
    }
  }
</script>

</body>
</html>
