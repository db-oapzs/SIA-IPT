<?php
include '../../../conexion.php';

	function ejecutaQuery($sqlQuery, $params = NULL){
		global $connection;
		$data = array();
		$stmt = sqlsrv_prepare($connection, $sqlQuery, $params);
		if ($stmt === false) {
			echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
		} else {
			$result = sqlsrv_execute($stmt);
		
			if ($result === false) {
			} else {
				while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
					$data[] = $row;
				}
			}
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

if(isset($_GET['status'])) {
    include '../../../errors.php';
    $status = $_GET["status"];
    if(array_key_exists($status, $statusErrors)) {
        echo '
        <nav id="cont-modalCorreo">
            <ul id="modalCorreo">
                <li id="cont-btnclose"><p id="btncloss"><span class="gg-close"></span></p></li>
                <li id="cont-datamodal">
                    <p>' . $status . ': ' . $statusErrors[$status] . '</p>
                </li>
            </ul>
        </nav>
        ';
    }
}

$anio = date('Y'); 
$queryIdiomas = 'SELECT Desc_Idioma FROM idiomas';
$queryCantidades = "SELECT CA.Desc_Hombres, CA.Desc_Mujeres, UA.Desc_Nombre_Unidad_Academica, I.Desc_Idioma, CA.Fecha 
        FROM Cantidades_Alumnos CA
        INNER JOIN 
        Unidades_Academicas UA ON CA.id_UnidadAcademica = UA.ID_UnidadAcademica
        INNER JOIN 
        Idiomas I ON CA.id_Idioma = I.ID_Idioma
        WHERE CA.Fecha LIKE ?";
$genero = ["Hombres" => 0, "Mujeres" => 0];
$unidades = array("CENLEX" => $genero, "CELEX" => $genero);
$idiomas = array_column(ejecutaQuery($queryIdiomas), "Desc_Idioma");
$cantidadesAnterior = ejecutaQuery($queryCantidades, array('%' . $anio-1 . '%'));
$cantidadesActual= ejecutaQuery($queryCantidades, array('%' . $anio . '%'));

foreach($idiomas as $idioma){
	$contadorAnterior[$idioma] = $unidades;
	$contadorActual[$idioma] = $unidades;
}

foreach ($cantidadesAnterior as $registro){
	if($registro['Desc_Nombre_Unidad_Academica'] != "SISTEMA DE INFORMACIÓN PARA LA AUTOEVALUACIÓN"){
		if(strpos($registro['Desc_Nombre_Unidad_Academica'], "CENTRO DE LENGUAS EXTRANJERAS") === 0){
			$contadorAnterior[$registro['Desc_Idioma']]['CENLEX']['Hombres'] += (int)$registro['Desc_Hombres'];
			$contadorAnterior[$registro['Desc_Idioma']]['CENLEX']['Mujeres'] += (int)$registro['Desc_Mujeres'];
		}
		else{
			$contadorAnterior[$registro['Desc_Idioma']]['CELEX']['Hombres'] += (int)$registro['Desc_Hombres'];
			$contadorAnterior[$registro['Desc_Idioma']]['CELEX']['Mujeres'] += (int)$registro['Desc_Mujeres'];
		}
	}
}

foreach ($cantidadesActual as $registro){
	if($registro['Desc_Nombre_Unidad_Academica'] != "SISTEMA DE INFORMACIÓN PARA LA AUTOEVALUACIÓN"){
		if(strpos($registro['Desc_Nombre_Unidad_Academica'], "CENTRO DE LENGUAS EXTRANJERAS") === 0){
			$contadorActual[$registro['Desc_Idioma']]['CENLEX']['Hombres'] += (int)$registro['Desc_Hombres'];
			$contadorActual[$registro['Desc_Idioma']]['CENLEX']['Mujeres'] += (int)$registro['Desc_Mujeres'];
		}
		else{
			$contadorActual[$registro['Desc_Idioma']]['CELEX']['Hombres'] += (int)$registro['Desc_Hombres'];
			$contadorActual[$registro['Desc_Idioma']]['CELEX']['Mujeres'] += (int)$registro['Desc_Mujeres'];
		}
	}
}

$array_contadores_ant = json_encode($contadorAnterior);
$array_contadores_act = json_encode($contadorActual);


    //include 'menu.php';
    include 'menuFinal.php';
?>
    <h1 style="margin-top: 100px; ">PROMEDIO DE ALUMNOS ATENDIDOS EN LENGUAS</h1>
    <section class="flex-container">

            <div class="Selector">
                <label id="IdiomLabel" for="SelectorIdioma">Lenguas</label>
                <select id="SelectorIdioma">
                    <option disabled selected>Selecciona una lengua</option>
                    <?php
                    foreach ($idiomas as $idioma) {
                        echo "<option value='$idioma'>$idioma</option>";
                    }
                    ?>
                </select>
            </div>

           <br> <p>Periodo: <span><?php echo 'ENERO - DICIEMBRE '.(string)((int)date('Y')-1)?></span></p> 
            
            <div class="TablaP">
                <div id="Header">CENLEX</div>
                <div id="Header2">CELEX</div>
                <div id="Header3">TOTAL</div>
                <div id="Subheader1">Hombres</div>
                <div id="Subheader2">Mujeres</div>
                <div id="Subheader3">Total</div>
                <div id="Subheader4">Hombres</div>
                <div id="Subheader5">Mujeres</div>
                <div id="Subheader6">Total</div>
                <div class="Subheader7" id="TOTALP1">0</div>
                <div class="V1" id="HCELEX1">0</div>
                <div class="V2" id="MCELEX1">0</div>
                <div class="V3" id="VTCELEX1">0</div>
                <div class="V4" id="HCENLEX1">0</div>
                <div class="V5" id="MCENLEX1">0</div>
                <div class="V6" id="VTCENLEX1">0</div>
            </div>

            <br><p>Periodo: <span><?php echo 'ENERO - DICIEMBRE '.(string)(date('Y'))?></span></p>   

            <div class="TablaP">
                <div id="Header">CENLEX</div>
                <div id="Header2">CELEX</div>
                <div id="Header3">TOTAL</div>
                <div id="Subheader1">Hombres</div>
                <div id="Subheader2">Mujeres</div>
                <div id="Subheader3">Total</div>
                <div id="Subheader4">Hombres</div>
                <div id="Subheader5">Mujeres</div>
                <div id="Subheader6">Total</div>
                <div class="Subheader7" id="TOTALP2">0</div>
                <div class="V1" id="HCELEX2">0</div>
                <div class="V2" id="MCELEX2">0</div>
                <div class="V3" id="VTCELEX2">0</div>
                <div class="V4" id="HCENLEX2">0</div>
                <div class="V5" id="MCENLEX2">0</div>
                <div class="V6" id="VTCENLEX2">0</div>
            </div>

            <div class="TablaTP2">
                <div id="Header4">SUBTOTAL</div>
                <div id="Header5">TOTAL</div>
                <div id="Subheader8">Hombres</div>
                <div id="Subheader9">Mujeres</div>
                <div class="V7" id="VP2H">0</div>
                <div class="V8" id="VP2M">0</div>
                <div class="V9" id="VP2T">0</div>
            </div>
            <div class="TablaVP">
                <div id="HeaderVP">Variación Porcentual</div>
                <div class="VP" id="VP">0%</div>
            </div>

            <form id="formCont" class="JInput" method="POST" action="">
                <label id="JustLabel" for="TextInput">Justificación</label>
                <textarea type="text" id="TextInput" name="Justificacion" placeholder="Ingrese su justificación..." required readonly></textarea>
                <input type="hidden" id="idioma" name="idioma" value="">
                <input type="submit" id="BGuardar" value="Guardar">
                <input type="submit" id="BEnviar" value="Enviar">
            </form>
    </section>
    
</body>
<script type="text/javascript">
    
    const selectIdioma = document.getElementById('SelectorIdioma');
    const idioma = document.getElementById('idioma');
    const TextInput = document.getElementById('TextInput');
	
	const arrayAnterior = <?php echo $array_contadores_ant; ?>;
	const arrayActual = <?php echo $array_contadores_act; ?>;
	
	const h_cenlex_ant = document.getElementById('HCELEX1');
	const m_cenlex_ant = document.getElementById('MCELEX1');
	const h_celex_ant = document.getElementById('HCENLEX1');
	const m_celex_ant = document.getElementById('MCENLEX1');
	
	const h_cenlex_act = document.getElementById('HCELEX2');
	const m_cenlex_act = document.getElementById('MCELEX2');
	const h_celex_act = document.getElementById('HCENLEX2');
	const m_celex_act = document.getElementById('MCENLEX2');
	
	const t_cenlex_ant = document.getElementById('VTCELEX1');
	const t_celex_ant = document.getElementById('VTCENLEX1');
	
	const t_cenlex_act = document.getElementById('VTCELEX2');
	const t_celex_act = document.getElementById('VTCENLEX2');
	
	const subt_hombres_act = document.getElementById('VP2H');
	const subt_mujeres_act = document.getElementById('VP2M');
	
	const total_anterior = document.getElementById('TOTALP1');
	const total_actual   = document.getElementById('TOTALP2');
	const total_subtotal = document.getElementById('VP2T');
	
	const variacion_porcentual = document.getElementById('VP');

    // Agregar un event listener para el evento 'change'
    selectIdioma.addEventListener('change', () => {
        // Obtener el valor seleccionado del select
        const idiomaSeleccionado = selectIdioma.value;
        
        // Verificar si se ha seleccionado un idioma válido
        if (idiomaSeleccionado !== "") {
            // Se ha seleccionado un idioma, puedes realizar acciones aquí
            console.log("Se ha seleccionado el idioma: " + idiomaSeleccionado);
            idioma.value = idiomaSeleccionado;
            TextInput.removeAttribute('readonly');
			
			h_cenlex_ant.innerHTML = arrayAnterior[idiomaSeleccionado]['CENLEX']['Hombres'];
			m_cenlex_ant.innerHTML = arrayAnterior[idiomaSeleccionado]['CENLEX']['Mujeres'];
			h_celex_ant.innerHTML  = arrayAnterior[idiomaSeleccionado]['CELEX']['Hombres'];
			m_celex_ant.innerHTML  = arrayAnterior[idiomaSeleccionado]['CELEX']['Mujeres'];
			
			var total_cenlex_ant = Object.values(arrayAnterior[idiomaSeleccionado]['CENLEX']).reduce((accumulator, currentValue) => accumulator + currentValue, 0);
			var total_celex_ant = Object.values(arrayAnterior[idiomaSeleccionado]['CELEX']).reduce((accumulator, currentValue) => accumulator + currentValue, 0);
			
			t_cenlex_ant.innerHTML = total_cenlex_ant;
			t_celex_ant.innerHTML = total_celex_ant;
			
			var valor_total_anterior = total_cenlex_ant + total_celex_ant;
			total_anterior.innerHTML = valor_total_anterior;
			
			h_cenlex_act.innerHTML = arrayActual[idiomaSeleccionado]['CENLEX']['Hombres'];
			m_cenlex_act.innerHTML = arrayActual[idiomaSeleccionado]['CENLEX']['Mujeres'];
			h_celex_act.innerHTML  = arrayActual[idiomaSeleccionado]['CELEX']['Hombres'];
			m_celex_act.innerHTML  = arrayActual[idiomaSeleccionado]['CELEX']['Mujeres'];
			
			var total_cenlex_act = Object.values(arrayActual[idiomaSeleccionado]['CENLEX']).reduce((accumulator, currentValue) => accumulator + currentValue, 0);
			var total_celex_act = Object.values(arrayActual[idiomaSeleccionado]['CELEX']).reduce((accumulator, currentValue) => accumulator + currentValue, 0);
			
			t_cenlex_act.innerHTML = total_cenlex_act;
			t_celex_act.innerHTML = total_celex_act;
			
			var valor_total_actual = total_cenlex_act + total_celex_act;
			total_actual.innerHTML = valor_total_actual;
			
			var subtotal_hombres_act = arrayActual[idiomaSeleccionado]['CENLEX']['Hombres'] + arrayActual[idiomaSeleccionado]['CELEX']['Hombres'];
			var subtotal_mujeres_act = arrayActual[idiomaSeleccionado]['CENLEX']['Mujeres'] + arrayActual[idiomaSeleccionado]['CELEX']['Mujeres'];
			subt_hombres_act.innerHTML = subtotal_hombres_act;
			subt_mujeres_act.innerHTML = subtotal_mujeres_act;
			total_subtotal.innerHTML = subtotal_hombres_act + subtotal_mujeres_act;
			
			var variacionPorcentual = valor_total_anterior !== 0 ? valor_total_actual / valor_total_anterior - 1 : " ";
			var formattedVariacion = (variacionPorcentual * 100).toFixed(2) + "%";
			variacion_porcentual.innerHTML = formattedVariacion;
        } else {
            // No se ha seleccionado ningún idioma válido
            console.log("No se ha seleccionado ningún idioma");
            TextInput.setAttribute('readonly', 'readonly');
        }
    });


    let btnGuardar = document.getElementById("BEnviar");

    btnGuardar.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón guardar.");
        let form = document.getElementById("formCont");
        if (form) {
            form.action = "enviarDataF9.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = document.getElementById("formCont");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    
    btnGuardar.addEventListener('mouseout', () => {
        let form = document.getElementById("formCont");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = document.getElementById("formCont");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    let btnEnviar = document.getElementById("BGuardar");
    
    btnEnviar.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón enviar.");
        let form = document.getElementById("formCont");
        if (form) {
            form.action = "guardarDataF9.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = document.getElementById("formCont");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    
    btnEnviar.addEventListener('mouseout', () => {
        let form = document.getElementById("formCont");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = document.getElementById("formCont");
            console.log("Nuevo action del formulario:", form2);
        }
    });
</script>
</html>