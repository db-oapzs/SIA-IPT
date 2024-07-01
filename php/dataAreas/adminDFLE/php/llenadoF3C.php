<?php
// Incluir la clase de PHP Spreadsheet
header('Content-Type: text/html; charset=utf-8');
require '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');

include '../../../conexion.php';

define("NUM_HOJA", 2);
	
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
		echo "<table border='1'>";
		echo "<tr>";
		foreach ($datos[0] as $clave => $valor) {
			echo "<th>$clave</th>";
		}
		echo "</tr>";
		foreach ($datos as $registro) {
			echo "<tr>";
			foreach ($registro as $valorCelda) {
				echo "<td>$valorCelda</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	
	
	function arregloNombres($hoja, $rango) {
		$dataArray = $hoja->rangeToArray($rango, NULL, TRUE, TRUE, FALSE);
		return array_map(function($subArray) {
			return $subArray[0];
		}, $dataArray);
	}
	
	function imprimirTablaFinal($programaIdioma) {
		echo '<table border="1">';
		
		foreach ($programaIdioma as $idioma => $filas) {
			echo '<tr><th colspan="5">' . $idioma . '</th></tr>';
			foreach ($filas as $fila) {
				echo '<tr>';
				foreach ($fila as $celda) {
					echo '<td>' . var_export($celda, true) . '</td>';
				}
				echo '</tr>';
			}
		}
		
		echo '</table>';
	}
	
	
	function llenaSeccion($hoja, $rangoNombres, $filaDatos, $data){
		echo "Llenando seccion: $rangoNombres <br>";
		$idiomas = ["INGLÉS", "ALEMÁN", "JAPONÉS", "COREANO", "PORTUGUÉS", "SEÑAS MEXICANAS", "FRANCÉS"];
		$arregloPosiciones = ["INGLÉS" => 'N', "ALEMÁN" => 'X', "JAPONÉS" => 'AH', "COREANO" => 'AM',
		"PORTUGUÉS" => 'AR', "SEÑAS MEXICANAS" => 'AX', "FRANCÉS" => 'BC'];
		$arregloFinal = array();
		
		
		$arregloUnidades = arregloNombres($hoja, $rangoNombres);
		$programaIdioma = array_fill(0, count($arregloUnidades), array_fill(0, 4, NULL));
		foreach ($idiomas as $idioma){
			$arregloFinal[$idioma] =  $programaIdioma;
		}
		
		foreach ($data as $registro){
			$posicion = array_search($registro['Siglas'], $arregloUnidades);
			if($posicion !== false){
				if($registro['ProgramaGeneral'] === 1){
					$mes = date("n", strtotime($registro['Fecha']));
					$trimestre = match (true) {$mes <= 3 => 0, $mes <= 6 => 1, $mes <= 9 => 2, $mes <= 12 => 3, default => -1};
					if($trimestre != -1){
						$arregloFinal[$registro['Desc_Idioma']][$posicion][$trimestre] = 1;
						echo ("&nbsp;Unidad: " . $registro['Siglas'] . " Posicion: " . $posicion . " Trimestre: " . $trimestre . "<br>");
					}
					
				}
			}
			else{
				continue;
			}
			
		}
		
		foreach ($arregloFinal as $idioma => $matrizIdioma){
			$hoja->fromArray($matrizIdioma,' ', $arregloPosiciones[$idioma] . (string)$filaDatos);
		}
		echo "<br>";
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
			
			llenaSeccion($hoja, 'A15:A34', 15, $data);
			llenaSeccion($hoja, 'A36:A67', 36, $data);
			llenaSeccion($hoja, 'A69:A87', 69, $data);
			llenaSeccion($hoja, 'A89:A104', 89, $data);
			llenaSeccion($hoja, 'A106:A107', 106, $data);

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
$nombreArchivo = "1 DFLE_". $numTrimestre ."T_". $anioActual ." Unid Acad CELEX obs gfl 2";
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
	
	imprimeTablaDatos($data);
}
else{
	echo "Sin datos";
}

$end_time = microtime(true);
$execution_time = $end_time - $start_time;
echo "<br>Tiempo de ejecución: " . $execution_time . " segundos<br><br>";

?>