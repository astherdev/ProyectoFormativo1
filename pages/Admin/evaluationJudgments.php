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
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .ficha-seleccionada {
       background-color: rgb(173, 0, 0); 
    }
    tr {
      cursor: pointer;
    }
  </style>
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

          <div class="tabla-scroll overflow-x-auto mb-6">
            <table class="tabla-ficha w-full text-left border-collapse text-sm text-gray-700">
              <thead class="bg-gray-200">
                <tr>
                  <th class="p-2">Campo 1</th>
                  <th class="p-2">Campo 2</th>
                  <th class="p-2">Campo 3</th>
                </tr>
              </thead>
              <tbody>
                <!-- Aca va el contenido de los juicios -->
              </tbody>
            </table>
          </div>

          <div class="acciones mt-6 flex justify-center flex-wrap gap-4">
          <button class="btn verde px-6 py-2 rounded-md text-white bg-green-500 hover:bg-green-600" >Subir Juicios</button>
          <button id="btn-inactivar" class="btn rojo px-6 py-2 rounded-md text-white bg-red-500 hover:bg-red-600">Eliminar Juicios</button>
          <button class="btn azul px-6 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600">Subir Nuevos Juicios</button>
        </div>

        </div>
      </div>
    </main>

    <?php include "../../includes/Footer.php"; ?>
  </div>

</body>
</html>
