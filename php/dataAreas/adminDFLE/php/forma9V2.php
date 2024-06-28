<?php
    require '../../../vendor/autoload.php';
    header('Content-Type: text/html; charset=utf-8');
    use PhpOffice\PhpSpreadsheet\IOFactory;
    date_default_timezone_set('America/Mexico_City');
    include '../../../conexion.php';

    $fecha = date('Y'); 
    $fechaPasado = (string)((int)$fecha-1);
    //var_dump($fecha);
    //var_dump($fechaPasado);
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
    $params = array('%' . $fechaPasado . '%'); 

    // Preparar la consulta
    $stmt = sqlsrv_prepare($connection, $queryData, $params);
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
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $datos[] = $row;
            }
        }
        // Liberar el conjunto de resultados
        sqlsrv_free_stmt($stmt);
    }


    
    function obtenerTrimestre($fecha) {
        // Asegurarse de que la fecha esté en el formato correcto
        $fechaValida = DateTime::createFromFormat('d-m-Y', $fecha);
        if (!$fechaValida) {
            return "Formato de fecha inválido";
        }
    
        // Obtener el mes de la fecha
        $mes = (int) $fechaValida->format('m');
    
        if ($mes >= 1 && $mes <= 3) {
            return "[enero - marzo]";
        } elseif ($mes >= 4 && $mes <= 6) {
            return "[abril - junio]";
        } elseif ($mes >= 7 && $mes <= 9) {
            return "[julio - septiembre]";
        } elseif ($mes >= 10 && $mes <= 12) {
            return "[octubre - diciembre]";
        } else {
            return "Mes inválido";
        }
    }


    $idiomaXls_1 = array();
    $idiomaXls_2 = array();
    // Imprimir los datos
    foreach ($datos as $row){
        if(            
            $row['Desc_Nombre_Unidad_Academica'] != 'SISTEMA DE INFORMACIÓN PARA LA AUTOEVALUACIÓN' 
        ){
        if(
            $row['Desc_Nombre_Unidad_Academica'] === 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD ZACATENCO'
            ||
            $row['Desc_Nombre_Unidad_Academica'] === 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD SANTO TOMÁS' 
        ){
            $idiomaXls_1[] = [
                $dato = $row['Desc_Idioma'],$row['Desc_Hombres'],$row['Desc_Mujeres']
            ];
        }else{
            $idiomaXls_2[] = [
                $dato = $row['Desc_Idioma'],$row['Desc_Hombres'],$row['Desc_Mujeres']
            ];
        }
    }
    }

        
// Definir arreglos para almacenar totales de hombres y mujeres por idioma para idiomaXls_1
$totalesHombres_1 = array();
$totalesMujeres_1 = array();

// Función para actualizar los totales de hombres y mujeres por idioma para idiomaXls_1
function actualizarTotales_1($idioma, $hombres, $mujeres) {
    global $totalesHombres_1, $totalesMujeres_1;
    
    if (!isset($totalesHombres_1[$idioma])) {
        $totalesHombres_1[$idioma] = 0;
    }
    if (!isset($totalesMujeres_1[$idioma])) {
        $totalesMujeres_1[$idioma] = 0;
    }

    $totalesHombres_1[$idioma] += $hombres;
    $totalesMujeres_1[$idioma] += $mujeres;
}

// Iterar sobre $idiomaXls_1 para sumar los totales
foreach ($idiomaXls_1 as $subArray) {
    $idioma = $subArray[0];
    $hombres = $subArray[1];
    $mujeres = $subArray[2];
    actualizarTotales_1($idioma, $hombres, $mujeres);
}
/*
// Imprimir totales para idiomaXls_1
foreach ($totalesHombres_1 as $idioma => $totalHombres) {
    $totalMujeres = $totalesMujeres_1[$idioma];
    echo "<br><h4>Total de Hombres para $idioma en idiomaXls_1: $totalHombres</h4>";
    echo "<h4>Total de Mujeres para $idioma en idiomaXls_1: $totalMujeres</h4>";
}
*/
// Definir arreglos para almacenar totales de hombres y mujeres por idioma para idiomaXls_2
$totalesHombres_2 = array();
$totalesMujeres_2 = array();

