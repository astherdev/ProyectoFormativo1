<?php
include "../includes/session.php";
include '../db/connection.php';



// Consulta base
$sql = "SELECT * FROM archivos WHERE estado = 'Activo'";

if (!empty($fichaFiltro)) {
    $fichaFiltro = $conn->real_escape_string($fichaFiltro);
    $sql .= " AND contenido LIKE '%$fichaFiltro%'";
}
if (!empty($denominacionFiltro)) {
    $denominacionFiltro = $conn->real_escape_string($denominacionFiltro);
    $sql .= " AND contenido LIKE '%$denominacionFiltro%'";
}
$sql .= " ORDER BY id DESC";
$resultado = $conn->query($sql);

// Funciones
function limpiar_clave($clave) {
    $clave = mb_strtolower($clave, 'UTF-8');
    $clave = str_replace(['á','é','í','ó','ú','ñ'], ['a','e','i','o','u','n'], $clave);
    return preg_replace('/[^a-z0-9_]+/', '_', trim($clave));
}

function convertir_fecha($fecha) {
    $partes = explode('/', $fecha);
    return count($partes) == 3 ? "{$partes[2]}-{$partes[1]}-{$partes[0]}" : null;
}

// Mensaje por GET
$mensaje = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'ok') {
        $mensaje = "<p style='color:green;'>Ficha insertada correctamente.</p>";
    } elseif ($_GET['msg'] === 'error') {
        $mensaje = "<p style='color:red;'>Error al insertar la ficha.</p>";
    } elseif ($_GET['msg'] === 'faltan') {
        $faltantes = $_GET['faltantes'] ?? '';
        $mensaje = "<p style='color:orange;'>Faltan campos requeridos: " . htmlspecialchars(urldecode($faltantes)) . "</p>";
    }
}

// Procesar archivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo'])) {
    $archivo = $_FILES['archivo']['tmp_name'];
    $nombreArchivo = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $tamano = $_FILES['archivo']['size'];

    // Validación de tipo permitido
    $extensionesPermitidas = ['text/plain', 'text/csv', 'application/vnd.ms-excel'];
    if (!in_array($tipo, $extensionesPermitidas)) {
        echo "❌ Tipo de archivo no permitido. Solo .txt o .csv.";
        exit;
    }

    // Leer y guardar contenido original en la tabla 'archivos'
    $contenido = file_get_contents($archivo);
    if ($contenido === false) {
        echo "❌ No se pudo leer el archivo.";
        exit;
    }
    $contenidoSQL = $conn->real_escape_string($contenido);
    $conn->query("INSERT INTO archivos (nombre, contenido) VALUES ('$nombreArchivo', '$contenidoSQL')");

    // Definir campos requeridos y sinónimos
    $sinonimos = [
        'fecha_del_reporte' => 'fecha_del_reporte', 'fecha del reporte' => 'fecha_del_reporte',
        'ficha_de_caracterizacion' => 'ficha_de_caracterizacion', 'ficha de caracterizacion' => 'ficha_de_caracterizacion',
        'codigo' => 'codigo', 'cogigo' => 'codigo', 'código' => 'codigo',
        'version' => 'version', 'versión' => 'version',
        'denominacion' => 'denominacion', 'denominación' => 'denominacion',
        'estado_de_la_ficha_de_caracterizacion' => 'estado_de_la_ficha_de_caracterizacion', 'estado de la ficha de caracterizacion' => 'estado_de_la_ficha_de_caracterizacion',
        'fecha_inicio' => 'fecha_inicio', 'fecha inicio' => 'fecha_inicio',
        'fecha_fin' => 'fecha_fin', 'fecha fin' => 'fecha_fin',
        'modalidad_de_formacion' => 'modalidad_de_formacion', 'modalidad de formacion' => 'modalidad_de_formacion',
        'modalidad de formación' => 'modalidad_de_formacion',
        'regional' => 'regional',
        'centro_de_formacion' => 'centro_de_formacion', 'centro de formacion' => 'centro_de_formacion', 'centro de formación' => 'centro_de_formacion'
    ];
    $requeridos = [
        'fecha_del_reporte', 'ficha_de_caracterizacion', 'codigo', 'version', 'denominacion',
        'estado_de_la_ficha_de_caracterizacion', 'fecha_inicio', 'fecha_fin',
        'modalidad_de_formacion', 'regional', 'centro_de_formacion'
    ];

    $datos_transformados = [];

    if (($gestor = fopen($archivo, "r")) !== false) {
        $contador = 0;
        while (($linea = fgetcsv($gestor, 1000, ",")) !== false && $contador < 30) {
            if (count($linea) >= 3 && !empty(trim($linea[0]))) {
                $clave_original = trim(str_replace([':', '"'], '', $linea[0]));
                $clave_limpia = limpiar_clave($clave_original);
                foreach ($sinonimos as $original => $estandar) {
                    if ($clave_limpia === limpiar_clave($original)) {
                        $valor = trim($linea[2], " \"");
                        $datos_transformados[$estandar] = $valor;
                        break;
                    }
                }
            }
            $contador++;
        }
        fclose($gestor);

        // Validar campos requeridos
        $faltantes = array_diff($requeridos, array_keys($datos_transformados));
        if (empty($faltantes)) {
            $valores = [];
            foreach ($requeridos as $campo) {
                $valores[$campo] = $datos_transformados[$campo] ?? '';
            }

            $sqlInsert = sprintf(
                "INSERT INTO fichas (
                    fecha_reporte, ficha_caracterizacion, codigo, version, denominacion,
                    estado, fecha_inicio, fecha_fin, modalidad, regional, centro_formacion
                ) VALUES (
                    '%s', %d, %d, %d, '%s', '%s', '%s', '%s', '%s', '%s', '%s'
                )",
                convertir_fecha($valores['fecha_del_reporte']),
                (int)$valores['ficha_de_caracterizacion'],
                (int)$valores['codigo'],
                (int)$valores['version'],
                $conn->real_escape_string($valores['denominacion']),
                $conn->real_escape_string($valores['estado_de_la_ficha_de_caracterizacion']),
                convertir_fecha($valores['fecha_inicio']),
                convertir_fecha($valores['fecha_fin']),
                $conn->real_escape_string($valores['modalidad_de_formacion']),
                $conn->real_escape_string($valores['regional']),
                $conn->real_escape_string($valores['centro_de_formacion'])
            );

            if ($conn->query($sqlInsert)) {
                header("Location: evaluationJudgments.php");
                exit;
            } else {
                header("Location: " . $_SERVER['PHP_SELF'] . "?msg=error");
                exit;
            }
        } else {
            header("Location: " . $_SERVER['PHP_SELF'] . "?msg=faltan&faltantes=" . urlencode(implode(', ', $faltantes)));
            exit;
        }
    } else {
        echo "❌ Error al abrir el archivo para procesamiento.";
    }
}
?>
