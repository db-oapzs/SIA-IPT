<?php
require '../../../vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');
use PhpOffice\PhpSpreadsheet\IOFactory;

date_default_timezone_set('America/Mexico_City');
include '../../../conexion.php';
include '../../../trimestre.php';

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
$cenlex = array();
$c1 = 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD ZACATENCO';
$c2 = 'CENTRO DE LENGUAS EXTRANJERAS UNIDAD SANTO TOMÁS';
$sqlCelex = '
    SELECT Desc_Nombre_Unidad_Academica 
    FROM Unidades_Academicas 
    WHERE 
    Desc_Nombre_Unidad_Academica = ?
    OR
    Desc_Nombre_Unidad_Academica = ?
';

$params = [
    $c1,
    $c2
];
$stmt = sqlsrv_prepare($connection, $sqlCelex, $params);

if ($stmt === false) {
    echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
} else {
    $result = sqlsrv_execute($stmt);
    if ($result === false) {
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            //echo "<br>";
            //print_r($row);
            $cenlex[] = $row['Desc_Nombre_Unidad_Academica'];
        }
    }
    sqlsrv_free_stmt($stmt);
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/iconos.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/CargActiv.css">
    <link rel="stylesheet" href="../styles/Home.css">
    <script src="../scripts/script.js" async defer></script>
    <script src="../scripts/scriptRecu.js" async defer></script>
    <script src="../scripts/selectIdioma.js" async defer></script>
    <script src="../scripts/BlockABC.js" async defer></script>
    <script src="../scripts/GentTabla.js" async defer></script>
    <style type="text/css">
        .btnFilasBTN {
            width: 200px;
            height: 60px;
            font-size: 15px;
            font-weight: 500;
            font-family: "Montserrat";
            text-transform: capitalize;
            letter-spacing: 1px;
            background-color: #6c1d45;
            color: #fff;
            padding-left: 10px;
            padding-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: 100ms all linear;
        }

        .btnFilasBTN:hover {
            background-color: #894668;
            transform: scale(1.02);
        }

        .selectsFr {
            width: 100%;
            height: 100% !important;
            border: 0;
        }
    </style>
</head>

