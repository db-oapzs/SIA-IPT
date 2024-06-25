<!DOCTYPE html>
<html>
<?php
    require '../../../vendor/autoload.php';
    header('Content-Type: text/html; charset=utf-8');
    use PhpOffice\PhpSpreadsheet\IOFactory;

    date_default_timezone_set('America/Mexico_City');
    include '../../../conexion.php';
    include '../../../trimestre.php';
    $rango_trimestre = obtenerRangoMesesTrimestre();
    $metas = [1,2,3,4,5];
    $numeroHojas = 0;

    //!------------------------------------------------------------------------
    $Indicador_CVE = array();
    $Eje_Fundamental_Transversal_Nombre = array();
    $Proyecto_CVE = array();
    $Proyecto_Nombre = array();
    $Accion_Descripcion = array();
    $Indicador_NombreDelIndicador = array();
    $Indicador_MetodoDeCalculo = array();
    $Meta_2024_Meta = array();
    $Area_Operativa_AreaOperativa = array();
    $Desc_Nombre_Usuario = array();
    $Desc_Cargo = array();
    $Desc_Correo_Electronico = array();
    $Desc_Numero_Telefono = array();
    $unidadAc = 'DIRECCIÓN DE FORMACIÓN DE LENGUAS EXTRANJERAS';
    //!------------------------------------------------------------------------

    $queryDataFAE = '
    SELECT MP.Indicador_CVE, 
    MP.Eje_Fundamental_Transversal_Nombre, 
    MP.Proyecto_CVE, MP.Proyecto_Nombre, 
    MP.Accion_Descripcion, 
    MP.Indicador_NombreDelIndicador, 
    MP.Indicador_MetodoDeCalculo, 
    MP.Meta_2024_Meta,
    MP.Area_Operativa_AreaOperativa,
    NU.Desc_Nombre_Usuario,
    C.Desc_Cargo,
    CE.Desc_Correo_Electronico,
    NT.Desc_Numero_Telefono
    FROM MatrizPIMP MP, Usuarios_General UG
    LEFT JOIN
    Nombre_Usuarios NU ON UG.id_NombreUsuario = NU.ID_NombreUsuario
    LEFT JOIN 
    Cargos C ON UG.id_Cargo = C.ID_Cargo
    LEFT JOIN
    Correo_Electronico CE ON UG.id_CorreoElectronico = CE.ID_CorreoElectronico
    LEFT JOIN
    Numero_Telefono NT ON UG.id_NumeroTelefono = NT.ID_NumeroTelefono
    WHERE 
    Indicador_NivelDelIndicador = ? 
    AND 
    Area_Operativa_AreaOperativa = ? 
    AND UG.id_UnidadAcademica = (
        SELECT ID_UnidadAcademica 
        FROM Unidades_Academicas 
        Where Siglas = ?)
    ';
    $PIMP = 'PIMP';
    $DFLE = 'DFLE';
    $DGA = 'DGA';
    $dataFAE = array();
    $params = array($PIMP, $DFLE, $DGA);
    $stmt = sqlsrv_prepare($connection, $queryDataFAE, $params);

    if ($stmt === false) {
        echo "Error al preparar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
    } else {
        $result = sqlsrv_execute($stmt);
        if ($result === false) {
            echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true) . "\n";
        } else {
            // Mostrar los resultados
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $dataFAE[] = $row;
                $Indicador_CVE[] = $row['Indicador_CVE'];
                $Eje_Fundamental_Transversal_Nombre[] = $row['Eje_Fundamental_Transversal_Nombre'];
                $Proyecto_CVE[] = $row['Proyecto_CVE'];
                $Proyecto_Nombre[] =$row['Proyecto_Nombre'];
                $Accion_Descripcion[] = $row['Accion_Descripcion'];
                $Indicador_NombreDelIndicador[] = $row['Indicador_NombreDelIndicador'];
                $Indicador_MetodoDeCalculo[] = $row['Indicador_MetodoDeCalculo'];
                $Meta_2024_Meta[] = $row['Meta_2024_Meta'];
                $Area_Operativa_AreaOperativa[] = $row['Area_Operativa_AreaOperativa'];
                $Desc_Nombre_Usuario [] =$row['Desc_Nombre_Usuario'];
                $Desc_Cargo[] = $row['Desc_Cargo'];
                $Desc_Correo_Electronico[] = $row['Desc_Correo_Electronico'];
                $Desc_Numero_Telefono[] = $row['Desc_Numero_Telefono'];
            }
        }
        sqlsrv_free_stmt($stmt);

    }
    
    $numeroHojas = count($dataFAE);

    //var_dump($dataFAE);
    /*
    foreach ($dataFAE as $key => $val) {
        echo "Registro " . ($key + 1) . ":<br>";
        foreach ($val as $subKey => $subVal) {
            echo $subKey . ": " . $subVal . "<br>";
        }
        echo "<br>";
    }
    */
    /*
    var_dump($Indicador_CVE);
    echo "<br>";
    var_dump($Eje_Fundamental_Transversal_Nombre);
    echo "<br>";
    var_dump($Proyecto_CVE);
    echo "<br>";
    var_dump($Proyecto_Nombre);
    echo "<br>";
    var_dump($Accion_Descripcion);
    echo "<br>";
    var_dump($Indicador_NombreDelIndicador);
    echo "<br>";
    var_dump($Indicador_MetodoDeCalculo);
    echo "<br>";
    var_dump($Meta_2024_Meta);
    echo "<br>";
    var_dump($Area_Operativa_AreaOperativa);
    echo "<br>";
    var_dump($Desc_Nombre_Usuario);
    echo "<br>";
    var_dump($Desc_Cargo);
    echo "<br>";
    var_dump($Desc_Correo_Electronico);
    echo "<br>";
    var_dump($Desc_Numero_Telefono);
    */
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/iconos.css">
    <link rel="stylesheet" href="../styles/styless.css">
    <link rel="stylesheet" href="../styles/faeData.css">
    <link rel="stylesheet" href="../styles/stylesModalFAE.css">

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

    <link rel="icon" href="../../../../recursos/multimedia/Logos/SIA Logo.png" type="image/png">
    <script src="../scripts/jquery-3.7.1.min.js"></script>
    <script src="../scripts/scriptt.js" async defer></script>
    <link rel="stylesheet" href="../../../../scripts/jqueryUI/jquery-ui.css">
    <script src="../../../../scripts/jqueryUI/jquery-ui.js"></script>
    <script src="../scripts/ScriptModalElimFAE.js"></script>
    <script src="../scripts/faeData.js"></script>
    <style>
        #botonera{
            width:50px;
            height: 330px;
            background: #DDDDDD;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            position: fixed;
            top:25%;
            overflow: hidden;
            border-radius: 0px 5px 5px 0px;
            list-style: none;
            box-shadow: 2px 0px 4px 0px rgba(0,0,0,0.25);
        }
        #botonera > li{
            width: 50px;
            height: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: 100ms all linear;
        }
        #botonera > li:hover{
            background: #682444;
            cursor:pointer;
            color:#ccc;
            transform:scale(1.1);
        }
        .dtaGen{
            overflow: hidden !important;
        }
        .dtaGno{
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            flex-wrap:wrap;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
            overflow-x: hidden;
            overflow-y: sroll;
        }
        .resizable {
            position: relative;
            display: inline-block;
        }
        .resizable img, .resizable table {
            display: block;
            width: 100%;
            height: 100%;
        }


        .contItems {
            width: 100px;
            height: 100px;
            display: flex;
            background: #EEEDEB;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            border-radius: 5px;
            overflow: hidden;
            margin: 10px;
        }
        .contItems > .contElim {
            width: 100%;
            height: 15px;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            align-items: center;
            overflow: hidden;
        }
        .contItems > .contElim > .itemBTEL {
            width: 15px;
            height: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: 150ms all linear;
        }
        .contItems > .contElim > .itemBTEL:hover {
            cursor: pointer;
            background: #ccc;
        }
        .contItems > .conMsjItm {
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            overflow: hidden;
            font-size: 100%;
        }
        .contItems > .conMsjItm > * {
            width: 100%;
            height: 100%;
            font-size: 100%;
        }
    </style>
