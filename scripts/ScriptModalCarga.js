window.addEventListener('load',()=>{
    console.log("DOM cargado");

    function MostrarModal(Mostrar)
    {
        let modal = document.getElementById("contModal-carga");
        if (Mostrar){
            console.log("Modal habilitado");
            modal.style.display = "flex";
            modal.style.position = 'fixed';
            modal.style.zIndex = "9999";
            modal.style.height = document.documentElement.scrollHeight + "px !important";
            
        }else{
            console.log("Modal deshabilitado");
            modal.style.display = "none";
            modal.style.zIndex = "100";
            modal.style.height = 0;
            modal.style.position = 'relative';
        }
    }
    console.log(document.documentElement.scrollHeight);
    MostrarModal(false);
    let btnEnviar_1 = document.getElementById("btnEnviar");
    btnEnviar_1.addEventListener("click",()=>{
        MostrarModal(true);
    });
    let btnEnviar_2 = document.getElementById("btnGuardar");
    btnEnviar_2.addEventListener("click",()=>{
        MostrarModal(true);
    });
});