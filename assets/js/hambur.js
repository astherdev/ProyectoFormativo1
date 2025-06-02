const menuIcon = document.getElementById('menuIcon');
const xClose = document.getElementById('xClose');
const menuNav = document.getElementById('menuNav');


xClose.style.display = 'none';

menuIcon.addEventListener('click', () => {
    menuNav.classList.add('active');
    menuIcon.style.display = 'none';
    xClose.style.display = 'block';
});

xClose.addEventListener('click', () => {
    menuNav.classList.remove('active');
    xClose.style.display = 'none';
    menuIcon.style.display = 'block';
});
