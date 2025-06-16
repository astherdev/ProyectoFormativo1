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
    <link rel="stylesheet" href="../assets/css/ModePage.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-100 flex">
    <?php include '../includes/sidebar.php'; ?>
    <div class="flex-1 flex flex-col min-h-screen">
        <?php include '../includes/headerLogIn.php'; ?>
        <main>
            <div class="w-full flex justify-start mb-0">
                <button id="backpage" onclick="history.back()">
                    <img src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png" alt="Atrás" class="w-5 h-5" />
                </button>
            </div>
            <div class="flex justify-start items-start min-h-screen ml-0 mt-16">
                <div class="ficha-container bg-white p-6 shadow-lg rounded-lg w-full max-w-6xl">
                    <h2 class="text-center text-2xl font-bold mb-4">INSTRUCTORES ACTIVOS</h2>
                    <h3 class="text-center text-lg text-gray-700 mb-6">Gestión De Personal</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto text-sm text-gray-700">
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
                            <tbody>
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
                                onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/editInstructor.php'">
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
    <div id="confirmModal">
        <div class="modal-content">
            <p>¿Estás seguro de que deseas inactivar a este instructor?</p>
            <button id="confirmOk">Aceptar</button>
            <button id="confirmCancel">Cancelar</button>
        </div>
    </div>

    <script>
        let instructorSeleccionadoId = null;
        let instructorDocumento = null;

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
            if (!instructorSeleccionadoId) return;
            document.getElementById('confirmModal').style.display = 'block';
        }

        function ocultarConfirmModal() {
            document.getElementById('confirmModal').style.display = 'none';
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
                    const fila = document.getElementById('instructor-' + instructorSeleccionadoId);
                    if (fila) fila.remove();

                    instructorSeleccionadoId = null;
                    instructorDocumento = null;
                    document.getElementById('btn-inactivar').disabled = true;
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

        document.getElementById('confirmCancel').addEventListener('click', () => {
            ocultarConfirmModal();
        });
    </script>
</body>
</html>
