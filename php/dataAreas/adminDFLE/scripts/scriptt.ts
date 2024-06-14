"use strict";
window.addEventListener("load", () => {
    console.log("DOM cargado");
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