</head>
<body>
    
    <div id="contFormTrans">
        <form id="formDataFAE" method="POST" action="">
            <h1>Datos Actuales</h1>

        </form>
    </div>
    <div id="contFormTrans_pas">
            <h1>Datos Pasados</h1>
        <form id="formDataFAE_pas" method="POST" action="FAEdataGuardaVariables.php">
        <nav class="navContHojaForm">
            <?php
                for($i = 0; $i < $numeroHojas ; $i++) {
                    echo '
                        <label name="V1">hoja : '.($i+1).' V1</label>
                        <input
                            id="intTrim1V1-'.($i).'"
                            type="text"
                            name="1erTrimV1[]"
                            value="0"
                            class="inputDTa"
                        />
                        <input
                            id="intTrim2V1-'.($i).'"
                            type="text"
                            name="2doTrimV1[]"
                            value="0"
                            class="inputDTa"
                        />
                        <input
                            id="intTrim3V1-'.($i).'"
                            type="text"
                            name="3erTrimV1[]"
                            value="0"
                            class="inputDTa"
                        />
                        <input
                            id="intTrim4V1-'.($i).'"
                            type="text"
                            name="4toTrimV1[]"
                            value="0"
                            class="inputDTa"
                        />
                    ';
                    echo '
                        <label name="V2">V2</label>
                        <input
                            id="intTrim1V2-'.($i).'"
                            type="text"
                            name="1erTrimV2[]"
                            value="0"
                            class="inputDTa"
                        />
                        <input
                            id="intTrim2V2-'.($i).'"
                            type="text"
                            name="2doTrimV2[]"
                            value="0"
                            class="inputDTa"
                        />
                        <input
                            id="intTrim3V2-'.($i).'"
                            type="text"
                            name="3erTrimV2[]"
                            value="0"
                            class="inputDTa"
                        />
                        <input
                            id="intTrim4V2-'.($i).'"
                            type="text"
                            name="4toTrimV2[]"
                            value="0"
                            class="inputDTa"
                        />
                    ';
                    echo "<br>";
                }
            ?>
                </nav>
            <input id="enviarFAEData" type="submit" value="Guardar FAE"/>
        </form>
    </div>

    <ul id="botonera">
        <li id="btnMH" title="Agrega Hojas al Ofició"><span id="icoMhojas" class="gg-file-add"></span></li>
        <!--
        <li id="btnArgHj" title="Recuperar Datos"><span id="icoDatos" class="gg-file-document"></span></li>
        -->
        <li id="btnMT" title="Agrega cuadro de Contenido"><span id="icoMTexto" class="gg-extension-add"></span></li>
        <li id="btnTxtC" title="Agrega cuadro de texto"><span id="icoCTexto" class="gg-format-text"></span></li>
        <li id="btnImp" title="Imprimir Documento"><span id="icoImprimir" class="gg-printer"></span></li>
        <li id="btnGuardar" title="Guardar FAE"><span id="icoGuardar" class="gg-folder-add"></span></li>
        <li id="btnarrow" title="Regresar"><span id="icoRegresar" class="gg-arrow-left-r"></span></li>
    </ul>
    <!-- ------------------- contenedor 2 --------------------------->
    <?php

        for($i = 0 ; $i < $numeroHojas ; $i++){

            echo'
                <div id="contpadre" class="contP-'.($i+1).' ">
                    <header id="cont-header">
                    <div id="logo-ipn">
                        <img src="../recursos/multimedia/img/logos/logo-poli.svg" alt="pruebas">
                    </div>
                    <div id="ipn-dii">
                            <p>instituto politécnico nacional</p>
                            <p>coordinación general de planeación</p>
                            <p>e información institucional</p>
                            <p>dirección de informacíon institucional</p>
                    </div>
                    <div id="fae-periodo">
                        <p>formatos de autoevaluación</p>
                        <p>periodo :<span> '.$rango_trimestre.'</span></p>
                    </div>
                    <div id="resumen-act">
                        <p>resumen de actividades, acciones relevantes, esfuerzos de superación y perspectivas</p>
                    </div>
                    <div id="data-fecha">
                        <p>página 1 de N</p>
                    </div>
                </header>
                <div id="conthijo">
                    <div id="cont-1">
                        <p>unidad responsable:</p>
                    </div>
                    <div id="cont-2">
                        <p>'.$unidadAc.'</p>
                    </div>
                    <div id="cont-3">
                    <p>'.$Eje_Fundamental_Transversal_Nombre[$i].'</p>
                    </div>
                    <div id="cont-4">
                        <p>eje fundamental:</p>
                    </div>
                    <div id="cont-5">
                        <p>proyecto institucional:</p>
                    </div>
                    <div id="cont-6">
                    <p> 0'.$Proyecto_CVE[$i].' '.$Proyecto_Nombre[$i].'</p>
                    </div>
                    <div id="cont-7">
                        <p>clave del indicador: '.$Indicador_CVE[$i].'</p>
                    </div>
                    <div id="cont-8">
                        <p>resumen de actividades</p>
                    </div>
                    <div id="cont-9">
                        <p>acción institucional:</p>
                        <p>'.$Accion_Descripcion[$i].'</p>
                    </div>
                    <div id="cont-10">
                        <p>Nombre del indicador:</p>
                        <p>'.$Indicador_NombreDelIndicador[$i].'</p>
                    </div>
                    <div id="cont-11">
                        <p>método de cálculo</p>
                        <p>'.$Indicador_MetodoDeCalculo[$i].'</p>
                    </div>
                    <div id="cont-12">
                        <p>indicador meta 2024 : '.$Meta_2024_Meta[$i].'</p>
                    </div>
                    <div id="cont-13" contenteditable="false" class="dtaGen con'.($i+1).'">
                    <div id="dato-'.($i+1).'" class="dtaGno"></div>
                    </div>
                    <div id="cont-14">
                        <p>variable</p>
                    </div>
                    <div id="cont-15">
                        <p>v1</p>
                    </div>
                    <div id="cont-16">
                        <p>v2</p>
                    </div>
                    <div id="cont-17">
                        <p>seguimiento del indicador por trimestre</p>
                    </div>
                    <div id="cont-18">
                        <p>1er.trim</p>
                    </div>
                    <div id="cont-19">
                        <p>2do.trim</p>
                    </div>
                    <div id="cont-20">
                        <p>3er.trim</p>
                    </div>
                    <div id="cont-21">
                        <p>4to.trim</p>
                    </div>
                    <div id="cont-22">
                        <p>acumulado</p>
                    </div>
                    <div id="cont-23">
                        <input
                            class="cData"
                            type="text"
                            name="Trim1V1[]"
                            placeholder="0"
                            id="Trim1V1-'.$i.'"
                        />
                    </div>
                    <div id="cont-24">
                        <input
                            class="cData"
                            type="text"
                            name="Trim2V1[]"
                            placeholder="0"
                            id="Trim2V1-'.$i.'"
                        />
                    </div>
                    <div id="cont-25">
                        <input
                            class="cData"
                            type="text"
                            name="Trim3V1[]"
                            placeholder="0"
                            id="Trim3V1-'.$i.'"
                        />
                    </div>
                    <div id="cont-26">
                        <input
                            class="cData"
                            type="text"
                            name="Trim4V1[]"
                            placeholder="0"
                            id="Trim4V1-'.$i.'"
                        />
                    </div>
                    <div id="cont-27">
                        <input
                            type="text"
                            name="AcV1[]"
                            placeholder="0"
                            readonly
                        />
                    </div>
                    <div id="cont-28">
                        <input
                            class="cData"
                            type="text"
                            name="Trim1V2[]"
                            placeholder="0"
                            id="Trim1V2-'.$i.'"
                        />
                    </div>
                    <div id="cont-29">
                        <input
                            class="cData"
                            type="text"
                            name="Trim2V2[]"
                            placeholder="0"
                            id="Trim2V2-'.$i.'"
                        />
                    </div>
                    <div id="cont-30">
                        <input
                            class="cData"
                            type="text"
                            name="Trim3V2[]"
                            placeholder="0"
                            id="Trim3V2-'.$i.'"
                        />
                    </div>
                    <div id="cont-31">
                        <input
                            class="cData"
                            type="text"
                            name="Trim4V2[]"
                            placeholder="0"
                            id="Trim4V2-'.$i.'"
                        />
                    </div>
                    <div id="cont-32">
                        <input
                            type="text"
                            name="AcV2[]"
                            placeholder="0"
                            readonly
                        />
                    </div>
                    <div id="cont-33">
                        <p>n/a</p>
                    </div>
                    <div id="cont-34">
                        <p>avance en el cumplimiento anual</p>
                    </div>
                    <div id="cont-35"></div>
                    <div id="cont-36"></div>
                </div>
                <footer id="cont-footer">
                    <div id="cont-qr">
                        <img src="../recursos/multimedia/img/qr/qrcode_generico.png">
                    </div>
                    <div id="cont-responsable">
                        <p>Responsable de integrar la información</p>
                        <p><span>Firma:</span></p>
                        <p>______________________________________</p>
                        <p><span>Nombre:&nbsp;&nbsp;&nbsp;&nbsp;'.$Desc_Nombre_Usuario[$i].'</span></p>
                        <p><span>cargo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$Desc_Cargo[$i].'</span></p>
                        <p><span>correo</span></p>
                        <p><span>electrónico:&nbsp;&nbsp;&nbsp;&nbsp;'.$Desc_Correo_Electronico[$i].'</span></p>
                        <p><span>teléfono:&nbsp;&nbsp;&nbsp;&nbsp;</span><label> 57296000 <span>extensión &nbsp;&nbsp;&nbsp;&nbsp;</span>'.$Desc_Numero_Telefono[$i].'</label></p>
                    </div>
                    <div id="cont-sello"><p>sello</p></div>
                    <div id="cont-autoriza">
                        <p>Autoriza la información reportada<br>
                        de la unidad responsable</p>
                        <p><span>Firma:</span></p>
                        <p>______________________________________</p>
                        <p><span>Nombre:</span></p>
                        <p><span>cargo: &nbsp;&nbsp;&nbsp;&nbsp;Secretario general del IPN</span></p>
                        <p><span>correo</span></p>
                        <p><span>electrónico</span></p>
                        <p><span>teléfono:</span><label> 57296000 <span>extensión</span> 79675</label></p>
                    </div>
                </footer>
            </div>
            ';
        }

    ?>
    

    <!-- ------------------- contenedor 3 --------------------------->
    

    <div id="contpadre">
        <header id="cont-header">
            <div id="logo-ipn">
                <img src="../recursos/multimedia/img/logos/logo-poli.svg" alt="pruebas">
            </div>
            <div id="ipn-dii">
                    <p>instituto politécnico nacional</p>
                    <p>coordinación general de planeación</p>
                    <p>e información institucional</p>
                    <p>dirección de informacíon institucional</p>
            </div>
            <div id="fae-periodo">
                <p>formatos de autoevaluación</p>
                <p>periodo :<span><?php echo $rango_trimestre ?></span></p>
            </div>
            <div id="resumen-act">
                <p>resumen de actividades, acciones relevantes, esfuerzos de superación y perspectivas</p>
            </div>
            <div id="data-fecha">
                <p>página 1 de N</p>
            </div>
        </header>
        <div id="conthijo-cab-cuerpo">
            <div id="cont-cabtable">
                <h3>ACCIONES RELEVANTES (ACCIONES NO CONTEMPLADAS EN SUS INDICADORES)</h3>
                <p>
                    DESCRIBIR DE FORMA ESPECÍFICA LAS ACCIONES QUE
                    EL ÁREA A SU CARGO CONDUJO DURANTE EL PERIODO 
                    PARA LOS TEMAS QUE SE SEÑALAN EN FORMA DE LISTA 
                    A CONTINUACIÓN, A FIN DE DAR SEGUIMIENTO A LAS 
                    ACTIVIDADES SUSTANTIVAS DEL INSTITUTO, PARA DAR 
                    RESPUESTA A LOS REQUERIMIENTOS DE INFORMACIÓN.
                </p>
            </div>
            <div id="cont-cuerpotable" class="dtaGen lt3">
            <div id="dato-1331" class="dtaGno"></div>
            </div>
            <div id="cont-pienotas"><h3>Notas :</h3><p contenteditable="true"></p></div>
        </div>
        <footer id="cont-footer">
            <div id="cont-qr">
                <img src="../recursos/multimedia/img/qr/qrcode_generico.png">
            </div>
            <div id="cont-responsable">
                <p>Responsable de integrar la información</p>
                <p><span>Firma:</span></p>
                <p>______________________________________</p>
                <p><span>Nombre:</span></p>
                <p><span>cargo:</span></p>
                <p><span>correo</span></p>
                <p><span>electrónico</span></p>
                <p><span>teléfono:</span><label> ########## <span>extensión</span> 79675</label></p>
            </div>
            <div id="cont-sello"><p>sello</p></div>
            <div id="cont-autoriza">
                <p>Autoriza la información reportada<br>
                   de la unidad responsable</p>
                <p><span>Firma:</span></p>
                <p>______________________________________</p>
                <p><span>Nombre:</span></p>
                <p><span>cargo: &nbsp;&nbsp;&nbsp;&nbsp;Secretario general del IPN</span></p>
                <p><span>correo</span></p>
                <p><span>electrónico</span></p>
                <p><span>teléfono:</span><label> ########## <span>extensión</span> 79675</label></p>
            </div>
        </footer>
    </div>
    <!-- ------------------- contenedor 4 --------------------------->
    

    <div id="contpadre">
        <header id="cont-header">
            <div id="logo-ipn">
                <img src="../recursos/multimedia/img/logos/logo-poli.svg" alt="pruebas">
            </div>
            <div id="ipn-dii">
                    <p>instituto politécnico nacional</p>
                    <p>coordinación general de planeación</p>
                    <p>e información institucional</p>
                    <p>dirección de informacíon institucional</p>
            </div>
            <div id="fae-periodo">
                <p>formatos de autoevaluación</p>
                <p>periodo :<span><?php echo $rango_trimestre ?></span></p>
            </div>
            <div id="resumen-act">
                <p>resumen de actividades, acciones relevantes, esfuerzos de superación y perspectivas</p>
            </div>
            <div id="data-fecha">
                <p>página 1 de N</p>
            </div>
        </header>
        <div id="conthijo-cab-cuerpo">
            <div id="cont-cabtable">
                <h3>ESFUERZOS DE SUPERACIÓN</h3>
                <p> 
                    ESPECIFICAR LAS MEDIDAS IMPLANTADAS POR
                    LA UNIDAD RESPONSABLE PARA MEJORAR LAS 
                    ACTIVIDADES A SU CARGO, ASÍ COMO LAS 
                    DIFICULTADES SUPERADAS Y LOS BENEFICIOS 
                    OBTENIDOS DURANTE EL PERIODO QUE SE 
                    INFORMA, PARA LOGRAR LA META REFERIDA 
                    EN EL RESUMEN DE ACTIVIDADES.
                </p>
            </div>
            <div id="cont-cuerpotable" class="dtaGen lt4">
                <div id="dato-1441" class="dtaGno"></div>
            </div>
            <div id="cont-pienotas"><h3>Notas :</h3><p contenteditable="true"></p></div>
        </div>
        <footer id="cont-footer">
            <div id="cont-qr">
                <img src="../recursos/multimedia/img/qr/qrcode_generico.png">
            </div>
            <div id="cont-responsable">
                <p>Responsable de integrar la información</p>
                <p><span>Firma:</span></p>
                <p>______________________________________</p>
                <p><span>Nombre:</span></p>
                <p><span>cargo:</span></p>
                <p><span>correo</span></p>
                <p><span>electrónico</span></p>
                <p><span>teléfono:</span><label> ########## <span>extensión</span> 79675</label></p>
            </div>
            <div id="cont-sello"><p>sello</p></div>
            <div id="cont-autoriza">
                <p>Autoriza la información reportada<br>
                   de la unidad responsable</p>
                <p><span>Firma:</span></p>
                <p>______________________________________</p>
                <p><span>Nombre:</span></p>
                <p><span>cargo: &nbsp;&nbsp;&nbsp;&nbsp;Secretario general del IPN</span></p>
                <p><span>correo</span></p>
                <p><span>electrónico</span></p>
                <p><span>teléfono:</span><label> ########## <span>extensión</span> 79675</label></p>
            </div>
        </footer>
    </div>
    <!-- ------------------- contenedor 5--------------------------->
    

    <div id="contpadre">
        <header id="cont-header">
            <div id="logo-ipn">
                <img src="../recursos/multimedia/img/logos/logo-poli.svg" alt="pruebas">
            </div>
            <div id="ipn-dii">
                    <p>instituto politécnico nacional</p>
                    <p>coordinación general de planeación</p>
                    <p>e información institucional</p>
                    <p>dirección de informacíon institucional</p>
            </div>
            <div id="fae-periodo">
                <p>formatos de autoevaluación</p>
                <p>periodo :<span><?php echo $rango_trimestre ?></span></p>
            </div>
            <div id="resumen-act">
                <p>resumen de actividades, acciones relevantes, esfuerzos de superación y perspectivas</p>
            </div>
            <div id="data-fecha">
                <p>página 1 de N</p>
            </div>
        </header>
        <div id="conthijo-cab-cuerpo">
            <div id="cont-cabtable">
                <h3>PERSPECTIVAS</h3>
                <p>
                CON BASE EN LA SITUACIÓN DESCRITA 
                EN LOS APARTADOS DE RESUMEN DE ACTIVIDADES Y ESFUERZOS
                DE SUPERACIÓN, DESCRIBIR LAS ACCIONES A EMPRENDER, 
                PARA EL CUMPLIMIENTO DE LAS ACTIVIDADES SUSTANTIVAS 
                QUE REQUIEREN TOMAR PREVISIONES, SEÑALANDO LOS RESULTADOS 
                QUE SE ESPERAN ALCANZAR
                </p>
            </div>
            <div id="cont-cuerpotable" class="dtaGen lt5">
            <div id="dato-4212" class="dtaGno"></div>
            </div>
            <div id="cont-pienotas"><h3>Notas :</h3><p contenteditable="true"></p></div>
        </div>
        <footer id="cont-footer">
            <div id="cont-qr">
                <img src="../recursos/multimedia/img/qr/qrcode_generico.png">
            </div>
            <div id="cont-responsable">
                <p>Responsable de integrar la información</p>
                <p><span>Firma:</span></p>
                <p>______________________________________</p>
                <p><span>Nombre:</span></p>
                <p><span>cargo:</span></p>
                <p><span>correo</span></p>
                <p><span>electrónico</span></p>
                <p><span>teléfono:</span><label> ########## <span>extensión</span> 79675</label></p>
            </div>
            <div id="cont-sello"><p>sello</p></div>
            <div id="cont-autoriza">
                <p>Autoriza la información reportada<br>
                   de la unidad responsable</p>
                <p><span>Firma:</span></p>
                <p>______________________________________</p>
                <p><span>Nombre:</span></p>
                <p><span>cargo: &nbsp;&nbsp;&nbsp;&nbsp;Secretario general del IPN</span></p>
                <p><span>correo</span></p>
                <p><span>electrónico</span></p>
                <p><span>teléfono:</span><label> ########## <span>extensión</span> 79675</label></p>
            </div>
        </footer>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script>
    var btnMH = document.getElementById('btnMH');
    var contadorHojas = <?php echo $numeroHojas?>;
    var dato = 'dato-0';
    var valrod = '';

