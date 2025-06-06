const toggleCheckbox = document.getElementById('toggle');
const body = document.body;
const generalDiv = document.getElementById('generalDiv');
const infoAdmin = document.getElementById('infoAdmin');
const tituloSeccion = document.querySelector('.titulo-seccion'); // NUEVO

// Al cargar: aplicar tema guardado
const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark') {
  body.classList.add('dark');
  if (generalDiv) generalDiv.classList.add('dark');
  if (infoAdmin) infoAdmin.classList.add('dark');
  if (tituloSeccion) tituloSeccion.classList.add('dark'); // NUEVO
  toggleCheckbox.checked = true;
}

// Al cambiar el switch
toggleCheckbox.addEventListener('change', () => {
  const isDark = toggleCheckbox.checked;
  body.classList.toggle('dark', isDark);
  if (generalDiv) generalDiv.classList.toggle('dark', isDark);
  if (infoAdmin) infoAdmin.classList.toggle('dark', isDark);
  if (tituloSeccion) tituloSeccion.classList.toggle('dark', isDark); // NUEVO
  localStorage.setItem('theme', isDark ? 'dark' : 'light');
});
