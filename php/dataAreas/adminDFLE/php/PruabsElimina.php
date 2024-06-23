<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../../../recursos/multimedia/Logos/SIA Logo.png" type="image/png">
    <link rel="stylesheet" href="../styles/iconos.css">

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../../../scripts/jqueryUI/jquery-ui.css">
    <script src="../scripts/jquery-3.7.1.min.js"></script>
    <script src="../../../../scripts/jqueryUI/jquery-ui.js"></script>

    <style>
        * {
            padding: 0;
            margin: 0;
        }
        #ContPadre {
            width: 100vw;
            height: 100vh;
            background: #aff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        #ContPadre > #ContHijo {
            width: 75%;
            height: 60%;
            background: #cca;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 1px solid #000;
            border-radius: 5px;
            overflow: hidden;
        }
        #ContPadre > #ContHijo0 {
            width: 75%;
            height: 100px;
            background: #4243;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 1px solid #000;
            border-radius: 5px;
            overflow: hidden;
        }
        .contItems {
            width: 250px;
            height: 200px;
            background: #add;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            border: 1px solid #000;
            border-radius: 5px;
            overflow: hidden;
            margin: 10px;
        }
        .contItems > .contElim {
            width: 100%;
            height: 15px;
            background: #d71;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            align-items: center;
            border: 1px solid #000;
            overflow: hidden;
        }
        .contItems > .contElim > .itemBTEL {
            width: 15px;
            height: 20px;
            background: #f1a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: 150ms all linear;
        }
        .contItems > .contElim > .itemBTEL:hover {
            cursor: pointer;
            background: #0af;
        }
        .contItems > .conMsjItm {
            width: 100%;
            height: 100%;
            background: #ccc;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .contItems > .conMsjItm > * {
            width: 100%;
            height: 100%;
            background: #143c;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div id="ContPadre">
        <div id="ContHijo0">
        </div>
        <div id="ContHijo">
        </div>
        <button id="addElementBtn">Añadir Elemento</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        const quill = new Quill('#ContHijo0', {
            theme: 'snow'
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script>
        let numInput = document.querySelectorAll('.contElim');
        for (let i = 0; i < numInput.length; i++) {
            console.log("input  : " + i);
        }
        $(function() {
            $(".contItems").resizable();
            $(".contItems").draggable();
        });

        let contIndex = 1; // Inicializar el índice para nuevos elementos

        document.getElementById('addElementBtn').addEventListener('click', function() {
            const newElement = document.createElement('div');
            newElement.id = 'cont' + contIndex;
            newElement.className = 'contItems';
            
            newElement.innerHTML = `
                <header class="contElim">
                    <div id="cont-${contIndex}" class="itemBTEL"><span class="gg-close btnElIT"></span></div>
                </header>
                <textarea id="condEDt-${contIndex}" class="conMsjItm" contenteditable="true">Este contenido es editable ${contIndex + 1}</textarea>
            `;
            
            tinymce.init({
                selector: `textarea#condEDt-${contIndex}`
            });
            
            document.getElementById('ContHijo').appendChild(newElement);

            // Hacer que el nuevo elemento sea resizable y draggable
            $(newElement).resizable();
            $(newElement).draggable();

            contIndex++; // Incrementar el índice para el próximo elemento
        });
    </script>
</body>
</html>
