<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/createObservation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <title>Create Observations</title>
</head>
<body class="flex min-h-screen">
  <?php include "../includes/sidebar.php"; ?>
  <div class="flex-1 flex flex-col">
    <?php include "../includes/headerLogIn.php"; ?>
		<main>
			<button id="backpage" onclick="history.back()"><img id="backImg" src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png"></button>
			<div class="Principal-cont create-observation">
				<h1>Crear Observaciones</h1>
				<div class="selects">
					<select name="ficha" id="ficha">
						<option value="1">2895664 (Diurna)</option>
						<option value="2">4633742 (Nocturna)</option>
						<option value="3">0937658 (Tarde)</option>
					</select>

					<select name="aprendiz" id="aprendiz">
						<option value="1">Luis Carlos Hernandez Henao</option>
						<option value="2">Johan Sebastian Mina</option>
						<option value="3">Isaac Echeverri Garcia</option>
					</select>
				</div>

				<h5>Fecha de Observación</h5>
				<div class="selects">
					<input type="date" id="tokenEnd" />
				</div>

				<h5>Asunto de la Observación</h5>
				<div class="selects">
					<input name="observation-tittle" id="observation-tittle" placeholder="Ingrese el asunto de la observación" />
				</div>

				<h5>Detalle de la Observación</h5>
				<div class="selects">
					<textarea name="observation" id="observation" placeholder="Ingrese la descripción de la observación..."></textarea>
				</div>
				
				<button class="confirm" onclick="window.location.href = '/Sensli1/ProyectoFormativo/pages/observations.php'">
				Confirmar
				</button>
			</div>
		</main>
    <?php include '../includes/footer.php'; ?>
  	</div>
</body>
</html>