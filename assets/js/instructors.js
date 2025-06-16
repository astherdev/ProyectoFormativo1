document.addEventListener('DOMContentLoaded', function () {
    const tabla = document.getElementById('tabla-instructores');
    const btnVerInactivos = document.getElementById('btn-ver-inactivos');
    const btnGenerarReporte = document.getElementById('btn-generar-reporte');

    tabla.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-inactivar')) {
            const fila = e.target.closest('tr');
            const id = fila.getAttribute('data-id');
            inactivarInstructor(id, fila);
        }
    });

    btnVerInactivos.addEventListener('click', function () {
        window.location.href = '/pages/inactivos.php';
    });

    btnGenerarReporte.addEventListener('click', function () {
        window.location.href = '/backend/descargarReporte.php';
    });

    function inactivarInstructor(id, fila) {
        fetch('/backend/inactivarInstructor.php', {
            method: 'POST',
            body: new URLSearchParams({ id: id })
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'OK') {
                fila.classList.add('inactivo');
                fila.querySelector('.btn-inactivar').disabled = true;
            } else {
                alert('Error al inactivar el instructor');
            }
        });
    }
});
