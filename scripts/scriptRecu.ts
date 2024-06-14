"use strict";

window.addEventListener("load", () => {
    console.log("DOM  Recuperación");
    document.getElementById('form-reset-password')!.addEventListener('submit', function (event) {
        event.preventDefault(); 
        var correo = (document.getElementsByName('correo')[0] as HTMLInputElement).value;
        document.getElementById('correo-confirmado')!.innerText = correo;
        (document.getElementById('mensaje-confirmacion') as HTMLElement).style.display = 'block';
    });

    let int_correo = document.querySelectorAll<HTMLInputElement>('#intCorreo1, #intCorreo2');    let primerCorreo = "";
    int_correo[0].addEventListener('input', () => {
        primerCorreo = int_correo[0].value;
    });
    let btnEntrar = <HTMLElement>document.getElementById("btnEnviar");

    function validarCorreo(correo) {
        const regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return regexCorreo.test(correo);
    }

    int_correo.forEach(element => {
        element.addEventListener('input', () => {
            if (validarCorreo(element.value)) {
                element.style.border = "2px solid green";  
                if (int_correo[1].value === primerCorreo) { 
                    int_correo[1].style.border = "2px solid green"; 
                    console.log("Los correos son correctos");
                    let status = true;
                    btnEntrar.style.transition = "100ms all linear"
                    btnEntrar.style.display="flex";
                } else {
                    int_correo[1].style.border = "2px solid red"; 
                    console.log("Los correos no coinciden");
                    let status = false;
                    btnEntrar.style.display="none";
                }
            } else {
                element.style.border = "2px solid red"; 
            }
            if (element.value === "") {
                element.style.border = "1px solid #ccc"; 
            }
        });
    });
});
