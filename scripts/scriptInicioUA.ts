"use strict";
window.addEventListener("load", () => {
    console.log("Dom Cargado!");

    // Función para rellenar con ceros a la izquierda
    function padLeft(value, length, char) {
        let str = value.toString();
        while (str.length < length) {
            str = char + str;
        }
        return str;
    }

    function actualizarReloj() {
        // Obtener el elemento con el ID "reloj"
        let elemento = document.getElementById('reloj');
        
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
            var tiempo = dia + '/' + mes + '/' + año +'     '+ horas + ':' + minutos + ':' + segundos ;
        
            // Actualizar el contenido del elemento <h2> con la hora actual
            elemento.innerText = tiempo;
        }
    }
    
    // Llamar a la función actualizarReloj cada segundo para actualizar el reloj en tiempo real
    setInterval(actualizarReloj, 1000);


    // Obtener el elemento select
const selectIdioma = <HTMLInputElement>document.getElementById('SelectorIdioma');
const idioma = <HTMLInputElement>document.getElementById('idioma');
const TextInput = <HTMLInputElement>document.getElementById('TextInput');

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


    let btnGuardar = <HTMLElement>document.getElementById("BEnviar");

    btnGuardar.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón guardar.");
        let form = <HTMLFormElement>document.getElementById("formStatus");
        if (form) {
            form.action = "enviarJustificacion.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = <HTMLFormElement>document.getElementById("formStatus");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    
    btnGuardar.addEventListener('mouseout', () => {
        let form = <HTMLFormElement>document.getElementById("formStatus");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = <HTMLFormElement>document.getElementById("formStatus");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    let btnEnviar = <HTMLElement>document.getElementById("BGuardar");
    
    btnEnviar.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón enviar.");
        let form = <HTMLFormElement>document.getElementById("formStatus");
        if (form) {
            form.action = "guardarJustificacion.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = <HTMLFormElement>document.getElementById("formStatus");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    
    btnEnviar.addEventListener('mouseout', () => {
        let form = <HTMLFormElement>document.getElementById("formStatus");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = <HTMLFormElement>document.getElementById("formStatus");
            console.log("Nuevo action del formulario:", form2);
        }
    });
});