function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

function checkElementsInView2() {
    // Actualizar la lista de elementos datshojas
    var datshojas = document.querySelectorAll('#contpadre');
    
    // Verificar si los elementos están en la vista
    datshojas.forEach(element => {
        if (isInViewport(element)) {
            console.log("Elemento visible en la parte superior:", element);
            var contenedorVista = element.getAttribute("class");
            console.log(contenedorVista);

            dato = contenedorVista;
            valrod = contenedorVista;
        }
    });
}

var debounceTimer2;
function debounceCheckElementsInView2() {
    clearTimeout(debounceTimer2);
    debounceTimer2 = setTimeout(checkElementsInView2, 100);
}

window.addEventListener('scroll', debounceCheckElementsInView2);
checkElementsInView2();


    function dataInputDa(){
    var cData = document.getElementsByClassName('cData');
    var inputDTaa = document.getElementsByClassName('inputDTa');
        for(let i = 0 ; i < cData.length ; i++){
            let dtcpacData = cData[i].getAttribute('id');
            let dtcpainputDTaa = inputDTaa[i].getAttribute('id');
            let iunpout = document.getElementById(dtcpacData);
            let output = document.getElementById(dtcpainputDTaa);
            console.log(iunpout,output);
            iunpout.addEventListener('input', ()=>{
                    output.value =  iunpout.value;
            });
        }
    }
    function dataInputDa1() {
    var cData = document.getElementsByClassName('cData');
    var inputDTaa = document.getElementsByClassName('inputDTa');
    
    console.log("Número de elementos con clase cData:", cData.length);
    console.log("Número de elementos con clase inputDTa:", inputDTaa.length);
    
    // Calcular la cantidad de bloques de datos basados en la longitud de cData (asumiendo 8 inputs por bloque)
    let datosCont = Math.floor(cData.length / 8);
    
    console.log("Cantidad de bloques de datos:", datosCont);
    
    // Arrays de prefijos para IDs
    let dtsV1 = [
        'intTrim1V1-',
        'intTrim2V1-',
        'intTrim3V1-',
        'intTrim4V1-',
        'intTrim1V2-',
        'intTrim2V2-',
        'intTrim3V2-',
        'intTrim4V2-',
    ];
    
    let dtsV1dac = [
        'Trim1V1-',
        'Trim2V1-',
        'Trim3V1-',
        'Trim4V1-',
        'Trim1V2-',
        'Trim2V2-',
        'Trim3V2-',
        'Trim4V2-',
    ];
    
    // Iterar sobre la cantidad de bloques de datos
    for (let i = 0; i < datosCont; i++) {
        // Iterar sobre los IDs y construir los IDs completos
        for (let j = 0; j < dtsV1.length; j++) {
            let idCompletoInput = dtsV1[j] + (i); // Sumar 1 porque quieres IDs empezando desde 1
            let idCompletoData = dtsV1dac[j] + (i); // Sumar 1 porque quieres IDs empezando desde 1
            
            console.log("ID del input:", idCompletoInput);
            console.log("ID del dato:", idCompletoData);
            let d1 = document.getElementById(idCompletoInput);
            let d2 = document.getElementById(idCompletoData);
            console.log(d1,d2);
            d2.addEventListener('input', ()=>{
                d1.value = d2.value;
            });
        }
    }
}

    //dataInputDa();
    dataInputDa1();


