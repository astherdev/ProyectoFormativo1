
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&family=Indie+Flower&family=Parkinsans:wght@300..800&family=Ruda:wght@400..900&family=Underdog&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/Admin/editJudgments.css">
    <title>Edit Judgments</title>
</head>
<body class="flex min-h-screen">

  <?php include "../../includes/sidebar.php"; ?>

  <div class="flex-1 flex flex-col">
    <?php include "../../includes/headersLogIn/headerLogIn.php"; ?>


    <main>
    <button id="backpage" onclick="history.back()"><img id="backImg" src="/Sensli1/ProyectoFormativo/assets/icons/flecha-izquierda.png"></button>
    <div id = "generalDiv">
        <div id="infoAdminEditJudgments">
            <h1>Editar Información de Juicios</h1>
            <div id = "filtersDiv">
                <select id = "tokenSelected" name = "tokenSelected" type="select" required>
                    <option value = "" disabled selected hidden>Selecciona una Ficha</option>
                    <option value = "token">2895664</option>
                    <option value = "token">7658336</option>
                    <option value = "token">9086553</option>
                </select>

                <select id = "learnerSelected" name = "learnerSelected" type="select" required>
                    <option value = "" disabled selected hidden>Seleccione un Aprendiz</option>
                    <option value = "Aprendiz">Luis Carlos Hernandez Henao</option>
                    <option value = "Aprendiz">Johan Sebastian Mina</option>
                    <option value = "Aprendiz">Isaac Echeverry García</option>
                </select>
            </div>
            <div id="infoContent">
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="../../assets/icons/documents.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Tipo de documento</label>
                    </div>
                    <input type="text" placeholder="Cédula de Ciudadania" id = "learnerDocumentType">
    
                    <div class = "formLabel">
                        <img src="../../assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Nombre</label>
                    </div>
                    <input type="text" placeholder="Isaac" id = "learnerName">
    
                    <div class = "formLabel">
                        <img src="../../assets/icons/turnOnOff.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Estado</label>
                    </div>
                    <select id = "learnerState" name = "learnerState" type="select" required>
                        <option value = "" disabled selected hidden>Selecciona una opción</option>
                        <option value = "Canceled">Cancelada</option>
                        <option value = "InFormation">En Formación</option>
                        <option value = "Ended">Finalizada</option>
                    </select>
                </div>
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="../../assets/icons/seeDocuments.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Número de Documento</label>
                    </div>
                    <input type="text" placeholder="1234567890" id = "learnerDocument">
    
                    <div class = "formLabel">
                        <img src="../../assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Apellidos</label>
                    </div>
                    <input type="text" placeholder="Abierta" id = "learnerLastName">
    
                    <div class = "formLabel">
                        <img src="../../assets/icons/turnOnOff.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Juicio de Evaluación</label>
                    </div>
                    <select id = "judgmentState" name = "judgmentState" type="select" required>
                        <option value = "" disabled selected hidden>Selecciona una opción</option>
                        <option value = "aprove">Aprobado</option>
                        <option value = "reprobate">Reprobado</option>
                    </select>
                </div>
            </div>
            <div id = "EvaluatorDiv">
                <div id = "FunctionaryLabel">
                    <img src="../../assets/icons/avatar.png" alt="Icono_Usuario" class = "form_icon">
                    <label>Funcionario que registro el juicio evaluativo</label>
                </div>
                <select id = "stateInput" name = "stateInput" type="select" required>
                    <option value = "" disabled selected hidden>Selecciona un Evaluador</option>
                    <option value = "Intructor">Lilian Fierro</option>
                    <option value = "Intructor">Johan Sebastian Mina</option>
                    <option value = "Intructor">Luis Carlso Hernandez</option>
                </select>
            </div>
            <div id = "buttonsDiv">
                <button id = "Update_button">Actualizar</button>
            </div>
        </div>
    </div>
    </main>
    <?php include "../../includes/footer.php";?>
</body>
</html>