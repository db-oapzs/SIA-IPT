<?php
include '../conexion.php';
if(isset($_GET['idioma'])) {
    $_idioma = $_GET["idioma"];
}else{
    $_idioma = ' ';
}
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

if(count($arrayDataSQL_H) === 0 || count($arrayDataSQL_M) === 0){
    //echo "<br><br><br>";
    for($i = 0 ; $i < 24 ; $i++){
        $arrayDataSQL_H[] = 0;
        $arrayDataSQL_M[] = 0;
    }
    //var_dump($arrayDataSQL_H);
}


var_dump($_SESSION);
?>
    <div id="contDataForm">
        <div id="headerData">
            <form id="formIdioma" method="POST" action="#phpunidades">
                <label>Selecciona idioma :</label>
                <select id="selectCont" name="idioma" style="width:350px;">
                <?php
                if(isset($_idioma) && $_idioma != ' '){
                    echo'
                    <option selected>'.$_idioma.'</option>
                    ';
                }else{
                    echo'
                    <option disabled selected>Selecciona una lengua</option>
                    ';
                }
                    // Iterar sobre el arreglo de idiomas y generar las opciones del select
                    foreach ($idiomas as $idioma) {
                        // Imprimir una opción para cada idioma
                        echo "<option class='optionIdiomas' value=\"$idioma\">$idioma</option>";
                    }
                ?>
                </select>
                <input id="elegirBTN" type="submit" value="Elegir"  
                    style="display:none;"
                />
            </form>
        </div>
        <div id="contMData">
            <div id="idiomaData">
                <div id="contIdiomaSelect"><?php echo $idiomaRecolectado ?></div>
                <form id="formIdioma" method="POST" action="ejecucionSQL.php" style="display:none;">
                    <input id="dtPidioma" type="hidden" name="idioma" value=""/>
                    <input id="dtsPASSado" type="submit" value="Datos Pasados" style="display:none;"/>
                </form>
                <div id="contbtnT" class="texttable" onclick="insertSpaceInInputs()"><p>Obtener Totales</p></div>
            </div>
            <div id="contDtaIdioma">
                <form id="tableForm" method="POST" action="#indefinido">
                    <div id="dataTable">
                        <div class="texttable" id="nivel">Nivel</div>
                        <div class="texttable" id="sexo">sexo</div>
                        <div class="texttable" id="Nbasico">basico</div>
                        <div class="texttable" id="Nintermedio">intermedio</div>
                        <div class="texttable" id="Navanzado">avanzado</div>
                        <div class="texttable" id="nsuperior">superior</div>
                        <div class="texttable" id="ntotales">totales</div>
                        <!--    columna nivel  -->
                        <div class="texttable" id="nivMS">media superior</div>
                        <div class="texttable" id="nivS">superior</div>
                        <div class="texttable" id="nivPos">posgrado</div>
                        <div class="texttable" id="nivEg">egresados</div>
                        <div class="texttable" id="nivEmp">empleados</div>
                        <div class="texttable" id="nivPG">publico General</div>
                        <!--columna de sexo -->
                        <div class="dataCeldas" id="dataHms1">hombre</div>
                        <div class="dataCeldas" id="dataMms1">mujer</div>
                        <div class="dataCeldas" id="dataTms1">total</div>
                        <div class="dataCeldas" id="dataHms2">hombre</div>
                        <div class="dataCeldas" id="dataMms2">mujer</div>
                        <div class="dataCeldas" id="dataTms2">total</div>
                        <div class="dataCeldas" id="dataHms3">hombre</div>
                        <div class="dataCeldas" id="dataMms3">mujer</div>
                        <div class="dataCeldas" id="dataTms3">total</div>
                        <div class="dataCeldas" id="dataHms4">hombre</div>
                        <div class="dataCeldas" id="dataMms4">mujer</div>
                        <div class="dataCeldas" id="dataTms4">total</div>
                        <div class="dataCeldas" id="dataHms5">hombre</div>
                        <div class="dataCeldas" id="dataMms5">mujer</div>
                        <div class="dataCeldas" id="dataTms5">total</div>
                        <div class="dataCeldas" id="dataHms6">hombre</div>
                        <div class="dataCeldas" id="dataMms6">mujer</div>
                        <div class="dataCeldas" id="dataTms6">total</div>

                        
                        <!-- Contenedores Bloqueo -->
                        <div id="block-cont0">
                            <h1>Contenido inhabilitado</h1>
                        </div>
                        <div id="block-cont1">
                            <h1>Contenido inhabilitado</h1>
                        </div>
                        <div id="block-cont2">
                            <h1>Contenido inhabilitado</h1>
                        </div>
                        <div id="block-cont3">
                            <h1>Contenido inhabilitado</h1>
                        </div>
                        <div id="block-cont4">
                            <h1>Contenido inhabilitado</h1>
                        </div>
                        <div id="block-cont5">
                            <h1>Contenido inhabilitado</h1>
                        </div>




                        <!-- Datos basico-->




                        <div class="dataCeldas" id="HbasicMs" >
                            <input class="inputs" type="text" name="HbasicMs"
                            value="<?php echo $arrayDataSQL_H[23]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MbasicMs" >
                            <input class="inputs" type="text" name="MbasicMs"
                            value="<?php echo $arrayDataSQL_M[23]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TbasicMs" >
                            <input class="inputs" type="text" name="TbasicMs" readonly required>
                        </div>
                        <div class="dataCeldas" id="HbasicSup" >
                            <input class="inputs" type="text" name="HbasicSup"
                            value="<?php echo $arrayDataSQL_H[22]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MbasicSup" >
                            <input class="inputs" type="text" name="MbasicSup"
                            value="<?php echo $arrayDataSQL_M[22]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TbasicSup" >
                            <input class="inputs" type="text" name="TbasicSup" readonly required>
                        </div>
                        <div class="dataCeldas" id="HbasicPos" >
                            <input class="inputs" type="text" name="HbasicPos"
                            value="<?php echo $arrayDataSQL_H[21]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MbasicPos" >
                            <input class="inputs" type="text" name="MbasicPos"
                            value="<?php echo $arrayDataSQL_M[21]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TbasicPos" >
                            <input class="inputs" type="text" name="TbasicPos" readonly required>
                        </div>
                        <div class="dataCeldas" id="HbasicEgr" >
                            <input class="inputs" type="text" name="HbasicEgr"
                            value="<?php echo $arrayDataSQL_H[20]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MbasicEgr" >
                            <input class="inputs" type="text" name="MbasicEgr"
                            value="<?php echo $arrayDataSQL_M[20]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TbasicEgr" >
                            <input class="inputs" type="text" name="TbasicEgr" readonly required>
                        </div>
                        <div class="dataCeldas" id="HbasicEmp" >
                            <input class="inputs" type="text" name="HbasicEmp"
                            value="<?php echo $arrayDataSQL_H[19]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MbasicEmp" >
                            <input class="inputs" type="text" name="MbasicEmp"
                            value="<?php echo $arrayDataSQL_M[19]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TbasicEmp" >
                            <input class="inputs" type="text" name="TbasicEmp" readonly required>
                        </div>
                        <div class="dataCeldas" id="HbasicPg" >
                            <input class="inputs" type="text" name="HbasicPg"
                            value="<?php echo $arrayDataSQL_H[18]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MbasicPg" >
                            <input class="inputs" type="text" name="MbasicPg"
                            value="<?php echo $arrayDataSQL_M[18]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TbasicPg" >
                            <input class="inputs" type="text" name="TbasicPg" readonly required>
                        </div>



                        <!-- Datos Intermedio-->



                        <div class="dataCeldas" id="HinterMs" >
                            <input class="inputs" type="text" name="HinterMs"
                            value="<?php echo $arrayDataSQL_H[17]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MinterMs" >
                            <input class="inputs" type="text" name="MinterMs"
                            value="<?php echo $arrayDataSQL_M[17]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TinterMs" >
                            <input class="inputs" type="text" name="TinterMs" readonly required>
                        </div>
                        <div class="dataCeldas" id="HinterSup" >
                            <input class="inputs" type="text" name="HinterSup"
                            value="<?php echo $arrayDataSQL_H[16]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MinterSup" >
                            <input class="inputs" type="text" name="MinterSup"
                            value="<?php echo $arrayDataSQL_M[16]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TinterSup" >
                            <input class="inputs" type="text" name="TinterSup" readonly required>
                        </div>
                        <div class="dataCeldas" id="HinterPos" >
                            <input class="inputs" type="text" name="HinterPos"
                            value="<?php echo $arrayDataSQL_H[15]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MinterPos" >
                            <input class="inputs" type="text" name="MinterPos"
                            value="<?php echo $arrayDataSQL_M[15]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TinterPos" >
                            <input class="inputs" type="text" name="TinterPos" readonly required>
                        </div>
                        <div class="dataCeldas" id="HinterEgr" >
                            <input class="inputs" type="text" name="HinterEgr"
                            value="<?php echo $arrayDataSQL_H[14]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MinterEgr" >
                            <input class="inputs" type="text" name="MinterEgr"
                            value="<?php echo $arrayDataSQL_M[14]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TinterEgr" >
                            <input class="inputs" type="text" name="TinterEgr" readonly required>
                        </div>
                        <div class="dataCeldas" id="HinterEmp" >
                            <input class="inputs" type="text" name="HinterEmp"
                            value="<?php echo $arrayDataSQL_H[13]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MinterEmp">
                            <input class="inputs" type="text" name="MinterEmp"
                            value="<?php echo $arrayDataSQL_M[13]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TinterEmp" >
                            <input class="inputs" type="text" name="TinterEmp" readonly required>
                        </div>
                        <div class="dataCeldas" id="HinterPg" >
                            <input class="inputs" type="text" name="HinterPg"
                            value="<?php echo $arrayDataSQL_H[12]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MinterPg" >
                            <input class="inputs" type="text" name="MinterPg"
                            value="<?php echo $arrayDataSQL_M[12]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TinterPg" >
                            <input class="inputs" type="text" name="TinterPg" readonly required>
                        </div>



                        <!-- Datos avanzado-->



                        <div class="dataCeldas" id="HavanzMs" >
                            <input class="inputs" type="text" name="HavanzMs"
                            value="<?php echo $arrayDataSQL_H[11]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MavanzMs" >
                            <input class="inputs" type="text" name="MavanzMs"
                            value="<?php echo $arrayDataSQL_M[11]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TavanzMs" >
                            <input class="inputs" type="text" name="TavanzMs" readonly required>
                        </div>
                        <div class="dataCeldas" id="HavanzSup" >
                            <input class="inputs" type="text" name="HavanzSup"
                            value="<?php echo $arrayDataSQL_H[10]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MavanzSup" >
                            <input class="inputs" type="text" name="MavanzSup"
                            value="<?php echo $arrayDataSQL_M[10]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TavanzSup" >
                            <input class="inputs" type="text" name="TavanzSup" readonly required>
                        </div>
                        <div class="dataCeldas" id="HavanzPos" >
                            <input class="inputs" type="text" name="HavanzPos"
                            value="<?php echo $arrayDataSQL_H[9]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MavanzPos" >
                            <input class="inputs" type="text" name="MavanzPos"
                            value="<?php echo $arrayDataSQL_M[9]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TavanzPos" >
                            <input class="inputs" type="text" name="TavanzPos" readonly required>
                        </div>
                        <div class="dataCeldas" id="HavanzEgr" >
                            <input class="inputs" type="text" name="HavanzEgr"
                            value="<?php echo $arrayDataSQL_H[8]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MavanzEgr" >
                            <input class="inputs" type="text" name="MavanzEgr"
                            value="<?php echo $arrayDataSQL_M[8]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TavanzEgr" >
                            <input class="inputs" type="text" name="TavanzEgr" readonly required>
                        </div>
                        <div class="dataCeldas" id="HavanzEmp" >
                            <input class="inputs" type="text" name="HavanzEmp"
                            value="<?php echo $arrayDataSQL_H[7]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MavanzEmp" >
                            <input class="inputs" type="text" name="MavanzEmp"
                            value="<?php echo $arrayDataSQL_M[7]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TavanzEmp" >
                            <input class="inputs" type="text" name="TavanzEmp" readonly required>
                        </div>
                        <div class="dataCeldas" id="HavanzPg" >
                            <input class="inputs" type="text" name="HavanzPg"
                            value="<?php echo $arrayDataSQL_H[6]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MavanzPg" >
                            <input class="inputs" type="text" name="MavanzPg"
                            value="<?php echo $arrayDataSQL_M[6]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TavanzPg" >
                            <input class="inputs" type="text" name="TavanzPg" readonly required>
                        </div>



                        <!-- Datos superior-->



                        <div class="dataCeldas" id="HsupMs" >
                            <input class="inputs" type="text" name="HsupMs"
                            value="<?php echo $arrayDataSQL_H[5]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MsupMs" >
                            <input class="inputs" type="text" name="MsupMs"
                            value="<?php echo $arrayDataSQL_M[5]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TsupMs" >
                            <input class="inputs" type="text" name="TsupMs" readonly required>
                        </div>
                        <div class="dataCeldas" id="HsupSup" >
                            <input class="inputs" type="text" name="HsupSup"
                            value="<?php echo $arrayDataSQL_H[4]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MsupSup" >
                            <input class="inputs" type="text" name="MsupSup"
                            value="<?php echo $arrayDataSQL_M[4]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TsupSup" >
                            <input class="inputs" type="text" name="TsupSup" readonly required>
                        </div>
                        <div class="dataCeldas" id="HsupPos" >
                            <input class="inputs" type="text" name="HsupPos"
                            value="<?php echo $arrayDataSQL_H[3]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MsupPos" >
                            <input class="inputs" type="text" name="MsupPos"
                            value="<?php echo $arrayDataSQL_M[3]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TsupPos" >
                            <input class="inputs" type="text" name="TsupPos" readonly required>
                        </div>
                        <div class="dataCeldas" id="HsupEgr" >
                            <input class="inputs" type="text" name="HsupEgr"
                            value="<?php echo $arrayDataSQL_H[2]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MsupEgr" >
                            <input class="inputs" type="text" name="MsupEgr"
                            value="<?php echo $arrayDataSQL_M[2]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TsupEgr" >
                            <input class="inputs" type="text" name="TsupEgr" readonly required>
                        </div>
                        <div class="dataCeldas" id="HsupEmp" >
                            <input class="inputs" type="text" name="HsupEmp"
                            value="<?php echo $arrayDataSQL_H[1]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MsupEmp" >
                            <input class="inputs" type="text" name="MsupEmp"
                            value="<?php echo $arrayDataSQL_M[1]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TsupEmp" >
                            <input class="inputs" type="text" name="TsupEmp" readonly required>
                        </div>
                        <div class="dataCeldas" id="HsupPg" >
                            <input class="inputs" type="text" name="HsupPg"
                            value="<?php echo $arrayDataSQL_H[0]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="MsupPg" >
                            <input class="inputs" type="text" name="MsupPg"
                            value="<?php echo $arrayDataSQL_M[0]; ?>"
                            />
                        </div>
                        <div class="dataCeldas" id="TsupPg" >
                            <input class="inputs" type="text" name="TsupPg" readonly required>
                        </div>



                        <!-- Datos totales-->



                        <div class="dataCeldas" id="HtotalMs" >
                            <input class="inputs" type="text" name="HtotalMs" readonly required>
                        </div>
                        <div class="dataCeldas" id="MtotalMs" >
                            <input class="inputs" type="text" name="MtotalMs" readonly required>
                        </div>
                        <div class="dataCeldas" id="TtotalMs" >
                            <input class="inputs" type="text" name="TtotalMs" readonly required>
                        </div>
                        <div class="dataCeldas" id="HtotalSup" >
                            <input class="inputs" type="text" name="HtotalSup" readonly required>
                        </div>
                        <div class="dataCeldas" id="MtotalSup" >
                            <input class="inputs" type="text" name="MtotalSup" readonly required>
                        </div>
                        <div class="dataCeldas" id="TtotalSup" >
                            <input class="inputs" type="text" name="TtotalSup" readonly required>
                        </div>
                        <div class="dataCeldas" id="HtotalPos" >
                            <input class="inputs" type="text" name="HtotalPos" readonly required>
                        </div>
                        <div class="dataCeldas" id="MtotalPos" >
                            <input class="inputs" type="text" name="MtotalPos" readonly required>
                        </div>
                        <div class="dataCeldas" id="TtotalPos" >
                            <input class="inputs" type="text" name="TtotalPos" readonly required>
                        </div>
                        <div class="dataCeldas" id="HtotalEgr" >
                            <input class="inputs" type="text" name="HtotalEgr" readonly required>
                        </div>
                        <div class="dataCeldas" id="MtotalEgr" >
                            <input class="inputs" type="text" name="MtotalEgr" readonly required>
                        </div>
                        <div class="dataCeldas" id="TtotalEgr" >
                            <input class="inputs" type="text" name="TtotalEgr" readonly required>
                        </div>
                        <div class="dataCeldas" id="HtotalEmp" >
                            <input class="inputs" type="text" name="HtotalEmp" readonly required>
                        </div>
                        <div class="dataCeldas" id="MtotalEmp" >
                            <input class="inputs" type="text" name="MtotalEmp" readonly required>
                        </div>
                        <div class="dataCeldas" id="TtotalEmp" >
                            <input class="inputs" type="text" name="TtotalEmp" readonly required>
                        </div>
                        <div class="dataCeldas" id="HtotalPg" >
                            <input class="inputs" type="text" name="HtotalPg" readonly required>
                        </div>
                        <div class="dataCeldas" id="MtotalPg" >
                            <input class="inputs" type="text" name="MtotalPg" readonly required>
                        </div>
                        <div class="dataCeldas" id="TtotalPg" >
                            <input class="inputs" type="text" name="TtotalPg" readonly required>
                        </div>

                        

                    </div>
                    <div id="footerData">
                        <div id="contVigencia">
                        <label>Vigencia</label>
                        <input type="date" name="fechaVigencia"/>
                        <input id="contIdiomaPost" type="hidden" name="idioma"/>
                        <input id="idContUnidadAca" type="hidden" name="unidadAcademica" value="<?php echo $nombre_usuario; ?>"/>
                        </div>
                        <input id="btnGuardar" type="submit" value="Guardar"/>
                        <input id="btnEnviar" type="submit" value="Enviar"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("formIdioma").addEventListener("submit", function(event) {
            event.preventDefault(); // Evita que el formulario se envíe

            var selectedOption = document.getElementById("selectCont").value;
            document.getElementById("contIdiomaSelect").innerText = selectedOption; 
            document.getElementById("contIdiomaPost").value = selectedOption; 
            document.getElementById("dtPidioma").value = selectedOption; 
        });
    });

</script>

</html>