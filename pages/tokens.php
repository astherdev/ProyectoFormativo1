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
            $th = ['Fecha Reporte','Ficha','Código','Versión','Denominación','Estado','Inicio','Fin','Modalidad'];
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
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='11'>No hay fichas registradas.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
    </main>
    <?php include "../includes/footer.php"; ?>
  </div>
</body>
</html>
