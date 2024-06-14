<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';

define("NUM_HOJA", 4);

	
	function trimestreAct() {
        $mes = date('n'); // Obtener el número del mes actual
		switch ($mes) {
			case 1: case 2: case 3:
				return "ENERO - MARZO";
			case 4: case 5: case 6:
				return "ABRIL - JUNIO";
			case 7: case 8: case 9:
				return "JULIO - SEPTIEMBRE";
			case 10: case 11: case 12:
				return "OCTUBRE - DICIEMBRE";
			default:
				return "Mes inválido";
		}
    }

	function fechas($hoja, $celdasFechas){
		$anio = (string) date('Y');
		$periodo = 'PERIODO: '.trimestreAct().' DE '.$anio;
		$fechaCorte = 'FECHA DE CORTE: 31 DE DICIEMBRE DE '.$anio;
        
		guardarContenidoEnCelda($hoja, $celdasFechas[0], $periodo);
		guardarContenidoEnCelda($hoja, $celdasFechas[1], $fechaCorte);
		
	}
	
	function archivoExistencia($nombre){
		$rutaData = '../../../exelDFLE/unidades/' . $nombre . '.xlsx';
		if (file_exists($rutaData)) {
			return true;
		} else {
			return false;
		}
	}
	

	
	function guardarContenidoEnCelda($hoja, $celda, $contenido){
		// Obtener la hoja específica por su índice y asignar contenido a la celda especificada
		$hoja->setCellValue($celda, $contenido);
	}


	function obtenerContenidoDeCelda($hoja, $celda) {
		// Obtener el valor de la celda especificada
		return $hoja -> getCell($celda)->getValue();
	}
	
	function reemplazaHoja($spreadsheet, $nombreHoja){
		global $rutaArchivoOriginal;
		$original = IOFactory::load($rutaArchivoOriginal);
		$hojaOriginal = $original->getSheetByName($nombreHoja);
		$hojaReemplazada = $spreadsheet->getSheetByName($nombreHoja);
		$sheetIndex = $spreadsheet->getIndex($hojaReemplazada);
		$spreadsheet->removeSheetByIndex($sheetIndex);
		$spreadsheet->addExternalSheet($hojaOriginal);
		moverHoja($spreadsheet, $nombreHoja, NUM_HOJA);
	}
	function moverHoja($spreadsheet, $nombreHoja, $nuevoIndice) {
		// Obtén la hoja que quieres mover
		$hoja = $spreadsheet->getSheetByName($nombreHoja);
	
		// Elimina la hoja de su posición actual
		$indiceActual = $spreadsheet->getIndex($hoja);
		$spreadsheet->removeSheetByIndex($indiceActual);
	
		// Agrega la hoja en la nueva posición
		$spreadsheet->addSheet($hoja, $nuevoIndice);
	}
	
	
	function llenaDatos($data, $ruta){
		//Hoja (4) 
		$rangoCeldas = 'B16:B27';
		$celdas = 'P16:P27';
		$spreadsheet = IOFactory::load($ruta);
		
		if ($spreadsheet){

			reemplazaHoja($spreadsheet, 'LENGUAS REGISTRO COMPARATIVO');
			$hoja = $spreadsheet->getSheet(NUM_HOJA);
			fechas($hoja, array("Q6", "Q7"));
			// Construcción del índice una vez al cargar el archivo
			$indiceCeldas = construirIndiceCeldas($hoja, $rangoCeldas);

			var_dump($indiceCeldas);

			foreach ($data as $registro){
				$idioma = $registro['Idiomas'];
				$descripcion = $registro['Desc_Justificacion'];
				// Luego, usa ObtenerCelda con el índice
				$fila = ObtenerCelda($idioma, $indiceCeldas);
				if($fila != NULL){
					guardarContenidoEnCelda($hoja,  'P' . $fila, $descripcion);
				}
			}
			
			$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$writer->save($ruta);
			echo "<br><h2>Tabla llenada exitosamente!</h2>";
		}
		else {
            //echo "<br><h1>Error al abrir la hoja del archivo Excel.</h1>";
			header("Location: Bienvenida.php?status=excelSheetOpenFailed");
			exit();
        }
		
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
	$nombreunidad = "1 DFLE_4T_". $anio ." Unid Acad CELEX obs gfl 2";
    $rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_1.xlsx';
    // Ruta donde se guardará la copia del archivo
    //$nombreArchivo = 'General_'.$nombreunidad.'_'.$idioma;
    $nombreArchivo = $nombreunidad;
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
				header("Location: Bienvenida.php?status=excelCopyFailed");
				exit();
			}
		}
		
	}
    else{
		header("Location: Bienvenida.php?status=emptyArray");
		exit();
	}

	imprimeTablaDatos($data);
	

?>