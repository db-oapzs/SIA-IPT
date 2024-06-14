<!DOCTYPE html>
<html>
<?php
include '../php/trimestre.php';
$rango_trimestre = obtenerRangoMesesTrimestre();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/iconos.css">
    <link rel="stylesheet" href="../styles/styless.css">
    <link rel="stylesheet" href="../styles/stylesModalFAE.css">
    <link rel="icon" href="../recursos/multimedia/Logos/SIA Logo.png" type="image/png">
    <script src="../scripts/scriptt.js" async defer></script>
    <script src="../scripts/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../scripts/jqueryUI/jquery-ui.css">
    <script src="../scripts/jqueryUI/jquery-ui.js"></script>
    <script src="../scripts/ScriptModalElimFAE.js"></script>
    <style>
        #botonera{
            width:50px;
            height: 230px;
            background: #DDDDDD;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            position: fixed;
            top:30%;
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
            display: block;
            justify-content: center;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
            overflow: hidden;
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
        #ModalElimHoja{
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.75);
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            z-index: 99999;
        }
        #ModalElimHoja >#modalHijElim{
            width: 400px;
            height: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #fff;
            border-radius: 5px;

            overflow: hidden;
        }
    </style>
</head>
<body>
    <div id="contModal-1">
            <div id="ContHijoElimH">
                <div id="contbtn"><span class="gg-close" id="Btn-CerrarModal"></span></div>
                <p>Seleccione la hoja del formato FAE que desea eliminar</p>
                <select id="conTHojaElim" name="Eliminar Hojas">
                    <option disabled selected>Selecciona una Hoja</option>
                </select>
                <input type="submit" id="Btn-ElimHoja" value="Eliminar Hoja">
            </div>    
        </div>

    <ul id="botonera">
        <li id="btnMH" title="Agrega Hojas al Ofició"><span id="icoMhojas" class="gg-file-add"></span></li>
        <li id="btnMT" title="Agrega cuadro de Contenido"><span id="icoMTexto" class="gg-extension-add"></span></li>
        <li id="btnElP" title="Eliminar una Pagina"><span id="icoEliminarP" class="gg-play-list-remove"></span></li>
        <li id="btnImp" title="Imprimir Documento"><span id="icoImprimir" class="gg-printer"></span></li>
    </ul>
    <!-- ------------------- contenedor 2 --------------------------->
    

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script>
    var btnMH = document.getElementById('btnMH');
    var contadorHojas = 1;
    var dato = 'dato-0';
    btnMH.addEventListener('click', () => {
        console.log("btn 1");var 
        contpadre = document.createElement("div");
        contpadre.id = "contpadre";
        contpadre.classList.add("contP-" + contadorHojas);

        contadorHojas+=1;
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
                        <p>indicador meta 2024 : 14</p>
                    </div>
                    <div id="cont-13" contenteditable="false" class="dtaGen con`+contadorHojas+`">
                    <div id="dato-`+contadorHojas+`" class="dtaGno"></div>
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
                    <div id="cont-23"></div>
                    <div id="cont-24"></div>
                    <div id="cont-25"></div>
                    <div id="cont-26"></div>
                    <div id="cont-27"></div>
                    <div id="cont-28"></div>
                    <div id="cont-29"></div>
                    <div id="cont-30"></div>
                    <div id="cont-31"></div>
                    <div id="cont-32"></div>
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
                `;
            contpadre.innerHTML = contHTML;
            var firstContPadre = document.getElementById('contpadre');
            document.body.insertBefore(contpadre, document.body.firstChild);
            let conts = document.querySelectorAll("#contpadre");
            for (let i = 0; i < conts.length; i++) {
                let cont = conts[i];
                let txt = cont.querySelectorAll("#data-fecha > p");
                txt.forEach((p, index) => {
                    p.textContent = "página " + (i + 1) + " de " + (conts.length);
                    console.log(p.textContent);
                });
            }
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
    function simulateCtrlZ() {
    var event = new KeyboardEvent('keydown', {
        bubbles: true,
        cancelable: true,
        key: 'z', 
        code: 'KeyZ', 
        ctrlKey: true
    });
    document.dispatchEvent(event);
    }
    var btnMT = document.getElementById('btnMT');
        btnMT.addEventListener('click', () => {
            console.log("btn 2");
            console.log(dato);

        var wrapper = document.createElement("div");
        wrapper.classList.add("resizable");

        var textBox = document.createElement("div");
        textBox.classList.add("miClase");
        textBox.setAttribute("contenteditable", true); // Permite que el contenido sea editable
        textBox.contentEditable = "true";
        textBox.style.width = "200px";
        textBox.style.height = "100px";
        textBox.style.backgroundColor = "#fff";
        textBox.style.border = "1px solid #ccc";
        textBox.style.padding = "10px";
        textBox.style.display = "flex";
        textBox.style.flexDirection = "column";
        textBox.style.fontSize = "20px";
        textBox.style.justifyContent = "center";
        textBox.style.alignItems = "center";
        textBox.style.fontWeight = "400";
        textBox.style.textTransform = "capitalize";
        textBox.style.letterSpacing = "2px";
        textBox.style.overflow = "hidden";


        wrapper.appendChild(textBox);
        document.getElementById(dato).appendChild(wrapper);
        makeDraggable(textBox);
        // Añadir el evento de pegado al nuevo cuadro de texto
        textBox.addEventListener('paste', handlePaste);
        simulateCtrlZ();
        simulateCtrlZ();
        simulateCtrlZ();
        simulateCtrlZ();
    });

    function handlePaste(e) {
        e.preventDefault();
        var clipboardData = e.clipboardData || window.clipboardData;
        var items = clipboardData.items;

        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            if (item.type.indexOf("image") !== -1) {
                var blob = item.getAsFile();
                var reader = new FileReader();
                reader.onload = function(event) {
                    var img = document.createElement("img");
                    img.src = event.target.result;
                    var wrapper = document.createElement("div");
                    wrapper.classList.add("resizable");
                    wrapper.appendChild(img);
                    e.target.appendChild(wrapper);
                    makeDraggable(textBox);
                };
                reader.readAsDataURL(blob);
            } else if (item.type.indexOf("text/plain") !== -1) {
                item.getAsString(function (text) {
                    document.execCommand("insertHTML", false, text);
                });
            } else if (item.type.indexOf("text/html") !== -1) {
                item.getAsString(function (html) {
                    document.execCommand("insertHTML", false, html);
                });
            } else if (item.type.indexOf("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") !== -1) {
                var file = item.getAsFile();
                var reader = new FileReader();
                reader.onload = function(event) {
                    var arrayBuffer = event.target.result;
                    var data = new Uint8Array(arrayBuffer);
                    var workbook = XLSX.read(data, {type: "array"});
                    var html = XLSX.utils.sheet_to_html(workbook.Sheets[workbook.SheetNames[0]]);
                    var wrapper = document.createElement("div");
                    wrapper.classList.add("resizable");
                    wrapper.innerHTML = html;
                    e.target.appendChild(wrapper);
                    makeDraggable(wrapper);
                };
                reader.readAsArrayBuffer(file);
            }
        }
    }

    function makeDraggable(element) {
        $(element).draggable({
            containment: "#contPegar",
            scroll: false
        });
        $(element).resizable({
            handles: 'n, e, s, w, ne, se, sw, nw'
        });
    }

    function submitContent() {
        var content = document.getElementById('contPegar').innerHTML;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'save_content.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('content=' + encodeURIComponent(content));
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
        $( "#btnElP" ).tooltip({
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




    var btnElP = document.getElementById('btnElP');
    var contenedores = [];
    btnElP.addEventListener('click', () => {    
        var contpadres = document.querySelectorAll('#contpadre');
        for (var i = 0; i < contpadres.length; i++) {
            if (contpadres[i].className.trim() !== '') {
                var modalEliminar = document.getElementById('contModal-1');
                modalEliminar.style.display = 'flex';
                modalEliminar.style.position = 'fixed';
                modalEliminar.style.top = '0';
                modalEliminar.style.left = '0';
                modalEliminar.style.width = '100vw';
                modalEliminar.style.height = '100vh';
                modalEliminar.style.zIndex = '9999';
                modalEliminar.style.backgroundColor = 'rgba(0, 0, 0, 0.75)';
                    
                console.log(contpadres[i]);
                contenedores[i] = contpadres[i].getAttribute('class');
            }
        }
        console.log(contenedores);
        var selectElement = document.getElementById('conTHojaElim');

        // Eliminar todas las opciones existentes excepto la primera
        selectElement.innerHTML = '<option disabled selected>Selecciona una Hoja</option>';

        // Agregar las nuevas opciones
        var contador = 0;
        contenedores.forEach(function(contenedor) {
            var option = document.createElement('option');
            option.value = contenedor;
            option.textContent = contenedor;
            selectElement.appendChild(option);
            contador+=1;
        });
        contador = 0;
    });

    let btnElim = document.getElementById("Btn-ElimHoja");
    let contModal = document.getElementById("contModal-1");

    btnElim.addEventListener('click', () => {
        console.log("se ha presionado el btn eliminar");

        let conTHojaElimDTA = document.getElementById('conTHojaElim');
        let hojaEliminda = conTHojaElimDTA.value; // No necesitas convertirlo a cadena, ya es una cadena.
        let hojaElim = document.getElementsByClassName(hojaEliminda); // getElementsByClassName devuelve una colección

        if (hojaElim.length > 0) {
            hojaElim[0].remove();
            var contpadres = document.querySelectorAll('#contpadre');
            for (var i = 0; i < contpadres.length; i++) {
                contenedores[i] = contpadres[i].getAttribute('class');
                if (contpadres[i].className.trim() !== '') {
                    console.log(contenedores);
                    let conts = document.querySelectorAll("#contpadre");
                    for (let i = 0; i < conts.length; i++) {
                        let cont = conts[i];
                        let txt = cont.querySelectorAll("#data-fecha > p");
                        txt.forEach((p, index) => {
                            p.textContent = "página " + (i + 1) + " de " + (conts.length);
                            console.log(p.textContent);
                        });
                    }
                }
            }
        } else {
            console.log("No se encontró la hoja a eliminar");
        }
        contModal.style.display = "none";
    });



    let btnImp = document.getElementById("btnImp");

// Función para ocultar los elementos
function ocultarElementos() {
    var elemento1 = document.getElementById('botonera');
    var elementos2 = document.getElementsByClassName('ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se');
    elemento1.style.display = 'none'; 
    for (var i = 0; i < elementos2.length; i++) {
        elementos2[i].style.display = 'none';
    }
}

// Función para mostrar los elementos
function mostrarElementos() {
    var elemento1 = document.getElementById('botonera');
    var elementos2 = document.getElementsByClassName('ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se');
    elemento1.style.display = 'flex'; // Cambia esto según lo que necesites
    for (var i = 0; i < elementos2.length; i++) {
        elementos2[i].style.display = 'block'; // Cambia esto según lo que necesites
    }
}

// Asignar eventos beforeprint y afterprint
window.addEventListener('beforeprint', ocultarElementos);
window.addEventListener('afterprint', mostrarElementos);

btnImp.addEventListener('click', () => {
    console.log("se ha presionado el btn imprimir");
    window.print();
});



    </script>
</html>

