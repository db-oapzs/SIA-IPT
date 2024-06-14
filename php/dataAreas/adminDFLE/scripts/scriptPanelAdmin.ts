"use strict";
window.addEventListener("load", ()=>{
    console.log("scritPad cargado");
    let modalescont = document.querySelectorAll(".btnModifUser");
    for(let i = 0 ; i < modalescont.length ; i++) {
        modalescont[i].addEventListener('click',()=>{
            
        });
    }
    let conTbtnCls = document.querySelectorAll(".conTbtnCls");
    let contModModif = document.querySelectorAll(".contModModif");
    for (let i = 0; i < conTbtnCls.length; i++) {
        conTbtnCls[i].addEventListener('click', () => {
            if (contModModif[i] instanceof HTMLElement) {
                (contModModif[i] as HTMLElement).style.display = 'none';
            }
        });
    }
    let btnAgU = <HTMLElement>document.getElementById('txtAgU');
    let modalAgUsr = <HTMLElement>document.getElementById('modalAgUsr');
    btnAgU.addEventListener('click',()=>{
        console.log('btn agr nuw user');
        modalAgUsr.style.display="flex";
    });
    let btnAgrCrmod = <HTMLElement>document.getElementById('btnAgrCrmod');
    btnAgrCrmod.addEventListener('click',()=>{
        console.log('btn cerrar nuw user');
        modalAgUsr.style.display="none";
    });
    
});