"use strict";
window.addEventListener("load", function () {
    console.log("scritPad cargado");
    var modalescont = document.querySelectorAll(".btnModifUser");
    for (var i = 0; i < modalescont.length; i++) {
        modalescont[i].addEventListener('click', function () {
        });
    }
    var conTbtnCls = document.querySelectorAll(".conTbtnCls");
    var contModModif = document.querySelectorAll(".contModModif");
    var _loop_1 = function (i) {
        conTbtnCls[i].addEventListener('click', function () {
            if (contModModif[i] instanceof HTMLElement) {
                contModModif[i].style.display = 'none';
            }
        });
    };
    for (var i = 0; i < conTbtnCls.length; i++) {
        _loop_1(i);
    }
    var btnAgU = document.getElementById('txtAgU');
    var modalAgUsr = document.getElementById('modalAgUsr');
    btnAgU.addEventListener('click', function () {
        console.log('btn agr nuw user');
        modalAgUsr.style.display = "flex";
    });
    var btnAgrCrmod = document.getElementById('btnAgrCrmod');
    btnAgrCrmod.addEventListener('click', function () {
        console.log('btn cerrar nuw user');
        modalAgUsr.style.display = "none";
    });
});
