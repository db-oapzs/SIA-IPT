<?php

// Incluir la clase de PHP Spreadsheet
require '../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');
include '../conexion.php';
$rutafinal;


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST) && isset($_POST["idioma"]) && $_POST['idioma'] != '' && $_POST['idioma'] != 'Selecciona una lengua') {
    //echo "<br><h2>Envia datos a la tabla temporal</h2><br>";
    //var_dump($_POST);
    //echo "<br><h2>" . count($_POST) . "</h2>";

    // Array recibido por POST
    $data = $_POST;
    $dataPOST = array();
    foreach ($data as $key => $value) {
        // Verificar si el nombre del campo no comienza con "T" y no contiene la palabra "total"
        if (substr($key, 0, 1) !== "T" && strpos($key, "total") === false) {
            // Guardar el nombre del campo y su valor (o un espacio si el valor está vacío)
            $dataPOST[$key] = $value !== "" ? $value : " ";
        }
    }
    $nombreunidad = $_POST['unidadAcademica'];
    $idioma = $_POST['idioma'];
    $fechaCreacion = date('d-m-Y H:i:s');
    $fecha = $fechaCreacion;
    // Mostrar el arreglo resultante
    //var_dump($dataPOST);
    //echo "<br><h2>" . count($dataPOST) . "</h2>";


    $queryVerifica = '
    SELECT 
    CASE 
        WHEN COUNT(*) >= 24 THEN ? 
        ELSE ?
    END AS Resultado
    FROM Cantidades_Alumnos 
    WHERE id_UnidadAcademica = 
    (SELECT ID_UnidadAcademica FROM Unidades_Academicas WHERE Desc_Nombre_Unidad_Academica = ?)
    AND id_Idioma = 
    (SELECT ID_Idioma FROM Idiomas WHERE Desc_Idioma = ?)
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
                //echo 'bloqueado';
                header("Location: cargarData.php?status=IdiomaBlock");
                exit();
            } else {
                //echo 'No bloqueado';
                function filtrarDatos($data, &$dataPOST, $keyword)
                {
                    foreach ($data as $key => $value) {
                        // Verificar si el nombre del campo contiene la palabra clave y no comienza con "T"
                        if (strpos($key, $keyword) !== false && substr($key, 0, 1) !== "T") {
                            // Guardar el nombre del campo y su valor (o un espacio si el valor está vacío)
                            $dataPOST[$key] = $value !== "" ? $value : " ";
                        }
                    }
                }

                $dataResult_basic = array();
                filtrarDatos($data, $dataResult_basic, "basic");
                //var_dump($dataResult_basic);
                //echo "<br><h2>" . count($dataResult_basic) . "</h2>";
                $dataResult_inter = array();
                filtrarDatos($data, $dataResult_inter, "inter");
                //var_dump($dataResult_inter);
                //echo "<br><h2>" . count($dataResult_inter) . "</h2>";
                $dataResult_avanz = array();
                filtrarDatos($data, $dataResult_avanz, "avanz");
                //var_dump($dataResult_avanz);
                //echo "<br><h2>" . count($dataResult_avanz) . "</h2>";
                $dataResult_sup = array();
                filtrarDatos($data, $dataResult_sup, "sup");
                //var_dump($dataResult_sup);
                //echo "<br><h2>" . count($dataResult_sup) . "</h2>";
                //!-----------------------------------------------------------------------------
                function filtrarDatosHM($data, &$dataPOST, $keyword)
                {
                    foreach ($data as $key => $value) {
                        // Verificar si el nombre del campo comienza con la palabra clave y no comienza con "T"
                        if (substr($key, 0, strlen($keyword)) === $keyword && substr($key, 0, 1) !== "T") {
                            // Guardar el nombre del campo y su valor (o un espacio si el valor está vacío)
                            $dataPOST[$key] = $value !== "" ? $value : " ";
                        }
                    }
                }

                $dataResult_basicH = array();
                filtrarDatosHM($dataResult_basic, $dataResult_basicH, "Hbasic");
                //echo "<br><br>";
                //var_dump($dataResult_basicH);

                //echo "<br><h2>" . count($dataResult_basicH) . "</h2>";
                $dataResult_basicM = array();
                filtrarDatosHM($dataResult_basic, $dataResult_basicM, "Mbasic");
                //var_dump($dataResult_basicM);
                //echo "<br><h2>" . count($dataResult_basicM) . "</h2>";

                $dataResult_interH = array();
                filtrarDatosHM($dataResult_inter, $dataResult_interH, "Hinter");
                //var_dump($dataResult_interH);
                //echo "<br><h2>" . count($dataResult_interH) . "</h2>";

                $dataResult_interM = array();
                filtrarDatosHM($dataResult_inter, $dataResult_interM, "Minter");
                //var_dump($dataResult_interM);
                //echo "<br><h2>" . count($dataResult_interM) . "</h2>";

                $dataResult_avanzH = array();
                filtrarDatosHM($dataResult_avanz, $dataResult_avanzH, "Havanz");
                //var_dump($dataResult_avanzH);
                //echo "<br><h2>" . count($dataResult_avanzH) . "</h2>";
                $dataResult_avanzM = array();
                filtrarDatosHM($dataResult_avanz, $dataResult_avanzM, "Mavanz");
                ////var_dump($dataResult_avanzM);
                //echo "<br><h2>" . count($dataResult_avanzM) . "</h2>";

                $dataResult_supH = array();
                filtrarDatosHM($dataResult_sup, $dataResult_supH, "Hsup");
                //var_dump($dataResult_supH);
                //echo "<br><h2>" . count($dataResult_supH) . "</h2>";
                $dataResult_supM = array();
                filtrarDatosHM($dataResult_sup, $dataResult_supM, "Msup");
                //var_dump($dataResult_supM);

                //echo "<br><h2>" . count($dataResult_supM) . "</h2>";
                //echo "<br><br><h2>" . ($fechaCreacion) . "</h2>";


                //!-----------------------------------------------------------------------


                function guardarContenidoEnCelda($spreadsheet, $celda, $contenido, $ruta)
                {
                    // Asignar contenido a la celda especificada
                    $spreadsheet->getActiveSheet()->setCellValue($celda, $contenido);
                }

                function archivoExistencia($nombre)
                {
                    $rutaData = '../exelDFLE/unidades/' . $nombre . '.xlsx';
                    if (file_exists($rutaData)) {
                        return true;
                    } else {
                        return false;
                    }
                }




// Ruta del archivo original y copia
                // Ruta del archivo original
                $anio = (string)date('Y');
                $rutaArchivoOriginal = '../exelDFLE/plnatilla/General.xlsx';
                // Ruta donde se guardará la copia del archivo
                //$nombreArchivo = 'General_'.$nombreunidad.'_'.$idioma;
                $mes = date('n');
                $numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => "Mes inválido"};
                $nombreArchivo = '4 DFLE_'.$numTrimestre.'T_'.$anio.' ' . $nombreunidad;
                $rutaCopiaArchivo = '../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';
                $RutanombreArchivo = $rutaCopiaArchivo;
                $rutafinal = $rutaCopiaArchivo;

                if (archivoExistencia($nombreArchivo)) {
                    //echo 'El archivo existe.';
                    $spreadsheet = IOFactory::load($rutafinal);
                    if ($spreadsheet) {
                        // Obtener la primera hoja (Sheet1) del archivo Excel
                        $hoja = $spreadsheet->getSheet(0); // Índice 0 indica la primera hoja
                        guardarContenidoEnCelda($spreadsheet, 'C7', $nombreunidad, $rutaCopiaArchivo);
                        $arregloCeldadData = ['C', 'D', 'F', 'G', 'I', 'J', 'L', 'M', 'O', 'P', 'U', 'V'];
                        //Encontrar dato de la B11 a la B22
                        $rangoCeldas = 'B11:B22';

                        function ObtenerCeldaIdioma($rang, $idiom, $hoja)
                        {
                            $celdas = $hoja->rangeToArray($rang, null, true, true, true);
                            // Iterar sobre cada celda del rango
                            foreach ($celdas as $fila => $columnas) {
                                foreach ($columnas as $columna => $valor) {
                                    // Verificar si el valor de la celda coincide con el idioma buscado
                                    if ($valor == $idiom) {
                                        // Si coincide, imprimir la posición de la celda
                                        $CeldaResult = $fila;
                                        return $CeldaResult;
                                        // Aquí puedes realizar cualquier otra acción que necesites con la celda encontrada
                                    }
                                }
                            }
                        }
                        //¿   Nivel basico Excel
                        $celdaR = ObtenerCeldaIdioma('B11:B22', $idioma, $hoja);
                        //echo "<br> $celdaR <br>";
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[0] . $celdaR, intval($dataResult_basicH["HbasicMs"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[1] . $celdaR, intval($dataResult_basicM["MbasicMs"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[2] . $celdaR, intval($dataResult_basicH["HbasicSup"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[3] . $celdaR, intval($dataResult_basicM["MbasicSup"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[4] . $celdaR, intval($dataResult_basicH["HbasicPos"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[5] . $celdaR, intval($dataResult_basicM["MbasicPos"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[6] . $celdaR, intval($dataResult_basicH["HbasicEgr"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[7] . $celdaR, intval($dataResult_basicM["MbasicEgr"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[8] . $celdaR, intval($dataResult_basicH["HbasicEmp"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[9] . $celdaR, intval($dataResult_basicM["MbasicEmp"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[10] . $celdaR, intval($dataResult_basicH["HbasicPg"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[11] . $celdaR, intval($dataResult_basicM["MbasicPg"]), $rutaCopiaArchivo);

                        //¿   Nivel intermedio Excel
                        $celdaR = ObtenerCeldaIdioma('B24:B35', $idioma, $hoja);
                        //echo "<br> $celdaR <br>";
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[0] . $celdaR, intval($dataResult_interH["HinterMs"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[1] . $celdaR, intval($dataResult_interM["MinterMs"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[2] . $celdaR, intval($dataResult_interH["HinterSup"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[3] . $celdaR, intval($dataResult_interM["MinterSup"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[4] . $celdaR, intval($dataResult_interH["HinterPos"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[5] . $celdaR, intval($dataResult_interM["MinterPos"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[6] . $celdaR, intval($dataResult_interH["HinterEgr"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[7] . $celdaR, intval($dataResult_interM["MinterEgr"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[8] . $celdaR, intval($dataResult_interH["HinterEmp"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[9] . $celdaR, intval($dataResult_interM["MinterEmp"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[10] . $celdaR, intval($dataResult_interH["HinterPg"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[11] . $celdaR, intval($dataResult_interM["MinterPg"]), $rutaCopiaArchivo);

                        //¿   Nivel avanzado Excel
                        $celdaR = ObtenerCeldaIdioma('B37:B48', $idioma, $hoja);
                        //echo "<br> $celdaR <br>";
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[0] . $celdaR, intval($dataResult_avanzH["HavanzMs"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[1] . $celdaR, intval($dataResult_avanzM["MavanzMs"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[2] . $celdaR, intval($dataResult_avanzH["HavanzSup"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[3] . $celdaR, intval($dataResult_avanzM["MavanzSup"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[4] . $celdaR, intval($dataResult_avanzH["HavanzPos"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[5] . $celdaR, intval($dataResult_avanzM["MavanzPos"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[6] . $celdaR, intval($dataResult_avanzH["HavanzEgr"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[7] . $celdaR, intval($dataResult_avanzM["MavanzEgr"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[8] . $celdaR, intval($dataResult_avanzH["HavanzEmp"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[9] . $celdaR, intval($dataResult_avanzM["MavanzEmp"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[10] . $celdaR, intval($dataResult_avanzH["HavanzPg"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[11] . $celdaR, intval($dataResult_avanzM["MavanzPg"]), $rutaCopiaArchivo);


                        //¿   Nivel superior Excel
                        $celdaR = ObtenerCeldaIdioma('B50:B61', $idioma, $hoja);
                        //echo "<br> $celdaR <br>";
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[0] . $celdaR, intval($dataResult_supH["HsupMs"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[1] . $celdaR, intval($dataResult_supM["MsupMs"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[2] . $celdaR, intval($dataResult_supH["HsupSup"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[3] . $celdaR, intval($dataResult_supM["MsupSup"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[4] . $celdaR, intval($dataResult_supH["HsupPos"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[5] . $celdaR, intval($dataResult_supM["MsupPos"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[6] . $celdaR, intval($dataResult_supH["HsupEgr"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[7] . $celdaR, intval($dataResult_supM["MsupEgr"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[8] . $celdaR, intval($dataResult_supH["HsupEmp"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[9] . $celdaR, intval($dataResult_supM["MsupEmp"]), $rutaCopiaArchivo);

                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[10] . $celdaR, intval($dataResult_supH["HsupPg"]), $rutaCopiaArchivo);
                        guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[11] . $celdaR, intval($dataResult_supM["MsupPg"]), $rutaCopiaArchivo);


                        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                        $writer->save($rutaCopiaArchivo);

                        //echo "<br><h1>¡Hoja abierta con éxito!</h1>";
                    } else {
                        //echo "<br><h1>Error al abrir la hoja del archivo Excel.</h1>";
                    }
                } else {
                    //echo 'El archivo No existe.';
                    // Copiar el archivo original a la nueva ubicación
                    if (copy($rutaArchivoOriginal, $rutaCopiaArchivo)) {
                        //echo 'Copia del archivo creada exitosamente.';
                        $RutanombreArchivo = $rutaCopiaArchivo;
                        $spreadsheet = IOFactory::load($rutafinal);
                        if ($spreadsheet) {
                            // Obtener la primera hoja (Sheet1) del archivo Excel
                            $hoja = $spreadsheet->getSheet(0); // Índice 0 indica la primera hoja
                            guardarContenidoEnCelda($spreadsheet, 'C7', $nombreunidad, $rutaCopiaArchivo);
                            $arregloCeldadData = ['C', 'D', 'F', 'G', 'I', 'J', 'L', 'M', 'O', 'P', 'U', 'V'];
                            //Encontrar dato de la B11 a la B22
                            $rangoCeldas = 'B11:B22';

                            function ObtenerCeldaIdioma($rang, $idiom, $hoja)
                            {
                                $celdas = $hoja->rangeToArray($rang, null, true, true, true);
                                // Iterar sobre cada celda del rango
                                foreach ($celdas as $fila => $columnas) {
                                    foreach ($columnas as $columna => $valor) {
                                        // Verificar si el valor de la celda coincide con el idioma buscado
                                        if ($valor == $idiom) {
                                            // Si coincide, imprimir la posición de la celda
                                            $CeldaResult = $fila;
                                            return $CeldaResult;
                                            // Aquí puedes realizar cualquier otra acción que necesites con la celda encontrada
                                        }
                                    }
                                }
                            }
                            //¿   Nivel basico Excel
                            $celdaR = ObtenerCeldaIdioma('B11:B22', $idioma, $hoja);
                            //echo "<br> $celdaR <br>";
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[0] . $celdaR, intval($dataResult_basicH["HbasicMs"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[1] . $celdaR, intval($dataResult_basicM["MbasicMs"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[2] . $celdaR, intval($dataResult_basicH["HbasicSup"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[3] . $celdaR, intval($dataResult_basicM["MbasicSup"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[4] . $celdaR, intval($dataResult_basicH["HbasicPos"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[5] . $celdaR, intval($dataResult_basicM["MbasicPos"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[6] . $celdaR, intval($dataResult_basicH["HbasicEgr"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[7] . $celdaR, intval($dataResult_basicM["MbasicEgr"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[8] . $celdaR, intval($dataResult_basicH["HbasicEmp"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[9] . $celdaR, intval($dataResult_basicM["MbasicEmp"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[10] . $celdaR, intval($dataResult_basicH["HbasicPg"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[11] . $celdaR, intval($dataResult_basicM["MbasicPg"]), $rutaCopiaArchivo);

                            //¿   Nivel intermedio Excel
                            $celdaR = ObtenerCeldaIdioma('B24:B35', $idioma, $hoja);
                            //echo "<br> $celdaR <br>";
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[0] . $celdaR, intval($dataResult_interH["HinterMs"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[1] . $celdaR, intval($dataResult_interM["MinterMs"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[2] . $celdaR, intval($dataResult_interH["HinterSup"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[3] . $celdaR, intval($dataResult_interM["MinterSup"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[4] . $celdaR, intval($dataResult_interH["HinterPos"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[5] . $celdaR, intval($dataResult_interM["MinterPos"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[6] . $celdaR, intval($dataResult_interH["HinterEgr"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[7] . $celdaR, intval($dataResult_interM["MinterEgr"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[8] . $celdaR, intval($dataResult_interH["HinterEmp"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[9] . $celdaR, intval($dataResult_interM["MinterEmp"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[10] . $celdaR, intval($dataResult_interH["HinterPg"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[11] . $celdaR, intval($dataResult_interM["MinterPg"]), $rutaCopiaArchivo);

                            //¿   Nivel avanzado Excel
                            $celdaR = ObtenerCeldaIdioma('B37:B48', $idioma, $hoja);
                            //echo "<br> $celdaR <br>";
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[0] . $celdaR, intval($dataResult_avanzH["HavanzMs"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[1] . $celdaR, intval($dataResult_avanzM["MavanzMs"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[2] . $celdaR, intval($dataResult_avanzH["HavanzSup"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[3] . $celdaR, intval($dataResult_avanzM["MavanzSup"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[4] . $celdaR, intval($dataResult_avanzH["HavanzPos"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[5] . $celdaR, intval($dataResult_avanzM["MavanzPos"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[6] . $celdaR, intval($dataResult_avanzH["HavanzEgr"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[7] . $celdaR, intval($dataResult_avanzM["MavanzEgr"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[8] . $celdaR, intval($dataResult_avanzH["HavanzEmp"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[9] . $celdaR, intval($dataResult_avanzM["MavanzEmp"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[10] . $celdaR, intval($dataResult_avanzH["HavanzPg"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[11] . $celdaR, intval($dataResult_avanzM["MavanzPg"]), $rutaCopiaArchivo);


                            //¿   Nivel superior Excel
                            $celdaR = ObtenerCeldaIdioma('B50:B61', $idioma, $hoja);
                            //echo "<br> $celdaR <br>";
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[0] . $celdaR, intval($dataResult_supH["HsupMs"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[1] . $celdaR, intval($dataResult_supM["MsupMs"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[2] . $celdaR, intval($dataResult_supH["HsupSup"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[3] . $celdaR, intval($dataResult_supM["MsupSup"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[4] . $celdaR, intval($dataResult_supH["HsupPos"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[5] . $celdaR, intval($dataResult_supM["MsupPos"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[6] . $celdaR, intval($dataResult_supH["HsupEgr"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[7] . $celdaR, intval($dataResult_supM["MsupEgr"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[8] . $celdaR, intval($dataResult_supH["HsupEmp"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[9] . $celdaR, intval($dataResult_supM["MsupEmp"]), $rutaCopiaArchivo);

                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[10] . $celdaR, intval($dataResult_supH["HsupPg"]), $rutaCopiaArchivo);
                            guardarContenidoEnCelda($spreadsheet, $arregloCeldadData[11] . $celdaR, intval($dataResult_supM["MsupPg"]), $rutaCopiaArchivo);


                            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                            $writer->save($rutaCopiaArchivo);

                            //echo "<br><h1>¡Hoja abierta con éxito!</h1>";
                        } else {
                            //echo "<br><h1>Error al abrir la hoja del archivo Excel.</h1>";
                        }
                    } else {
                        //echo '<br><h1>Error al crear la copia del archivo.</h1>';
                    }
                }








                //!------------------------------------------------------------------------------


                $Niveles_Competencia = 1234;
                $Nivel_Educativo = 123456;

                function InsertarRegistro($conexion, $descHombres, $descMujeres, $UnidadAcademica, $Idioma, $id_Competencia, $id_NivelEducativo, $Fecha)
                {
                    $QueryGetID_UnidadAcademica = "SELECT ID_UnidadAcademica FROM Unidades_Academicas WHERE Desc_Nombre_Unidad_Academica = ?";

                    $params = array($UnidadAcademica);
                    // Preparar la consulta
                    $stmt = sqlsrv_prepare($conexion, $QueryGetID_UnidadAcademica, $params);
                    if ($stmt === false) {
                        // Manejar el error de la consulta preparada
                        echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
                    } else {
                        // Ejecutar la consulta
                        $result = sqlsrv_execute($stmt);

                        if ($result === false) {
                            // Manejar el error de la ejecución de la consulta
                            echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
                        } else {
                            // Mostrar los resultados
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                $id_UnidadAcademica = $row['ID_UnidadAcademica'];
                            }
                        }
                        // Liberar el conjunto de resultados
                        sqlsrv_free_stmt($stmt);
                    }

                    //----------------------------------------------------------------------
                    $QueryGetID_Idioma = "SELECT ID_Idioma FROM Idiomas WHERE Desc_Idioma = ?";

                    $params = array($Idioma);
                    // Preparar la consulta
                    $stmt = sqlsrv_prepare($conexion, $QueryGetID_Idioma, $params);
                    if ($stmt === false) {
                        // Manejar el error de la consulta preparada
                        echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
                    } else {
                        // Ejecutar la consulta
                        $result = sqlsrv_execute($stmt);

                        if ($result === false) {
                            // Manejar el error de la ejecución de la consulta
                            echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
                        } else {
                            // Mostrar los resultados
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                $id_Idioma = $row['ID_Idioma'];
                            }
                            if ($id_NivelEducativo == 6) {
                                $id_TipoPoblacion = 2;
                            } else {
                                $id_TipoPoblacion = 1;
                            }
                            ;
                        }
                        // Liberar el conjunto de resultados
                        sqlsrv_free_stmt($stmt);
                    }

                    //----------------------------------------------------------------------
                    $queryInsertar = "INSERT INTO cantidades_alumnos (Desc_Hombres, Desc_Mujeres, id_UnidadAcademica, id_Competencia, id_Idioma, id_TipoPoblacion, id_NivelEducativo, Fecha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                    $params = [
                        intval($descHombres),
                        intval($descMujeres),
                        intval($id_UnidadAcademica),
                        intval($id_Competencia),
                        intval($id_Idioma),
                        intval($id_TipoPoblacion),
                        intval($id_NivelEducativo),
                        $Fecha
                    ];

                    // Preparar la consulta
                    $stmt = sqlsrv_prepare($conexion, $queryInsertar, $params);
                    if ($stmt === false) {
                        // Manejar el error de la consulta preparada
                        echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
                    } else {
                        // Ejecutar la consulta
                        $result = sqlsrv_execute($stmt);

                        if ($result === false) {
                            // Manejar el error de la ejecución de la consulta
                            echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
                        } else {
                            //echo 'consulta hecha';
                        }
                        // Liberar el conjunto de resultados
                        sqlsrv_free_stmt($stmt);
                    }
                    //----------------------------------------------------------------------
                }

                // Ejemplo de valores


                //?BASICO
                //?----------------------------------------------------------------------

                $keys = array_keys($dataResult_basicH);
                $keyss = array_keys($dataResult_basicM);
                $num_keys = count($keys);

                for ($i = 0; $i < $num_keys; $i++) {
                    $key = $keys[$i];
                    $key2 = $keyss[$i];
                    // Verificar si la clave existe antes de acceder a los valores
                    $valueH = isset($dataResult_basicH[$key]) ? $dataResult_basicH[$key] : 'Valor no definido';
                    $valueM = isset($dataResult_basicM[$key2]) ? $dataResult_basicM[$key2] : 'Valor no definido';

                    //echo "<br><h3>Valor H para la clave $key: $valueH</h3>";
                    //echo "<br><h3>Valor M para la clave $key2: $valueM</h3>";
                    InsertarRegistro($connection, intval($valueH), intval($valueM), $nombreunidad, $idioma, 1, $i + 1, $fecha);
                }
                //? intermedio
                //?----------------------------------------------------------------------

                $keys = array_keys($dataResult_interH);
                $keyss = array_keys($dataResult_interM);
                $num_keys = count($keys);

                for ($i = 0; $i < $num_keys; $i++) {
                    $key = $keys[$i];
                    $key2 = $keyss[$i];
                    // Verificar si la clave existe antes de acceder a los valores
                    $valueH = isset($dataResult_interH[$key]) ? $dataResult_interH[$key] : 'Valor no definido';
                    $valueM = isset($dataResult_interM[$key2]) ? $dataResult_interM[$key2] : 'Valor no definido';

                    //echo "<br><h3>Valor H para la clave $key: $valueH</h3>";
                    //echo "<br><h3>Valor M para la clave $key2: $valueM</h3>";
                    InsertarRegistro($connection, intval($valueH), intval($valueM), $nombreunidad, $idioma, 2, $i + 1, $fecha);
                }

                //? avanzado
                //?----------------------------------------------------------------------

                $keys = array_keys($dataResult_avanzH);
                $keyss = array_keys($dataResult_avanzM);
                $num_keys = count($keys);

                for ($i = 0; $i < $num_keys; $i++) {
                    $key = $keys[$i];
                    $key2 = $keyss[$i];
                    // Verificar si la clave existe antes de acceder a los valores
                    $valueH = isset($dataResult_avanzH[$key]) ? $dataResult_avanzH[$key] : 'Valor no definido';
                    $valueM = isset($dataResult_avanzM[$key2]) ? $dataResult_avanzM[$key2] : 'Valor no definido';

                    //echo "<br><h3>Valor H para la clave $key: $valueH</h3>";
                    //echo "<br><h3>Valor M para la clave $key2: $valueM</h3>";
                    InsertarRegistro($connection, intval($valueH), intval($valueM), $nombreunidad, $idioma, 3, $i + 1, $fecha);
                }
                //? superior
                //?----------------------------------------------------------------------

                $keys = array_keys($dataResult_supH);
                $keyss = array_keys($dataResult_supM);
                $num_keys = count($keys);

                for ($i = 0; $i < $num_keys; $i++) {
                    $key = $keys[$i];
                    $key2 = $keyss[$i];
                    $valueH = isset($dataResult_supH[$key]) ? $dataResult_supH[$key] : 'Valor no definido';
                    $valueM = isset($dataResult_supM[$key2]) ? $dataResult_supM[$key2] : 'Valor no definido';

                    //echo "<br><h3>Valor H para la clave $key: $valueH</h3>";
                    //echo "<br><h3>Valor M para la clave $key2: $valueM</h3>";
                    InsertarRegistro($connection, intval($valueH), intval($valueM), $nombreunidad, $idioma, 4, $i + 1, $fecha);
                }

                //?----------------------------------------------------------------------
                header("Location: cargarData.php?status=InsertSuccess");
                exit();
            }
        }
        // Liberar el conjunto de resultados
        sqlsrv_free_stmt($stmt);
    }

} else {
    header("Location: cargarData.php?status=IdiomamErr");
    exit();
}
?>