btnMH.addEventListener('click', () => {
    checkElementsInView2();  // Llamar a la función para encontrar el elemento visible

    console.log("btn 1");
    var contpadre = document.createElement("div");
    contpadre.id = "contpadre";
    contpadre.classList.add("contP-" + contadorHojas);

    contadorHojas += 1;
    var contHTML = `
        <header id="cont-header">
            <div id="logo-ipn">
                <img src="../recursos/multimedia/img/logos/logo-poli.svg" alt="pruebas">
            </div>
            <div id="ipn-dii">
                <p>instituto politécnico nacional</p>
                <p>coordinación general de planeación</p>
                <p>e información institucional</p>
                <p>dirección de informacíon institucional</p>
            </div>
            <div id="fae-periodo">
                <p>formatos de autoevaluación</p>
                <p>periodo :<span><?php echo $rango_trimestre ?></span></p>
            </div>
            <div id="resumen-act">
                <p>resumen de actividades, acciones relevantes, esfuerzos de superación y perspectivas</p>
            </div>
            <div id="data-fecha">
                <p>página 1 de N</p>
            </div>
        </header>
        <div id="conthijo">
            <div id="cont-1">
                <p>unidad responsable:</p>
            </div>
            <div id="cont-2"></div>
            <div id="cont-3"></div>
            <div id="cont-4">
                <p>eje fundamental:</p>
            </div>
            <div id="cont-5">
                <p>proyecto institucional:</p>
            </div>
            <div id="cont-6"></div>
            <div id="cont-7">
                <p>clave del indicador: F######</p>
            </div>
            <div id="cont-8">
                <p>resumen de actividades</p>
            </div>
            <div id="cont-9">
                <p>acción institucional:</p>
            </div>
            <div id="cont-10">
                <p>Nombre del indicador:</p>
            </div>
            <div id="cont-11">
                <p>método de cálculo</p>
            </div>
            <div id="cont-12">
                <p>indicador meta 2024 :</p>
            </div>
            <div id="cont-13" contenteditable="false" class="dtaGen con${contadorHojas}">
                <div id="dato-${contadorHojas}" class="dtaGno"></div>
            </div>
            <div id="cont-14">
                <p>variable</p>
            </div>
            <div id="cont-15">
                <p>v1</p>
            </div>
            <div id="cont-16">
                <p>v2</p>
            </div>
            <div id="cont-17">
                <p>seguimiento del indicador por trimestre</p>
            </div>
            <div id="cont-18">
                <p>1er.trim</p>
            </div>
            <div id="cont-19">
                <p>2do.trim</p>
            </div>
            <div id="cont-20">
                <p>3er.trim</p>
            </div>
            <div id="cont-21">
                <p>4to.trim</p>
            </div>
            <div id="cont-22">
                <p>acumulado</p>
            </div>
            <div id="cont-23">
                <input id="Trim1V1-${contadorHojas-1}" class="cData" type="text" name="Trim1V1[]" placeholder="0" />
            </div>
            <div id="cont-24">
                <input id="Trim2V1-${contadorHojas-1}"  class="cData" type="text" name="Trim2V1[]" placeholder="0" />
            </div>
            <div id="cont-25">
                <input id="Trim3V1-${contadorHojas-1}"  class="cData" type="text" name="Trim3V1[]" placeholder="0" />
            </div>
            <div id="cont-26">
                <input id="Trim4V1-${contadorHojas-1}"  class="cData" type="text" name="Trim4V1[]" placeholder="0" />
            </div>
            <div id="cont-27">
                <input type="text" name="AcV1[]" placeholder="0" readonly />
            </div>
            <div id="cont-28">
                <input id="Trim1V2-${contadorHojas-1}"  class="cData" type="text" name="Trim1V2[]" placeholder="0" />
            </div>
            <div id="cont-29">
                <input id="Trim2V2-${contadorHojas-1}"  class="cData" type="text" name="Trim2V2[]" placeholder="0" />
            </div>
            <div id="cont-30">
                <input id="Trim3V2-${contadorHojas-1}"  class="cData" type="text" name="Trim3V2[]" placeholder="0" />
            </div>
            <div id="cont-31">
                <input id="Trim4V2-${contadorHojas-1}"  class="cData" type="text" name="Trim4V2[]" placeholder="0" />
            </div>
            <div id="cont-32">
                <input type="text" name="AcV2[]" placeholder="0" readonly />
            </div>
            <div id="cont-33">
                <p>n/a</p>
            </div>
            <div id="cont-34">
                <p>avance en el cumplimiento anual</p>
            </div>
            <div id="cont-35"></div>
            <div id="cont-36"></div>
        </div>
        <footer id="cont-footer">
            <div id="cont-qr">
                <img src="../recursos/multimedia/img/qr/qrcode_generico.png">
            </div>
            <div id="cont-responsable">
                <p>Responsable de integrar la información</p>
                <p><span>Firma:</span></p>
                <p>______________________________________</p>
                <p><span>Nombre:</span></p>
                <p><span>cargo:</span></p>
                <p><span>correo</span></p>
                <p><span>electrónico</span></p>
                <p><span>teléfono:</span><label> 57296000 <span>extensión</span> 79675</label></p>
            </div>
            <div id="cont-sello"><p>sello</p></div>
            <div id="cont-autoriza">
                <p>Autoriza la información reportada<br> de la unidad responsable</p>
                <p><span>Firma:</span></p>
                <p>______________________________________</p>
                <p><span>Nombre:</span></p>
                <p><span>cargo: &nbsp;&nbsp;&nbsp;&nbsp;Secretario general del IPN</span></p>
                <p><span>correo</span></p>
                <p><span>electrónico</span></p>
                <p><span>teléfono:</span><label> 57296000 <span>extensión</span> 79675</label></p>
            </div>
        </footer>
    `;
    let htmlinputs = `
        <label name="V1">hoja : ${contadorHojas}  V1</label>
        <input
            id="intTrim1V1-${contadorHojas-1}"
            type="text"
            name="1erTrimV1[]"
            value="0"
            class="inputDTa"
        />
        <input
            id="intTrim2V1-${contadorHojas-1}"
            type="text"
            name="2doTrimV1[]"
            value="0"
            class="inputDTa"
        />
        <input
            id="intTrim3V1-${contadorHojas-1}"
            type="text"
            name="3erTrimV1[]"
            value="0"
            class="inputDTa"
        />
        <input
            id="intTrim4V1-${contadorHojas-1}"
            type="text"
            name="4toTrimV1[]"
            value="0"
            class="inputDTa"
        />
        <label name="V2">V2</label>
        <input
            id="intTrim1V2-${contadorHojas-1}"
            type="text"
            name="1erTrimV2[]"
            value="0"
            class="inputDTa"
        />
        <input
            id="intTrim2V2-${contadorHojas-1}"
            type="text"
            name="2doTrimV2[]"
            value="0"
            class="inputDTa"
        />
        <input
            id="intTrim3V2-${contadorHojas-1}"
            type="text"
            name="3erTrimV2[]"
            value="0"
            class="inputDTa"
        />
        <input
            id="intTrim4V2-${contadorHojas-1}"
            type="text"
            name="4toTrimV2[]"
            value="0"
            class="inputDTa"
        />
        <br>
    `;
    var navContHojaForm = document.querySelector('.navContHojaForm');
    navContHojaForm.insertAdjacentHTML('beforeend', htmlinputs);

    
    
    contpadre.innerHTML = contHTML;

    // Encuentra el contenedor visible y lo utiliza para insertar después de este
    var firstContPadre = document.querySelector(`.${valrod}`);
    if (firstContPadre) {
        firstContPadre.parentNode.insertBefore(contpadre, firstContPadre.nextSibling);
    }

    // Actualizar números de página
    let conts = document.querySelectorAll("#contpadre");
    for (let i = 0; i < conts.length; i++) {
        let cont = conts[i];
        let txt = cont.querySelectorAll("#data-fecha > p");
        txt.forEach((p, index) => {
            p.textContent = "página " + (i + 1) + " de " + (conts.length);
            console.log(p.textContent);
        });
    }



    
    //dataInputDa();
    dataInputDa1();
});    

    // Obtener todos los elementos con la clase 'dtaGen'
    var datshojas = document.querySelectorAll('.dtaGno');

    // Función para verificar si un elemento esta en la parte superior de la ventana
    function isInViewport(element) {
        var rect = element.getBoundingClientRect();
        return rect.top >= 0 && rect.top <= (window.innerHeight || document.documentElement.clientHeight);
    }

    function checkElementsInView() {
        // Actualizar la lista de elementos datshojas
        datshojas = document.querySelectorAll('.dtaGno');
        
        // Verificar si los elementos están en la vista
        datshojas.forEach(element => {
            if (isInViewport(element)) {
                console.log("Elemento visible en la parte superior:", element);
                var contenedorVista = element.getAttribute("id");
                console.log(contenedorVista);

                dato = contenedorVista;
            }
        });
    }


    // Función para verificar los elementos en la vista con un pequeño retraso
    var debounceTimer;
    function debounceCheckElementsInView() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(checkElementsInView, 100);
    }

    // Evento de scroll que verifica si los elementos están en la parte superior de la ventana
    window.addEventListener('scroll', debounceCheckElementsInView);

    // Verificar los elementos en la vista al cargar la página
    checkElementsInView();
    
    window.addEventListener('afterprint', handleAfterPrint);

