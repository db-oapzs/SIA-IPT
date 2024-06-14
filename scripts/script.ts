"use strict";
window.addEventListener("load",()=>{
    console.log("DOM cargado");
    let btnMenu = <HTMLElement>document.getElementById("btnMenu");
    let icoMenu = <HTMLElement>document.getElementById("icobtn");
    let menu_R = <HTMLElement>document.getElementById("menuGob_r");
    btnMenu.addEventListener("click", () => {
        if (icoMenu.classList.contains("gg-menu")) {
            icoMenu.classList.remove("gg-menu");
            icoMenu.classList.add("gg-close"); 
            menu_R.style.height = "300px";
            menu_R.style.paddingTop = "150px";
        } else if (icoMenu.classList.contains("gg-close")) {
            icoMenu.classList.remove("gg-close");
            icoMenu.classList.add("gg-menu");
            menu_R.style.height = "0px";
            menu_R.style.paddingTop = "0px";
        }
    });
});