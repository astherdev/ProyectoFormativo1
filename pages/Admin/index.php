<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sensli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Ruda:wght@400..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/css/index.css" />
    <link rel="stylesheet" href="../../assets/css/ModePage.css" />
</head>
<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 h-16 flex items-center px-6 shadow-sm">
        <?php include "../../includes/headersLogIn/headerLogIn.php"; ?>
    </header>

    <div class="flex flex-1">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#00324D] text-white flex flex-col justify-between py-6 px-4">
    </aside>

    <button id="backpage" onclick="history.back()" class="mb-4 mx-auto">
        <img id="backImg" src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png" alt="Atrás" class="mx-auto" />
    </button>

    <main class="flex-1 bg-gray-50 flex justify-center items-start">
        <div class="text-center">
        <div id="principal-content" class="mb-6">
            <h1 class="titulo-principal">¡Educación de Calidad<br>Futuro Brillante!</h1>
            <img src="../../assets/img/sena.png" alt="SENA" class="mx-auto" />
        </div>
        <button type="button" class="IS" onclick="window.location.href='../auth/login.php'">
            Iniciar Sesión
        </button>
    </div>
    </main>
</div>
<?php require_once '../../includes/footer.php'; ?>
</body>
</html>
