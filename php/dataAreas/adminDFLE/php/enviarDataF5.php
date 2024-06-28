<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
include '../../../trimestre.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Justificacion"]) && isset($_POST["idioma"]) && $_POST['idioma'] != "") {
    echo "<br><h2>Envia la justificacion a la base de datos Formal</h2><br>";
    var_dump($_POST);
    $justificacion = $_POST['Justificacion']; // Correct key
    $nombreArchivo =  'LENGUAS  CON  REGISTRO COMPARATIVO';
    $idioma = $_POST['idioma'];
    $fecha = date('d-m-Y H:i:s');
    echo "<br><h2>" . count($_POST) . "</h2>";
    var_dump($justificacion);
    var_dump($idioma);

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

    // Insert justification into the database
    $queryTemp = '
        INSERT INTO JustificacionesFormato5_9 (Desc_Justificacion, id_FormatoAutoevaluacion, id_Idioma, Fecha)
        VALUES (?, 
        (SELECT ID_FormatoAutoevaluacion FROM FormatosAutoevaluacion WHERE Desc_FormatoAutoevaluacion = ?),
        (SELECT ID_Idioma FROM Idiomas WHERE Desc_Idioma = ?), ?)
    ';

    $params = array($justificacion, $nombreArchivo, $idioma, $fecha);
    $stmt = sqlsrv_prepare($connection, $queryTemp, $params);

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
                7 => 'JUNLIO',
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

        $anio = date('Y');
        $mes = date('n');
        $numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => "Mes inválido"};
        $rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_1.xlsx';
        $nombreArchivo = "1 DFLE_". $numTrimestre ."T_". $anio ." Unid Acad CELEX obs gfl 2";
        $rutaCopiaArchivo = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';
        $rutafinal = $rutaCopiaArchivo;
        $fechaCorte = 'FECHA DE CORTE: 31 DE DICIEMBRE DE '.$anio;
        $periodo = 'PERIODO: '.trimestreAct().' DE '.$anio;

        if (archivoExistencia($nombreArchivo)) {
            $spreadsheet = IOFactory::load($rutafinal);
            $totalSheets = $spreadsheet->getSheetCount();

            if ($totalSheets > 1) {
                $hoja = $spreadsheet->getSheet(4);
                $rangoCeldas = 'B16:B27';
                guardarContenidoEnCelda($spreadsheet, 'Q6', $periodo,4);
                guardarContenidoEnCelda($spreadsheet, 'Q7', $fechaCorte,4);

                $celdaR = ObtenerCeldaIdioma($rangoCeldas, $idioma, $hoja);

                if (is_numeric($celdaR)) {
                    guardarContenidoEnCelda($spreadsheet, 'P' . $celdaR, $justificacion,4);
                    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                    $writer->save($rutaCopiaArchivo);
                } else {
                    echo $celdaR; // Error message from ObtenerCeldaIdioma function
                }
            } else {
                echo "La hoja 4 no existe en el archivo Excel.";
            }
        } else {
            if (copy($rutaArchivoOriginal, $rutafinal)) {
                $spreadsheet = IOFactory::load($rutafinal);
                $totalSheets = $spreadsheet->getSheetCount();

                if ($totalSheets > 1) {
                    $hoja = $spreadsheet->getSheet(4);
                    $rangoCeldas = 'B16:B27';
                    guardarContenidoEnCelda($spreadsheet, 'Q6', $periodo,4);
                    guardarContenidoEnCelda($spreadsheet, 'Q7', $fechaCorte,4);

                    $celdaR = ObtenerCeldaIdioma($rangoCeldas, $idioma, $hoja);

                    if (is_numeric($celdaR)) {
                        guardarContenidoEnCelda($spreadsheet, 'P' . $celdaR, $justificacion, 4);
                        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                        $writer->save($rutaCopiaArchivo);
                    } else {
                        echo $celdaR; // Error message from ObtenerCeldaIdioma function
                    }
                } else {
                    echo "La hoja 4 no existe en el archivo Excel.";
                }
            } else {
                echo '<br><h1>Error al crear la copia del archivo.</h1>';
            }
        }
    }
} else {
    header("Location: archivoF5Justificacion.php?status=IdiomamErr");
    exit();
}
?>
