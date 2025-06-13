<!-- excel_to_csv.php -->
<form action="procesar_excel.php" method="post" enctype="multipart/form-data">
  <label>Nombre del archivo CSV (sin ".csv"):</label><br>
  <input type="text" name="nombre_csv" required><br><br>

  <label>Sube el archivo Excel:</label><br>
  <input type="file" name="archivo_excel" accept=".xlsx, .xls" required><br><br>

  <button type="submit">Convertir</button>
</form>
