<?php
include '../../../conexion.php';
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

$idiomas = array(); 
$stmt = sqlsrv_prepare($connection, $sql);
if ($stmt === false) {
    //echo "Error al preparar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
} else {
    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        //echo "Error al ejecutar la consulta: " . sqlsrv_errors()[0]['message'] . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            //echo "<br>";
            //print_r($row);
            $idiomas[] = $row['Desc_Idioma'];
        }
    }
    // Liberar el conjunto de resultados
    sqlsrv_free_stmt($stmt);
}

// Cierra la conexión
sqlsrv_close($connection);

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
                <div id="Header"><?php echo 'ENERO - DICIEMBRE '.(string)((int)date('Y')-1)?></div>
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
                <div id="Header"><?php echo 'ENERO - DICIEMBRE '.(string)(date('Y'))?></div>
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
    
    const selectIdioma = document.getElementById('SelectorIdioma');
    const idioma = document.getElementById('idioma');
    const TextInput = document.getElementById('TextInput');

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