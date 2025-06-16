<?php
require '../vendor/autoload.php'; // Asegúrate de que el autoload esté correcto
include '../db/connection.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Evita cualquier salida antes del archivo
ob_clean();

$sql = "SELECT * FROM instructores WHERE Estado != 'Inactivo'";
$resultado = $conn->query($sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Encabezados
$headers = ['Nombre', 'Apellidos', 'Correo', 'Tipo Documento', 'N° Documento', 'Estado', 'Cargo', 'Tipo Contrato', 'Inicio Contrato', 'Fin Contrato'];
$sheet->fromArray($headers, NULL, 'A1');

// Datos
$filaExcel = 2;
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $sheet->setCellValue('A' . $filaExcel, $fila['Nombre']);
        $sheet->setCellValue('B' . $filaExcel, $fila['Apellidos']);
        $sheet->setCellValue('C' . $filaExcel, $fila['Correo']);
        $sheet->setCellValue('D' . $filaExcel, $fila['Tipo_Documento']);
        $sheet->setCellValue('E' . $filaExcel, $fila['No_Documento']);
        $sheet->setCellValue('F' . $filaExcel, $fila['Estado']);
        $sheet->setCellValue('G' . $filaExcel, $fila['Cargo']);
        $sheet->setCellValue('H' . $filaExcel, $fila['tipoContrato']);
        $sheet->setCellValue('I' . $filaExcel, $fila['fechaIniContrato']);
        $sheet->setCellValue('J' . $filaExcel, $fila['fechaFinContrato']);
        $filaExcel++;
    }
}

// Enviar archivo al navegador
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="instructores.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