let contIndex = 1; // Inicializar el índice para nuevos elementos
const btnMT = document.getElementById('btnMT');

btnMT.addEventListener('click', () => {
    console.log("btn 2");
    console.log(dato);
    const newElement = document.createElement('div');
    newElement.id = 'cont' + contIndex;
    newElement.className = 'contItems';
    newElement.innerHTML = `
        <header class="contElim">
            <div class="itemBTEL" data-id="${contIndex}"><span class="gg-close btnElIT"></span></div>
        </header>
        <div class="conMsjItm" contenteditable="false">Contenido</div>
    `;

    document.getElementById(dato).appendChild(newElement);

    // Añadir el evento de pegado al nuevo cuadro de texto
    newElement.addEventListener('paste', handlePaste);

    // Hacer que el nuevo elemento sea resizable y draggable
    $(newElement).resizable();
    $(newElement).draggable();

    // Añadir el evento de click para eliminar el elemento
    const deleteButton = newElement.querySelector('.itemBTEL');
    deleteButton.addEventListener('click', () => {
        const elementId = deleteButton.getAttribute('data-id');
        const elementToRemove = document.getElementById('cont' + elementId);
        if (elementToRemove) {
            elementToRemove.remove();
        } else {
            console.log('Elemento no encontrado: cont' + elementId);
        }
    });

    contIndex++; // Incrementar el índice para el próximo elemento
    // Añadir el evento de pegado al nuevo cuadro de texto
    newElement.addEventListener('paste', handlePaste);
});


