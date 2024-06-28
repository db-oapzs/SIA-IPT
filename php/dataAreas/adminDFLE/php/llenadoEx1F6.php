<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';


define("NUM_HOJA", 5);
	
	
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

	function ObtenerCelda($rango, $valorBuscado, $hojaCalculo) {
		$celdasRango = $hojaCalculo->rangeToArray($rango, null, true, true, true);
		// Iterar sobre cada fila del rango
		foreach ($celdasRango as $numeroFila => $columnasFila) {
			foreach ($columnasFila as $letraColumna => $valorCelda) {
				// Verificar si el valor de la celda coincide con el valor buscado
				if ($valorCelda == $valorBuscado) {
					// Si coincide, devolver la posición de la fila
					$resultadoFila = $numeroFila;
					return $resultadoFila;
					// Aquí puedes realizar cualquier otra acción que necesites con la celda encontrada
				}
			}
		}
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
		// Obtener el valor de la celda especificada de la hoja específica
		return $hoja->getCell($celda)->getValue();
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
		$rangoCeldas = 'B14:B106';
		$spreadsheet = IOFactory::load($ruta);

		$posicion = array(
			"Población IPN" => array(
				"MEDIO SUPERIOR" => array(
					"BASICO" => "D", 
					"INTERMEDIO" => "E", 
					"AVANZADO" => "F", 
					"SUPERIOR" => "G" 
				),
				"SUPERIOR" => array(
					"BASICO" => "H", 
					"INTERMEDIO" => "I", 
					"AVANZADO" => "J", 
					"SUPERIOR" => "K" 
				),
				"POSGRADO" => array(
					"BASICO" => "L", 
					"INTERMEDIO" => "M", 
					"AVANZADO" => "N", 
					"SUPERIOR" => "O" 
				),
				"EGRESADOS" => array(
					"BASICO" => "P", 
					"INTERMEDIO" => "Q", 
					"AVANZADO" => "R", 
					"SUPERIOR" => "S" 
				),
				"EMPLEADOS" => array(
					"BASICO" => "T", 
					"INTERMEDIO" => "U", 
					"AVANZADO" => "V", 
					"SUPERIOR" => "W" 
				)
			),
			"Población General" => array(
				"No aplica" => array(
					"BASICO" => "X", 
					"INTERMEDIO" => "Y",
					"AVANZADO" => "Z", 
					"SUPERIOR" => "AA" 
				)
				
			)
			
		);
		
		if ($spreadsheet){
			reemplazaHoja($spreadsheet, 'NIVEL_EST_LENEXTPOBATEND');
			$hoja = $spreadsheet->getSheet(NUM_HOJA);
			fechas($hoja, array("AB6", "AB7"));

			foreach ($data as $registro){
				$siglas = $registro['Siglas'];
				if ($siglas === "SIA"){
					continue;
				}
				
				$tipoPoblacion = $registro['Tipo_Poblacion'];
				$nivelEducativo = $registro['Nivel_Educativo'];
				$nivelCompetencia = $registro['Competencia'];
				$fila = ObtenerCelda($rangoCeldas, $siglas, $hoja);
				
				if (is_numeric($registro['Desc_Hombres']) && is_numeric($registro['Desc_Mujeres'])) {
					$totalAlumnos = $registro['Desc_Hombres'] + $registro['Desc_Mujeres'];
				} else {
					$totalAlumnos = 0;
					echo "Error: Uno o ambos valores no son numéricos.";
				}
				//echo ($posicion[$tipoPoblacion][$nivelEducativo][$nivelCompetencia]." TOTAL: " .$totalAlumnos. "<br>");
				//echo ( $siglas. " | " . $fila . " | " .$tipoPoblacion. " | " .$nivelEducativo. " | " .$nivelCompetencia . " || " . $posicion[$tipoPoblacion][$nivelEducativo][$nivelCompetencia] . $fila . "<br>");
				
				if ($fila != NULL){
					guardarContenidoEnCelda($hoja, $posicion[$tipoPoblacion][$nivelEducativo][$nivelCompetencia] . $fila, $totalAlumnos);
				}
				
			}
			$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$writer->save($ruta);
			//echo "<br><h2>Tabla llenada exitosamente!</h2>";
			header("Location: llenadoCF5.php?status=DatosExcel1F6");
			exit();
		}
		
		else {
            //echo "<br><h1>Error al abrir la hoja del archivo Excel.</h1>";
			header("Location: Bienvenida.php?status=excelSheetOpenFailed");
			exit();
        }
	}

	
	function imprimeTablaDatos($data){
		// Imprimir la tabla HTML
		//echo "<table border='1'>";
		// Imprimir la fila de encabezados de la tabla
		//echo "<tr>";
		foreach ($data[0] as $key => $value) {
			//echo "<th>$key</th>";
		}
		//echo "</tr>";
		// Imprimir los datos de cada fila en la tabla
		foreach ($data as $registro) {
			//echo "<tr>";
			foreach ($registro as $valor) {
				//echo "<td>$valor</td>";
			}
			//echo "</tr>";
		}
		//echo "</table>";
	}


	// Ruta del archivo original
    $anio = (string) date('Y');	
	$mes = date('n');
	$numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => "Mes inválido"};
	$nombreunidad = "1 DFLE_". $numTrimestre ."T_". $anio ." Unid Acad CELEX obs gfl 2";
    $rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_1.xlsx';
    // Ruta donde se guardará la copia del archivo
    //$nombreArchivo = 'General_'.$nombreunidad.'_'.$idioma;
    $nombreArchivo = $nombreunidad;
    $rutaCopiaArchivo = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';
    $RutanombreArchivo = $rutaCopiaArchivo;
    $rutafinal = $rutaCopiaArchivo;
	
	$sql = 'SELECT 
				CA.ID_Registro,
				CA.Desc_Hombres,
				CA.Desc_Mujeres,
				UA.Desc_Nombre_Unidad_Academica AS Unidad_Academica,
				NC.Desc_Nivel_De_Competencia AS Competencia,
				I.Desc_Idioma AS Idioma,
				TP.Desc_TipoPoblacion AS Tipo_Poblacion,
				NE.Desc_NivelEducativo AS Nivel_Educativo,
				CA.Fecha,
				UA.Siglas AS Siglas
			FROM 
				Cantidades_Alumnos CA
			INNER JOIN 
				Unidades_Academicas UA ON CA.id_UnidadAcademica = UA.ID_UnidadAcademica
			INNER JOIN 
				Niveles_Competencia NC ON CA.id_Competencia = NC.ID_Competencia
			INNER JOIN 
				Idiomas I ON CA.id_Idioma = I.ID_Idioma
			INNER JOIN 
				Tipo_Poblacion TP ON CA.id_TipoPoblacion = TP.ID_TipoPoblacion
			INNER JOIN 
				Nivel_Educativo NE ON CA.id_NivelEducativo = NE.ID_NivelEducativo
			WHERE 
				UA.Siglas != \'SIA\' ';
	
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
			//echo '<h1>El archivo existe.</h1><br>';
			
			llenaDatos($data, $rutaCopiaArchivo);
		}
		
		else{
			echo '<h1>El archivo No existe.</h1><br>';
			if (copy($rutaArchivoOriginal, $rutaCopiaArchivo)) {
				//echo 'Copia del archivo creada exitosamente.<br>';
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
	
?>