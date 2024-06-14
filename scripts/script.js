"use strict";
window.addEventListener("load", function () {
    console.log("DOM cargado");
    var btnMenu = document.getElementById("btnMenu");
    var icoMenu = document.getElementById("icobtn");
    var menu_R = document.getElementById("menuGob_r");
    btnMenu.addEventListener("click", function () {
        if (icoMenu.classList.contains("gg-menu")) {
            icoMenu.classList.remove("gg-menu");
            icoMenu.classList.add("gg-close");
            menu_R.style.height = "300px";
            menu_R.style.paddingTop = "150px";
        }
        else if (icoMenu.classList.contains("gg-close")) {
            icoMenu.classList.remove("gg-close");
            icoMenu.classList.add("gg-menu");
            menu_R.style.height = "0px";
            menu_R.style.paddingTop = "0px";
        }
    });
});
