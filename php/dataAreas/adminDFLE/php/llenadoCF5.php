<?php
// Incluir la clase de PHP Spreadsheet
header('Content-Type: text/html; charset=utf-8');
require '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');

define("NUM_HOJA", 4);

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
	
	function arregloNombres($hoja, $rango){
		$dataArray = $hoja->rangeToArray($rango, NULL, TRUE, TRUE, FALSE);
		return $dataArray;
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
	
	
	function llenaDatos($listaIdiomas){
		
		global $queryIdiomaFecha, $anioActual, $anioAnterior, $rutaArchivoCopia;
		$unidadesAnterior = ejecutaQuery($queryIdiomaFecha, array("%".$anioAnterior."%"));
		$unidadesActual = ejecutaQuery($queryIdiomaFecha, array("%".$anioActual."%"));
		
		imprimeTablaDatos($unidadesAnterior);
		imprimeTablaDatos($unidadesActual);
		
		$data = array();
		$dataActual = array();
		$arrayAnioActual = array();
		$arrayAnioAnterior = array();
		$idiomas = array_column($listaIdiomas, "Desc_Idioma");
		$contador  = ["NMS" => 0, "NS" =>0, "C INV" => 0, "CVDR" => 0, "CENLEX" => 0];
		
		foreach($idiomas as $registroIdioma){
			$arregloContadores[$registroIdioma] = $contador;
			$arregloContadoresAnterior[$registroIdioma] = $contador;
		}
		
		foreach($unidadesAnterior as &$item){
			unset($item["Fecha"]);
		}
		
		foreach($unidadesActual as &$item){
			unset($item["Fecha"]);
		}
		$unidadesAnterior = array_unique($unidadesAnterior, SORT_REGULAR);
		$unidadesActual = array_unique($unidadesActual, SORT_REGULAR);
		
		foreach($unidadesAnterior as $registro){
			$arregloContadoresAnterior[$registro['Desc_Idioma']][$registro['Desc_SiglasTipo']] ++;
		}
		
		foreach($unidadesActual as $registro){
			$arregloContadores[$registro['Desc_Idioma']][$registro['Desc_SiglasTipo']] ++;
		}
		
		$dataAnterior = array_map('array_values', array_values($arregloContadoresAnterior));
		$dataActual = array_map('array_values', array_values($arregloContadores));

		$spreadsheet = IOFactory::load($rutaArchivoCopia);
		if ($spreadsheet){
			$hoja = $spreadsheet->getSheet(NUM_HOJA);
			fechas($hoja, 'Q6');
			$hoja->fromArray($dataAnterior, ' ', 'C16');
			$hoja->fromArray($dataActual, ' ', 'I16');
			$hoja->setCellValue('C13', "ENERO - DICIEMBRE DE ".$anioAnterior);
			$hoja->setCellValue('I13', "ENERO - DICIEMBRE DE ".$anioActual);
			$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
			$writer->save($rutaArchivoCopia);
			header("Location: llenadoEx1F5.php?status=Excel1F5CGenerado");
			exit();
		}
	}

	
// Consulta SQL para obtener unidades académicas y sus tipos filtradas por idioma y fecha
$queryIdiomaFecha = 'SELECT DISTINCT CA.Fecha, UA.Siglas, TUA.Desc_SiglasTipo, I.Desc_Idioma
					FROM Cantidades_Alumnos CA
					JOIN Unidades_Academicas UA ON
					CA.id_UnidadAcademica = UA.ID_UnidadAcademica
					JOIN TipoUnidadAcademica TUA ON 
					UA.id_TipoUnidadAcademica = TUA.ID_TipoUnidadAcademica
					JOIN Idiomas I ON CA.id_Idioma = I.ID_Idioma
					where Fecha LIKE ?';


//	Consulta SQL para obtener la lista de los idiomas		
$queryListaIdiomas = 'SELECT Desc_Idioma FROM idiomas';

//Declaración de variables.
$anioActual = (int)date('Y');
$anioAnterior = $anioActual - 1;

// Ruta del archivo original y copia
$mes = date('n');
$numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => "Mes inválido"};
$nombreArchivo = "1 DFLE_". $numTrimestre ."T_". $anioActual ." Unid Acad CELEX obs gfl 2";
$rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_1.xlsx';
$rutaArchivoCopia = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';

$listaIdiomas = array();

$listaIdiomas = ejecutaQuery($queryListaIdiomas);

if ($listaIdiomas != NULL){

	if (archivoExistencia($nombreArchivo)) {
		echo '<h1>El archivo existe.</h1><br>';
		
		llenaDatos($listaIdiomas);
	}
	
	else{
		echo '<h1>El archivo No existe.</h1><br>';
		if (copy($rutaArchivoOriginal, $rutaArchivoCopia)) {
			echo 'Copia del archivo creada exitosamente.<br>';
			llenaDatos($listaIdiomas);
		} 
		
		else {
			echo '<br><h1>Error al crear la copia del archivo.</h1>';
			header("Location: Bienvenida.php?status=errorArray");
			exit();
		}
	}
	
	imprimeTablaDatos($listaIdiomas);
	
}
   else{
	header("Location: Bienvenida.php?status=emptyArray");
	exit();
}

$end_time = microtime(true);
$execution_time = $end_time - $start_time;
echo "Tiempo de ejecución: " . $execution_time . " segundos";
?>