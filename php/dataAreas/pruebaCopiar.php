<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contenedor de Pegado</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style type="text/css">
        * {
            padding: 0;
            margin: 0;
        }
        body {
            background: #ca6;
        }
        #contentPadre {
            width: 100vw;
            height: 100vh;
            background: #F0F3FF;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        #contentPadre > #contPegar {
            width: 70%;
            height: 60%;
            background: #C9D7DD;
            display: block;
            justify-content: center;
            align-items: center;
            overflow: auto;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        }
        #contentPadre > #btncuadroTex {
            width: 200px;
            height: 50px;
            background: #2a2;
            font-size: 18px;
            font-weight: 500;
            text-align: center;
            text-transform: capitalize;
            display: flex;
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 10px;
            overflow: hidden;
            cursor: pointer;
            flex-direction: column;
            border-radius: 5px;
            justify-content: center;
            align-items: center;
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
        .miClase {
            width: 200px;
            height: 100px;
            background-color: #BFCFE7;
            border: 2px solid #7077A1;
            padding: 5px;
            display: flex;
            flex-direction: column;
            font-size: 20px;
            justify-content: center;
            align-items: center;
            font-weight: 400;
            text-transform: capitalize;
            letter-spacing: 2px;
            overflow: hidden;
            
        }
    </style>
</head>
<body>

<div id="contentPadre">
    <div id="contPegar" contenteditable="false"></div>
    <div id="btncuadroTex"><span>Agregar Cuadro de Texto</span></div>
    <button onclick="submitContent()">Enviar</button>   
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script>

    // Agrega un cuadro de texto editable
    document.getElementById('btncuadroTex').addEventListener('click', function() {
        var wrapper = document.createElement("div");
        wrapper.classList.add("resizable");

        var textBox = document.createElement("div");
        textBox.classList.add("miClase");
        textBox.setAttribute("contenteditable", true); // Permite que el contenido sea editable

        wrapper.appendChild(textBox);
        document.getElementById('contPegar').appendChild(wrapper);
        makeDraggable(textBox);

        // Añadir el evento de pegado al nuevo cuadro de texto
        textBox.addEventListener('paste', handlePaste);
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
</script>
</body>
</html>