function handlePaste(e) {
    e.preventDefault();
    var clipboardData = e.clipboardData || window.clipboardData;
    var items = clipboardData.items;

    // Verificar si hay contenido previo y eliminarlo si es necesario
    if (e.target.innerHTML.trim() !== '') {
        e.target.innerHTML = '';
    }

    for (var i = 0; i < items.length; i++) {
        var item = items[i];
        if (item.type.indexOf("image") !== -1) {
            // Manejar imágenes
            var blob = item.getAsFile();
            var reader = new FileReader();
            reader.onload = function(event) {
                var img = document.createElement("img");
                img.src = event.target.result;
                var wrapper = document.createElement("div");
                wrapper.classList.add("resizable");
                wrapper.appendChild(img);
                e.target.appendChild(wrapper);
            };
            reader.readAsDataURL(blob);
        } 
    }
}



let contIndex1 = 1; // Inicializar el índice para nuevos elementos
const btnTxtC = document.getElementById('btnTxtC');

// Definir las opciones de la barra de herramientas de Quill
const toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],       
  ['blockquote', 'code-block'],

  [{ 'header': 1 }, { 'header': 2 }],               
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],     
  [{ 'indent': '-1'}, { 'indent': '+1' }],         
  [{ 'direction': 'rtl' }],                        

  [{ 'size': ['small', false, 'large', 'huge'] }],  

  [{ 'color': [] }, { 'background': [] }],          
  [{ 'font': [] }],
  [{ 'align': [] }],

];

