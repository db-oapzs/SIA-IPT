<?php

// Incluir la clase de PHP Spreadsheet
require '../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');
include '../conexion.php';

$nombreunidad = 'ESCUELA NACIONAL DE CIENCIAS BIOLÓGICAS'; // Asigna el valor correcto
$idioma = 'INGLÉS'; // Asigna el valor correcto

$queryVerifica = '
SELECT Desc_Nombre_Unidad_Academica FROM Unidades_Academicas

';

$params = array('true', 'false', $nombreunidad, $idioma);

// Preparar la consulta
$stmt = sqlsrv_prepare($connection, $queryVerifica, $params);
if ($stmt === false) {
    // Manejar el error de la consulta preparada
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    // Ejecutar la consulta
    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        // Manejar el error de la ejecución de la consulta
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        // Mostrar los resultados
        $statusEnvio = null;
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $statusEnvio = $row['Resultado'];
        }
        if ($statusEnvio === 'true') {
            echo 'bloqueado';
            header("Location: cargarData.php?status=IdiomaBlock");
            exit();
        } else {
            echo 'No bloqueado';
        }
    }
    // Liberar el conjunto de resultados
    sqlsrv_free_stmt($stmt);
}

?>
