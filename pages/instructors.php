<?php
include "../includes/session.php";
include '../db/connection.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM instructores WHERE Estado != 'Inactivo'";
$resultado = $conn->query($sql);

$datos = [];
if ($resultado && $resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Instructores Activos</title>
    <link rel="stylesheet" href="../assets/css/tables.css" />
<!-- <link rel="stylesheet" href="../assets/css/ModePage.css" /> -->
<script src="../assets/js/ModePage.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">
<?php include '../includes/sidebar.php'; ?>
<div class="flex-1 flex flex-col min-h-screen">
<?php include '../includes/headerLogIn.php'; ?>
<main class="mb-[4%]">
    <div class="w-full flex justify-start mb-0">
        <button id="backpage" onclick="history.back()">
            <img src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png" alt="Atrás" class="w-5 h-5" />
        </button>
    </div>
   <div class="flex justify-center items-start min-h-screen mt-16">

        <div class="ficha-container bg-white p-6 shadow-lg rounded-lg w-full max-w-6xl">
            <h2 class="text-center text-2xl font-bold mb-4">INSTRUCTORES ACTIVOS</h2>
            <h3 class="text-center text-lg text-gray-700 mb-6">Gestión De Personal</h3>

            <div class="overflow-x-auto">
                <table id="tabla-instructores" class="w-full table-auto text-sm text-gray-700">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Nombres</th>
                            <th class="px-4 py-2">Apellidos</th>
                            <th class="px-4 py-2">Correo</th>
                            <th class="px-4 py-2">Tipo de documento</th>
                            <th class="px-4 py-2">N° Documento</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2">Cargo</th>
                            <th class="px-4 py-2">Tipo de Contrato</th>
                            <th class="px-4 py-2">Inicio Contrato</th>
                            <th class="px-4 py-2">Fin Contrato</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-body">
                        <?php foreach ($datos as $fila): 
                                    $uniqueId = htmlspecialchars($fila['No_Documento'] . '_' . md5($fila['Correo']));
                                ?>
                                    <tr 
                                        id="instructor-<?= $uniqueId ?>" 
                                        class="fila-instructor cursor-pointer hover:bg-gray-100"
                                        onclick="seleccionarInstructor('<?= $uniqueId ?>', '<?= htmlspecialchars($fila['No_Documento']) ?>')"
                                    >
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Nombre']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Apellidos']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Correo']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Tipo_Documento']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['No_Documento']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Estado']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Cargo']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['tipoContrato']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['fechaIniContrato']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['fechaFinContrato']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="paginacion" class="flex justify-center mt-4 space-x-1"></div>

            <div class="mt-6 flex justify-center space-x-4">
                <button class="px-6 py-2 rounded-md text-white hover:brightness-110" 
                    style="background-color: #39a900;"
                    onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/createInstructor.php'">Crear Instructor
                </button>

                <button id="btn-inactivar" 
                        class="px-6 py-2 rounded-md text-white bg-red-500 hover:bg-red-600" 
                        onclick="mostrarConfirmModal()" 
                        disabled>
                    Inactivar
                </button>

                <button class="px-6 py-2 rounded-md text-white hover:brightness-110" 
                        style="background-color: #00324D;"
                        onclick="window.location.href='/Sensli1/ProyectoFormativo/backend/descargarReporte.php'">
                    Generar Reporte
                </button>

                <button class="px-6 py-2 rounded-md text-white hover:brightness-110" 
                        style="background-color: #00324D;"
                        onclick="editarInstructorSeleccionado()">
                    Editar
                </button>

                <button class="px-6 py-2 rounded-md text-white hover:brightness-110" 
                        style="background-color: #39a900;"
                        onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/instructoresInactivos.php'">
                    Ver Inactivos
                </button>
            </div>
        </div>
    </div>
</main>
<?php include '../includes/footer.php'; ?>
</div>

<!-- Modal confirmación -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
    <h2 class="text-lg font-semibold mb-4 text-gray-800">Confirmación</h2>
    <p class="mb-4 text-gray-600">¿Estás seguro de que deseas inactivar a este instructor?</p>
    <div class="flex justify-end gap-2">
      <button id="confirmOk" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Aceptar</button>
      <button id="confirmCancel" onclick="ocultarConfirmModal()" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancelar</button>
    </div>
  </div>
</div>

<!-- Modal de advertencia -->
<div id="popup-editar" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
    <h2 class="text-lg font-semibold mb-4 text-gray-800">Atención</h2>
    <p class="mb-4 text-gray-600">Selecciona un instructor para editar.</p>
    <div class="flex justify-end">
      <button onclick="cerrarPopup('popup-editar')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Cerrar
      </button>
    </div>
  </div>
</div>

