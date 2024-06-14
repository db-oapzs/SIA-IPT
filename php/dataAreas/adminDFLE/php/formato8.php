<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';

$fecha = date('Y');
var_dump($fecha);

$queryData = "
    SELECT CA.Desc_Hombres, CA.Desc_Mujeres, UA.Desc_Nombre_Unidad_Academica, I.Desc_Idioma, CA.Fecha 
    FROM Cantidades_Alumnos CA
    INNER JOIN 
    Unidades_Academicas UA ON CA.id_UnidadAcademica = UA.ID_UnidadAcademica
    INNER JOIN 
    Idiomas I ON CA.id_Idioma = I.ID_Idioma
    WHERE CA.Fecha LIKE ?
";

$datos = array();
$params = array('%' . $fecha . '%');

// Preparar la consulta
$stmt = sqlsrv_prepare($connection, $queryData, $params);
if ($stmt === false) {
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $datos[] = $row;
        }
    }
    sqlsrv_free_stmt($stmt);
}

function obtenerTrimestre($fecha)
{
    $fechaValida = DateTime::createFromFormat('Y-m-d H:i:s', $fecha);
    if (!$fechaValida) {
        return "Formato de fecha inválido";
    }

    $mes = (int) $fechaValida->format('m');

    if ($mes >= 1 && $mes <= 3) {
        return "ENERO - MARZO";
    } elseif ($mes >= 4 && $mes <= 6) {
        return "ABRIL-JUNIO";
    } elseif ($mes >= 7 && $mes <= 9) {
        return "JULIO-SEPTIEMBRE";
    } elseif ($mes >= 10 && $mes <= 12) {
        return "OCTUBRE - DICIEMBRE";
    } else {
        return "Mes inválido";
    }
}

$idiomaXls_1 = array();
$idiomaXls_2 = array();
$sumaPorTrimestre1 = array();
$sumaPorTrimestre2 = array();
$datosTrim = [
    "ENERO - MARZO" => ["C", "D", "F", "G"],
    "ABRIL-JUNIO" => ["J", "K", "M", "N"],
    "JULIO-SEPTIEMBRE" => ["Q", "R", "T", "U"],
    "OCTUBRE - DICIEMBRE" => ["X", "Y", "AA", "AB"]
];
var_dump($datosTrim);

foreach ($datosTrim as $trimestre => $letras) {
    echo "<h2>Trimestre: $trimestre</h2>";
    foreach ($letras as $letra) {
        echo "<p>fila: $letra</p>";
    }
}

foreach ($datos as $row) {
    if ($row['Desc_Nombre_Unidad_Academica'] != 'SISTEMA DE INFORMACIÓN PARA LA AUTOEVALUACIÓN') {
        // Convertir fecha a 'Y-m-d H:i:s'
        $fechaConvertida = DateTime::createFromFormat('d-m-Y H:i:s', $row['Fecha'])->format('Y-m-d H:i:s');
        $trimestre = obtenerTrimestre($fechaConvertida);
        $idioma = $row['Desc_Idioma'];

        if (
            $row['Desc_Nombre_Unidad_Academica'] === 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD ZACATENCO' ||
            $row['Desc_Nombre_Unidad_Academica'] === 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD SANTO TOMÁS'
        ) {

            $key = $idioma . '_' . $trimestre;
            if (!isset($sumaPorTrimestre1[$key])) {
                $sumaPorTrimestre1[$key] = [
                    'idioma' => $idioma,
                    'trimestre' => $trimestre,
                    'hombres' => 0,
                    'mujeres' => 0
                ];
            }

            $idiomaXls_1[] = [
                $row['Desc_Idioma'],
                $row['Desc_Hombres'],
                $row['Desc_Mujeres'],
                $fechaConvertida
            ];

            $sumaPorTrimestre1[$key]['hombres'] += $row['Desc_Hombres'];
            $sumaPorTrimestre1[$key]['mujeres'] += $row['Desc_Mujeres'];
        } else {

            $key = $idioma . '_' . $trimestre;
            if (!isset($sumaPorTrimestre2[$key])) {
                $sumaPorTrimestre2[$key] = [
                    'idioma' => $idioma,
                    'trimestre' => $trimestre,
                    'hombres' => 0,
                    'mujeres' => 0
                ];
            }

            $idiomaXls_2[] = [
                $row['Desc_Idioma'],
                $row['Desc_Hombres'],
                $row['Desc_Mujeres'],
                $fechaConvertida
            ];

            $sumaPorTrimestre2[$key]['hombres'] += $row['Desc_Hombres'];
            $sumaPorTrimestre2[$key]['mujeres'] += $row['Desc_Mujeres'];
        }
    }
}



