<?php 
include '../db/connection.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM instructores";
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
    <title>Sensli</title>
    <link rel="stylesheet" href="../assets/css/tables.css">
    <link rel="stylesheet" href="../assets/css/ModePage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
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
            <div class="flex justify-start items-start min-h-screen ml-[0px] mt-16">
                <div class="ficha-container bg-white p-6 shadow-lg rounded-lg w-full max-w-6xl">
                    <h2 class="ficha-titulo text-center text-2xl font-bold mb-4">INSTRUCTORES</h2>
                    <h3 class="subtitulo text-center text-lg text-gray-700 mb-6">Gestión De Personal</h3>

                    <div class="tabla-scroll overflow-x-auto">
                        <table class="tabla-ficha w-full table-auto text-sm text-gray-700">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2">Nombres</th>
                                    <th class="px-4 py-2">Apellidos</th>
                                    <th class="px-4 py-2">Correo</th>
                                    <th class="px-4 py-2">Tipo de documento</th>
                                    <th class="px-4 py-2">Numero de Documento</th>
                                    <th class="px-4 py-2">Cargo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datos as $fila): ?>
                                    <tr id="instructor-<?= htmlspecialchars($fila['No_Documento']) ?>" onclick="seleccionarInstructor('<?= htmlspecialchars($fila['No_Documento']) ?>')" class="hover:bg-gray-100">
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Nombre']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Apellidos']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Correo']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Tipo_Documento']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['No_Documento']) ?></td>
                                        <td class="px-4 py-2"><?= htmlspecialchars($fila['Cargo']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="acciones mt-6 flex justify-center space-x-4">
                        <button class="btn verde px-6 py-2 rounded-md text-white bg-green-500 hover:bg-green-600" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/createInstructor.php'">Crear Instructor</button>
                        <button id="btn-inactivar" class="btn rojo px-6 py-2 rounded-md text-white bg-red-500 hover:bg-red-600" onclick="inactivarInstructor()" disabled>Inactivar</button>
                        <button class="btn azul px-6 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/instructors.php'">Generar Reporte</button>
                        <button class="btn gris px-6 py-2 rounded-md text-white bg-gray-500 hover:bg-gray-600" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/editInstructor.php'">Editar</button>
                    </div>
                </div>
            </div>
        </main>
        <?php include '../includes/footer.php'; ?>
    </div>
    <script>
        let instructorSeleccionadoId = null;
        function seleccionarInstructor(id) {
            if (instructorSeleccionadoId === id) {
                document.getElementById('instructor-' + id).classList.remove('instructor-seleccionado');
                instructorSeleccionadoId = null;
                document.getElementById('btn-inactivar').disabled = true;
            } else {
                document.querySelectorAll('.tabla-ficha tr').forEach(row => {
                    row.classList.remove('instructor-seleccionado');
                });
                instructorSeleccionadoId = id;
                document.getElementById('instructor-' + id).classList.add('instructor-seleccionado');
                document.getElementById('btn-inactivar').disabled = false;
            }
        }

        function inactivarInstructor() {
            if (!instructorSeleccionadoId) return;
            fetch('../../backend/inactivarInstructor.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'no_documento=' + encodeURIComponent(instructorSeleccionadoId)
            })
            .then(res => res.text())
            .then(response => {
                if (response === 'OK') {
                    document.getElementById('instructor-' + instructorSeleccionadoId).remove();
                    instructorSeleccionadoId = null;
                    document.getElementById('btn-inactivar').disabled = true;
                } else {
                    alert('Error al inactivar el instructor: ' + response);
                }
            });
        }
    </script>
</body>
</html>
