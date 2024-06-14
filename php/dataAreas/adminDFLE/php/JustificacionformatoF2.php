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

    
?>
    <h1>UNIDADES ACADÉMICAS QUE CUENTAN CON CELEX</h1>
    <section class="flex-container">
            <div class="Selector">
                <label id="IdiomLabel" for="SelectorNivel">Niveles</label>
                <select id="SelectorIdioma" name="opcNivel" required>
                    <option value=" " disabled selected> Selecciona una Opción</option>
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
            <div class="Tablas">
                <div class="TablaP">
                    <div id="Header"><div class="TH">Nivel</div></div>
                    <div id="Header2"><div class="TH">Periodo A</div></div>
                    <div id="Header3"><div class="TH">Periodo B</div></div>
                    <div class="V1" id="NivelSelec"><div class="TH">AA</div></div>
                    <div class="V2" id="UAPA"><div class="TH">valor</div></div>
                    <div class="V3" id="UAPB"><div class="TH">valor</div></div>
                </div>
    
                <div class="TablaVP">
                    <div id="HeaderVP"><div class="TH">Variación Porcentual</div></div>
                    <div class="VP" id="VP"><div class="TH">valor</div></div>
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