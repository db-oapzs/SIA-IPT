"use strict";
window.addEventListener("load", function () {
    console.log("Dom Cargado!");
    // Función para rellenar con ceros a la izquierda
    function padLeft(value, length, char) {
        var str = value.toString();
        while (str.length < length) {
            str = char + str;
        }
        return str;
    }
    function actualizarReloj() {
        // Obtener el elemento con el ID "reloj"
        var elemento = document.getElementById('reloj');
        // Verificar si el elemento existe
        if (elemento instanceof HTMLElement && elemento !== null) {
            // Obtener la fecha y hora actual
            var ahora = new Date();
            // Obtener los datos de hora, minutos, segundos, día, mes y año
            var horas = padLeft(ahora.getHours(), 2, '0');
            var minutos = padLeft(ahora.getMinutes(), 2, '0');
            var segundos = padLeft(ahora.getSeconds(), 2, '0');
            var dia = padLeft(ahora.getDate(), 2, '0');
            var mes = padLeft(ahora.getMonth() + 1, 2, '0'); // Se suma 1 ya que los meses van de 0 a 11
            var año = ahora.getFullYear().toString();
            // Formatear la salida del reloj
            //var tiempo = horas + ':' + minutos + ':' + segundos + ' - ' + dia + '/' + mes + '/' + año;
            var tiempo = dia + '/' + mes + '/' + año + '     ' + horas + ':' + minutos + ':' + segundos;
            // Actualizar el contenido del elemento <h2> con la hora actual
            elemento.innerText = tiempo;
        }
    }
    // Llamar a la función actualizarReloj cada segundo para actualizar el reloj en tiempo real
    setInterval(actualizarReloj, 1000);
    // Obtener el elemento select
    var selectIdioma = document.getElementById('SelectorIdioma');
    var idioma = document.getElementById('idioma');
    var TextInput = document.getElementById('TextInput');
    // Agregar un event listener para el evento 'change'
    selectIdioma.addEventListener('change', function () {
        // Obtener el valor seleccionado del select
        var idiomaSeleccionado = selectIdioma.value;
        // Verificar si se ha seleccionado un idioma válido
        if (idiomaSeleccionado !== "") {
            // Se ha seleccionado un idioma, puedes realizar acciones aquí
            console.log("Se ha seleccionado el idioma: " + idiomaSeleccionado);
            idioma.value = idiomaSeleccionado;
            TextInput.removeAttribute('readonly');
        }
        else {
            // No se ha seleccionado ningún idioma válido
            console.log("No se ha seleccionado ningún idioma");
            TextInput.setAttribute('readonly', 'readonly');
        }
    });
    var btnGuardar = document.getElementById("BEnviar");
    btnGuardar.addEventListener('mouseover', function () {
        console.log("El mouse está sobre el botón guardar.");
        var form = document.getElementById("formStatus");
        if (form) {
            form.action = "enviarJustificacion.php"; // Reemplaza "nueva_url" con la URL deseada
            var form2 = document.getElementById("formStatus");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    btnGuardar.addEventListener('mouseout', function () {
        var form = document.getElementById("formStatus");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            var form2 = document.getElementById("formStatus");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    var btnEnviar = document.getElementById("BGuardar");
    btnEnviar.addEventListener('mouseover', function () {
        console.log("El mouse está sobre el botón enviar.");
        var form = document.getElementById("formStatus");
        if (form) {
            form.action = "guardarJustificacion.php"; // Reemplaza "nueva_url" con la URL deseada
            var form2 = document.getElementById("formStatus");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    btnEnviar.addEventListener('mouseout', function () {
        var form = document.getElementById("formStatus");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            var form2 = document.getElementById("formStatus");
            console.log("Nuevo action del formulario:", form2);
        }
    });
});
