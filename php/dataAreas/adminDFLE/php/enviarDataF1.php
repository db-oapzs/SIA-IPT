<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
include '../../../trimestre.php';

define("NUM_HOJA", 0);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selectNivelA"]) && isset($_POST["selectNivelA"]) && $_POST['selectNivelA'] != "") {
    //echo "<br><h2>Envia a la base de datos Formal</h2><br>";
    //var_dump($_POST);
    $nombreArchivo =  'UNIDADES ACADÉMICAS QUE CUENTAN CON CELEX Y SUPERVISADAS';
    $fecha = date('d-m-Y H:i:s');
    //echo "<br><h2>" . count($_POST) . "</h2>";
    $dataSeparada = array();
	
	foreach ($_POST as $key => $value) {
        $newKey = str_replace("Trim", "-", $key);
        $dataSeparada[$newKey] = $value;
    }
	
	foreach ($_POST as $key => $value) {
        //echo "$key<br>";
    }
	
    //var_dump($dataSeparada);
	//echo"<br><br>";
	
// ------------------ CÓDIGO QUE VACÍA LOS DATOS AL EXCEL (FORMATO 1 -> SUPERVISIÓN ACADÉMICA AL CELEX) ------------------
	
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

	function imprimeTablaDatos($datos){
		//echo "<table border='1'>";
		//echo "<tr>";
		foreach ($datos[0] as $clave => $valor) {
			echo "<th>$clave</th>";
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
	
	function llenaNMS($hoja, $rangoNombres, $celdaDatos, $datos){
		$nombres = arregloNombres($hoja, $rangoNombres);
		$tamanio = count($nombres);
		$arregloDatos = array();
		$arregloDatos = array_fill(0, $tamanio, array_fill(0, 4, 0));
		foreach($datos as $key => $value) {
			if ($key === "selectNivelA") {
				continue; // Salta a la siguiente iteración si la clave es "selectNivelA"
			}
			$patron = '/Ce[cyt]*(\d+)Trim(\d+)SX/';
			preg_match($patron, $key, $coincidencias);
			
			if (substr($key, 0, 3) === "Cet"){
				$unidad = "CET 1";
			}
			else{
				$unidad = "CECyT ".$coincidencias[1];
			}
			$trimestre = (int)$coincidencias[2] - 1;
			$posicion = buscarCadena($unidad, $nombres);
			if($posicion >= 0){
				$arregloDatos[$posicion][$trimestre] = 1;
			}
		}

		$hoja->fromArray($arregloDatos, ' ', $celdaDatos);
	}
	
	function llenaNS($hoja, $rangoNombres, $celdaDatos, $datos){
		$nombres = arregloNombres($hoja, $rangoNombres);
		$tamanio = count($nombres);
		$arregloDatos = array();
		$arregloDatos = array_fill(0, $tamanio, array_fill(0, 4, 0));
		
		foreach($datos as $key => $value) {
			
			if ($key === "selectNivelA") continue;
			
			$patron = '/^([A-Z]+[a-z]*)Trim(\d+)SX$/';
			preg_match($patron, $key, $coincidencias);
			
			$unidad = $coincidencias[1];
			$trimestre = (int)$coincidencias[2];
			switch($unidad){
				case "CICSma":
					$unidad = "CICS Milpa Alta";
					break;
				case "CICSst":
					$unidad = "CICS Santo Tomás";
					break;
				case "ESCAst":
					$unidad = "ESCA Santo Tomás";
					break;
				case "ESCAt":
					$unidad = "ESCA Tepepan";
					break;
				case "ESIAtec":
					$unidad = "ESIA Tecamachalco";
					break;
				case "ESIAt":
					$unidad = "ESIA Ticomán";
					break;
				case "ESIAz":
					$unidad = "ESIA Zacatenco";
					break;
				case "ESIMEa":
					$unidad = "ESIME Azcapotzalco";
					break;
				case "ESIMEc":
					$unidad = "ESIME Culhuacán";
					break;
				case "ESIMEt":
					$unidad = "ESIME Ticomán";
					break;
				case "ESIMEz":
					$unidad = "ESIME Zacatenco";
					break;
			}
			//echo($unidad . " " . $trimestre);
			//echo "<br>";
			
			$posicion = buscarCadena($unidad, $nombres);
			//echo "POS: $posicion<br>";
			if($posicion >= 0){
				$arregloDatos[$posicion][$trimestre-1] = 1;
			}
			
		}

		$hoja->fromArray($arregloDatos, ' ', $celdaDatos);
	}
	
	function llenaCINV($hoja, $rangoNombres, $celdaDatos, $datos){
		$nombres = arregloNombres($hoja, $rangoNombres);
		$tamanio = count($nombres);
		$arregloDatos = array();
		$arregloDatos = array_fill(0, $tamanio, array_fill(0, 4, 0));
		
		foreach($datos as $key => $value) {
			
			if ($key === "selectNivelA") continue;
			
			$patron = '/^([A-Z]+[a-z]*)Trim(\d+)SX$/';
			preg_match($patron, $key, $coincidencias);
			
			$unidad = $coincidencias[1];
			$trimestre = (int)$coincidencias[2];
			if (strpos($unidad, "CICI") === 0) {
				if ($unidad != "CICIMAR"){
					$unidad = substr($unidad, strlen("CI"));
				}
			}
			
			switch($unidad){
				case "CICATAL":
					$unidad = "CICATA Legaria";
					break;
				case "CICATAA":
					$unidad = "CICATA Altamira";
					break;
				case "CICATAQ":
					$unidad = "CICATA Querétaro";
					break;
				case "CICATAM":
					$unidad = "CICATA Morelos";
					break;
				case "CIBAT":
					$unidad = "CIBA Tlaxcala";
					break;
				case "CIIDIRD":
					$unidad = "CIIDIR Durango";
					break;
				case "CIIDIRM":
					$unidad = "CIIDIR Michoacán";
					break;
				case "CIIDIRO":
					$unidad = "CIIDIR Oaxaca";
					break;
				case "CIIDIRS":
					$unidad = "CIIDIR Sinaloa";
					break;
				
			}
			
			//echo($unidad . " " . $trimestre);
			//echo "<br>";
			
			$posicion = buscarCadena($unidad, $nombres);
			//echo "POS: $posicion<br>";
			if($posicion >= 0){
				$arregloDatos[$posicion][$trimestre-1] = 1;
			}
			
		}

		$hoja->fromArray($arregloDatos, ' ', $celdaDatos);
	}
	
	function llenaCVDR($hoja, $rangoNombres, $celdaDatos, $datos){
		$nombres = arregloNombres($hoja, $rangoNombres);
		$tamanio = count($nombres);
		$arregloDatos = array();
		$arregloDatos = array_fill(0, $tamanio, array_fill(0, 4, 0));
		
		foreach($datos as $key => $value) {
			
			if ($key === "selectNivelA") continue;
			
			$patron = '/^([A-Z]+[a-z]*)Trim(\d+)SX$/';
			preg_match($patron, $key, $coincidencias);
			
			$unidad = $coincidencias[1];
			$trimestre = (int)$coincidencias[2];

			
			switch($unidad){
				case "CVDRCJ":
					$unidad = "CVDR Cajeme";
					break;
				case "CVDRCH":
					$unidad = "CVDR Campeche";
					break;
				case "CVDRCN":
					$unidad = "CVDR Cancún";
					break;
				case "CVDRCL":
					$unidad = "CVDR Culiacan";
					break;
				case "CVDRD":
					$unidad = "CVDR Durango";
					break;
				case "CVDRLM":
					$unidad = "CVDR Los Mochis";
					break;
				case "CVDRMZ":
					$unidad = "CVDR Mazatlán";
					break;
				case "CVDRMR":
					$unidad = "CVDR Morelia";
					break;
				case "CVDROX":
					$unidad = "CVDR Oaxaca";
					break;
				case "CVDRTM":
					$unidad = "CVDR Tampico";
					break;
				case "CVDRTJ":
					$unidad = "CVDR Tijuana";
					break;
				case "CVDRTX":
					$unidad = "CVDR Tlaxcala";
					break;
				case "CVDRCHI":
					$unidad = "CIITA Chihuahua";
					break;
				case "CVDRV":
					$unidad = "CIITA Veracruz";
					break;
				case "CVDRG":
					$unidad = "CIITA Guanajuato";
					break;
				case "CVDRP":
					$unidad = "CIITA Puebla";
					break;
			}
			
			//echo($unidad . " " . $trimestre);
			//echo "<br>";
			
			$posicion = buscarCadena($unidad, $nombres);
			//echo "POS: $posicion<br>";
			if($posicion >= 0){
				$arregloDatos[$posicion][$trimestre-1] = 1;
			}
			
		}

		$hoja->fromArray($arregloDatos, ' ', $celdaDatos);
	}
	
	
	function llenaDatos($data){
		global $rutaArchivoCopia;

		$spreadsheet = IOFactory::load($rutaArchivoCopia);
		if ($spreadsheet){
			$hoja = $spreadsheet->getSheet(NUM_HOJA);
			fechas($hoja, 'K5');
			
			switch($data["selectNivelA"]){
				case "contDtMS":
					llenaNMS($hoja, 'B15:B34', 'G15', $data);
					break;
				case "contDTS":
					llenaNS($hoja, 'B36:B67', 'G36', $data);
					break;
				case "contDtCI":
					llenaCINV($hoja, 'B69:B87', 'G69', $data);
					break;
				case "contDtCVDR":
					llenaCVDR($hoja, 'B89:B104', 'G89', $data);
					break;
			}
			
			//llenaSeccion($hoja, 'B15:B34', 'G15', $data);
			//llenaSeccion($hoja, 'B36:B67', 'G36', $data);
			
			//llenaSeccion($hoja, 'B69:B87', 'G69', $data);
			//llenaSeccion($hoja, 'B89:B104', 'G89', $data);
			
			$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$writer->save($rutaArchivoCopia);
			header("Location: Bienvenida.php?status=excel1F1Gen");
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

	if ($_POST != NULL){
		if (archivoExistencia($nombreArchivo)) {
			//echo '<h1>El archivo existe.</h1><br>';
			
			llenaDatos($_POST);
		}
		
		else{
			//echo '<h1>El archivo No existe.</h1><br>';
			if (copy($rutaArchivoOriginal, $rutaArchivoCopia)) {
				//echo 'Copia del archivo creada exitosamente.<br>';
				llenaDatos($_POST);
			} 
			
			else {
				//echo '<br><h1>Error al crear la copia del archivo.</h1>';
				header("Location: Bienvenida.php?status=excelCopyFailed");
				exit();
			}
		}
	}

	$end_time = microtime(true);
	$execution_time = $end_time - $start_time;
	//echo "Tiempo de ejecución: " . $execution_time . " segundos";

} else {
    header("Location: Bienvenida.php?status=Ni");
    exit();
}
?>
