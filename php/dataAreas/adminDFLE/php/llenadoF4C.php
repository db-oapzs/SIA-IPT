<?php
// Incluir la clase de PHP Spreadsheet
header('Content-Type: text/html; charset=utf-8');
require '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');

define("NUM_HOJA", 3);

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
	

	function imprimeTablaDatos($datos){
		//echo "<table border='1'>";
		//echo "<tr>";
		foreach ($datos[0] as $clave => $valor) {
			//echo "<th>$clave</th>";
		}
		//echo "</tr>";
		foreach ($datos as $registro) {
			//echo "<tr>";
			foreach ($registro as $valorCelda) {
				//echo "<td>$valorCelda</td>";
			}
			//echo "</tr>";
		}
		//echo "</table>";
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
		$idiomas=["INGLÉS" => 0, "FRANCÉS" => 4, "ALEMÁN" => 8, "ITALIANO" => 12, "JAPONÉS" => 16, 
		"CHINO-MANDARÍN" => 20, "PORTUGUÉS" => 24, "RUSO" => 28, "NÁHUATL" => 32, "ESPAÑOL" => 36, 
		"SEÑAS MEXICANAS" => 40, "COREANO" => 44];
		$nombres = arregloNombres($hoja, $rangoNombres);
		$tamanio = count($nombres);
		$arregloDatos = array_fill(0, $tamanio, array_fill(0, 48, 0));
		
		foreach($data as $unidad){
			$posicion = buscarCadena($unidad['Siglas'], $nombres);
			if($posicion >= 0){
				$fecha = DateTime::createFromFormat('d-m-Y H:i:s', $unidad['Fecha']);
				$mes = (int)$fecha->format('m');
				$numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => -1};
				//echo ($unidad['Siglas'] . " Fecha:" . $unidad['Fecha'] . " Mes: " . $mes . " Trimestre: " . $numTrimestre . "<br>");
				$posicionArreglo = $numTrimestre + $idiomas[$unidad['Desc_Idioma']]-1;
				$arregloDatos[$posicion][$posicionArreglo] = 1;
			}
		}
		$hoja->fromArray($arregloDatos, ' ', $celdaDatos);
	}
	
	
	function llenaDatos($data){
		global $rutaArchivoCopia;

		$spreadsheet = IOFactory::load($rutaArchivoCopia);
		if ($spreadsheet){
			$hoja = $spreadsheet->getSheet(NUM_HOJA);
			fechas($hoja, 'AY6');
			llenaSeccion($hoja, 'B16:B35', 'D16', $data);
			llenaSeccion($hoja, 'B37:B68', 'D37', $data);
			llenaSeccion($hoja, 'B70:B88', 'D70', $data);
			llenaSeccion($hoja, 'B90:B105', 'D90', $data);
			llenaSeccion($hoja, 'B107:B108', 'D107', $data);
			$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$writer->save($rutaArchivoCopia);
			//header("Location: llenadoF3C.php?status=Excel1F4Gen");
			header("Location: llenadoF3C.php?status=Excel1F4Gen");
			exit();
		}
	}

//Declaración de variables.
$anioActual = (int)date('Y');
$anioAnterior = $anioActual - 1;

// Ruta del archivo original y copia

$mes = date('n');
$numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => "Mes inválido"};
$nombreArchivo = "1 DFLE_". $numTrimestre ."T_". $anioActual ." Unid Acad CELEX obs gfl 2";
$rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_1.xlsx';
$rutaArchivoCopia = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';

$query =	"	SELECT DISTINCT UA.Siglas, I.Desc_Idioma, CA.Fecha
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
		//echo '<h1>El archivo existe.</h1><br>';
		
		llenaDatos($data);
	}
	
	else{
		echo '<h1>El archivo No existe.</h1><br>';
		if (copy($rutaArchivoOriginal, $rutaArchivoCopia)) {
			//echo 'Copia del archivo creada exitosamente.<br>';
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
//echo "<br>Tiempo de ejecución: " . $execution_time . " segundos<br><br>";
//imprimeTablaDatos($data);
?>