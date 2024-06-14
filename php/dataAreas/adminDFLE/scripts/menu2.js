"use strict";
window.addEventListener("load", function () {
    console.log("menu2 script cargado");
    var btnMenuAd = document.getElementById("btnicoMenu");
    var btnMenuAccion = document.getElementById("btnMenuAccion");
    var itemsM = document.getElementById("itemsM");
    var navMenuAd = document.getElementById("navMenuAd");
    if (btnMenuAd && btnMenuAccion && itemsM && navMenuAd) {
        var animateWidth_1 = function (element, start, end, duration, callback) {
            var startTime = performance.now();
            var step = function (currentTime) {
                var elapsed = currentTime - startTime;
                var progress = Math.min(elapsed / duration, 1);
                var width = start + (end - start) * progress;
                element.style.width = "".concat(width, "px");
                if (progress < 1) {
                    requestAnimationFrame(step);
                }
                else if (callback) {
                    callback();
                }
            };
            requestAnimationFrame(step);
        };
        btnMenuAccion.addEventListener('click', function () {
            if (btnMenuAd.classList.contains("gg-close")) {
                btnMenuAd.classList.remove("gg-close");
                btnMenuAd.classList.add("gg-menu");
                itemsM.style.display = "none";
                animateWidth_1(navMenuAd, 400, 50, 200);
            }
            else {
                btnMenuAd.classList.remove("gg-menu");
                btnMenuAd.classList.add("gg-close");
                animateWidth_1(navMenuAd, 50, 400, 200, function () {
                    itemsM.style.display = "flex";
                });
            }
        });
    }
    else {
        console.error("Elementos no encontrados: btnicoMenu, btnMenuAccion, itemsM o navMenuAd");
    }
});
