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
		$rutaData = '../../../exelDFLE/unidades/' . $nombre . '.xlsx';
		if (file_exists($rutaData)) {
			return true;
		} else {
			return false;
		}
	}
	
	function ejecutaQuery($sqlQuery, $params = NULL){
		global $connection;
		$data = array();
		$stmt = sqlsrv_prepare($connection, $sqlQuery, $params);
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
		return $data;
	}
	
	function imprimeTablaDatos($data){
		if ($data != NULL){
			
			// Si el ResultSet no es vacío, se imprime la tabla.
			echo "<table border='1'>";
			echo "<tr>";
			foreach ($data[0] as $key => $value) {
				echo "<th>$key</th>";
			}
			echo "</tr>";
			foreach ($data as $registro) {
				echo "<tr>";
				foreach ($registro as $valor) {
					echo "<td>$valor</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
			
		}
		else{
			
			echo "ERROR: ¡ResultSet vacío!";
			//header("Location: ../../html/login.php?status=emptyArray");
			//exit();
			
		}
	}
	
	function arregloNombres($hoja, $rango) {
		$dataArray = $hoja->rangeToArray($rango, NULL, TRUE, TRUE, FALSE);
		return array_map(function($subArray) {
			return $subArray[0];
		}, $dataArray);
	}
	
	function llenaDatos($data, $ruta){
		$arregloDatos = array_fill(0, 12, array(NULL));
		
		$spreadsheet = IOFactory::load($ruta);
		if ($spreadsheet){
			$hoja = $spreadsheet->getSheet(NUM_HOJA);
			fechas($hoja, 'Q6');
			$idiomas = arregloNombres($hoja, 'B16:B27');
			
			foreach ($data as $registro){
				$posicion = array_search($registro['Idiomas'], $idiomas);
				$arregloDatos[$posicion][0] = $registro['Desc_Justificacion'];
			}
			var_dump($arregloDatos);
			$hoja->fromArray($arregloDatos, ' ', 'P16');
			$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$writer->save($ruta);
			header("Location: llenadoF4C.php?status=Excel1F5JGenerado");
			exit();
		}
	}

	// Ruta del archivo original
	$anio = date('Y');
	$mes = date('n');
	$numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => "Mes inválido"};
	$nombreArchivo = "1 DFLE_". $numTrimestre ."T_". $anio ." Unid Acad CELEX obs gfl 2";
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
	$data = ejecutaQuery($sql);
	
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
				header("Location: Bienvenida.php?status=errorArray");
				exit();
			}
		}
		
	}
    else{
		header("Location: Bienvenida.php?status=errorArray");
		exit();
	}

	imprimeTablaDatos($data);
	

?>