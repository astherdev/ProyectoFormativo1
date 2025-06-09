<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sidebar con Header y Main</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Ruda:wght@400..900&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Ruda', sans-serif;
    }
  </style>
</head>
<body class="flex">

  <!-- Sidebar -->
  <aside class="fixed top-0 left-0 w-64 bg-[#00324D] text-white h-screen flex flex-col justify-between py-6 px-4">
    <!-- Logo y título -->
    <div>
      <div class="flex items-center gap-4 mb-8">
        <img src="/Sensli1/ProyectoFormativo/assets/img/Logo-Sena-Negativo.png" alt="Logo" class="w-12 h-12" />
        <h2 class="text-xl font-semibold">Inicio</h2>
      </div>

      <!-- Navegación -->
      <nav>
        <ul class="space-y-4">
          <li class="flex items-center gap-3">
            <img src="/Sensli1/ProyectoFormativo/assets/icons/casa.png" class="w-5 h-5" alt="Casa" />
            <a href="/Sensli1/ProyectoFormativo/pages/main.php" class="hover:underline">Inicio</a>
          </li>
          <li class="flex items-center gap-3">
            <img src="/Sensli1/ProyectoFormativo/assets/icons/mesa.png" class="w-5 h-5" alt="Mesa" />
            <a href="/Sensli1/ProyectoFormativo/pages/Admin/viewToken.php" class="hover:underline">Fichas</a>
          </li>
          <li class="flex items-center gap-3">
            <img src="/Sensli1/ProyectoFormativo/assets/icons/carpeta.png" class="w-5 h-5" alt="Carpeta" />
            <a href="/Sensli1/ProyectoFormativo/pages/Admin/instructors.php" class="hover:underline">Instructores</a>
          </li>
        </ul>
      </nav>
    </div>

    <!-- Parte inferior (iconos) -->
    <div class="flex flex-col pb-11 gap-4 items-center mx-auto w-fit">
      <label>
        <input type="checkbox" id="toggle" class="hidden" />
        <img src="/Sensli1/ProyectoFormativo/assets/icons/lunas.png" alt="Modo Oscuro" class="w-6 h-6 cursor-pointer" />
      </label>
    </div>
  </aside>

  <!-- Header -->
  <nav class="fixed top-0 left-64 right-0 h-16 bg-white border-b border-gray-200 flex items-center px-6 z-40">
    <div class="flex justify-between w-full items-center">
      <!-- Logo y título -->
      <a href="#" class="flex items-center gap-3">
        <img src="/Sensli1/ProyectoFormativo/assets/img/Logo-Sena-Negativo.png" alt="Logo" class="h-8 w-8" />
        <span class="text-xl font-semibold text-black">SENSLI</span>
      </a>

      <!-- Perfil usuario -->
      <div class="relative">
        <button
          id="userMenuButton"
          aria-expanded="false"
          aria-haspopup="true"
          class="flex items-center focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-full"
        >
          <img
            src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png"
            alt="Perfil"
            class="w-8 h-8 rounded-full"
          />
        </button>

        <div
          id="userDropdown"
          class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg hidden"
        >
          <div class="px-4 py-3 text-gray-800 border-b border-gray-200">
            <p class="text-sm font-semibold">Yuly Saénz</p>
            <p class="text-xs truncate">admin@gmail.com</p>
          </div>
          <ul>
            <li>
              <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Perfil</a>
            </li>
            <li>
              <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <script>
    // Toggle sidebar (para móviles)
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('aside');
    sidebarToggle?.addEventListener('click', () => {
      if (sidebar.classList.contains('-translate-x-full')) {
        sidebar.classList.remove('-translate-x-full');
      } else {
        sidebar.classList.add('-translate-x-full');
      }
    });

    // Toggle menú usuario
    const userMenuButton = document.getElementById('userMenuButton');
    const userDropdown = document.getElementById('userDropdown');

    userMenuButton?.addEventListener('click', (e) => {
      e.stopPropagation();
      userDropdown.classList.toggle('hidden');
      userMenuButton.setAttribute(
        'aria-expanded',
        userDropdown.classList.contains('hidden') ? 'false' : 'true'
      );
    });

    // Cerrar menú al hacer clic fuera
    window.addEventListener('click', (e) => {
      if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
        userDropdown.classList.add('hidden');
        userMenuButton.setAttribute('aria-expanded', 'false');
      }
    });
  </script>
</body>
</html>
