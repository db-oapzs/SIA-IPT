"use strict";
window.addEventListener("load", function () {
    console.log("DOM  Recuperación");

    var int_correo = document.querySelectorAll('#intCorreo1, #intCorreo2');
    var primerCorreo = "";
    int_correo[0].addEventListener('input', function () {
        primerCorreo = int_correo[0].value;
    });
    var btnEntrar = document.getElementById("btnEnviar");
    function validarCorreo(correo) {
        var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return regexCorreo.test(correo);
    }
    int_correo.forEach(function (element) {
        element.addEventListener('input', function () {
            if (validarCorreo(element.value)) {
                element.style.border = "2px solid green";
                if (int_correo[1].value === primerCorreo) {
                    int_correo[1].style.border = "2px solid green";
                    console.log("Los correos son correctos");
                    var status_1 = true;
                    btnEntrar.style.transition = "100ms all linear";
                    btnEntrar.style.display = "flex";
                }
                else {
                    int_correo[1].style.border = "2px solid red";
                    console.log("Los correos no coinciden");
                    var status_2 = false;
                    btnEntrar.style.display = "none";
                }
            }
            else {
                element.style.border = "2px solid red";
            }
            if (element.value === "") {
                element.style.border = "1px solid #ccc";
            }
        });
    });
});