<div id="popup-inactivar" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
    <h2 class="text-lg font-semibold mb-4 text-gray-800">Atención</h2>
    <p class="mb-4 text-gray-600">Selecciona un instructor para inactivar.</p>
    <div class="flex justify-end">
      <button onclick="cerrarPopup('popup-inactivar')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Cerrar
      </button>
    </div>
  </div>
</div>

<script>
let instructorSeleccionadoId = null;
let instructorDocumento = null;
const datos = <?php echo json_encode($datos); ?>;
const elementosPorPagina = 10;
let paginaActual = 1;

function seleccionarInstructor(uniqueId, documentoReal) {
    if (instructorSeleccionadoId === uniqueId) {
        const fila = document.getElementById('instructor-' + uniqueId);
        if (fila) fila.classList.remove('instructor-seleccionado');
        instructorSeleccionadoId = null;
        instructorDocumento = null;
        document.getElementById('btn-inactivar').disabled = true;
        return;
    }

    document.querySelectorAll('tr.fila-instructor.instructor-seleccionado').forEach(row => {
        row.classList.remove('instructor-seleccionado');
    });

    const fila = document.getElementById('instructor-' + uniqueId);
    if (fila) {
        fila.classList.add('instructor-seleccionado');
        instructorSeleccionadoId = uniqueId;
        instructorDocumento = documentoReal;
        document.getElementById('btn-inactivar').disabled = false;
    }
}

function mostrarConfirmModal() {
    if (!instructorSeleccionadoId) {
        mostrarPopup('popup-inactivar');
        return;
    }
    document.getElementById('confirmModal').classList.remove('hidden');
}

function ocultarConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
}

document.getElementById('confirmOk').addEventListener('click', () => {
    fetch('../backend/inactivarInstructor.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'no_documento=' + encodeURIComponent(instructorDocumento)
    })
    .then(res => res.text())
    .then(response => {
        if (response.trim() === 'OK') {
            instructorSeleccionadoId = null;
            instructorDocumento = null;
            document.getElementById('btn-inactivar').disabled = true;
            cargarTabla();
        } else {
            alert('Error al inactivar el instructor: ' + response);
        }
        ocultarConfirmModal();
    })
    .catch(error => {
        alert('Error en la solicitud: ' + error);
        ocultarConfirmModal();
    });
});

function editarInstructorSeleccionado() {
    if (!instructorDocumento) {
        mostrarPopup('popup-editar');
        return;
    }
    window.location.href = '/Sensli1/ProyectoFormativo/pages/editInstructor.php?no_documento=' + encodeURIComponent(instructorDocumento);
}

function mostrarPopup(id) {
    document.getElementById(id).classList.remove('hidden');
}

function cerrarPopup(id) {
    document.getElementById(id).classList.add('hidden');
}

function cargarTabla() {
    const tbody = document.getElementById('tabla-body');
    tbody.innerHTML = '';
    const inicio = (paginaActual - 1) * elementosPorPagina;
    const fin = inicio + elementosPorPagina;
    const paginaDatos = datos.slice(inicio, fin);

    paginaDatos.forEach(fila => {
        const uniqueId = fila.No_Documento + '_' + md5(fila.Correo);
        const tr = document.createElement('tr');
        tr.id = 'instructor-' + uniqueId;
        tr.className = 'fila-instructor cursor-pointer hover:bg-gray-100';
        tr.onclick = () => seleccionarInstructor(uniqueId, fila.No_Documento);

        tr.innerHTML = `
            <td class="px-4 py-2">${fila.Nombre}</td>
            <td class="px-4 py-2">${fila.Apellidos}</td>
            <td class="px-4 py-2">${fila.Correo}</td>
            <td class="px-4 py-2">${fila.Tipo_Documento}</td>
            <td class="px-4 py-2">${fila.No_Documento}</td>
            <td class="px-4 py-2">${fila.Estado}</td>
            <td class="px-4 py-2">${fila.Cargo}</td>
            <td class="px-4 py-2">${fila.tipoContrato}</td>
            <td class="px-4 py-2">${fila.fechaIniContrato}</td>
            <td class="px-4 py-2">${fila.fechaFinContrato}</td>
        `;
        tbody.appendChild(tr);
    });

    renderizarPaginacion();
}

function renderizarPaginacion() {
    const totalPaginas = Math.ceil(datos.length / elementosPorPagina);
    const contenedor = document.getElementById('paginacion');
    contenedor.innerHTML = '';
    for (let i = 1; i <= totalPaginas; i++) {
        const btn = document.createElement('button');
        btn.innerText = i;
        btn.className = `px-3 py-1 rounded ${i === paginaActual ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'} hover:bg-blue-400`;
        btn.onclick = () => {
            paginaActual = i;
            cargarTabla();
        };
        contenedor.appendChild(btn);
    }
}

function md5(str) {
    return btoa(unescape(encodeURIComponent(str))).slice(0, 10);
}

cargarTabla();
</script>
</body>
</html>
