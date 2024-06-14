"use strict";
window.addEventListener("load", function () {
    console.log("DOM cargado");
    var conts = document.querySelectorAll("#contpadre");
    var _loop_1 = function (i) {
        var cont = conts[i];
        var txt = cont.querySelectorAll("#data-fecha > p");
        txt.forEach(function (p, index) {
            p.textContent = "página " + (i + 1) + " de " + (conts.length);
            console.log(p.textContent);
        });
    };
    for (var i = 0; i < conts.length; i++) {
        _loop_1(i);
    }
});
