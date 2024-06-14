<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
include '../../../trimestre.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selectIdioma']) && !empty($_POST['selectIdioma'])) {
        if (empty($_POST['dato3']) || empty($_POST['dato4']) || empty($_POST['dato5'])) {
            header("Location: CargaActiv.php?status=ArrayEmpty");
            exit();
        }

        echo "<br><h2>  Datos por enviar </h2><br>";
        var_dump($_POST);

        // Extraer el primer elemento
        $selectIdioma = $_POST['selectIdioma'];
        unset($_POST['selectIdioma']);

        // Colocar el resto de los datos en un nuevo arreglo
        $nuevosDatos = array();
        foreach ($_POST as $key => $value) {
            $nuevosDatos[$key] = $value;
        }

        // Depuración para verificar los resultados
        echo "<br><h2>  selectIdioma </h2><br>";
        var_dump($selectIdioma);

        echo "<br><h2>  Nuevos Datos </h2><br>";
        var_dump($nuevosDatos);

        foreach ($nuevosDatos as $key => $value) {
            echo "<br><br><br>";
            echo "  -- key : " . $key . "   valor  : ";
            print_r($value); // O var_dump($value);
        }

        for ($i = 1; $i <= count($nuevosDatos); $i++) {
            echo "<br>";
            // var_dump($nuevosDatos['dato'.$i]);
        }
        //!---------------------------------------------------------------------------------------
        function trimestreAct()
        {
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

        // Function to save content in a specific cell of a sheet
        function guardarContenidoEnCelda($spreadsheet, $celda, $contenido, $hoja)
        {
            $spreadsheet->getSheet($hoja)->setCellValue($celda, $contenido);
        }

        // Function to check if a file exists
        function archivoExistencia($nombre)
        {
            $rutaData = '../../../exelDFLE/unidades/' . $nombre . '.xlsx';
            return file_exists($rutaData);
        }

        // Function to get cell row based on language
        function ObtenerCeldaIdioma($rango, $idioma, $hoja)
        {
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

        // Function to insert rows after a specified row in a sheet
        function insertarFilas($spreadsheet, $fila, $filas_n, $hojaIndex)
        {
            $hoja = $spreadsheet->getSheet($hojaIndex);
            $hoja->insertNewRowBefore($fila + 1, $filas_n); // Insertar 'n' filas después de la fila indicada
        }
        function insertarFormulaEnCelda($spreadsheet, $hojaIndex, $celda, $formula)
        {
            // Obtiene la hoja por índice
            $hoja = $spreadsheet->getSheet($hojaIndex);

            // Inserta la fórmula en la celda especificada
            $hoja->setCellValue($celda, $formula);
        }

        function subirData($connection, $params)
        {
            $queryData = '
            INSERT INTO Formato12DFLE (Desc_Trimestre, Desc_Tipo_Accion, Desc_AccionFormativa, 
            Desc_Modalidad, id_Idioma, id_UnidadAcademica, Desc_Hombres, Desc_Mujeres, Fecha)
            VALUES (?, ?, ?, ?, 
            (SELECT ID_Idioma FROM Idiomas WHERE Desc_Idioma = ?), 
            (SELECT ID_UnidadAcademica FROM Unidades_Academicas WHERE Desc_Nombre_Unidad_Academica = ?), 
            ?, ?, ?);
            ';

            // Preparar la consulta
            $stmt = sqlsrv_prepare($connection, $queryData, $params);

            // Verificar si la preparación de la consulta falló
            if ($stmt === false) {
                echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
                return false; // Salir de la función si hay un error
            }

            // Ejecutar la consulta
            $result = sqlsrv_execute($stmt);

            // Verificar si la ejecución de la consulta falló
            if ($result === false) {
                echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
                return false; // Salir de la función si hay un error
            }

            // Si todo va bien, imprimir un mensaje de éxito
            echo "<br><h1>Datos insertados</h1>";
            return true; // Indicar que la operación fue exitosa
        }


        $anio = (string) date('Y');
        $rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_5.xlsx';
        $nombreArchivo = '5 DFLE_4T_' . $anio . ' ACCIONES DE FORMACION DOCENTE';
        $rutaCopiaArchivo = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';
        $rutafinal = $rutaCopiaArchivo;
        $fechaCorte = 'FECHA DE CORTE: 31 DE DICIEMBRE DE ' . $anio;
        $periodo = 'PERIODO: ' . trimestreAct() . ' DE ' . $anio;
        $no_filas = (int) count($nuevosDatos['dato1']);
        $trimestre = trimestreAct();

        if (archivoExistencia($nombreArchivo)) {
            $spreadsheet = IOFactory::load($rutafinal);
            $totalSheets = $spreadsheet->getSheetCount();

            if ($totalSheets > 1) {
                $hoja = $spreadsheet->getSheet(1);
                $rangoCeldas = 'B12:B100';
                guardarContenidoEnCelda($spreadsheet, 'I6', $periodo, 1);
                guardarContenidoEnCelda($spreadsheet, 'I7', $fechaCorte, 1);

                $celdaR = ObtenerCeldaIdioma($rangoCeldas, $selectIdioma, $hoja);
                echo "<br> $celdaR";
                // Insertar filas después de la fila encontrada
                insertarFilas($spreadsheet, (string) ((int) $celdaR - 1), $no_filas, 1);
                for ($i = $celdaR; $i < $celdaR + $no_filas; $i++) {
                    guardarContenidoEnCelda($spreadsheet, 'I7', $fechaCorte, 1);
                    for ($j = 1; $j <= count($nuevosDatos); $j++) {
                        if (isset($nuevosDatos['dato' . $j][$i - $celdaR])) {
                            guardarContenidoEnCelda($spreadsheet, 'B' . $i, (string) ($nuevosDatos['dato1'][$i - $celdaR]), 1);
                            guardarContenidoEnCelda($spreadsheet, 'C' . $i, (string) ($nuevosDatos['dato2'][$i - $celdaR]), 1);
                            guardarContenidoEnCelda($spreadsheet, 'D' . $i, (string) ($nuevosDatos['dato3'][$i - $celdaR]), 1);
                            guardarContenidoEnCelda($spreadsheet, 'E' . $i, (string) ($nuevosDatos['dato4'][$i - $celdaR]), 1);
                            guardarContenidoEnCelda($spreadsheet, 'F' . $i, (string) ($nuevosDatos['dato5'][$i - $celdaR]), 1);

                            guardarContenidoEnCelda($spreadsheet, 'G' . $i, (string) ($nuevosDatos['dato6'][$i - $celdaR]), 1);
                            guardarContenidoEnCelda($spreadsheet, 'H' . $i, (string) ($nuevosDatos['dato7'][$i - $celdaR]), 1);
                            guardarContenidoEnCelda($spreadsheet, 'I' . $i, (string) ($nuevosDatos['dato8'][$i - $celdaR]), 1);

                            $params = [
                                (string) $trimestre,
                                (string) ($nuevosDatos['dato1'][$i - $celdaR]),
                                (string) ($nuevosDatos['dato2'][$i - $celdaR]),
                                (string) ($nuevosDatos['dato3'][$i - $celdaR]),
                                (string) ($nuevosDatos['dato4'][$i - $celdaR]),
                                (string) ($nuevosDatos['dato5'][$i - $celdaR]),
                                (string) ($nuevosDatos['dato6'][$i - $celdaR]),
                                (string) ($nuevosDatos['dato7'][$i - $celdaR]),
                                (string) date('Y-m-d H:i:s')
                            ];

                            subirData($connection, $params);

                            $suma = (string) ((int) ($nuevosDatos['dato6'][$i - $celdaR]) + (int) ($nuevosDatos['dato7'][$i - $celdaR]));
                            guardarContenidoEnCelda($spreadsheet, 'I' . $i, $suma, 1);
                        }
                    }
                }
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
                    $hoja = $spreadsheet->getSheet(1);
                    $rangoCeldas = 'B12:B100';
                    guardarContenidoEnCelda($spreadsheet, 'I6', $periodo, 1);
                    guardarContenidoEnCelda($spreadsheet, 'I7', $fechaCorte, 1);

                    $celdaR = ObtenerCeldaIdioma($rangoCeldas, $selectIdioma, $hoja);
                    echo "<br> $celdaR";
                    // Insertar filas después de la fila encontrada
                    insertarFilas($spreadsheet, (string) ((int) $celdaR - 1), $no_filas, 1);
                    for ($i = $celdaR; $i < $celdaR + $no_filas; $i++) {
                        guardarContenidoEnCelda($spreadsheet, 'I7', $fechaCorte, 1);
                        for ($j = 1; $j <= count($nuevosDatos); $j++) {
                            if (isset($nuevosDatos['dato' . $j][$i - $celdaR])) {
                                guardarContenidoEnCelda($spreadsheet, 'B' . $i, (string) ($nuevosDatos['dato1'][$i - $celdaR]), 1);
                                guardarContenidoEnCelda($spreadsheet, 'C' . $i, (string) ($nuevosDatos['dato2'][$i - $celdaR]), 1);
                                guardarContenidoEnCelda($spreadsheet, 'D' . $i, (string) ($nuevosDatos['dato3'][$i - $celdaR]), 1);
                                guardarContenidoEnCelda($spreadsheet, 'E' . $i, (string) ($nuevosDatos['dato4'][$i - $celdaR]), 1);
                                guardarContenidoEnCelda($spreadsheet, 'F' . $i, (string) ($nuevosDatos['dato5'][$i - $celdaR]), 1);

                                guardarContenidoEnCelda($spreadsheet, 'G' . $i, (string) ($nuevosDatos['dato6'][$i - $celdaR]), 1);
                                guardarContenidoEnCelda($spreadsheet, 'H' . $i, (string) ($nuevosDatos['dato7'][$i - $celdaR]), 1);
                                guardarContenidoEnCelda($spreadsheet, 'I' . $i, (string) ($nuevosDatos['dato8'][$i - $celdaR]), 1);


                                $params = [
                                    (string) $trimestre,
                                    (string) ($nuevosDatos['dato1'][$i - $celdaR]),
                                    (string) ($nuevosDatos['dato2'][$i - $celdaR]),
                                    (string) ($nuevosDatos['dato3'][$i - $celdaR]),
                                    (string) ($nuevosDatos['dato4'][$i - $celdaR]),
                                    (string) ($nuevosDatos['dato5'][$i - $celdaR]),
                                    (string) ($nuevosDatos['dato6'][$i - $celdaR]),
                                    (string) ($nuevosDatos['dato7'][$i - $celdaR]),
                                    (string) date('Y-m-d H:i:s')

                                ];

                                subirData($connection, $params);

                                $suma = (string) ((int) ($nuevosDatos['dato6'][$i - $celdaR]) + (int) ($nuevosDatos['dato7'][$i - $celdaR]));
                                guardarContenidoEnCelda($spreadsheet, 'I' . $i, $suma, 1);
                            }
                        }
                    }
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
        echo "<br><h2>Error: El campo 'selectIdioma' no está establecido o está vacío.</h2><br>";
        header("Location: CargaActiv.php?status=TrimErrSelect");
        exit();
    }
} else {
    echo "<br><h2>Error: La solicitud no se realizó por el método POST.</h2><br>";
    header("Location: CargaActiv.php?status=DataPOST");
    exit();
}
?>