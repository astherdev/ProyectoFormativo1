const menuToggle = document.getElementById('menuToggle');
  const menu = document.getElementById('menu');

  menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('open');
    menu.classList.toggle('open');
  });

