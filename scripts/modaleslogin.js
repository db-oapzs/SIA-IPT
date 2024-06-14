"use strict";
window.addEventListener("load", function () {
    console.log("Dom cargado");
    var btncloseModal = document.getElementById("btncloss");
    var modal = document.getElementById("cont-modalCorreo");
    function hideScrollbar() {
        document.body.style.overflow = "hidden";
    }
    function showScrollbar() {
        document.body.style.overflow = "auto";
    }
    function scrollToTop() {
        window.scrollTo(0, 0);
    }
    btncloseModal.addEventListener('click', function () {
        modal.style.display = "none";
        showScrollbar();
    });
    modal.addEventListener('click', function (event) {
        event.stopPropagation();
    });
    document.body.addEventListener('click', function () {
        modal.style.display = "none";
        showScrollbar();
    });
    hideScrollbar();
    scrollToTop();
});
