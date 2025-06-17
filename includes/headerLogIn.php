<header class="w-full h-12 bg-white border-b border-gray-200 flex items-center justify-between px-6">
  <a href="#" class="flex items-center gap-3">
    <img src="/Sensli1/ProyectoFormativo/assets/img/Logo-Sena-Negativo.png" alt="Logo" class="h-6 w-6" />
    <span class="text-lg font-semibold text-black">SENSLI</span>
  </a>

  <!-- Perfil usuario -->
  <div class="relative">
    <button
      id="userMenuButton"
      aria-expanded="false"
      aria-haspopup="true"
      class="flex items-center focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-full"
    >
      <img src="/Sensli1/ProyectoFormativo/assets/icons/avatar.png" alt="Perfil" class="w-8 h-8 rounded-full" />
    </button>

    <div
      id="userDropdown"
      class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg hidden"
    >
      <div class="px-4 py-3 text-gray-800 border-b border-gray-200">
        <p class="text-sm font-semibold">
          <?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : 'Usuario'; ?>
        </p>
        <p class="text-xs truncate">
          <?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'correo@ejemplo.com'; ?>
        </p>
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

  <script>
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

    window.addEventListener('click', (e) => {
      if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
        userDropdown.classList.add('hidden');
        userMenuButton.setAttribute('aria-expanded', 'false');
      }
    });
  </script>
</header>