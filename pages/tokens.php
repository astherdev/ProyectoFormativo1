<?php
include "../includes/session.php";
include '../db/connection.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Fichas</title>
    <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/tokens.css">
  <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">
    <?php include '../includes/sidebar.php'; ?>
    <div class="flex-1 flex flex-col min-h-screen">
        <?php include '../includes/headerLogIn.php'; ?>
    <main class="content-area">
      <button id="backpage" onclick="history.back()" class="m-4">
        <img src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png" alt="Atrás" class="w-5 h-5" />
      </button>
      <h2 class="subtitle">Fichas Registradas</h2>
      <div class="table-container">
      <table class="data-table">
        <thead>
          <tr>
            <?php
            $th = ['Fecha Reporte','Ficha','Código','Versión','Denominación','Estado','Inicio','Fin','Modalidad', 'Tipo de Oferta', 'Horario','Jefe De Grupo'];
            foreach ($th as $h) echo "<th>$h</th>";
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = $conn->query("SELECT * FROM fichas ORDER BY fecha_registro DESC");
          if ($res && $res->num_rows) {
            while ($row = $res->fetch_assoc()) {
              echo "<tr class='cursor-pointer hover:bg-gray-100' onclick=\"window.location.href='evaluationJudgments.php?ficha={$row['ficha_caracterizacion']}'\">";
              echo "<td>{$row['fecha_reporte']}</td>";
              echo "<td>{$row['ficha_caracterizacion']}</td>";
              echo "<td>{$row['codigo']}</td>";
              echo "<td>{$row['version']}</td>";
              echo "<td>{$row['denominacion']}</td>";
              echo "<td>{$row['estado']}</td>";
              echo "<td>{$row['fecha_inicio']}</td>";
              echo "<td>{$row['fecha_fin']}</td>";
              echo "<td>{$row['modalidad']}</td>";
              echo "<td>{$row['tipo_oferta']}</td>";
              echo "<td>{$row['horario']}</td>";
              echo "<td>{$row['jefe_grupo']}</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='11'>No hay fichas registradas.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
    <?php
// Procesar formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ficha_id'])) {
    $ficha_id = $conn->real_escape_string($_POST['ficha_id']);
    $tipo_oferta = $conn->real_escape_string($_POST['tipo_oferta']);
    $horario = $conn->real_escape_string($_POST['horario']);
    

    // Solo si se recibió jefe_grupo
    if (isset($_POST['jefe_grupo']) && !empty($_POST['jefe_grupo'])) {
        $jefe_grupo = $conn->real_escape_string($_POST['jefe_grupo']);
    } else {
        $jefe_grupo = null; // o puedes asignar un valor por defecto
    }

    $sql = "UPDATE fichas SET tipo_oferta = '$tipo_oferta', horario = '$horario'";
    if ($jefe_grupo !== null) {
        $sql .= ", jefe_grupo = '$jefe_grupo'";
    }
    $sql .= " WHERE ficha_caracterizacion = '$ficha_id'";

    $conn->query($sql);
}

?>

<h3 class="text-xl font-semibold mt-6 mb-2">Actualizar Ficha</h3>
<form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-lg">
  <div class="mb-4">
    <label for="ficha_id" class="block text-gray-700 font-bold mb-2">Ficha:</label>
    <select name="ficha_id" id="ficha_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
      <?php
      $fichas = $conn->query("SELECT ficha_caracterizacion FROM fichas");
      while ($row = $fichas->fetch_assoc()) {
        echo "<option value='{$row['ficha_caracterizacion']}'>{$row['ficha_caracterizacion']}</option>";
      }
      ?>
    </select>
  </div>

  <div class="mb-4">
    <label for="tipo_oferta" class="block text-gray-700 font-bold mb-2">Tipo de Oferta:</label>
    <select name="tipo_oferta" id="tipo_oferta" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
      <option value="Abierta">Abierta</option>
      <option value="Cerrada">Cerrada</option>
    </select>
  </div>

  <div class="mb-4">
    <label for="horario" class="block text-gray-700 font-bold mb-2">Horario:</label>
    <select name="horario" id="horario" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
      <option value="Diurna">Diurna</option>
      <option value="Mixta">Mixta</option>
      <option value="Nocturna">Nocturna</option>
    </select>
  </div>

  <!-- Para cuando funcione lo de asignar instructores a fichas -->
<div class="mb-6">
  <label for="jefe_grupo" class="block text-gray-700 font-bold mb-2">Jefe de Grupo:</label>
  <select name="jefe_grupo" id="jefe_grupo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    <?php
    $jefes = $conn->query("SELECT nombre, Apellidos FROM instructores");
    if ($jefes && $jefes->num_rows > 0) {
        while ($jefe = $jefes->fetch_assoc()) {
            $nombreCompleto = htmlspecialchars($jefe['nombre'] . ' ' . $jefe['Apellidos']);
            echo "<option value=\"$nombreCompleto\">$nombreCompleto</option>";
        }
    } else {
        echo "<option value=\"\" disabled selected>No hay instructores disponibles</option>";
    }
    ?>
  </select>
</div>

<div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Guardar Cambios
        </button>
      </div>
    </form>


    </main>
    <?php include "../includes/footer.php"; ?>
  </div>
</body>
</html>
