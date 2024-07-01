<?php
// Incluir la clase de PHP Spreadsheet
require '../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');
include '../conexion.php';
$rutafinal;
$idioma;
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../../html/login.php?status=sessionCad");
    exit();
}
$correo = $_SESSION['correo'];
$nombre_usuario = $_SESSION['nombre_usuario'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
    //var_dump($_POST);
    $datos = $_POST;
    $dataPOST = array();
    foreach ($datos as $key => $value) {
        // Verificar si el nombre del campo no comienza con "T" y no contiene la palabra "total"
        if (substr($key, 0, 1) !== "T" && strpos($key, "total") === false) {
            // Guardar el nombre del campo y su valor (o un espacio si el valor está vacío)
            $dataPOST[$key] = $value !== "" ? $value : " ";
        }
    }
    $fechaCreacion = date('d-m-Y H:i:s');
    // Mostrar el arreglo resultante
    //echo "<br>";
   // echo "<br>";
    //var_dump($dataPOST);
    $data = $dataPOST;
    //echo "<br><h2>" . count($dataPOST) . "</h2>";
    //var_dump($data);
    //echo "<br><h2>" . count($data) . "</h2>";
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
    //!  -----------------  todos los hombres
    $dataResult_Hombres = array();
    filtrarDatos($data, $dataResult_Hombres, "H");
    //var_dump($dataResult_Hombres);
    //echo "<br><h2>" . count($dataResult_Hombres) . "</h2>";
    //!  -----------------  todas las mujeres
    $dataResult_Mujeres = array();
    filtrarDatos($data, $dataResult_Mujeres, "M");
    //var_dump($dataResult_Mujeres);
    //echo "<br><h2>" . count($dataResult_Mujeres) . "</h2>";


    //!  ------------------------------  por idiomas
    //!  -----------------  ingles
    $dataResult_Ing = array();
    filtrarDatos($data, $dataResult_Ing, "ing");
    //var_dump($dataResult_Ing);
    //echo "<br><h2>" . count($dataResult_Ing) . "</h2>";
    //!  -----------------  frances
    $dataResult_Fra = array();
    filtrarDatos($data, $dataResult_Fra, "fra");
    //var_dump($dataResult_Fra);
    //echo "<br><h2>" . count($dataResult_Fra) . "</h2>";
    //!  -----------------  Aleman
    $dataResult_Ale = array();
    filtrarDatos($data, $dataResult_Ale, "ale");
    //var_dump($dataResult_Ale);
    //echo "<br><h2>" . count($dataResult_Ale) . "</h2>";
    //!  -----------------  Italiano
    $dataResult_Ita = array();
    filtrarDatos($data, $dataResult_Ita, "ita");
    //var_dump($dataResult_Ita);
    //echo "<br><h2>" . count($dataResult_Ita) . "</h2>";
    //!  -----------------  Japon
    $dataResult_Jap = array();
    filtrarDatos($data, $dataResult_Jap, "jap");
    //var_dump($dataResult_Jap);
    //echo "<br><h2>" . count($dataResult_Jap) . "</h2>";
    //!  -----------------  Chino Mandarin
    $dataResult_Chinm = array();
    filtrarDatos($data, $dataResult_Chinm, "chim");
    //var_dump($dataResult_Chinm);
    //echo "<br><h2>" . count($dataResult_Chinm) . "</h2>";
    //!  -----------------  Portugues 
    $dataResult_Por = array();
    filtrarDatos($data, $dataResult_Por, "por");
    //var_dump($dataResult_Por);
    //echo "<br><h2>" . count($dataResult_Por) . "</h2>";
    //!  -----------------  Ruso 
    $dataResult_Rus = array();
    filtrarDatos($data, $dataResult_Rus, "rus");
    //var_dump($dataResult_Rus);
    //echo "<br><h2>" . count($dataResult_Rus) . "</h2>";
    //!  -----------------  Nahuatl 
    $dataResult_Nah = array();
    filtrarDatos($data, $dataResult_Nah, "nah");
    //var_dump($dataResult_Nah);
    //echo "<br><h2>" . count($dataResult_Nah) . "</h2>";
    //!  -----------------  Español 
    $dataResult_Esp = array();
    filtrarDatos($data, $dataResult_Esp, "esp");
    //var_dump($dataResult_Esp);
    //echo "<br><h2>" . count($dataResult_Esp) . "</h2>";
    //!  -----------------  Señas Mexicanas 
    $dataResult_Senm = array();
    filtrarDatos($data, $dataResult_Senm, "señm");
    //var_dump($dataResult_Senm);
    //echo "<br><h2>" . count($dataResult_Senm) . "</h2>";
    //!  -----------------  Coreano  
    $dataResult_Cor = array();
    filtrarDatos($data, $dataResult_Cor, "cor");
    //var_dump($dataResult_Cor);
    //echo "<br><h2>" . count($dataResult_Cor) . "</h2>";





    //!-----------------------------------------------------------------------

    function guardarContenidoEnCelda($spreadsheet, $celda, $contenido, $hoja) {
        $spreadsheet->getSheet($hoja)->setCellValue($celda, $contenido);
    }

    function archivoExistencia($nombre) {
        $rutaData = '../exelDFLE/unidades/' . $nombre . '.xlsx';
        if (file_exists($rutaData)) {
            return true;
        } else {
            return false;
        }
    }

    function ObtenerCeldaIdioma($rang,$idiom,$hoja){
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

    function insertarDtoF11($connection,$queryPrueba,$params){
        $stmt = sqlsrv_prepare($connection, $queryPrueba, $params);
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
                //echo "<br><h1>datos ".$params[3]." insertados</h1>";
            }
            // Liberar el conjunto de resultados
            sqlsrv_free_stmt($stmt);
        }

    }


    // Ruta del archivo original
    $anio = date('Y');
    $rutaArchivoOriginal = '../exelDFLE/plnatilla/General_Formato_5.xlsx';
    // Ruta donde se guardará la copia del archivo
    $mes = date('n');
    $numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => "Mes inválido"};
    $nombreArchivo = '5 DFLE_'.$numTrimestre.'T_'.$anio.' ACCIONES DE FORMACION DOCENTE';
    $rutaCopiaArchivo = '../exelDFLE/unidades/'.'5 DFLE_'.$numTrimestre.'T_'.$anio.' ACCIONES DE FORMACION DOCENTE'.'.xlsx';
    $RutanombreArchivo = $rutaCopiaArchivo;
    $rutafinal = $rutaCopiaArchivo;

    $unidad = 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD SANTO TOMÁS';
    $queryPrueba = ' 
    INSERT INTO Cantidades_Formato_11 (Desc_Hombres, Desc_Mujeres, id_UnidadCenlex, id_Idioma, Fecha)
    VALUES (?, ?,
        (SELECT ID_UnidadAcademica FROM Unidades_Academicas WHERE Desc_Nombre_Unidad_Academica = ?),
        (SELECT ID_Idioma FROM Idiomas WHERE Desc_Idioma = ?),?)
    ';
    
    $params = [
        (int)($dataResult_Ing["HingSt"]),
        (int)($dataResult_Ing["MingSt"]),
        $unidad,
        'INGLÉS',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Fra["HfraSt"]),
        (int)($dataResult_Fra["MfraSt"]),
        $unidad,
        'FRANCÉS',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Ale["HaleSt"]),
        (int)($dataResult_Ale["MaleSt"]),
        $unidad,
        'ALEMÁN',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Ita["HitaSt"]),
        (int)($dataResult_Ita["MitaSt"]),
        $unidad,
        'ITALIANO',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Jap["HjapSt"]),
        (int)($dataResult_Jap["MjapSt"]),
        $unidad,
        'JAPONÉS',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Chinm["HchimSt"]),
        (int)($dataResult_Chinm["MchimSt"]),
        $unidad,
        'CHINO-MANDARÍN',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Por["HporSt"]),
        (int)($dataResult_Por["HporSt"]),
        $unidad,
        'PORTUGUÉS',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Rus["HrusSt"]),
        (int)($dataResult_Rus["MrusSt"]),
        $unidad,
        'RUSO',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Nah["HnahSt"]),
        (int)($dataResult_Nah["MnahSt"]),
        $unidad,
        'NÁHUATL',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Esp["HespSt"]),
        (int)($dataResult_Esp["MespSt"]),
        $unidad,
        'ESPAÑOL',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Senm["HseñmSt"]),
        (int)($dataResult_Senm["MseñmSt"]),
        $unidad,
        'SEÑAS MEXICANAS',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);
    $params = [
        (int)($dataResult_Cor["HcorSt"]),
        (int)($dataResult_Cor["McorSt"]),
        $unidad,
        'COREANO',
        $fechaCreacion
    ];
    insertarDtoF11($connection,$queryPrueba,$params);



    if (archivoExistencia($nombreArchivo)) {
        //echo 'El archivo existe.';
        $spreadsheet = IOFactory::load($rutaCopiaArchivo);
        $totalSheets = $spreadsheet->getSheetCount();
    
        if ($spreadsheet) {
            $hoja = $spreadsheet->getSheet(0);

            // ingles
            guardarContenidoEnCelda($spreadsheet,'C13',intval($dataResult_Ing["HingSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D13',intval($dataResult_Ing["MingSt"]),0);

            // frances
            guardarContenidoEnCelda($spreadsheet,'C14',intval($dataResult_Fra["HfraSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D14',intval($dataResult_Fra["MfraSt"]),0);

            // Aleman
            guardarContenidoEnCelda($spreadsheet,'C15',intval($dataResult_Ale["HaleSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D15',intval($dataResult_Ale["MaleSt"]),0);

            // Italiano
            guardarContenidoEnCelda($spreadsheet,'C16',intval($dataResult_Ita["HitaSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D16',intval($dataResult_Ita["MitaSt"]),0);

            // Japon
            guardarContenidoEnCelda($spreadsheet,'C17',intval($dataResult_Jap["HjapSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D17',intval($dataResult_Jap["MjapSt"]),0);

            // Chino mandarin
            guardarContenidoEnCelda($spreadsheet,'C18',intval($dataResult_Chinm["HchimSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D18',intval($dataResult_Chinm["MchimSt"]),0);

            // Portugues        
            guardarContenidoEnCelda($spreadsheet,'C19',intval($dataResult_Por["HporSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D19',intval($dataResult_Por["MporSt"]),0);

            // Ruso        
            guardarContenidoEnCelda($spreadsheet,'C20',intval($dataResult_Rus["HrusSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D20',intval($dataResult_Rus["MrusSt"]),0);

            // Nahuatl        
            guardarContenidoEnCelda($spreadsheet,'C21',intval($dataResult_Nah["HnahSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D21',intval($dataResult_Nah["MnahSt"]),0);

            // Español        
            guardarContenidoEnCelda($spreadsheet,'C22',intval($dataResult_Esp["HespSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D22',intval($dataResult_Esp["MespSt"]),0);

            // Señas Mexicanas        
            guardarContenidoEnCelda($spreadsheet,'C23',intval($dataResult_Senm["HseñmSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D23',intval($dataResult_Senm["MseñmSt"]),0);

            // Coreano        
            guardarContenidoEnCelda($spreadsheet,'C24',intval($dataResult_Cor["HcorSt"]),0);
            guardarContenidoEnCelda($spreadsheet,'D24',intval($dataResult_Cor["McorSt"]),0);


            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save($rutaCopiaArchivo);



            header("Location: inicio.php?status=DatosCenlexCorrect");
            exit();


            //echo "<br><h1>¡Hoja abierta con éxito 1!</h1>";
        } else {
            echo "<br><h1>Error al abrir la hoja del archivo Excel. 1</h1>";
        }
    } else {
        //echo 'El archivo No existe.';
        // Copiar el archivo original a la nueva ubicación
        if(copy($rutaArchivoOriginal, $rutaCopiaArchivo)) {
            //echo 'Copia del archivo creada exitosamente.';
            $spreadsheet = IOFactory::load($rutaCopiaArchivo);
            $totalSheets = $spreadsheet->getSheetCount();
            if ($spreadsheet) {
                // Obtener la primera hoja (Sheet1) del archivo Excel
                $hoja = $spreadsheet->getSheet(0); 
    
                // ingles
                guardarContenidoEnCelda($spreadsheet,'C13',intval($dataResult_Ing["HingSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D13',intval($dataResult_Ing["MingSt"]),0);

                // frances
                guardarContenidoEnCelda($spreadsheet,'C14',intval($dataResult_Fra["HfraSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D14',intval($dataResult_Fra["MfraSt"]),0);

                // Aleman
                guardarContenidoEnCelda($spreadsheet,'C15',intval($dataResult_Ale["HaleSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D15',intval($dataResult_Ale["MaleSt"]),0);

                // Italiano
                guardarContenidoEnCelda($spreadsheet,'C16',intval($dataResult_Ita["HitaSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D16',intval($dataResult_Ita["MitaSt"]),0);

                // Japon
                guardarContenidoEnCelda($spreadsheet,'C17',intval($dataResult_Jap["HjapSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D17',intval($dataResult_Jap["MjapSt"]),0);

                // Chino mandarin
                guardarContenidoEnCelda($spreadsheet,'C18',intval($dataResult_Chinm["HchimSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D18',intval($dataResult_Chinm["MchimSt"]),0);

                // Portugues        
                guardarContenidoEnCelda($spreadsheet,'C19',intval($dataResult_Por["HporSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D19',intval($dataResult_Por["MporSt"]),0);

                // Ruso        
                guardarContenidoEnCelda($spreadsheet,'C20',intval($dataResult_Rus["HrusSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D20',intval($dataResult_Rus["MrusSt"]),0);

                // Nahuatl        
                guardarContenidoEnCelda($spreadsheet,'C21',intval($dataResult_Nah["HnahSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D21',intval($dataResult_Nah["MnahSt"]),0);

                // Español        
                guardarContenidoEnCelda($spreadsheet,'C22',intval($dataResult_Esp["HespSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D22',intval($dataResult_Esp["MespSt"]),0);

                // Señas Mexicanas        
                guardarContenidoEnCelda($spreadsheet,'C23',intval($dataResult_Senm["HseñmSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D23',intval($dataResult_Senm["MseñmSt"]),0);

                // Coreano        
                guardarContenidoEnCelda($spreadsheet,'C24',intval($dataResult_Cor["HcorSt"]),0);
                guardarContenidoEnCelda($spreadsheet,'D24',intval($dataResult_Cor["McorSt"]),0);

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->save($rutaCopiaArchivo);


                header("Location: inicio.php?status=DatosCenlexCorrect");
                exit();


                //echo "<br><h1>¡Hoja abierta con éxito 2 !</h1>";
            } else {
                echo "<br><h1>Error al abrir la hoja del archivo Excel. 2</h1>";
            }
        } else {
            echo '<br><h1>Error al crear la copia del archivo.</h1>';
        }
    }
}
?>
