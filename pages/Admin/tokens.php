<?php
  include '../../includes/headersLogIn/headerLogIn.php';

  	// conexión
	include '../../db/connection.php';

	if ($conn->connect_error) {
		die("Conexión fallida: " . $conn->connect_error);
	}

	// consulta
	$sql = "SELECT * FROM aprendiz";
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
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Sensli</title>
</head>
<body class="bg-white text-center pb-28 overflow-x-hidden font-sans">

  <div class="max-w-full mx-auto mt-12 px-6 py-5 bg-white rounded-lg shadow-lg border border-transparent max-w-[90%]">
    <h2 class="text-center bg-[#00324D] text-white p-3 mb-5 rounded-md text-2xl font-semibold">
      FICHA
    </h2>

    <div class="flex justify-center gap-5 mb-6">
      <select class="p-2 text-base rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#00324D]">
        <option selected disabled>Ficha 123456 (Diurna)</option>
      </select>
      <select class="p-2 text-base rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#00324D]">
        <option selected disabled>Programa de Formación</option>
      </select>
    </div>

    <h3 class="text-center mb-3 text-xl font-medium">APRENDICES</h3>

    <div class="overflow-x-auto mb-6">
      <table class="min-w-[1200px] w-full border-collapse">
  <thead>
    <tr class="bg-gray-200 text-center text-sm font-semibold">
      <th class="p-2 border-b-4 border-black">Tipo de documento</th>
      <th class="p-2 border-b-4 border-black">Número de Documento</th>
      <th class="p-2 border-b-4 border-black">Nombres</th>
      <th class="p-2 border-b-4 border-black">Apellidos</th>
      <th class="p-2 border-b-4 border-black">Estado</th>
      <th class="p-2 border-b-4 border-black">Competencia</th>
      <th class="p-2 border-b-4 border-black">Resultado de aprendizaje</th>
      <th class="p-2 border-b-4 border-black">Juicio de evaluación</th>
      <th class="p-2 border-b-4 border-black">Fecha y hora de juicio</th>
      <th class="p-2 border-b-4 border-black">Funcionario que registró el juicio</th>
      <th class="p-2 border-b-4 border-black">Porcentaje Aprobado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($datos as $fila): ?>
    <tr class="text-center text-sm">
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['Tipo_Documento']) ?></td>
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['No_Documento']) ?></td>
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['Nombre']) ?></td>
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['No_Telefonico']) ?></td>
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['Correo']) ?></td>
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['Estado']) ?></td>
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['Etapa']) ?></td>
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['Tipo_Oferta']) ?></td>
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['Fecha_y_hora_de_juicio']) ?></td>
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['Funcionario_Registro']) ?></td>
      <td class="py-2 border-t-4 border-b-4 border-black"><?= htmlspecialchars($fila['Porcentaje_Aprobado']) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

    </div>

    <div class="flex justify-center gap-3 flex-wrap">
      <button class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700 transition">Crear Ficha</button>
      <button class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700 transition">Inactivar</button>
      <button class="px-4 py-2 text-white bg-[#00324D] rounded hover:bg-[#002136] transition">Generar Reporte</button>
      <button class="px-4 py-2 text-white bg-[#00324D] rounded hover:bg-[#002136] transition">Editar</button>
      <button class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700 transition">Agregar Aprendiz</button>
      <button class="px-4 py-2 text-white bg-[#00324D] rounded hover:bg-[#002136] transition">Editar Juicios</button>
    </div>
  </div>

  <?php include '../../includes/Footer.php'; ?>
</body>
</html>