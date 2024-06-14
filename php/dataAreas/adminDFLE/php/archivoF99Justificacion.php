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
                <div class="V5" id="MCELEX1">0</div>
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
                <div class="V5" id="MCELEX2">0</div>
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