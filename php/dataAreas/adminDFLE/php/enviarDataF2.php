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
    INSERT INTO JustificacionesFormato2 (Desc_Justificacion, id_FormatoAutoevaluacion, id_NivelEducativo, Fecha)
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

    //!------------------------------------------------------------------
    // Function to save content in a specific cell of a sheet
    function guardarContenidoEnCelda($spreadsheet, $celda, $contenido, $hoja) {
        $spreadsheet->getSheet($hoja)->setCellValue($celda, $contenido);
    }

    // Function to check if a file exists
    function archivoExistencia($nombre) {
        $rutaData = '../../../exelDFLE/unidades/' . $nombre . '.xlsx';
        return file_exists($rutaData);
    }

    // Function to get cell row based on language
    function ObtenerCeldaIdioma($rango, $idioma, $hoja) {
        $celdas = $hoja->rangeToArray($rango, null, true, true, true);

        // Iterate over each cell in the range
        foreach ($celdas as $fila => $columnas) {
            foreach ($columnas as $columna => $valor) {
                // Check if the cell value matches the searched language
                if (strcasecmp($valor, $idioma) === 0) {
                    // If matched, return the row number
                    return $fila;
                }
            }
        }

        // If the language is not found, return an error message
        return "No se encontró el idioma en el rango de celdas especificado";
    }
    //!------------------------------------------------------------------

    $anioo = ((int)date('Y'));
    $anioAct = (string)("%".($anioo)."%");
    $anioPas = (string)("%".($anioo-1)."%");
    $nivelesData = $idioma;
    function dataAtuales($connection,$params,&$array){
        $queryCuentasActuales = '
            SELECT COUNT(DISTINCT UA.Desc_Nombre_Unidad_Academica) AS total_unidades
            FROM Cantidades_Alumnos CA
            LEFT JOIN Unidades_Academicas UA ON CA.id_UnidadAcademica = UA.ID_UnidadAcademica
            LEFT JOIN TipoUnidadAcademica TP ON TP.ID_TipoUnidadAcademica = UA.id_TipoUnidadAcademica
            WHERE Fecha LIKE ? AND UA.id_TipoUnidadAcademica = (
                SELECT ID_TipoUnidadAcademica 
                FROM TipoUnidadAcademica 
                WHERE Desc_TipoUnidadAcademica = ?
        )';
        $stmt = sqlsrv_prepare($connection, $queryCuentasActuales,$params);
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
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $array = $row['total_unidades'];
                }
            }
        }
    }
    function dataPasados($connection,$params,&$array){
        $queryCuentasPasadoss = '
            SELECT COUNT(DISTINCT UA.Desc_Nombre_Unidad_Academica) AS total_unidades
            FROM Cantidades_Alumnos CA
            LEFT JOIN Unidades_Academicas UA ON CA.id_UnidadAcademica = UA.ID_UnidadAcademica
            LEFT JOIN TipoUnidadAcademica TP ON TP.ID_TipoUnidadAcademica = UA.id_TipoUnidadAcademica
            WHERE Fecha LIKE ? AND UA.id_TipoUnidadAcademica = (
                SELECT ID_TipoUnidadAcademica 
                FROM TipoUnidadAcademica 
                WHERE Desc_TipoUnidadAcademica = ?
        )';
        
        $stmt = sqlsrv_prepare($connection, $queryCuentasPasadoss,$params);
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
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $array = $row['total_unidades'];
                }
            }
        }
    }

    $dtaCuentaMSPas = array();
    $params = [
        $anioPas,
        $nivelesData
    ];   
    dataAtuales($connection,$params,$dtaCuentaMSPas);
    
    $dtaCuentaMSAc = array();
    $params = [
        $anioAct,
        $nivelesData
    ];   
    dataAtuales($connection,$params,$dtaCuentaMSAc);

    $anio = (string) date('Y');
    $rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_1.xlsx';
    $nombreArchivo = '1 DFLE_4T_'.$anio.' Unid Acad CELEX obs gfl 2';
    $rutaCopiaArchivo = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';
    $rutafinal = $rutaCopiaArchivo;
    $fechaCorte = 'FECHA DE CORTE: 31 DE DICIEMBRE DE '.$anio;
    $periodo = 'PERIODO: '.trimestreAct().' DE '.$anio;
    $comparacion_anio = 'ENERO - DICIEMBRE '.$anio;
    $comparacion_anio_pasado = 'ENERO - DICIEMBRE '.(string)((int)$anio-1);

    var_dump($params);

    echo "<br><br><br>";
    
    $celdaContenido = '';
    switch ($idioma) {
        case 'NIVEL MEDIO SUPERIOR':
            echo "medio superior";
            $celdaContenido = '16';
            break;
        case 'NIVEL SUPERIOR':
            echo "superior";
            $celdaContenido = '17';
            break;
        case 'CENTROS DE INVESTIGACIÓN':
            $celdaContenido = '18';
            echo "centros";
            break;
        case 'CENTROS VINCULACIÓN Y DESARROLLO REGIONAL':
            echo "vinculacion";
            $celdaContenido = '19';
            break;
        default:
            echo "Sin dato";
            $celdaContenido = '-';
            break;
    }
    

    var_dump($celdaContenido);

    if (archivoExistencia($nombreArchivo)) {
        $spreadsheet = IOFactory::load($rutafinal);
        $totalSheets = $spreadsheet->getSheetCount();

        if ($totalSheets > 1) {
            $hoja = $spreadsheet->getSheet(1);
            $rangoCeldas = 'B16:B27';
            guardarContenidoEnCelda($spreadsheet, 'R7', $periodo,1);
            guardarContenidoEnCelda($spreadsheet, 'R8', $fechaCorte,1);
            guardarContenidoEnCelda($spreadsheet, 'I14', $comparacion_anio,1);
            guardarContenidoEnCelda($spreadsheet, 'H14', $comparacion_anio_pasado,1);

            guardarContenidoEnCelda($spreadsheet, 'H'.$celdaContenido, $dtaCuentaMSPas,1);
            guardarContenidoEnCelda($spreadsheet, 'I'.$celdaContenido, $dtaCuentaMSAc,1);
            guardarContenidoEnCelda($spreadsheet, 'P'.$celdaContenido, $justificacion,1);
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save($rutaCopiaArchivo);
        } else {
            echo "La hoja 1 no existe en el archivo Excel.";
        }
    } else {
        if (copy($rutaArchivoOriginal, $rutafinal)) {
            $spreadsheet = IOFactory::load($rutafinal);
            $totalSheets = $spreadsheet->getSheetCount();

            if ($totalSheets > 1) {
                $hoja = $spreadsheet->getSheet(1);
                $rangoCeldas = 'B16:B27';
                guardarContenidoEnCelda($spreadsheet, 'R7', $periodo,1);
                guardarContenidoEnCelda($spreadsheet, 'R8', $fechaCorte,1);
                guardarContenidoEnCelda($spreadsheet, 'I14', $comparacion_anio,1);
                guardarContenidoEnCelda($spreadsheet, 'H14', $comparacion_anio_pasado,1);

                guardarContenidoEnCelda($spreadsheet, 'H'.$celdaContenido, $dtaCuentaMSPas,1);
                guardarContenidoEnCelda($spreadsheet, 'I'.$celdaContenido, $dtaCuentaMSAc,1);
                guardarContenidoEnCelda($spreadsheet, 'P'.$celdaContenido, $justificacion,1);
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save($rutaCopiaArchivo);
            } else {
                echo "La hoja 1 no existe en el archivo Excel.";
            }
        } else {
            echo '<br><h1>Error al crear la copia del archivo.</h1>';
        }
    }
} else {
    header("Location: JustificacionformatoF2.php?status=NivErr");
    exit();
}
?>
