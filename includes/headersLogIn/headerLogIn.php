<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sidebar</title>
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
  <aside class="w-64 bg-[#00324D] text-white h-screen fixed flex flex-col justify-between py-6 px-4">
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
            <img src="/Sensli1/ProyectoFormativo/assets/icons/casa.png" class="w-5 h-5" />
            <a href="/Sensli1/ProyectoFormativo/pages/main.php" class="hover:underline">Inicio</a>
          </li>
          <li class="flex items-center gap-3">
            <img src="/Sensli1/ProyectoFormativo/assets/icons/mesa.png" class="w-5 h-5" />
            <a href="/Sensli1/ProyectoFormativo/pages/Admin/viewToken.php" class="hover:underline">Fichas</a>
          </li>
          <li class="flex items-center gap-3">
            <img src="/Sensli1/ProyectoFormativo/assets/icons/carpeta.png" class="w-5 h-5" />
            <a href="/Sensli1/ProyectoFormativo/pages/Admin/instructors.php" class="hover:underline">Instructores</a>
          </li>
          
        </ul>
      </nav>
    </div>

    <!-- Parte inferior (iconos) -->
    <div class="flex flex-col items-center gap-4">
      <!-- Toggle (sin funcionalidad ya que no quieres modo oscuro) -->
      <label>
        <input type="checkbox" id="toggle" class="hidden" />
        <span class="text-sm">Modo Claro/Oscuro</span>
      </label>

      <!-- Iconos perfil y menú -->
      <div class="flex items-center gap-4">
        <img src="/Sensli1/ProyectoFormativo/assets/icons/menu.png" alt="menu" class="w-6 h-6" />
        <img src="/Sensli1/ProyectoFormativo/assets/icons/usuario.png" alt="usuario" class="w-6 h-6" />
      </div>
    </div>
  </aside>

  <!-- Header (navbar) sin modo oscuro -->
  <nav class="fixed top-0 left-64 right-0 h-16 bg-white border-b border-gray-200 flex items-center px-6 z-40">
    <div class="flex justify-between w-full items-center">
      <!-- Izquierda: botón menú hamburguesa para móviles -->
      <button
        type="button"
        class="inline-flex items-center p-2 text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
        aria-controls="logo-sidebar"
        aria-expanded="false"
        id="sidebarToggle"
      >
        <span class="sr-only">Abrir sidebar</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z" clip-rule="evenodd"></path>
        </svg>
      </button>

      <!-- Logo y título -->
      <a href="#" class="flex items-center gap-3">
        <img src="/Sensli1/ProyectoFormativo/assets/img/Logo-Sena-Negativo.png" alt="Logo" class="h-8 w-8" />
        <span class="text-xl font-semibold text-black">SENSLI</span>
      </a>

      <!-- Derecha: perfil usuario -->
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

  <!-- Menú desplegable usuario (oculto por defecto con 'hidden') -->
  <div
    id="userDropdown"
    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg hidden"
  >
    <div class="px-4 py-3 text-gray-800 border-b border-gray-200">
      <p class="text-sm font-semibold">Neil Sims</p>
      <p class="text-xs truncate">neil.sims@flowbite.com</p>
    </div>
    <ul>
      <li>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Earnings</a>
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