<body>
    <?php
    //include 'menu.php';
    include 'menuFinal.php';
    ?>
    <div id="contpadre">
        <form id="conthijo" method="POST" action="">
            <div id="cont_9"></div>
            <div id="cont_10"><span id="resultado"></span></div>
            <div id="cont_11">
                <select id="AgregarIdioma" style="
                width: 100%;
                height: 100%;
                font-size: 15px;
                font-weight: 500;
                text-align: center;
                text-transform: capitalize;
                font-family: 'Montserrat' !important;
                letter-spacing: 1px;
                background-color: #6c1d45;
                color:#fff;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
                transition: 100ms all linear;
                " name="selectIdioma">
                    <option disabled selected>Seleccionar Trimestre</option>
                    <option value="TOTAL TRIM 2">Enero-Marzo</option>
                    <option value="TOTAL TRIM 3">Abril-Junio</option>
                    <option value="TOTAL TRIM 4">Julio-Septiembre</option>
                    <option value="TOTAL ACUMULADO">Octubre-Dciembre</option>
                </select>
            </div>
            <div id="cont_12"> tabla</div>
            <div id="contTabla">
                <div id="contenedorTabla">
                    <table id="miTabla">
                        <thead>
                            <tr>
                                <th>Tipo de acción</th>
                                <th>Acciones de Fromación</th>
                                <th>MODALIDAD ESC, NESC, MIXTA</th>
                                <th>IDIOMA QUE FORTALECE</th>
                                <th>CENLEX</th>
                                <th>HOMBRES<br><br>0</th>
                                <th>MUJERES<br><br>0</th>
                                <th>TOTAL<br><br>0</th>
                            </tr>
                            <!--<tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Suma</th>
                        <th>Suma</th>
                        <th>Suma</th>
                    </tr>-->
                        </thead>
                        <tbody>
                            <!-- Filas por defecto -->
                            <tr>
                                <td class="celda"><textarea type="text" name="dato1[]" oninput="ajustarAltura(this)"
                                        required></textarea></td>
                                <td class="celda"><textarea type="text" name="dato2[]" oninput="ajustarAltura(this)"
                                        required></textarea></td>

                                <td class="celda">
                                    <select class="selectsFr" id="SelectorIdioma" name="dato3[]"
                                        oninput="ajustarAltura(this)" required>
                                        <option disabled selected>Selecciona una lengua</option>
                                        <option value='ESC'>ESC</option>
                                        <option value='NESC'>NESC</option>
                                        <option value='MIXTA'>MIXTA</option>
                                    </select>
                                </td>

                                <td class="celda">
                                    <select class="selectsFr" id="SelectorIdioma" name="dato4[]"
                                        oninput="ajustarAltura(this)" required>
                                        <option disabled selected>Selecciona una lengua</option>
                                        <?php
                                        foreach ($idiomas as $idioma) {
                                            echo "<option value='$idioma'>$idioma</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="celda">
                                    <select class="selectsFr" id="SelectorIdioma" name="dato5[]"
                                        oninput="ajustarAltura(this)" required>
                                        <option disabled selected>Selecciona una lengua</option>
                                        <?php
                                        foreach ($cenlex as $cenle) {
                                            echo "<option value='$cenle'>$cenle</option>";
                                        }
                                        ?>
                                    </select>
                                </td>

                                <td class="celda"><textarea type="text" name="dato6[]" oninput="ajustarAltura(this)"
                                        required></textarea></td>
                                <td class="celda"><textarea type="text" name="dato7[]" oninput="ajustarAltura(this)"
                                        required></textarea></td>
                                <td class="celda"><textarea type="text" name="dato8[]" oninput="ajustarAltura(this)"
                                        required></textarea></td>
                            </tr>
                            <!-- Fin de filas por defecto -->
                        </tbody>
                    </table>

                </div>
            </div>
            <div id="cont_14"> <input id="btnGrd" align="center" type="submit" value="Guardar" /></div>
            <div id="cont_15"> <input id="btnEnv" align="center" type="submit" value="Enviar" /></div>
        </form>
        <div id="cont_16"> <input class="btnFilasBTN" align="center" type="submit" value="Agregar Fila"
                onclick="agregarFila()" /></div>





</body>
<script type="text/javascript">
    document.getElementById('AgregarIdioma').addEventListener('change', function () {
        var resultado = document.getElementById('resultado');
        resultado.textContent = this.options[this.selectedIndex].text;
    });

    document.getElementById('AgregarIdioma').addEventListener('change', function () {
        var resultado = document.getElementById('resultado');
        resultado.textContent = this.options[this.selectedIndex].text;
    });



    let btnGuardar = document.getElementById("btnEnv");

    btnGuardar.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón guardar.");
        let form = document.getElementById("conthijo");
        if (form) {
            form.action = "enviarDataF12.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = document.getElementById("conthijo");
            console.log("Nuevo action del formulario:", form2);
        }
    });

    btnGuardar.addEventListener('mouseout', () => {
        let form = document.getElementById("conthijo");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = document.getElementById("conthijo");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    let btnEnviar = document.getElementById("btnGrd");

    btnEnviar.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón enviar.");
        let form = document.getElementById("conthijo");
        if (form) {
            form.action = "guardarF12.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = document.getElementById("conthijo");
            console.log("Nuevo action del formulario:", form2);
        }
    });

    btnEnviar.addEventListener('mouseout', () => {
        let form = document.getElementById("conthijo");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = document.getElementById("conthijo   ");
            console.log("Nuevo action del formulario:", form2);
        }
    });



    function agregarFila() {
        var tabla = document.getElementById("miTabla");
        tabla.getElementsByTagName('tbody')[0];
        var fila = tabla.insertRow();
        var celda1 = fila.insertCell(0);
        var celda2 = fila.insertCell(1);
        var celda3 = fila.insertCell(2);
        var celda4 = fila.insertCell(3);
        var celda5 = fila.insertCell(4);
        var celda6 = fila.insertCell(5);
        var celda7 = fila.insertCell(6);
        var celda8 = fila.insertCell(7);
        celda1.classList.add("celda");
        celda2.classList.add("celda");
        celda3.classList.add("celda");
        celda4.classList.add("celda");
        celda5.classList.add("celda");
        celda6.classList.add("celda");
        celda7.classList.add("celda");
        celda8.classList.add("celda");
        celda1.innerHTML = '<textarea type="text" name="dato1[]" oninput="ajustarAltura(this)" required></textarea>';
        celda2.innerHTML = '<textarea type="text" name="dato2[]" oninput="ajustarAltura(this)" required></textarea>';

        celda3.innerHTML = `
            <select class="selectsFr" id="SelectorIdioma" name="dato3[]"  oninput="ajustarAltura(this)" required>
                <option disabled selected>Selecciona una lengua</option>
                <option value='ESC'>ESC</option>
                <option value='NESC'>NESC</option>
                <option value='MIXTA'>MIXTA</option>
            </select>
                    `;
        celda4.innerHTML = `
        <select class="selectsFr" id="SelectorIdioma" name="dato4[]" oninput="ajustarAltura(this)" required>
            <option disabled selected>Selecciona una lengua</option>
            <?php
            foreach ($idiomas as $idioma) {
                echo "<option value='" . $idioma . "'>" . $idioma . "</option>";
            }
            ?>
        </select>
    `;
    celda5.innerHTML = `
        <select class="selectsFr" id="SelectorIdioma" name="dato5[]" oninput="ajustarAltura(this)" required>
            <option disabled selected>Selecciona una lengua</option>
                <?php
                foreach ($cenlex as $cenle) {
                    echo "<option value='" . $cenle . "'>" . $cenle . "</option>";
                }
                ?>
            </select>
        `;
    
        celda6.innerHTML = '<textarea type="text" name="dato6[]" oninput="ajustarAltura(this)" required></textarea>';
    
        celda7.innerHTML = '<textarea type="text" name="dato7[]" oninput="ajustarAltura(this)" required></textarea>';
        celda8.innerHTML = '<textarea type="text" name="dato8[]" oninput="ajustarAltura(this)" required></textarea>';
        // Insertar el botón después de la tabla
        var dta1 = document.getElementById("contenedorTabla");
        dta1.insertAdjacentElement("afterend", document.getElementById("btnAgregarFila"));
    }
    function ajustarAltura(input) {
        var fila = input.parentNode.parentNode;
        var celda = input.parentNode;
        fila.style.height = "auto";
        celda.style.height = "auto";
        fila.style.height = fila.scrollHeight + "px";
        celda.style.height = fila.scrollHeight + "px";
    }
    window.onload = function () {
        var textAreas = document.getElementsByTagName('textarea');
        for (var i = 0; i < textAreas.length; i++) {
            textAreas[i].addEventListener('input', function () {
                var lines = this.value.split('\n').length;
                if (lines > 5) {
                this.style.overflowY = 'scroll';
            }
         
   else {
                this.style.overflowY = 'hidden';
            }
        });
    }
};


</script>
</html>