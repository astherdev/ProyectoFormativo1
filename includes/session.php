<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: /Sensli1/ProyectoFormativo/auth/login.php");
    exit();
}

// Puedes acceder a los datos así:
$usuario = $_SESSION['usuario'];
$nombre = $_SESSION['nombre'];
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : null;
?>
