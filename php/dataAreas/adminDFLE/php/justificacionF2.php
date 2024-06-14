
<?php
    require '../../../vendor/autoload.php';
    header('Content-Type: text/html; charset=utf-8');
    use PhpOffice\PhpSpreadsheet\IOFactory;

    date_default_timezone_set('America/Mexico_City');
    include '../../../conexion.php';

    //include 'menu.php';
    include 'menuFinal.php';


    $queryNiveles = '
        SELECT Desc_TipoUnidadAcademica FROM TipoUnidadAcademica
    ';
    $unidades = array();
    $stmt = sqlsrv_prepare($connection, $queryNiveles);
    if ($stmt === false) {
        // Manejar el error de la consulta preparada
        echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        // Ejecutar la consulta
        $result = sqlsrv_execute($stmt);

        if ($result === false) {
            // Manejar el error de la ejecución de la consulta
            echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
        } else {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $unidades[] = $row;
            }
        }
    }
    $anio = ((int)date('Y'));
    $anioAct = (string)("%".($anio)."%");
    $anioPas = (string)("%".($anio-1)."%");
    $nivelesData = [
        'NIVEL MEDIO SUPERIOR',
        'NIVEL SUPERIOR',
        'CENTROS DE INVESTIGACIÓN',
        'CENTROS VINCULACIÓN Y DESARROLLO REGIONAL'
    ];
    function dataAtuales($connection,$params,&$array){
        $queryCuentasActuales = '
            SELECT COUNT(DISTINCT UA.Desc_Nombre_Unidad_Academica) AS total_unidades
            FROM Cantidades_Alumnos CA
            LEFT JOIN Unidades_Academicas UA ON CA.id_UnidadAcademica = UA.ID_UnidadAcademica
            LEFT JOIN TipoUnidadAcademica TP ON TP.ID_TipoUnidadAcademica = UA.id_TipoUnidadAcademica
            WHERE Fecha LIKE ? AND UA.id_TipoUnidadAcademica = (
                SELECT ID_TipoUnidadAcademica 
                FROM TipoUnidadAcademica 
                WHERE Desc_TipoUnidadAcademica = ?
        )';
        $stmt = sqlsrv_prepare($connection, $queryCuentasActuales,$params);
        if ($stmt === false) {
            // Manejar el error de la consulta preparada
            echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
        } else {
            // Ejecutar la consulta
            $result = sqlsrv_execute($stmt);
    
            if ($result === false) {
                // Manejar el error de la ejecución de la consulta
                echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
            } else {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $array[] = $row;
                }
            }
        }
    }
    function dataPasados($connection,$params,&$array){
        $queryCuentasPasadoss = '
            SELECT COUNT(DISTINCT UA.Desc_Nombre_Unidad_Academica) AS total_unidades
            FROM Cantidades_Alumnos CA
            LEFT JOIN Unidades_Academicas UA ON CA.id_UnidadAcademica = UA.ID_UnidadAcademica
            LEFT JOIN TipoUnidadAcademica TP ON TP.ID_TipoUnidadAcademica = UA.id_TipoUnidadAcademica
            WHERE Fecha LIKE ? AND UA.id_TipoUnidadAcademica = (
                SELECT ID_TipoUnidadAcademica 
                FROM TipoUnidadAcademica 
                WHERE Desc_TipoUnidadAcademica = ?
        )';
        
        $stmt = sqlsrv_prepare($connection, $queryCuentasPasadoss,$params);
        if ($stmt === false) {
            // Manejar el error de la consulta preparada
            echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
        } else {
            // Ejecutar la consulta
            $result = sqlsrv_execute($stmt);
    
            if ($result === false) {
                // Manejar el error de la ejecución de la consulta
                echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
            } else {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $array[] = $row;
                }
            }
        }
    }

    $dtaCuentaMSPas = array();
    for($i = 0 ; $i < 4 ; $i++){
        $params = [
            $anioPas,
            $nivelesData[$i]
        ];   
        dataAtuales($connection,$params,$dtaCuentaMSPas);
    }
    
    $dtaCuentaMSAc = array();
    for($i = 0 ; $i < 4 ; $i++){
        $params = [
            $anioAct,
            $nivelesData[$i]
        ];   
        dataAtuales($connection,$params,$dtaCuentaMSAc);
    }
    
    $datoVp0 = (int)$dtaCuentaMSPas[0]['total_unidades'] !== 0 ? 
        (string)((int)(100 * ((int)$dtaCuentaMSAc[0]['total_unidades'] / (int)$dtaCuentaMSPas[0]['total_unidades'])).'%') : 0;

    $datoVp1 = (int)$dtaCuentaMSPas[1]['total_unidades'] !== 0 ? 
        (string)((int)(100 * ((int)$dtaCuentaMSAc[1]['total_unidades'] / (int)$dtaCuentaMSPas[1]['total_unidades'])).'%')  : 0;

    $datoVp2 = (int)$dtaCuentaMSPas[2]['total_unidades'] !== 0 ? 
        (string)((int)(100 * ((int)$dtaCuentaMSAc[2]['total_unidades'] / (int)$dtaCuentaMSPas[2]['total_unidades'])).'%')  : 0;

    $datoVp3 = (int)$dtaCuentaMSPas[3]['total_unidades'] !== 0 ? 
        (string)((int)(100 * ((int)$dtaCuentaMSAc[3]['total_unidades'] / (int)$dtaCuentaMSPas[3]['total_unidades'])).'%')  : 0;


