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

$sql = 'SELECT Desc_Idioma FROM idiomas';
$queryDatos = 'SELECT DISTINCT CA.Fecha, UA.Siglas, TUA.Desc_SiglasTipo, I.Desc_Idioma
					FROM Cantidades_Alumnos CA
					JOIN Unidades_Academicas UA ON
					CA.id_UnidadAcademica = UA.ID_UnidadAcademica
					JOIN TipoUnidadAcademica TUA ON 
					UA.id_TipoUnidadAcademica = TUA.ID_TipoUnidadAcademica
					JOIN Idiomas I ON CA.id_Idioma = I.ID_Idioma
					where Fecha LIKE ?';
$anio = date('Y'); 
$contador  = ["NMS" => 0, "NS" =>0, "C INV" => 0, "CVDR" => 0, "CENLEX" => 0];
$idiomas = array_column(ejecutaQuery($sql), "Desc_Idioma");
foreach($idiomas as $registroIdioma){
	$arregloContadores[$registroIdioma] = $contador;
	$arregloContadoresAnterior[$registroIdioma] = $contador;
}

$datos = ejecutaQuery($queryDatos, array('%'.$anio.'%'));
$datosAnterior = ejecutaQuery($queryDatos, array('%'. $anio-1 .'%'));

foreach($datos as &$item){
	unset($item["Fecha"]);
}

foreach($datosAnterior as &$item){
	unset($item["Fecha"]);
}

$valoresUnicos = array_unique($datos, SORT_REGULAR);
$valoresUnicosAnterior = array_unique($datosAnterior, SORT_REGULAR);

foreach($valoresUnicos as $registro){
	$arregloContadores[$registro['Desc_Idioma']][$registro['Desc_SiglasTipo']] ++;
}

foreach($valoresUnicosAnterior as $registro){
	$arregloContadoresAnterior[$registro['Desc_Idioma']][$registro['Desc_SiglasTipo']] ++;
}

$json_array = json_encode($arregloContadores);
$json_array2 = json_encode($arregloContadoresAnterior);

    //include 'menu.php';
    include 'menuFinal.php';
?>
    <h1>LENGUAS  CON  REGISTRO</h1>
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
            <div class="TablaP">
                <div id="Header">ENERO - DICIEMBRE <?php echo $anio-1?></div>
                <div id="Subheader1">NMS</div>
                <div id="Subheader2">NS</div>
                <div id="Subheader3">C INV</div>
                <div id="Subheader4">CVDR</div>
                <div id="Subheader5">CENLEX</div>
                <div id="Subheader6">TOTAL</div>
                <div class="V1" id="VNMSA">0</div>
                <div class="V2" id="VNSA">0</div>
                <div class="V3" id="VCINVA">0</div>
                <div class="V4" id="VCVDRA">0</div>
                <div class="V5" id="VCENLEXA">0</div>
                <div class="V6" id="VTOTALA">0</div>
            </div>
            <div class="TablaP">
                <div id="Header">ENERO - DICIEMBRE <?php echo $anio?></div>
                <div id="Subheader1">NMS</div>
                <div id="Subheader2">NS</div>
                <div id="Subheader3">C INV</div>
                <div id="Subheader4">CVDR</div>
                <div id="Subheader5">CENLEX</div>
                <div id="Subheader6">TOTAL</div>
                <div class="V1" id="VNMSB">0</div>
                <div class="V2" id="VNSB">0</div>
                <div class="V3" id="VCINVB">0</div>
                <div class="V4" id="VCVDRB">0</div>
                <div class="V5" id="VCENLEXB">0</div>
                <div class="V6" id="VTOTALB">0</div>
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
    const arrayJS = <?php echo $json_array; ?>;
    const selectIdioma = document.getElementById('SelectorIdioma');
    const idioma = document.getElementById('idioma');
    const TextInput = document.getElementById('TextInput');
    const nmsActual = document.getElementById('VNMSB');
    const nsActual = document.getElementById('VNSB');
    const cinvActual = document.getElementById('VCINVB');
    const cvdrActual = document.getElementById('VCVDRB');
    const cenlexActual = document.getElementById('VCENLEXB');
    const totalActual = document.getElementById('VTOTALB');
	const nmsAnterior = document.getElementById('VNMSA');
    const nsAnterior = document.getElementById('VNSA');
    const cinvAnterior = document.getElementById('VCINVA');
    const cvdrAnterior = document.getElementById('VCVDRA');
    const cenlexAnterior = document.getElementById('VCENLEXA');
    const totalAnterior = document.getElementById('VTOTALA');
	const varPorcentual = document.getElementById('VP');

    // Agregar un event listener para el evento 'change'
    selectIdioma.addEventListener('change', () => {
        // Obtener el valor seleccionado del select
        const idiomaSeleccionado = selectIdioma.value;
        var arrayJS = <?php echo $json_array; ?>;
		var contadorAnterior = <?php echo $json_array2; ?>;
        // Verificar si se ha seleccionado un idioma válido
        if (idiomaSeleccionado !== "") {
            // Se ha seleccionado un idioma, puedes realizar acciones aquí
            console.log("Se ha seleccionado el idioma: " + idiomaSeleccionado);
            idioma.value = idiomaSeleccionado;
            TextInput.removeAttribute('readonly');
			var valores = arrayJS[idiomaSeleccionado];
            nmsActual.innerHTML = valores['NMS'];	
            nsActual.innerHTML = valores['NS'];
            cinvActual.innerHTML = valores['C INV'];
            cvdrActual.innerHTML = valores['CVDR'];
            cenlexActual.innerHTML = valores['CENLEX'];
			var sum = Object.values(valores).reduce((accumulator, currentValue) => accumulator + currentValue, 0);
            totalActual.innerHTML = sum;
			
			var arrayIdiomaAnterior = contadorAnterior[idiomaSeleccionado];
            nmsAnterior.innerHTML = arrayIdiomaAnterior['NMS'];	
            nsAnterior.innerHTML = arrayIdiomaAnterior['NS'];
            cinvAnterior.innerHTML = arrayIdiomaAnterior['C INV'];
            cvdrAnterior.innerHTML = arrayIdiomaAnterior['CVDR'];
            cenlexAnterior.innerHTML = arrayIdiomaAnterior['CENLEX'];
			var sum2 = Object.values(arrayIdiomaAnterior).reduce((accumulator, currentValue) => accumulator + currentValue, 0);
            totalAnterior.innerHTML = sum2;
			
			var variacionPorcentual = sum2 !== 0 ? sum / sum2 - 1 : " ";
			var formattedVariacion = (variacionPorcentual * 100).toFixed(2) + "%";
			varPorcentual.innerHTML = formattedVariacion;

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
            form.action = "enviarDataF5.php"; // Reemplaza "nueva_url" con la URL deseada
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
            form.action = "guardarDataF5.php"; // Reemplaza "nueva_url" con la URL deseada
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