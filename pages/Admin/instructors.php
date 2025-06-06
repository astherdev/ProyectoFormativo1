<?php 
  include "../../includes/headersLogIn/headerLogIn.php";
	// conexión
	$conn = new mysqli("localhost", "root", "123456", "sensli", 3306);

	if ($conn->connect_error) {
		die("Conexión fallida: " . $conn->connect_error);
	}

	// consulta
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
    <link rel="stylesheet" href="../../assets/css/tables.css">
     <link rel="stylesheet" href="../../assets/css/ModePage.css">
    <title>Sensli</title>
</head>
<body>
	<div class="ficha-container">
		<h2 class="ficha-titulo">INSTRUCTORES</h2>
		<h3 class="subtitulo">Gestion De Personal</h3>
		<div class="tabla-scroll">
			<table class="tabla-ficha">
			<thead>
				<tr>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Correo</th>
					<th>Tipo de documento</th>
					<th>Numero de Documento</th>
					<th>Cargo</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($datos as $fila): ?>
					<tr>
						<td><?= htmlspecialchars($fila['Nombre']) ?></td>
						<td><?= htmlspecialchars($fila['Apellidos']) ?></td>
						<td><?= htmlspecialchars($fila['Correo']) ?></td>
						<td><?= htmlspecialchars($fila['Tipo_Documento']) ?></td>
						<td><?= htmlspecialchars($fila['No_Documento']) ?></td>
						<td><?= htmlspecialchars($fila['Cargo']) ?></td>
					</tr>
				<?php endforeach; ?>

			</tbody>
			</table>
		</div>
		<div class="acciones">
			<button class="btn verde" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/Admin/createInstructor.php'">Crear Instructor</button>
			<button class="btn rojo" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/Admin/instructors.php'">Inactivar</button>
			<button class="btn azul" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/Admin/instructors.php'">Generar Reporte</button>
			<button class="btn gris" onclick="window.location.href='/Sensli1/ProyectoFormativo/pages/Admin/editInstructor.php'">Editar</button>
		</div>
	</div>
	<?php include '../../includes/footer.php'; ?>
</body>
</html>
