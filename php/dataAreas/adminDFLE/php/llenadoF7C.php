<?php

// Incluir la clase de PHP Spreadsheet
header('Content-Type: text/html; charset=utf-8');
require '../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('America/Mexico_City');

include '../../../conexion.php';

	
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
	
	
	function ObtenerCelda($rang, $idiom, $hoja){
		$celdas = $hoja->rangeToArray($rang, null, true, true, true);
		// Iterar sobre cada celda del rango
		foreach ($celdas as $fila => $columnas) {
			foreach ($columnas as $columna => $valor) {
				// Verificar si el valor de la celda coincide con el idioma buscado
				if ($valor == $idiom) {
					// Si coincide, imprimir la posición de la celda
					$CeldaResult = $fila;
					return $CeldaResult;
					// Aquí puedes realizar cualquier otra acción que necesites con la celda encontrada
				}
			}
		}
	}


	function guardarContenidoEnCelda($hoja, $celda, $contenido){
		// Obtener la hoja específica por su índice y asignar contenido a la celda especificada
		$hoja->setCellValue($celda, $contenido);
	}


	function archivoExistencia($nombre){
		$rutaData = '../../../exelDFLE/unidades/' . $nombre . '.xlsx';
		if (file_exists($rutaData)) {
			return true;
		} else {
			return false;
		}
	}


	function obtenerContenidoDeCelda($hoja, $celda) {
		// Obtener el valor de la celda especificada
		return $hoja -> getCell($celda)->getValue();
	}
	
	function actualizaContenidoDeCelda($hoja, $celda, $valor) {
		$valorActual = obtenerContenidoDeCelda($hoja, $celda);
		if ($valorActual == NULL || $valorActual === '')
			$valorActual = 0;
		// Validar que los valores sean numéricos
		if (is_numeric($valorActual) && is_numeric($valor)) {
			$valorNuevo = $valorActual + $valor;
			guardarContenidoEnCelda($hoja, $celda, $valorNuevo);
		} else {
			echo "Error: Los valores no son numéricos.";
		}
	}
	
	function verificarInstancia($arregloUnidades, $nombre) {
		foreach ($arregloUnidades as $indice => $unidad) {
			
			if ($unidad->siglas === $nombre) {

				return $indice; 
			}
		}
		return -1; 
	}
	
	
	function imprimeTablaDatos($data){
		// Imprimir la tabla HTML
		echo "<table border='1'>";
		// Imprimir la fila de encabezados de la tabla
		echo "<tr>";
		foreach ($data[0] as $key => $value) {
			echo "<th>$key</th>";
		}
		echo "</tr>";
		// Imprimir los datos de cada fila en la tabla
		foreach ($data as $registro) {
			echo "<tr>";
			foreach ($registro as $valor) {
				echo "<td>$valor</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}


	
	class NivelEducativo {
		public $totalHombres = 0;
		public $totalMujeres = 0;
		
		// Función para sumar valor a totalHombres
		public function sumarHombres($cantidad) {
			$this->totalHombres += $cantidad;
		}
		
		// Función para sumar valor a totalMujeres
		public function sumarMujeres($cantidad) {
			$this->totalMujeres += $cantidad;
		}
	}
	
	class Unidad {
		public $poblaciones = array();
		public $siglas;

		public function __construct($siglas) {
			$this->siglas = $siglas;
			$this->poblaciones = array(
				"Población IPN" => array(
					"MEDIO SUPERIOR" => new NivelEducativo(),
					"SUPERIOR" => new NivelEducativo(),
					"POSGRADO" => new NivelEducativo(),
					"EGRESADOS" => new NivelEducativo(),
					"EMPLEADOS" => new NivelEducativo()
				),
				"Población General" => array(
					"No aplica" => new NivelEducativo()
				)
			);
		}

		public function sumarValorHombres($valor, $cadena1, $cadena2) {
			if (isset($this->poblaciones[$cadena1][$cadena2])) {
				$this->poblaciones[$cadena1][$cadena2]->sumarHombres($valor);
			} else {
				echo "La ubicación especificada no existe.";
			}
		}

		public function sumarValorMujeres($valor, $cadena1, $cadena2) {
			if (isset($this->poblaciones[$cadena1][$cadena2])) {
				$this->poblaciones[$cadena1][$cadena2]->sumarMujeres($valor);
			} else {
				echo "La ubicación especificada no existe.";
			}
		}
	}

	
	function llenaDatos($data, $ruta){
		$spreadsheet = IOFactory::load($ruta);
		$columnasDatos = array(
						"Población IPN" => array(
							"MEDIO SUPERIOR" => array("C","D"),
							"SUPERIOR" => array("F","G"),
							"POSGRADO" => array("I","J"),
							"EGRESADOS" => array("L","M"),
							"EMPLEADOS" => array("O","P")
						),
						"Población General" => array(
							"No aplica" => array("U","V")
						)
					);
		$unidades = array();
		
		if ($spreadsheet){
			
			$hoja = $spreadsheet->getSheet(0);
			fechas($hoja, 'Z7');
			
			foreach ($data as $registro){
				$siglas = $registro['Siglas'];
				if ($siglas === "SIA"){
					continue;
				}
				$tipoPoblacion = $registro['Tipo_Poblacion'];
				$nivelEducativo = $registro['Nivel_Educativo'];
				
				$cantidadHombresRegistro = $registro['Desc_Hombres'];
				$cantidadMujeresRegistro = $registro['Desc_Mujeres'];
				
				$indice = verificarInstancia($unidades, $siglas);
				
				if ($indice != -1){
					$unidades[$indice] -> sumarValorHombres($cantidadHombresRegistro, $tipoPoblacion, $nivelEducativo);
					$unidades[$indice] -> sumarValorMujeres($cantidadMujeresRegistro, $tipoPoblacion, $nivelEducativo);
				}
				else{
					$nuevaUnidad = new Unidad ($siglas);
					$nuevaUnidad -> sumarValorHombres($cantidadHombresRegistro, $tipoPoblacion, $nivelEducativo);
					$nuevaUnidad -> sumarValorMujeres($cantidadMujeresRegistro, $tipoPoblacion, $nivelEducativo);
					array_push($unidades, $nuevaUnidad);
				}
				
			}
			
			foreach ($unidades as $unidad){
				$rangoCeldas = 'B17:B108';
				$fila = ObtenerCelda($rangoCeldas, $unidad->siglas, $hoja);
				
				var_dump($fila);
				echo"<br>";
				var_dump($unidad->siglas);
				echo"<br>";
				
				//var_dump($unidad->poblaciones);
				foreach ($unidad->poblaciones as $poblacion => $niveles){
					echo"<br>$poblacion<br>";
					foreach ($niveles as $nivel => $alumnos){
						echo"<br>$nivel<br>";
						$celdaHombres = $columnasDatos[$poblacion][$nivel][0] . $fila;
						$celdaMujeres = $columnasDatos[$poblacion][$nivel][1] . $fila;
						guardarContenidoEnCelda($hoja, $celdaHombres, $alumnos->totalHombres);
						guardarContenidoEnCelda($hoja, $celdaMujeres, $alumnos->totalMujeres);
						echo ("HOMBRES ($celdaHombres): $alumnos->totalHombres<br>");
						echo "MUJERES($celdaMujeres): $alumnos->totalMujeres<br>";
					}
					echo"<br>";
				}

				echo"<br><br>";
			}
			
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


	// Ruta del archivo original
	$anio = date('Y');
	$mes = date('n');
	$numTrimestre = match (true) {$mes <= 3 => 1, $mes <= 6 => 2, $mes <= 9 => 3, $mes <= 12 => 4, default => "Mes inválido"};
	$nombreArchivo = "2 DFLE_". $numTrimestre ."T_". $anio ." IDIOMAS POR NIVEL gf";
    
	$rutaArchivoOriginal = '../../../exelDFLE/plnatilla/General_Formato_2.xlsx';
    $rutaCopiaArchivo = '../../../exelDFLE/unidades/' . $nombreArchivo . '.xlsx';
    
	
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
			ORDER BY 
				UA.Desc_Nombre_Unidad_Academica,
				CASE 
					WHEN TP.Desc_TipoPoblacion = \'Población IPN\' THEN 1 
					WHEN TP.Desc_TipoPoblacion = \'Población General\' THEN 2 
					ELSE 3 
				END,
				CASE 
					WHEN NE.Desc_NivelEducativo = \'MEDIO SUPERIOR\' THEN 1
					WHEN NE.Desc_NivelEducativo = \'SUPERIOR\' THEN 2
					WHEN NE.Desc_NivelEducativo = \'POSGRADO\' THEN 3
					WHEN NE.Desc_NivelEducativo = \'EGRESADOS\' THEN 4
					WHEN NE.Desc_NivelEducativo = \'EMPLEADOS\' THEN 5
					ELSE 6 
				END,
				CASE
					WHEN NC.Desc_Nivel_De_Competencia = \'BASICO\' THEN 1
					WHEN NC.Desc_Nivel_De_Competencia = \'INTERMEDIO\' THEN 2
					WHEN NC.Desc_Nivel_De_Competencia = \'AVANZADO\' THEN 3
					ELSE 4
				END';
	
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