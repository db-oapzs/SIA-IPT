window.addEventListener('load', () => {
  console.log("DOM cargado");

  let btnCerrar = document.getElementById("Btn-CerrarModal");
  btnCerrar.addEventListener('click', () => {
    console.log("se ha presionado el btn cerrar");
    let contModal = document.getElementById("contModal-1");
    contModal.style.display = "none";
  });
});