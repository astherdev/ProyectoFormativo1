<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/Admin/editJudgments.css">
    <title>Edit Judgments</title>
</head>
<body>
    <?php 
        include "../../includes/headersLogIn/headerLogIn.php";
    ?>
    <div id = "generalDiv">
        <div id="infoAdmin">
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
                        <option value = "reprobate"></option>
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
                <button id = "Update_button" onclick="window.location.href = '/Sensli1/ProyectoFormativo/pages/Admin/tokens'">Actualizar</button>
            </div>
        </div>
    </div>
    <?php include "../../includes/footer.php";?>
</body>
</html>