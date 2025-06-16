<?php 
include '../db/connection.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM instructores WHERE Estado = 'Inactivo'";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructores Inactivos</title>
    <link rel="stylesheet" href="../assets/css/tables.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">
    <?php include '../includes/sidebar.php'; ?>
    <div class="flex-1 flex flex-col min-h-screen">
        <?php include '../includes/headerLogIn.php'; ?>
        <main>
            <div class="flex justify-start items-start min-h-screen ml-0 mt-16">
                <div class="ficha-container bg-white p-6 shadow-lg rounded-lg w-full max-w-6xl">
                    <h2 class="text-center text-2xl font-bold mb-4">INSTRUCTORES INACTIVOS</h2>

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
                                    <th class="px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datos as $fila): ?>
                                    <tr id="instructor-<?= htmlspecialchars($fila['No_Documento']) ?>">
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Nombre']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Apellidos']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Correo']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Tipo_Documento']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['No_Documento']) ?></td>
                                        <td class="px-4 py-2 text-red-600 font-bold"><?= htmlspecialchars($fila['Estado']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Cargo']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['tipoContrato']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['fechaIniContrato']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['fechaFinContrato']) ?></td>
                                        <td class="px-4 py-2">
                                            <button class="px-4 py-1 bg-green-500 hover:bg-green-600 text-white rounded" 
                                                onclick="mostrarModal('<?= htmlspecialchars($fila['No_Documento']) ?>')">
                                                Reactivar
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 text-center">
                        <a href="instructors.php" class="px-6 py-2 rounded-md text-white inline-block text-center hover:brightness-110" style="background-color: #00324D;">Volver</a>
                    </div>
                </div>
            </div>
        </main>
        <?php include '../includes/footer.php'; ?>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm text-center">
            <h3 class="text-lg font-semibold mb-4">¿Estás seguro?</h3>
            <p class="mb-6">¿Deseas reactivar este instructor?</p>
            <input type="hidden" id="documentoSeleccionado">
            <div class="flex justify-center gap-4">
                <button onclick="confirmarReactivacion()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Sí, reactivar</button>
                <button onclick="cerrarModal()" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">Cancelar</button>
            </div>
        </div>
    </div>

    <script>
    function mostrarModal(no_documento) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('documentoSeleccionado').value = no_documento;
    }

    function cerrarModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    function confirmarReactivacion() {
        const no_documento = document.getElementById('documentoSeleccionado').value;

        fetch('reactivarInstructor.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'no_documento=' + encodeURIComponent(no_documento)
        })
        .then(response => response.text())
        .then(result => {
            if (result.trim() === 'OK') {
                const fila = document.getElementById('instructor-' + no_documento);
                if (fila) fila.remove();
                cerrarModal();
            } else {
                alert('Error: ' + result);
            }
        })
        .catch(error => {
            alert('Error en la solicitud: ' + error);
        });
    }
    </script>
</body>
</html>
