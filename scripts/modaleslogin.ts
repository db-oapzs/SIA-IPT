"use strict";
window.addEventListener("load", () => {
    console.log("Dom cargado");
    let btncloseModal = <HTMLElement>document.getElementById("btncloss");
    let modal = <HTMLElement>document.getElementById("cont-modalCorreo");
    
    function hideScrollbar() {
        document.body.style.overflow = "hidden";
    }
    
    function showScrollbar() {
        document.body.style.overflow = "auto";
    }

    function scrollToTop() {
        window.scrollTo(0, 0);
    }

    btncloseModal.addEventListener('click', () => {
        modal.style.display = "none";
        showScrollbar(); 
    });

    modal.addEventListener('click', (event) => {
        event.stopPropagation();
    });

    document.body.addEventListener('click', () => {
        modal.style.display = "none";
        showScrollbar(); 
    });

    hideScrollbar();

    scrollToTop();
});
