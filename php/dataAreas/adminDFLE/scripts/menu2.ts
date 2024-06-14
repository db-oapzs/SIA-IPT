"use strict";

window.addEventListener("load", () => {
    console.log("menu2 script cargado");

    const btnMenuAd = document.getElementById("btnicoMenu") as HTMLElement;
    const btnMenuAccion = document.getElementById("btnMenuAccion") as HTMLElement;
    const itemsM = document.getElementById("itemsM") as HTMLElement;
    const navMenuAd = document.getElementById("navMenuAd") as HTMLElement;

    if (btnMenuAd && btnMenuAccion && itemsM && navMenuAd) {
        const animateWidth = (element: HTMLElement, start: number, end: number, duration: number, callback?: () => void) => {
            const startTime = performance.now();

            const step = (currentTime: number) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const width = start + (end - start) * progress;
                element.style.width = `${width}px`;

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else if (callback) {
                    callback();
                }
            };

            requestAnimationFrame(step);
        };

        btnMenuAccion.addEventListener('click', () => {
            if (btnMenuAd.classList.contains("gg-close")) {
                btnMenuAd.classList.remove("gg-close");
                btnMenuAd.classList.add("gg-menu");
                itemsM.style.display = "none";
                animateWidth(navMenuAd, 400, 50, 200);
            } else {
                btnMenuAd.classList.remove("gg-menu");
                btnMenuAd.classList.add("gg-close");
                animateWidth(navMenuAd, 50, 400, 200, () => {
                    itemsM.style.display = "flex";
                });
            }
        });
    } else {
        console.error("Elementos no encontrados: btnicoMenu, btnMenuAccion, itemsM o navMenuAd");
    }
});
