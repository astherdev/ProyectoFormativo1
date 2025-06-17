<?php
session_start();
session_unset();
session_destroy();
header("Location: ../pages/index.php"); // Redirige al login (ajusta la ruta si es necesario)
exit();
?>