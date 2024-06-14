<?php
include '../conexion.php';
if(isset($_GET['status'])) {
    include '../errors.php';
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

        include 'menu.php';
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
                <div id="Header">Periodo</div>
                <div id="Subheader1">NMS</div>
                <div id="Subheader2">NS</div>
                <div id="Subheader3">C INV</div>
                <div id="Subheader4">CVDR</div>
                <div id="Subheader5">CENLEX</div>
                <div id="Subheader6">TOTAL</div>
                <div class="V1" id="VNMSA">Value</div>
                <div class="V2" id="VNSA">Value</div>
                <div class="V3" id="VCINVA">Value</div>
                <div class="V4" id="VCVDRA">Value</div>
                <div class="V5" id="VCENLEXA">Value</div>
                <div class="V6" id="VTOTALA">Value</div>
            </div>
            <div class="TablaP">
                <div id="Header">Periodo</div>
                <div id="Subheader1">NMS</div>
                <div id="Subheader2">NS</div>
                <div id="Subheader3">C INV</div>
                <div id="Subheader4">CVDR</div>
                <div id="Subheader5">CENLEX</div>
                <div id="Subheader6">TOTAL</div>
                <div class="V1" id="VNMSB">Value</div>
                <div class="V2" id="VNSB">Value</div>
                <div class="V3" id="VCINVB">Value</div>
                <div class="V4" id="VCVDRB">Value</div>
                <div class="V5" id="VCENLEXB">Value</div>
                <div class="V6" id="VTOTALB">Value</div>
            </div>

            <div class="TablaVP">
                <div id="HeaderVP">Variación Porcentual</div>
                <div class="VP" id="VP">Value</div>
            </div>
            <form id="formStatus" class="JInput" method="POST" action="enviaJustificacion.php">
                <label id="JustLabel" for="TextInput">Justificación</label>
                <textarea type="text" id="TextInput" name="Justificación" placeholder="Ingrese su justificación..." required readonly></textarea>
                <input type="hidden" id="idioma" name="idioma" value="">
                <input type="submit" id="BGuardar" value="Guardar">
                <input type="submit" id="BEnviar" value="Enviar">
            </form>

    </section>
</body>

</html>