// Ejemplo de uso
$fecha = "28-05-2024";
echo "<br><br><br><br>";
var_dump($idiomaXls_1);
echo "<br><br><br><br>";
var_dump($idiomaXls_2);
echo "<br><br><br><br>";
echo "<br><br><br><br>";
var_dump($sumaPorTrimestre1);
echo "<br><br><br><br>";
echo "<br><br><br><br>";
var_dump($sumaPorTrimestre2);


//!--------------------------------------------------------------------------

function guardarContenidoEnCelda($spreadsheet, $celda, $contenido, $hoja)
{
    // Asignar contenido a la celda especificada en la hoja indicada
    $spreadsheet->getSheet($hoja)->setCellValue($celda, $contenido);
}


function archivoExistencia($nombre)
{
    $rutaData = '../../../exelDFLE/unidades/' . $nombre . '.xlsx';
    if (file_exists($rutaData)) {
        return true;
    } else {
        return false;
    }
}


function ObtenerCeldaIdioma($rango, $idioma, $hoja)
{
    $celdas = $hoja->rangeToArray($rango, null, true, true, true);

    // Iterar sobre cada celda del rango
    foreach ($celdas as $fila => $columnas) {
        foreach ($columnas as $columna => $valor) {
            // Verificar si el valor de la celda coincide con el idioma buscado
            if (strcasecmp($valor, $idioma) === 0) {
                // Si coincide, construir la referencia de la celda y retornarla
                $celdaResult = $fila;
                return $celdaResult;
            }
        }
    }

    // Si el idioma no se encuentra en el rango de celdas, retornar un mensaje de error
    return "No se encontró el idioma en el rango de celdas especificado";
}
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
    $anio = (string) date('Y');
    $rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_3.xlsx';
    $nombreArchivo = '3 DFLE_4T_'.$anio.' ACUMULADO Y COMPARATIVO';
    $rutaCopiaArchivo = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';
    $rutafinal = $rutaCopiaArchivo;
    $fechaCorte = 'FECHA DE CORTE: 31 DE DICIEMBRE DE '.$anio;
    $periodo = 'PERIODO: '.trimestreAct().' DE '.$anio;
    $corteActual = 'Enero - Diciembre '.$anio;
    $cortePasado = 'Enero - Diciembre '.(string)((int)$anio-1);

