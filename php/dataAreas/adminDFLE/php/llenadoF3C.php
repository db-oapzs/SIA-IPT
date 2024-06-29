<?php
// Incluir la clase de PHP Spreadsheet
header('Content-Type: text/html; charset=utf-8');
require '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');

define("NUM_HOJA", 2);

include '../../../conexion.php';
	
$start_time = microtime(true);

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
	

	
	
	function arregloNombres($hoja, $rango){
		$dataArray = $hoja->rangeToArray($rango, NULL, TRUE, TRUE, FALSE);
		return $dataArray;
	}
	
	function buscarCadena($cadena, $arreglo) {
		foreach ($arreglo as $indice => $subArreglo) {
			if (isset($subArreglo[0]) && $subArreglo[0] === $cadena) {
				return $indice;
			}
		}
		return -1; // Devuelve -1 si la cadena no se encuentra en el arreglo
	}
	
	
	function llenaSeccion($hoja, $rangoNombres, $celdaDatos, $data){
		$idiomas=["INGLÉS" => 0, "ALEMÁN" => 10, "JAPONÉS" => 20, "COREANO" => 25,
		"PORTUGUÉS" => 30, "SEÑAS MEXICANAS" => 36, "FRANCÉS" => 41];
		
		$nombres = arregloNombres($hoja, $rangoNombres);
		$tamanio = count($nombres);
		$arregloDatos = array_fill(0, $tamanio, array_fill(0, 45, NULL));
		
		foreach($data as $unidad){
			$posicion = buscarCadena($unidad['Siglas'], $nombres);
			echo ($unidad['Siglas']);
			echo (" POSICION: " . $posicion . "<br>");
			if($posicion >= 0 && isset($idiomas[$unidad['Desc_Idioma']])){
				$fecha = DateTime::createFromFormat('d-m-Y H:i:s', $unidad['Fecha']);
				$mes = (int)$fecha->format('m');
				$numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => -1};
				echo ($unidad['Siglas'] . " Fecha:" . $unidad['Fecha'] . " Mes: " . $mes . " Trimestre: " . $numTrimestre);
				$posicionArreglo = $numTrimestre + $idiomas[$unidad['Desc_Idioma']]-1;
				echo " ProgramaG: ";
				echo($unidad['ProgramaGeneral']);
				echo "<br>";
				if((int)$unidad['ProgramaGeneral'] === 1){
					$arregloDatos[$posicion][$posicionArreglo] = 1;
				}
			}
		}
		
		$hoja->fromArray($arregloDatos, NULL, $celdaDatos);
	}
	
	function llenaAnios($hoja){
		global $anioActual;
		$arregloDatos = array_fill(0, 52, NULL);
		$posiciones = [11, 21, 31, 36, 41, 47, 52];
		$arregloDatos[0] = $anioActual - 3;
		$arregloDatos[5] = $anioActual - 2;
		$arregloDatos[10] = $anioActual - 1;
		foreach ($posiciones as $posicion) {
			if ($posicion === 21 || $posicion === 31 || $posicion === 47) {
				$arregloDatos[$posicion - 1] = $anioActual - 1;
			}
			$arregloDatos[$posicion] = $anioActual;
		}
		$arregloDatosBidimensional = [$arregloDatos];
		$hoja->fromArray($arregloDatosBidimensional, NULL, 'C12');
	}

	
	
	function llenaDatos($data){
		global $rutaArchivoCopia;
		$spreadsheet = IOFactory::load($rutaArchivoCopia);
		if ($spreadsheet){
			$hoja = $spreadsheet->getSheet(NUM_HOJA);
			fechas($hoja, 'BN4');
			llenaAnios($hoja);
			llenaSeccion($hoja, 'A15:A34', 'N15', $data);
			llenaSeccion($hoja, 'A36:A67', 'N36', $data);
			llenaSeccion($hoja, 'A69:A87', 'N69', $data);
			llenaSeccion($hoja, 'A89:A104', 'N89', $data);
			llenaSeccion($hoja, 'A106:A107', 'N106', $data);
			$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$writer->save($rutaArchivoCopia);
			header("Location: llenadoF1C.php?status=dataEx1F3gen");
			exit();
		}
	}

//Declaración de variables.
$anioActual = (int)date('Y');
$anioAnterior = $anioActual - 1;

// Ruta del archivo original y copia
$mes = date('n');
$numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => "Mes inválido"};
$nombreArchivo = "1 DFLE_". $numTrimestre ."T_". $anioActual ." Unid Acad CELEX obs gfl 2";
$rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_1.xlsx';
$rutaArchivoCopia = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';

$query =	"	SELECT DISTINCT UA.Siglas, I.Desc_Idioma, CA.Fecha, CA.ProgramaGeneral
				FROM Cantidades_Alumnos CA 
				JOIN Unidades_Academicas UA ON
				CA.id_UnidadAcademica = UA.ID_UnidadAcademica
				JOIN Idiomas I ON 
				CA.id_Idioma = I.ID_Idioma
				WHERE Fecha LIKE ?";
$anioQuery = "%" . $anioActual . "%";
$data = ejecutaQuery($query, array($anioQuery));

if ($data != NULL){
	if (archivoExistencia($nombreArchivo)) {
		echo '<h1>El archivo existe.</h1><br>';
		
		llenaDatos($data);
	}
	
	else{
		echo '<h1>El archivo No existe.</h1><br>';
		if (copy($rutaArchivoOriginal, $rutaArchivoCopia)) {
			echo 'Copia del archivo creada exitosamente.<br>';
			llenaDatos($data);
		} 
		
		else {
			echo '<br><h1>Error al crear la copia del archivo.</h1>';
			header("Location: Bienvenida.php?status=excelCopyFailed");
			exit();
		}
	}
}

$end_time = microtime(true);
$execution_time = $end_time - $start_time;
echo "<br>Tiempo de ejecución: " . $execution_time . " segundos<br><br>";
?>