<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="stylesheet" href="../../assets/css/Admin/Edit_token.css">
=======
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/Admin/editToken.css">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/ModePage.css">
>>>>>>> develop
    <title>Edit Token</title>
</head>
<body>
    <?php 
<<<<<<< HEAD
        include  "../../includes/header.php";
=======
        include "../../includes/headersLogIn/headerLogIn.php";

>>>>>>> develop
    ?>
    <div id = "generalDiv">
        <div id="infoAdmin">
            <h1>Editar Ficha</h1>
            <div id="infoContent">
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/users.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Número de Ficha</label>
                    </div>
                    <input type="text" placeholder="2895664" id = "tokenNum">
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/book.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Instructor de Grupo</label>
                    </div>
                    <select id = "groupInstru" name = "groupInstru" type="select" required>
                        <option value = "" disabled selected hidden>Selecciona una opción</option>
                        <option value = "Intructor">Lilian Fierro</option>
                        <option value = "Intructor">Johan Sebastian Mina</option>
                        <option value = "Intructor">Luis Carlso Hernandez</option>
                    </select>
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/seeDocuments.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Estado</label>
                    </div>
                    <select id = "stateInput" name = "stateInput" type="select" required>
                        <option value = "" disabled selected hidden>Selecciona una opción</option>
                        <option value = "Canceled">Cancelada</option>
                        <option value = "InFormation">En Formación</option>
                        <option value = "Ended">Finalizada</option>
                    </select>
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/finish.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Fecha de Fin</label>
                    </div>
                    <input type="date" id = "tokenEnd">
                </div>
                <div class = "columna">
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/road.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Etapa</label>
                    </div>
                    <input type="text" placeholder="Lectiva" id = "tokenStage">
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/lock.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Tipo de Oferta</label>
                    </div>
                    <input type="text" placeholder="Abierta" id = "tokenType">
    
                    <div class = "formLabel">
                        <img src="/Sensli1/ProyectoFormativo/assets/icons/turnOnOff.png" alt="Icono_Usuario" class = "form_icon">
                        <label>Fecha de Inicio</label>
                    </div>
                    <input type = "date" id = "tokenStart">
                </div>
            </div>
            <div id = "buttonsDiv">
                <button id = "Confirm_button">Aceptar</button>
                <button id = "Cancel_button">Cancelar</button>
            </div>
        </div>
    </div>
    <?php include "../../includes/footer.php";?>
</body>
</html>