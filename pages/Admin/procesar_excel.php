<?php
require __DIR__ . '/../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo_excel']) && isset($_POST['nombre_csv'])) {
    $archivoTmp = $_FILES['archivo_excel']['tmp_name'];
    $nombreCsv = trim($_POST['nombre_csv']); // Nombre sin extensión
    $nombreCsv = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreCsv); // Sanitizar
    $nombreCsvCompleto = $nombreCsv . '.csv';

    // Cargar archivo Excel
    $documento = IOFactory::load($archivoTmp);

    // Tomar la primera hoja
    $hoja = $documento->getActiveSheet();
    $datos = $hoja->toArray();

    // Mostrar como CSV en pantalla
    header('Content-Type: text/csv');
    header("Content-Disposition: inline; filename=\"$nombreCsvCompleto\"");

    $salida = fopen('php://output', 'w');
    foreach ($datos as $fila) {
        fputcsv($salida, $fila);
    }
    fclose($salida);
    exit;
}
?>