// Función para actualizar los totales de hombres y mujeres por idioma para idiomaXls_2
function actualizarTotales_2($idioma, $hombres, $mujeres) {
    global $totalesHombres_2, $totalesMujeres_2;
    
    if (!isset($totalesHombres_2[$idioma])) {
        $totalesHombres_2[$idioma] = 0;
    }
    if (!isset($totalesMujeres_2[$idioma])) {
        $totalesMujeres_2[$idioma] = 0;
    }

    $totalesHombres_2[$idioma] += $hombres;
    $totalesMujeres_2[$idioma] += $mujeres;
}

// Iterar sobre $idiomaXls_2 para sumar los totales
foreach ($idiomaXls_2 as $subArray) {
    $idioma = $subArray[0];
    $hombres = $subArray[1];
    $mujeres = $subArray[2];
    actualizarTotales_2($idioma, $hombres, $mujeres);
}
/*
// Imprimir totales para idiomaXls_2
foreach ($totalesHombres_2 as $idioma => $totalHombres) {
    $totalMujeres = $totalesMujeres_2[$idioma];
    echo "<br><h4>Total de Hombres para $idioma en idiomaXls_2: $totalHombres</h4>";
    echo "<h4>Total de Mujeres para $idioma en idiomaXls_2: $totalMujeres</h4>";
}

*/

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



$anio = (string) date('Y');
$rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_3.xlsx';
$nombreArchivo = '3 DFLE_4T_'.$anio.' ACUMULADO Y COMPARATIVO';
$rutaCopiaArchivo = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';
$rutafinal = $rutaCopiaArchivo;

if (archivoExistencia($nombreArchivo)) {
    //echo 'El archivo existe.';
    $spreadsheet = IOFactory::load($rutafinal);
        if ($spreadsheet) {
            $hoja = $spreadsheet->getSheet(1); 
            
            guardarContenidoEnCelda($spreadsheet, 'J13','Enero - Diciembre '.'  '.date('Y'), 1);
            guardarContenidoEnCelda($spreadsheet, 'C13','Enero - Diciembre '.'  '.(string)((int)date('Y')-1), 1);
            
            
            $rangoCeldas = 'B16:B27';
            
            foreach ($totalesHombres_1 as $idioma => $cantidad) {
                //echo "Idioma: $idioma, Cantidad H: ".$cantidad."<br>";
                $celdaResult = ObtenerCeldaIdioma($rangoCeldas, $idioma, $hoja);
                //echo "<br><h2> --------- $celdaResult </h2>";
                guardarContenidoEnCelda($spreadsheet, 'C'.$celdaResult, $cantidad, 1);
            }
            
            foreach ($totalesMujeres_1 as $idioma => $cantidad) {
                //echo "Idioma: $idioma, Cantidad M: ".$cantidad."<br>";
                $celdaResult = ObtenerCeldaIdioma($rangoCeldas,(string)$idioma,$hoja);
                //echo "<br><h2> --------- $celdaResult </h2>";
                guardarContenidoEnCelda($spreadsheet, 'D'.$celdaResult, $cantidad, 1);
            }
            //echo "<br><br><br><br><br><br>";
            foreach ($totalesHombres_2 as $idioma => $cantidad) {
                //echo "Idioma: $idioma, Cantidad H: ".$cantidad."<br>";
                $celdaResult = ObtenerCeldaIdioma($rangoCeldas,(string)$idioma,$hoja);
                guardarContenidoEnCelda($spreadsheet, 'F'.$celdaResult, $cantidad, 1);
                //echo "<br><h2> --------- $celdaResult </h2>";
            }
            foreach ($totalesMujeres_2 as $idioma => $cantidad) {
                //echo "Idioma: $idioma, Cantidad M: ".$cantidad."<br>";
                $celdaResult = ObtenerCeldaIdioma($rangoCeldas,(string)$idioma,$hoja);
                guardarContenidoEnCelda($spreadsheet, 'G'.$celdaResult, $cantidad, 1);
                //echo "<br><h2> --------- $celdaResult </h2>";
            }
            
            //var_dump($totalesHombres_1);
            //var_dump($totalesHombres_2);
    
    
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save($rutaCopiaArchivo);

            header("Location: Bienvenida.php?status=Exc3-Generado");
            exit();
            //echo "<br><h1>¡Hoja abierta con éxito!</h1>";
        } else {
            //echo "<br><h1>Error al abrir la hoja del archivo Excel.</h1>";
            header("Location: Bienvenida.php?status=ErrXls");
            exit();
        }

    }
?>
