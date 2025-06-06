const toggleButton = document.getElementById('toggle-theme');
const body = document.body;

// Aplicar tema guardado al cargar
const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark') {
  body.classList.add('dark');
}

// Cambiar tema al hacer clic
toggleButton.addEventListener('click', () => {
  body.classList.toggle('dark');
  
  // Guardar preferencia
  const isDark = body.classList.contains('dark');
  localStorage.setItem('theme', isDark ? 'dark' : 'light');
});