btnTxtC.addEventListener('click', () => {
    console.log("btn 2");
    console.log(dato);
    const newElement = document.createElement('div');
    newElement.id = 'contC' + contIndex1;
    newElement.className = 'contItems';
    newElement.innerHTML = `
        <header class="contElim">
            <div class="itemBTEL" data-id="${contIndex1}"><span class="gg-close btnElIT"></span></div>
        </header>
        <div id="editor${contIndex1}" class="conMsjItm">texto</div>
    `;

    // Agregar nuevo elemento al DOM
    document.getElementById(dato).appendChild(newElement);

    // Inicializar Quill después de que el nuevo elemento se haya agregado al DOM
    const quill = new Quill(`#editor${contIndex1}`, {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    // Ajustar el tamaño del contenedor del editor para que ocupe el 100% del espacio
    const editorContainer = document.getElementById(`editor${contIndex1}`);
    editorContainer.style.width = '100%';
    editorContainer.style.height = '100%';

    // Hacer que el nuevo elemento sea resizable y draggable
    $(newElement).resizable();
    $(newElement).draggable();

    // Añadir el evento de click para eliminar el elemento
    const deleteButton = newElement.querySelector('.itemBTEL');
    deleteButton.addEventListener('click', () => {
        const elementId = deleteButton.getAttribute('data-id');
        const elementToRemove = document.getElementById('contC' + elementId);
        if (elementToRemove) {
            elementToRemove.remove();
        } else {
            console.log('Elemento no encontrado: cont' + elementId);
        }
    });

    contIndex1++; // Incrementar el índice para el próximo elemento
    // Añadir el evento de pegado al nuevo cuadro de texto
    newElement.addEventListener('paste', handlePaste2);
});




function handlePaste2(e) {
    e.preventDefault();
    var clipboardData = e.clipboardData || window.clipboardData;
    var items = clipboardData.items;

    // Verificar si hay contenido previo y eliminarlo si es necesario
    if (e.target.innerHTML.trim() !== '') {
        e.target.innerHTML = '';
    }

    for (var i = 0; i < items.length; i++) {
        var item = items[i];
        if (item.type.indexOf("text/plain") !== -1 || item.type.indexOf("text/html") !== -1) {
            // Manejar texto plano o HTML
            item.getAsString(function (text) {
                document.execCommand("insertHTML", false, text);
            });
        } 
    }
}



    // Función para manejar el evento keydown
    function handleKeyDown(event) {
        // Verificar si se presionó "Control" (ctl) junto con "P"
        if (event.ctrlKey && event.key === 'p') {
            // Ocultar los elementos deseados
            var elemento1 = document.getElementById('botonera');
            var elementos2 = document.getElementsByClassName('ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se');
            elemento1.style.display = 'none'; 
            for (var i = 0; i < elementos2.length; i++) {
                elementos2[i].style.display = 'none';
            }
        }
    }

    document.addEventListener('keydown', handleKeyDown);

    // Función para manejar el evento afterprint
    function handleAfterPrint() {
        // Mostrar los elementos deseados nuevamente
        var elemento1 = document.getElementById('botonera');
        var elementos2 = document.getElementsByClassName('ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se');
        elemento1.style.display = 'flex'; // Cambia esto según lo que necesites
        for (var i = 0; i < elementos2.length; i++) {
            elementos2[i].style.display = 'block'; // Cambia esto según lo que necesites
        }
    }


    $( function() {
        $( "#btnMT").tooltip({
        show: null,
        position: {
            my: "left top",
            at: "left bottom"
        },
        open: function( event, ui ) {
            ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
        }
        });
        $( "#btnMH" ).tooltip({
        show: null,
        position: {
            my: "left top",
            at: "left bottom"
        },
        open: function( event, ui ) {
            ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
        }
        });
        $( "#btnarrow" ).tooltip({
        show: null,
        position: {
            my: "left top",
            at: "left bottom"
        },
        open: function( event, ui ) {
            ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
        }
        });
        $( "#btnGuardar" ).tooltip({
        show: null,
        position: {
            my: "left top",
            at: "left bottom"
        },
        open: function( event, ui ) {
            ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
        }
        });
        $( "#btnTxtC" ).tooltip({
        show: null,
        position: {
            my: "left top",
            at: "left bottom"
        },
        open: function( event, ui ) {
            ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
        }
        });
    } );


    let contModal = document.getElementById("contModal-1");
    let btnImp = document.getElementById("btnImp");

// Función para ocultar los elementos
function ocultarElementos() {
    var elemento1 = document.getElementById('botonera');
    var elementos2 = document.getElementsByClassName('ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se');
    var elementos3 = document.querySelectorAll('.ql-toolbar');
    var headerConts = document.getElementsByClassName('contElim');
    var container = document.getElementsByClassName('ql-container ql-snow');
    var contItemss = document.getElementsByClassName('contItems');
    elemento1.style.display = 'none'; 
    for (var i = 0; i < elementos2.length; i++) {
        elementos2[i].style.display = 'none';
    }
    for (var i = 0; i < elementos3.length; i++) {
        elementos3[i].style.display = 'none';
    }
    for (var i = 0; i < headerConts.length; i++) {
        headerConts[i].style.display = 'none';
    }
    for (var i = 0; i < contItemss.length; i++) {
        contItemss[i].style.border = '0px';
        container[i].style.border = '0px';
    }
}

// Función para mostrar los elementos
function mostrarElementos() {
    var elemento1 = document.getElementById('botonera');
    var elementos2 = document.getElementsByClassName('ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se');
    var elementos3 = document.querySelectorAll('.ql-toolbar');
    var headerConts = document.getElementsByClassName('contElim');
    var contItemss = document.getElementsByClassName('contItems');
    var container = document.getElementsByClassName('ql-container ql-snow');
    elemento1.style.display = 'flex'; // Cambia esto según lo que necesites
    for (var i = 0; i < elementos2.length; i++) {
        elementos2[i].style.display = 'block'; // Cambia esto según lo que necesites
    }
    for (var i = 0; i < elementos3.length; i++) {
        elementos3[i].style.display = 'flex';
    }
    for (var i = 0; i < headerConts.length; i++) {
        headerConts[i].style.display = 'flex';
    }
    for (var i = 0; i < contItemss.length; i++) {
        contItemss[i].style.border = '1px solid #ccc';
        container[i].style.border = '1px solid #ccc';
    }
}

window.addEventListener('beforeprint', ocultarElementos);
window.addEventListener('afterprint', mostrarElementos);

btnImp.addEventListener('click', () => {
    console.log("se ha presionado el btn imprimir");
    window.print();
});
let btnarrow = document.getElementById("btnarrow");
btnarrow.addEventListener('click', () => {
    console.log("se ha presionado btnarrow");
    history.back();
});
let btnGuardar = document.getElementById("btnGuardar");
let enviarFAEData = document.getElementById("enviarFAEData");
btnGuardar.addEventListener('click', () => {
    console.log("se ha presionado enviarFAEData");
    enviarFAEData.click();
});
    </script>
</html>

