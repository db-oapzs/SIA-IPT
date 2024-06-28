<?php

// Incluir la clase de PHP Spreadsheet
header('Content-Type: text/html; charset=utf-8');
require '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');

include '../../../conexion.php';
define("NUM_HOJA", 4);

	
	function fechas($hoja, $celdasFechas) {
		$mes = date('n'); 
		$anio = date('Y'); 
		$diaCorte = ($mes > 3 && $mes < 10) ? 30 : 31; 
		$trimestre = match (true) {
			$mes <= 3 => "ENERO - MARZO",
			$mes <= 6 => "ABRIL - JUNIO",
			$mes <= 9 => "JULIO - SEPTIEMBRE",
			$mes <= 12 => "OCTUBRE - DICIEMBRE",
			default => "Mes inválido"
		};
		$periodo = "PERIODO: $trimestre DE $anio";
		$mesCorte = substr($trimestre, strrpos($trimestre, ' ') + 1);
		$fechaCorte = "FECHA DE CORTE: $diaCorte DE $mesCorte DE $anio";
		$fechas = [[$periodo],[$fechaCorte]];
		$hoja->fromArray($fechas, null, $celdasFechas);
	}
	
	function archivoExistencia($nombre){
		$rutaData = '../exelDFLE/unidades/' . $nombre . '.xlsx';
		if (file_exists($rutaData)) {
			return true;
		} else {
			return false;
		}
	}
	
	function insertEmptyArrays($array) {
		for ($i = 16; $i <= 27; $i++) {
			if (!isset($array[$i])) {
				$array[$i] = array(NULL);
			}
		}
		ksort($array); // Ordena el array por sus claves para mantener el orden correcto
		return $array;
	}

	function guardarContenidoEnCelda($hoja, $celda, $contenido){
		// Obtener la hoja específica por su índice y asignar contenido a la celda especificada
		$hoja->setCellValue($celda, $contenido);
	}


	function obtenerContenidoDeCelda($hoja, $celda) {
		// Obtener el valor de la celda especificada
		return $hoja -> getCell($celda)->getValue();
	}
	
	
	function llenaDatos($data, $ruta){
		//Hoja (4) 
		$rangoCeldas = 'B16:B27';
		$celdas = 'P16:P27';
		$spreadsheet = IOFactory::load($ruta);
		
		if ($spreadsheet){

			$hoja = $spreadsheet->getSheet(NUM_HOJA);
			fechas($hoja, 'Q6');
			// Construcción del índice una vez al cargar el archivo
			$indiceCeldas = construirIndiceCeldas($hoja, $rangoCeldas);

			$datos = array();
			foreach ($data as $registro){
				$idioma = $registro['Idiomas'];
				$descripcion = $registro['Desc_Justificacion'];
				// Luego, usa ObtenerCelda con el índice
				$fila = ObtenerCelda($idioma, $indiceCeldas);
				if($fila != NULL){
					//guardarContenidoEnCelda($hoja,  'P' . $fila, $descripcion);
					$datos[$fila] = array($descripcion);
				}
			}

			$datos = insertEmptyArrays($datos);
			$hoja->fromArray($datos, ' ', 'P16');
			$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$writer->save($ruta);
			echo "<br><h2>Tabla llenada exitosamente!</h2>";
		}
		else {
            //echo "<br><h1>Error al abrir la hoja del archivo Excel.</h1>";
			header("Location: ../../../html/login.php?status=excelSheetOpenFailed");
			exit();
        }
		
	}
	
	
	
	function construirIndiceCeldas($hojaCalculo, $rango) {
		$celdasRango = $hojaCalculo->rangeToArray($rango, null, true, true, true);
		$indiceCeldas = [];

		foreach ($celdasRango as $numeroFila => $columnasFila) {
			foreach ($columnasFila as $letraColumna => $valorCelda) {
				if ($valorCelda !== null && $valorCelda !== '') {
					$indiceCeldas[$valorCelda] = $numeroFila;
				}
			}
		}

		return $indiceCeldas;
	}

	function ObtenerCelda($valorBuscado, $indiceCeldas) {
		return isset($indiceCeldas[$valorBuscado]) ? $indiceCeldas[$valorBuscado] : null;
	}


	// Ruta del archivo original
	$anio = date('Y');
	$mes = date('n');
	$numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => "Mes inválido"};
	$nombreArchivo = "1 DFLE_". $numTrimestre ."T_". $anio ." Unid Acad CELEX obs gfl 2";
    $rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_1.xlsx';
    // Ruta donde se guardará la copia del archivo
    //$nombreArchivo = 'General_'.$nombreunidad.'_'.$idioma;
    $rutaCopiaArchivo = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';
    $RutanombreArchivo = $rutaCopiaArchivo;
    $rutafinal = $rutaCopiaArchivo;
	
	$sql = 'SELECT	JF.Desc_Justificacion,
					FA.Desc_FormatoAutoevaluacion AS Desc_FormatoAutoevaluacion, 
					L.Desc_Idioma AS Idiomas, 
					JF.Fecha
			FROM JustificacionesFormato5_9 JF 
					INNER JOIN
					FormatosAutoevaluacion FA ON JF.id_FormatoAutoevaluacion = FA.ID_FormatoAutoevaluacion
					INNER JOIN
					Idiomas L ON JF.id_Idioma = L.ID_Idioma
			WHERE FA.ID_FormatoAutoevaluacion = 5
	';
	
	$data = array(); 
	$stmt = sqlsrv_prepare($connection, $sql);
	if ($stmt === false) {
		echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
	} else {
		$result = sqlsrv_execute($stmt);
	
		if ($result === false) {
			//echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
		} else {
			while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				//echo "<br>";
				//print_r($row);
				$data[] = $row;
			}
		}
		// Liberar el conjunto de resultados
		sqlsrv_free_stmt($stmt);
	}
	
	
	if ($data != NULL){
		if (archivoExistencia($nombreArchivo)) {
			echo '<h1>El archivo existe.</h1><br>';
			llenaDatos($data, $rutaCopiaArchivo);
		}
		
		else{
			echo '<h1>El archivo No existe.</h1><br>';
			if (copy($rutaArchivoOriginal, $rutaCopiaArchivo)) {
				echo 'Copia del archivo creada exitosamente.<br>';
				llenaDatos($data, $rutaCopiaArchivo);
			} 
			
			else {
				echo '<br><h1>Error al crear la copia del archivo.</h1>';
				header("Location: ../../../html/login.php?status=excelCopyFailed");
				exit();
			}
		}
		
	}
    else{
		header("Location: ../../../html/login.php?status=emptyArray");
		exit();
	}


?>