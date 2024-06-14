<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
include '../../../trimestre.php';

function trimestreAct() {
    $mes = date('n'); // Obtener el número del mes actual
    $ano = date('Y'); // Obtener el año actual

    // Definir los nombres de los meses
    $nombres_meses = array(
        1 => 'ENERO',
        2 => 'FEBRERO',
        3 => 'MARZO',
        4 => 'ABRIL',
        5 => 'MAYO',
        6 => 'JUNIO',
        7 => 'JULIO',
        8 => 'AGOSTO',
        9 => 'SEPTIEMBRE',
        10 => 'OCTUBRE',
        11 => 'NOVIEMBRE',
        12 => 'DICIEMBRE'
    );

    // Definir los trimestres y sus meses
    $trimestres = array(
        1 => array(1, 2, 3), // Enero - Marzo
        2 => array(4, 5, 6), // Abril - Junio
        3 => array(7, 8, 9), // Julio - Septiembre
        4 => array(10, 11, 12) // Octubre - Diciembre
    );
    // Determinar el trimestre actual
    if ($mes >= 1 && $mes <= 3) {
        $trimestre_actual = 1;
    } elseif ($mes >= 4 && $mes <= 6) {
        $trimestre_actual = 2;
    } elseif ($mes >= 7 && $mes <= 9) {
        $trimestre_actual = 3;
    } else {
        $trimestre_actual = 4;
    }

    // Obtener los nombres de los meses del trimestre actual
    $meses_trimestre_actual = array();
    foreach ($trimestres[$trimestre_actual] as $num_mes) {
        $meses_trimestre_actual[] = $nombres_meses[$num_mes];
    }

    // Crear el formato de rango
    $rango_meses_trimestre_actual = reset($meses_trimestre_actual) . ' - ' . end($meses_trimestre_actual);

    // Devolver el formato de rango
    return $rango_meses_trimestre_actual;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Justificacion"]) && isset($_POST["idioma"]) && $_POST['idioma'] != "") {
    echo "<br><h2>Envia la justificacion a la base de datos Formal</h2><br>";
    var_dump($_POST);
    $justificacion = $_POST['Justificacion']; // Correct key
    $nombreArchivo =  'Unidades Académicas que cuentan con CELEX COMPARATIVO';
    $idioma = $_POST['idioma'];
    $fecha = date('d-m-Y H:i:s');
    echo "<br><h2>" . count($_POST) . "</h2>";
    var_dump($justificacion);
    var_dump($idioma);

    $queryJusF2 = '
    INSERT INTO JustificacionesFormato2_Temporal (Desc_Justificacion, id_FormatoAutoevaluacion, id_NivelEducativo, Fecha)
    VALUES ( ? , 
    (SELECT ID_FormatoAutoevaluacion FROM FormatosAutoevaluacion WHERE Desc_FormatoAutoevaluacion = ?),
    (SELECT ID_TipoUnidadAcademica FROM TipoUnidadAcademica WHERE Desc_TipoUnidadAcademica = ?), ?)    
    ';
    $params = [
        (string)$justificacion,
        (string)$nombreArchivo,
        (string)$idioma,
        (string)$fecha
    ];
    $stmt = sqlsrv_prepare($connection, $queryJusF2, $params);

    if ($stmt === false) {
        echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        $result = sqlsrv_execute($stmt);
        if ($result === false) {
            echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
        } else {
            echo "<br><h1>datos insertados</h1>";
        }
        sqlsrv_free_stmt($stmt);
    }
} else {
    header("Location: JustificacionformatoF2.php?status=NivErr");
    exit();
}
?>
