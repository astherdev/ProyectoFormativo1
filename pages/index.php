<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sensli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Ruda:wght@400..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/index.css" />
    <link rel="stylesheet" href="../assets/css/ModePage.css" />
</head>
<body class="flex min-h-screen">

  <div class="flex-1 flex flex-col">
    <?php include "../includes/headerLogOut.php"; ?>

    <main>
      <div class="w-full flex justify-start mb-0">
        <button id="backpage" onclick="history.back()">
          <img src="../assets/icons/flecha-izquierda.png" alt="Atrás" class="w-5 h-5" />
        </button>
      </div>

      <div id="principal-content" class="mb-6">
        <h1 class="titulo-principal text-3xl font-bold mb-4">
          ¡Educación de Calidad<br>Futuro Brillante!
        </h1>
        <img src="../assets/img/sena.png" alt="SENA" class="mx-auto" />
      </div>

      <button type="button" class="IS" onclick="window.location.href='../auth/login.php'"> Iniciar Sesión </button>
    </main>

    <?php require_once '../includes/footer.php'; ?>
  </div>

</body>

</html>