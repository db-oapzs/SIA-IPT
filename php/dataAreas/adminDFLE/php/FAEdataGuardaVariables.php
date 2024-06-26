<?php
	// Incluir la clase de PHP Spreadsheet
	header('Content-Type: text/html; charset=utf-8');
	require '../../../vendor/autoload.php';
	use PhpOffice\PhpSpreadsheet\IOFactory;
	date_default_timezone_set('America/Mexico_City');
		
	include '../../../conexion.php';
	
    session_start();
    if (!isset($_SESSION['correo'])) {
        header("Location: ../../../../html/login.php?status=sessionCad");
        exit();
    }
	
	$correo = $_SESSION['correo'];
	$nombre_usuario = $_SESSION['nombre_usuario'];
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) && !empty($_POST)){
		function ejecutaQuery($sqlQuery, $params = NULL){
			global $connection;
			$data = array();
			$stmt = sqlsrv_prepare($connection, $sqlQuery, $params);
			if ($stmt === false) {
				echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
				header("Location: copia.php?status=errorConsulta");
				exit();
			} else {
				$result = sqlsrv_execute($stmt);
			
				if ($result === false) {
					header("Location: copia.php?status=errorDtFAE");
					exit();
				} else {
					while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
						$data[] = $row;
					}
				}
				sqlsrv_free_stmt($stmt);
			}
			return $data;
		}
		
		function obtenerValoresEnPosicion($array, $x) {
			$resultados = ["V1" => [],"V2" => []];
			$ordenV1 = ["1erTrimV1", "2doTrimV1", "3erTrimV1", "4toTrimV1"];
			$ordenV2 = ["1erTrimV2", "2doTrimV2", "3erTrimV2", "4toTrimV2"];

			foreach ($ordenV1 as $clave) {
				if (isset($array[$clave][$x])) {
					$resultados["V1"][] = $array[$clave][$x];
				} else {
					$resultados["V1"][] = null;
				}
			}

			foreach ($ordenV2 as $clave) {
				if (isset($array[$clave][$x])) {
					$resultados["V2"][] = $array[$clave][$x];
				} else {
					$resultados["V2"][] = null;
				}
			}

			return $resultados;
		}

		$indicadores = $_POST['indicadorPIMDFLE'];
		$notas = $_POST['notas'];

		$datosVariables = ' 
			INSERT INTO FAES_DFLE_Indicadores_Temporal(
			Clave_Indicador, 
			Variable, 
			PRIMER_TRIM, 
			SEGUNDO_TRIM, 
			TERCER_TRIM, 
			CUARTO_TRIM, 
			Fecha)
			VALUES(?, ?, ?, ?, ?, ?, ?)
		';
		$fecha = date('d-m-Y H:i:s');
		
		
		for ($i = 0; $i < count($_POST['1erTrimV1']); $i++){
			$variables = obtenerValoresEnPosicion($_POST, $i);
			$valoresV1 = [$indicadores[$i], "V1", $fecha];
			array_splice($valoresV1, 2, 0, $variables["V1"]);
			$valoresV2 = [$indicadores[$i], "V2", $fecha];
			array_splice($valoresV2, 2, 0, $variables["V2"]);
			ejecutaQuery($datosVariables, $valoresV1);
            ejecutaQuery($datosVariables, $valoresV2);
		}


		$queryNotas = '
			INSERT INTO NOTAS_FAE_DFLE (
			Notas,
			Tipo_Resumen,
			Area_Operativa, 
			Fecha)
			VALUES 
			?,?,?,?
		';
		$fechaDarafae = (string)date('Y-m-d H:i:s');
	
		
		$queryNotas = '
			INSERT INTO NOTAS_FAE_DFLE_Temporal (
				Notas,
				Tipo_Resumen,
				Area_Operativa, 
				Fecha
			) VALUES (?, ?, ?, ?)
		';
		$fechaDarafae = date('Y-m-d H:i:s');
	
		for ($i = 0; $i < count($notas); $i++) {
			$params = [$i + 1, $notas[$i], $nombre_usuario, $fechaDarafae];
			ejecutaQuery($queryNotas, $params);
			//echo"nota insertada - $i - <br>";
		}
		
		header("Location: copia.php?status=FaeGuardado");
		exit();
	}


?>