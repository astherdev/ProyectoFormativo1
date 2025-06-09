<?php 
include "../includes/headersLogIn/headerLogIn.php";
include '../db/connection.php';

// Verificar conexión a la base de datos
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener las fichas activas
$sql = "SELECT * FROM fichas WHERE Estado = 'Activo'";
$resultado = $conn->query($sql);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error en la consulta: " . $conn->error);
}

// Almacenar los resultados en los arrays $tecnico y $tecnologo
$tecnico = [];
$tecnologo = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        if (strpos(strtolower($fila['Denominacion']), 'tecnico') !== false) {
            $tecnico[] = $fila; // Fichas de Técnico
        } else {
            $tecnologo[] = $fila; // Fichas de Tecnólogo
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Sensli1/ProyectoFormativo/assets/css/main.css">
    <title>Sensli</title>
    <style>
        .principal-content {
            margin-top: 50px;
            text-align: center;
            padding: 20px;
        }
        /* Contenedor para las dos columnas */
        .contenedor-columnas {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 0 20px;
            margin-top: 30px;
            overflow-x: hidden; /* Deshabilita el scroll horizontal */
        }

        /* Estilo de cada columna */
        .columna {
            width: 100%; /* Cada columna ocupa casi la mitad */
            max-height: 70vh; /* Máxima altura de la columna */
            overflow-y: auto; /* Scroll vertical */
            padding-right: 15px;
        }

        /* Módulos de las fichas */
        .modulo {
            background-color: #00324D; /* Fondo oscuro para la ficha */
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modulo-header {
            display: flex;
            align-items: center;
            margin-top: 10px;
            background-color: #00324D; /* Fondo oscuro para la cabecera */
            color: white; /* Texto blanco en la cabecera */
            padding: 10px;
            border-radius: 8px;
        }

        .logo-modulo {
            height: 40px;
            width: 40px;
            margin-right: 15px;
        }

        .datos {
            font-size: 14px;
            color: white; /* Color blanco para el texto de la información */
            background-color: #00324D; /* Fondo oscuro para la información */
            padding: 10px;
            border-radius: 8px;
        }

        .titulo-seccion {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .contenedor-columnas {
                flex-direction: column;
                align-items: center; /* Centra las columnas */
                gap: 2rem;
                overflow-x: auto; /* Scroll horizontal solo en pantallas pequeñas */
            }

            /* Aumentamos el ancho de las columnas para pantallas pequeñas */
            .columna {
                width: 90%; /* En pantallas pequeñas las columnas se vuelven más anchas */
            }
        }

        /* Ajuste del contenedor en pantallas grandes */
        @media (min-width: 1024px) {
            .contenedor-columnas {
                width: 95%; /* Se aumenta el ancho del contenedor */
                margin: 0 auto; /* Centrado del contenedor */
            }

            /* Ajuste de las columnas en pantallas grandes */
            .columna {
                width: 48%; /* Deja más espacio, ocupando casi la mitad */
            }
        }
    </style>
</head>
<body>
    <!-- Contenedor principal -->
    <div class="flex justify-start items-start min-h-screen pt-16" style="margin-left: 40%;"> 
        <div class="principal-content max-w-4xl w-full">
            <h1 class="text-2xl font-semibold">Bienvenid@ <span class="admin">[Admin]</span></h1>
            <p class="mt-2">Ahora puedes navegar por el sistema <br> libremente</p>
            <h3 class="titulo-seccion mt-6 text-xl font-semibold">Fichas activas</h3>

            <!-- Contenedor de las dos columnas -->
            <div class="contenedor-columnas">
                <!-- Columna Técnico -->
                <div class="columna">
                    <h3 class="titulo-seccion">Técnico</h3>
                    <?php foreach ($tecnico as $ficha): ?>
                        <div class="modulo">
                            <h4 class="tipo-ficha text-lg font-semibold"><?= $ficha['Denominacion'] ?></h4>
                            <div class="modulo-header">
                                <img src="/Sensli1/ProyectoFormativo/assets/img/Logo-Sena-Negativo.png" alt="SENA" class="logo-modulo">
                                <div class="datos">
                                    <strong><?= $ficha['No_Ficha'] ?></strong><br>
                                    Instructor de Grupo: <?= $ficha['Jefe_Grupo'] ?><br>
                                    Estado: <?= $ficha['Estado'] ?><br>
                                    Fecha Inicio: <?= $ficha['Fecha_Inicio'] ?><br>
                                    Fecha Fin: <?= $ficha['Fecha_Fin'] ?><br>
                                    Aprendices: <?= $ficha['Aprendices'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Columna Tecnólogo -->
                <div class="columna">
                    <h3 class="titulo-seccion">Tecnólogo</h3>
                    <?php foreach ($tecnologo as $ficha): ?>
                        <div class="modulo">
                            <h4 class="tipo-ficha text-lg font-semibold"><?= $ficha['Denominacion'] ?></h4>
                            <div class="modulo-header">
                                <img src="/Sensli1/ProyectoFormativo/assets/img/Logo-Sena-Negativo.png" alt="SENA" class="logo-modulo">
                                <div class="datos">
                                    <strong><?= $ficha['No_Ficha'] ?></strong><br>
                                    Instructor de Grupo: <?= $ficha['Jefe_Grupo'] ?><br>
                                    Estado: <?= $ficha['Estado'] ?><br>
                                    Fecha Inicio: <?= $ficha['Fecha_Inicio'] ?><br>
                                    Fecha Fin: <?= $ficha['Fecha_Fin'] ?><br>
                                    Aprendices: <?= $ficha['Aprendices'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php require_once '../includes/Footer.php'; ?>