?>
    <h1>UNIDADES ACADÉMICAS QUE CUENTAN CON CELEX</h1>
    <section class="flex-containerF2">
            <div class="SelectorF2">
                <label id="IdiomLabelF2" for="SelectorNivel">Niveles</label>
                <select id="SelectorNivelF2" name="opcNivel" required>
                    <option disabled selected>Selecciona un Nivel</option>
                    <?php 
                        foreach ($unidades as $unidade) {
                            $unidad = $unidade['Desc_TipoUnidadAcademica'];
                            if($unidad != 'CENTRO DE LENGUAS EXTRANJERAS'){
                                echo "<option  value=\"$unidad\">$unidad</option>";
                            }
                        }
                    ?>
                </select>
                
            </div>
            <div class="TablasF2">
                <div class="TablaPF2">
                    <div id="HeaderF2"><div class="THF2">Nivel</div></div>
                    <div id="Header2F2"><div class="THF2"><?php echo 'ENERO - DICIEMBRE '.(string)((int)date('Y')-1)?></div></div>
                    <div id="Header3F2"><div class="THF2"><?php echo 'ENERO - DICIEMBRE '.(string)(date('Y'))?></div></div>
                    <div class="V1F2" id="NivelSelecF2"><div id="nivelSSelecT" class="THF2">Selecciona un Nivel</div></div>
                    <div class="V2F2" id="UAPAF2"><div id="contPeriodoPas" class="THF2">0</div></div>
                    <div class="V3F2" id="UAPBF2"><div id="contPeriodoAct" class="THF2">0</div></div>
                </div>
    
                <div class="TablaVPF2">
                    <div id="HeaderVPF2"><div class="THF2">Variación Porcentual</div></div>
                    <div class="VPF2" id="VPF2"><div id="contPeriodoVaps" class="THF2">0%</div></div>
                </div>
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
    
    const selectIdioma = document.getElementById('SelectorNivelF2');
    const idioma = document.getElementById('idioma');
    const TextInput = document.getElementById('TextInput');
    const nivelSSelecT = document.getElementById('nivelSSelecT');
    const contPeriodoPas = document.getElementById('contPeriodoPas');
    const contPeriodoAct = document.getElementById('contPeriodoAct');
    const contPeriodoVaps = document.getElementById('contPeriodoVaps');

    // Agregar un event listener para el evento 'change'
    selectIdioma.addEventListener('change', () => {
        // Obtener el valor seleccionado del select
        const idiomaSeleccionado = selectIdioma.value;
        
        // Verificar si se ha seleccionado un idioma válido
        if (idiomaSeleccionado !== "") {
            // Se ha seleccionado un idioma, puedes realizar acciones aquí
            console.log("Se ha seleccionado el idioma: " + idiomaSeleccionado);
            idioma.value = idiomaSeleccionado;
            nivelSSelecT.innerHTML = idiomaSeleccionado;
            TextInput.removeAttribute('readonly');
            if(idiomaSeleccionado == 'NIVEL MEDIO SUPERIOR'){
                contPeriodoPas.innerHTML = <?php echo $dtaCuentaMSPas[0]['total_unidades'] ?>;
                contPeriodoAct.innerHTML = <?php echo $dtaCuentaMSAc[0]['total_unidades'] ?>;
                contPeriodoVaps.innerHTML = '<?php echo $datoVp0 ?>';
            }else if(idiomaSeleccionado == 'NIVEL SUPERIOR'){
                contPeriodoPas.innerHTML = <?php echo $dtaCuentaMSPas[1]['total_unidades'] ?>;
                contPeriodoAct.innerHTML = <?php echo $dtaCuentaMSAc[1]['total_unidades'] ?>;
                contPeriodoVaps.innerHTML = '<?php echo $datoVp1 ?>';
            }else if(idiomaSeleccionado == 'CENTROS DE INVESTIGACIÓN'){
                contPeriodoPas.innerHTML = <?php echo $dtaCuentaMSPas[2]['total_unidades'] ?>;
                contPeriodoAct.innerHTML = <?php echo $dtaCuentaMSAc[2]['total_unidades'] ?>;
                contPeriodoVaps.innerHTML = '<?php echo $datoVp2 ?>';
            }else if(idiomaSeleccionado == 'CENTROS VINCULACIÓN Y DESARROLLO REGIONAL'){
                contPeriodoPas.innerHTML = <?php echo $dtaCuentaMSPas[3]['total_unidades'] ?>;
                contPeriodoAct.innerHTML = <?php echo $dtaCuentaMSAc[3]['total_unidades'] ?>;
                contPeriodoVaps.innerHTML = '<?php echo $datoVp3 ?>';
            }else{
                contPeriodoPas.innerHTML = '0';
                contPeriodoAct.innerHTML = '0';
            }

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
            form.action = "enviarDataF2.php"; // Reemplaza "nueva_url" con la URL deseada
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
            form.action = "guardarDataF2.php"; // Reemplaza "nueva_url" con la URL deseada
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