if (archivoExistencia($nombreArchivo)) {
    //echo 'El archivo existe.';
    $spreadsheet = IOFactory::load($rutafinal);

    if ($spreadsheet) {
        $hoja = $spreadsheet->getSheet(0);
        guardarContenidoEnCelda($spreadsheet, 'AK7', $periodo,0);
        guardarContenidoEnCelda($spreadsheet, 'AK8', $fechaCorte,0);

        $rangoCeldas = 'B16:B27';
        //Empieza a escribir el documento
        echo "<br><br><br><br>";
        echo "<br><br><br><br>";
        foreach ($sumaPorTrimestre1 as $key => $value) {
            $celdaR = ObtenerCeldaIdioma($rangoCeldas, $value["idioma"], $hoja);
            echo "celdaR: " . $celdaR . "<br>";
            echo "Idioma: " . $value["idioma"] . "<br>";
            echo "Trimestre: " . $value["trimestre"] . "<br>";
            $ultimasColumnas = array_slice($datosTrim[$value["trimestre"]], -2);
            //echo "Columnas: " . implode(", ", $ultimasColumnas) . "<br>";
            list($col1, $col2) = array_slice($ultimasColumnas, 0, 2);
            // Imprimir las columnas sin espacios ni otros caracteres
            echo "Columna 1: " . (string) $col1 . (string) $celdaR . "<br>";
            echo "Columna 2: " . (string) $col2 . (string) $celdaR . "<br>";
            echo "Hombres: " . $value["hombres"] . "<br>";
            echo "Mujeres: " . $value["mujeres"] . "<br><br>";
            guardarContenidoEnCelda($spreadsheet, $col1 . $celdaR, $value["hombres"], 0);
            guardarContenidoEnCelda($spreadsheet, $col2 . $celdaR, $value["mujeres"], 0);
        }
        echo "<br><br><br><br>";
        echo "<br><br><br><br>";
        foreach ($sumaPorTrimestre2 as $key => $value) {
            $celdaR = ObtenerCeldaIdioma($rangoCeldas, $value["idioma"], $hoja);
            echo "celdaR: " . $celdaR . "<br>";
            echo "Idioma: " . $value["idioma"] . "<br>";
            echo "Trimestre: " . $value["trimestre"] . "<br>";
            $primerasColumnas = array_slice($datosTrim[$value["trimestre"]], 0, 2);
            //echo "Columnas: " . implode(", ", $primerasColumnas) . "<br>";
            list($col1, $col2) = array_slice($primerasColumnas, 0, 2);
            // Imprimir las columnas sin espacios ni otros caracteres
            echo "Columna 1: $col1$celdaR<br>";
            echo "Columna 2: $col2$celdaR<br>";
            echo "Hombres: " . $value["hombres"] . "<br>";
            echo "Mujeres: " . $value["mujeres"] . "<br><br>";
            guardarContenidoEnCelda($spreadsheet, $col1 . $celdaR, $value["hombres"], 0);
            guardarContenidoEnCelda($spreadsheet, $col2 . $celdaR, $value["mujeres"], 0);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($rutaCopiaArchivo);

    } else {
        //echo "<br><h1>Error al abrir la hoja del archivo Excel.</h1>";
    }
} else {
    //echo 'El archivo No existe.';
    // Copiar el archivo original a la nueva ubicación
    if (copy($rutaArchivoOriginal, $rutafinal)) {
        //echo 'Copia del archivo creada exitosamente.';
        $spreadsheet = IOFactory::load($rutafinal);

        if ($spreadsheet) {
            $hoja = $spreadsheet->getSheet(0);
            guardarContenidoEnCelda($spreadsheet, 'AK7', $periodo,0);
            guardarContenidoEnCelda($spreadsheet, 'AK8', $fechaCorte,0);

            $rangoCeldas = 'B16:B27';
            //Empieza a escribir el documento
            echo "<br><br><br><br>";
            echo "<br><br><br><br>";
            foreach ($sumaPorTrimestre1 as $key => $value) {
                $celdaR = ObtenerCeldaIdioma($rangoCeldas, $value["idioma"], $hoja);
                echo "celdaR: " . $celdaR . "<br>";
                echo "Idioma: " . $value["idioma"] . "<br>";
                echo "Trimestre: " . $value["trimestre"] . "<br>";
                $ultimasColumnas = array_slice($datosTrim[$value["trimestre"]], -2);
                //echo "Columnas: " . implode(", ", $ultimasColumnas) . "<br>";
                list($col1, $col2) = array_slice($ultimasColumnas, 0, 2);
                // Imprimir las columnas sin espacios ni otros caracteres
                echo "Columna 1: " . (string) $col1 . (string) $celdaR . "<br>";
                echo "Columna 2: " . (string) $col2 . (string) $celdaR . "<br>";
                echo "Hombres: " . $value["hombres"] . "<br>";
                echo "Mujeres: " . $value["mujeres"] . "<br><br>";
                guardarContenidoEnCelda($spreadsheet, $col1 . $celdaR, $value["hombres"], 0);
                guardarContenidoEnCelda($spreadsheet, $col2 . $celdaR, $value["mujeres"], 0);
            }
            echo "<br><br><br><br>";
            echo "<br><br><br><br>";
            foreach ($sumaPorTrimestre2 as $key => $value) {
                $celdaR = ObtenerCeldaIdioma($rangoCeldas, $value["idioma"], $hoja);
                echo "celdaR: " . $celdaR . "<br>";
                echo "Idioma: " . $value["idioma"] . "<br>";
                echo "Trimestre: " . $value["trimestre"] . "<br>";
                $primerasColumnas = array_slice($datosTrim[$value["trimestre"]], 0, 2);
                //echo "Columnas: " . implode(", ", $primerasColumnas) . "<br>";
                list($col1, $col2) = array_slice($primerasColumnas, 0, 2);
                // Imprimir las columnas sin espacios ni otros caracteres
                echo "Columna 1: $col1$celdaR<br>";
                echo "Columna 2: $col2$celdaR<br>";
                echo "Hombres: " . $value["hombres"] . "<br>";
                echo "Mujeres: " . $value["mujeres"] . "<br><br>";
                guardarContenidoEnCelda($spreadsheet, $col1 . $celdaR, $value["hombres"], 0);
                guardarContenidoEnCelda($spreadsheet, $col2 . $celdaR, $value["mujeres"], 0);
            }

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save($rutaCopiaArchivo);

        } else {
            //echo "<br><h1>Error al abrir la hoja del archivo Excel.</h1>";
        }
    } else {
        //echo '<br><h1>Error al crear la copia del archivo.</h1>';
    }
}


?>