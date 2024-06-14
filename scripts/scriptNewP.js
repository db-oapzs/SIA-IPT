"use strict";
window.addEventListener("load", function () {
    console.log("DOM Loaded - NewPassword");
    var password1Input = document.getElementById("passW1");
    var password2Input = document.getElementById("passW2");
    var btnEntrar = document.getElementById("btnEntrar");
    if (password1Input && password2Input && btnEntrar) {
        password1Input.addEventListener('input', function () {
            var contenido = password1Input.value;
            // Expresión regular actualizada para verificar la complejidad de la contraseña.
            var controlSeguridad = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!¡¿?#$%&+\-._;,="@]).{8,}$/;
            // Ahora, utilizando correctamente el método .test() para evaluar el contenido.
            var isValid = controlSeguridad.test(contenido);
            console.log("¿Es válida la contraseña?", isValid);
            if (isValid) {
                password1Input.style.border = "2px solid green";
            }
            else {
                password1Input.style.border = "2px solid red";
            }
            if (contenido == "") {
                password1Input.style.border = "0";
            }
            // Comprobar si el valor de la segunda contraseña coincide con la primera
            if (password2Input.value === contenido) {
                password2Input.style.border = "2px solid green";
                btnEntrar.style.display = "flex";
            }
            else {
                password2Input.style.border = "2px solid red";
                btnEntrar.style.display = "none";
            }
            if (password2Input.value === "") {
                password2Input.style.border = "0";
            }
        });
        password2Input.addEventListener('input', function () {
            var contenido = password2Input.value;
            var password1Value = password1Input.value;
            if (contenido === password1Value) {
                password2Input.style.border = "2px solid green";
                btnEntrar.style.display = "flex";
            }
            else {
                password2Input.style.border = "2px solid red";
                btnEntrar.style.display = "none";
            }
            if (contenido === "") {
                password2Input.style.border = "0";
            }
        });
    }
    else {
        console.log("El elemento passW1, passW2 o btnEntrar no fueron encontrados.");
    }
});
