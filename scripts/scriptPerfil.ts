"use strict";
window.addEventListener("load",()=>{
    console.log("DOM cargado");
let dataSum = (dtHom: string): HTMLInputElement | null => {
    let _HbasicMs = document.querySelector(dtHom);
    let dta = _HbasicMs?.getAttribute("id");
    let HbasicMs = document.querySelector("#" + dtHom + " > input");
    if (HbasicMs) {
        let newId = dta ? dta + "_input" : "input";
        HbasicMs.setAttribute("id", newId);
        return HbasicMs as HTMLInputElement;
    } else {
        console.log("Elemento no encontrado.");
        return null;
    }
};


function dataSumNiv(dt1: HTMLInputElement | null, dt2: HTMLInputElement | null, dttotal: string){
    if (dt1 && dt2) {
        dt1.addEventListener("input", () => {
            let dt2Element = dataSum(dttotal) as HTMLInputElement;
            if (dt2Element) {
                let newValue = (+dt1.value + +dt2.value).toString(); // Suma de los valores
                newValue = newValue.replace(/\D/g, ''); // Reemplazo de caracteres no numéricos
                dt2Element.value = newValue; // Asignar el nuevo valor al elemento
            }
        });        
        dt2.addEventListener("input", () => {
            let dt2Element = dataSum(dttotal) as HTMLInputElement;
            if (dt2Element) {
                let newValue = (+dt1.value + +dt2.value).toString(); // Suma de los valores
                newValue = newValue.replace(/\D/g, ''); // Reemplazo de caracteres no numéricos
                dt2Element.value = newValue; // Asignar el nuevo valor al elemento
            }
        });
        
    }
}
let datosCeldas = document.querySelectorAll(".dataCeldas > input");

for (let i = 0; i < datosCeldas.length; i++) {
    datosCeldas[i].addEventListener("input", function(event) {
        let input = event.target as HTMLInputElement;
        let valor = input.value;
        // Remover cualquier carácter que no sea un número
        input.value = valor.replace(/\D/g, '');
    });
}


let HbasicMS = dataSum("HbasicMs");
let MbasicMS = dataSum("MbasicMs");
dataSumNiv(HbasicMS, MbasicMS, "TbasicMs");
let HinterMs = dataSum("HinterMs");
let MinterMs = dataSum("MinterMs");
dataSumNiv(HinterMs, MinterMs, "TinterMs");
let HavanzMs = dataSum("HavanzMs");
let MavanzMs = dataSum("MavanzMs");
dataSumNiv(HavanzMs, MavanzMs, "TavanzMs");
let HsupMs = dataSum("HsupMs");
let MsupMs = dataSum("MsupMs");
dataSumNiv(HsupMs, MsupMs, "TsupMs");


let HbasicSup = dataSum("HbasicSup");
let MbasicSup = dataSum("MbasicSup");
dataSumNiv(HbasicSup, MbasicSup, "TbasicSup");
let HinterSup = dataSum("HinterSup");
let MinterSup = dataSum("MinterSup");
dataSumNiv(HinterSup, MinterSup, "TinterSup");
let HavanzSup = dataSum("HavanzSup");
let MavanzSup = dataSum("MavanzSup");
dataSumNiv(HavanzSup, MavanzSup, "TavanzSup");
let HsupSup = dataSum("HsupSup");
let MsupSup = dataSum("MsupSup");
dataSumNiv(HsupSup, MsupSup, "TsupSup");



let HbasicPos = dataSum("HbasicPos");
let MbasicPos = dataSum("MbasicPos");
dataSumNiv(HbasicPos, MbasicPos, "TbasicPos");
let HinterPos = dataSum("HinterPos");
let MinterPos = dataSum("MinterPos");
dataSumNiv(HinterPos, MinterPos, "TinterPos");
let HavanzPos = dataSum("HavanzPos");
let MavanzPos = dataSum("MavanzPos");
dataSumNiv(HavanzPos, MavanzPos, "TavanzPos");
let HsupPos = dataSum("HsupPos");
let MsupPos = dataSum("MsupPos");
dataSumNiv(HsupPos, MsupPos, "TsupPos");



let HbasicEgr = dataSum("HbasicEgr");
let MbasicEgr = dataSum("MbasicEgr");
dataSumNiv(HbasicEgr, MbasicEgr, "TbasicEgr");
let HinterEgr = dataSum("HinterEgr");
let MinterEgr = dataSum("MinterEgr");
dataSumNiv(HinterEgr, MinterEgr, "TinterEgr");
let HavanzEgr = dataSum("HavanzEgr");
let MavanzEgr = dataSum("MavanzEgr");
dataSumNiv(HavanzEgr, MavanzEgr, "TavanzEgr");
let HsupEgr = dataSum("HsupEgr");
let MsupEgr = dataSum("MsupEgr");
dataSumNiv(HsupEgr, MsupEgr, "TsupEgr");


let HbasicEmp = dataSum("HbasicEmp");
let MbasicEmp = dataSum("MbasicEmp");
dataSumNiv(HbasicEmp, MbasicEmp, "TbasicEmp");
let HinterEmp = dataSum("HinterEmp");
let MinterEmp = dataSum("MinterEmp");
dataSumNiv(HinterEmp, MinterEmp, "TinterEmp");
let HavanzEmp = dataSum("HavanzEmp");
let MavanzEmp = dataSum("MavanzEmp");
dataSumNiv(HavanzEmp, MavanzEmp, "TavanzEmp");
let HsupEmp = dataSum("HsupEmp");
let MsupEmp = dataSum("MsupEmp");
dataSumNiv(HsupEmp, MsupEmp, "TsupEmp");



let HbasicPg = dataSum("HbasicPg");
let MbasicPg = dataSum("MbasicPg");
dataSumNiv(HbasicPg, MbasicPg, "TbasicPg");
let HinterPg = dataSum("HinterPg");
let MinterPg = dataSum("MinterPg");
dataSumNiv(HinterPg, MinterPg, "TinterPg");
let HavanzPg = dataSum("HavanzPg");
let MavanzPg = dataSum("MavanzPg");
dataSumNiv(HavanzPg, MavanzPg, "TavanzPg");
let HsupPg = dataSum("HsupPg");
let MsupPg = dataSum("MsupPg");
dataSumNiv(HsupPg, MsupPg, "TsupPg");

let bloqueaIntputs = (arraySup: string[], status: boolean) => {
    for(let i = 0; i < arraySup.length; i++){
        let input = document.querySelector('#'+arraySup[i] + ' > input');
        if(input instanceof HTMLInputElement) {
            if(status === true){
                input.readOnly = true;
            }else{
                input.readOnly = false;
            }
        }
    }    
};

let nivMS = <HTMLElement>document.getElementById("nivS");

let arraySup = [
    'HbasicSup',
    'MbasicSup',
    'HinterSup',
    'MinterSup',
    'HavanzSup',
    'MavanzSup',
    'HsupSup',
    'MsupSup'
];

bloqueaIntputs(arraySup,true);
nivMS.addEventListener('click', () => {
    let block_cont1 = document.getElementById("block-cont1");

    if (block_cont1) {
        if (block_cont1.style.display === "flex") {
            block_cont1.style.display = "none";
            bloqueaIntputs(arraySup,false);
        } else {
            block_cont1.style.display = "flex";
            bloqueaIntputs(arraySup,true);
        }
    }
});
nivMS.click();

let nivPos = <HTMLElement>document.getElementById("nivPos");
let arrayPos = [
    'HbasicPos',
    'MbasicPos',
    'HinterPos',
    'MinterPos',
    'HavanzPos',
    'MavanzPos',
    'HsupPos',
    'MsupPos'
];
bloqueaIntputs(arrayPos,true);
nivPos.addEventListener('click', () => {
    let block_cont = document.getElementById("block-cont2");

    if (block_cont) {
        if (block_cont.style.display === "flex") {
            block_cont.style.display = "none";
            bloqueaIntputs(arrayPos,false);
        } else {
            block_cont.style.display = "flex";
            bloqueaIntputs(arrayPos,true);
        }
    }
});
nivPos.click();
let nivEg = <HTMLElement>document.getElementById("nivEg");
let arrayEgr = [
    'HbasicEgr',
    'MbasicEgr',
    'HinterEgr',
    'MinterEgr',
    'HavanzEgr',
    'MavanzEgr',
    'HsupEgr',
    'MsupEgr'
];
bloqueaIntputs(arrayEgr,true);
nivEg.addEventListener('click', () => {
    let block_cont = document.getElementById("block-cont3");

    if (block_cont) {
        if (block_cont.style.display === "flex") {
            block_cont.style.display = "none";
            bloqueaIntputs(arrayEgr,false);
        } else {
            block_cont.style.display = "flex";
            bloqueaIntputs(arrayEgr,true);
        }
    }
});
nivEg.click();
let nivEmp = <HTMLElement>document.getElementById("nivEmp");
let arrayEmp = [
    'HbasicEmp',
    'MbasicEmp',
    'HinterEmp',
    'MinterEmp',
    'HavanzEmp',
    'MavanzEmp',
    'HsupEmp',
    'MsupEmp'
];
bloqueaIntputs(arrayEmp,true);
nivEmp.addEventListener('click', () => {
    let block_cont = document.getElementById("block-cont4");

    if (block_cont) {
        if (block_cont.style.display === "flex") {
            block_cont.style.display = "none";
            bloqueaIntputs(arrayEmp,false);
        } else {
            block_cont.style.display = "flex";
            bloqueaIntputs(arrayEmp,true);
        }
    }
});
nivEmp.click();
let nivPG = <HTMLElement>document.getElementById("nivPG");
let arrayPg = [
    'HbasicPg',
    'MbasicPg',
    'HinterPg',
    'MinterPg',
    'HavanzPg',
    'MavanzPg',
    'HsupPg',
    'MsupPg'
];
bloqueaIntputs(arrayPg,true);
nivPG.addEventListener('click', () => {
    let block_cont = document.getElementById("block-cont5");

    if (block_cont) {
        if (block_cont.style.display === "flex") {
            block_cont.style.display = "none";
            bloqueaIntputs(arrayPg,false);
        } else {
            block_cont.style.display = "flex";
            bloqueaIntputs(arrayPg,true);
        }
    }
});
nivPG.click();
let nivMS_ = <HTMLElement>document.getElementById("nivMS");
let arrayMs = [
    'HbasicMs',
    'MbasicMs',
    'HinterMs',
    'MinterMs',
    'HavanzMs',
    'MavanzMs',
    'HsupMs',
    'MsupMs'
];
nivMS_.addEventListener('click', () => {
    let block_cont = document.getElementById("block-cont0");

    if (block_cont) {
        if (block_cont.style.display === "flex") {
            block_cont.style.display = "none";
            bloqueaIntputs(arrayMs,false);
        } else {
            block_cont.style.display = "flex";
            bloqueaIntputs(arrayMs,true);
        }
    }
});


function sumaDataFilas(
    dt1: HTMLInputElement | null,
    dt2: HTMLInputElement | null,
    dt3: HTMLInputElement | null,
    dt4: HTMLInputElement | null,
    dttotal: string,
    totaloriguen: string,
    totaldestino: string,
    totaltolal: string
) {
    const updateTotal = () => {
        if (dt1 && dt2 && dt3 && dt4) {
            let total = +dt1.value + +dt2.value + +dt3.value + +dt4.value;
            let newValue = total.toString().replace(/\D/g, '');
            const dt2Element = dataSum(dttotal) as HTMLInputElement;
            if (dt2Element) {
                dt2Element.value = newValue;
                    let input1 = dataSum(String(totaloriguen)) as HTMLInputElement;
                    let input2 = dataSum(String(totaldestino)) as HTMLInputElement;
                    if (input1 && input2) {
                        let totalValue = +input1.value + +input2.value;
                        console.log("Total de HtotalMs y MtotalMs: " + totalValue);
                        let salida = dataSum(String(totaltolal)) as HTMLInputElement;
                        salida.value = String(totalValue);
                    }
            }
        }
    };

    if (dt1) {
        dt1.addEventListener("input", updateTotal);
    }
    if (dt2) {
        dt2.addEventListener("input", updateTotal);
    }
    if (dt3) {
        dt3.addEventListener("input", updateTotal);
    }
    if (dt4) {
        dt4.addEventListener("input", updateTotal);
    }
}



let _HbasicMs = dataSum("HbasicMs");
let _HinterMs = dataSum("HinterMs");
let _HavanzMs = dataSum("HavanzMs");
let _HsupMs = dataSum("HsupMs");
sumaDataFilas(_HbasicMs,_HinterMs,_HavanzMs,_HsupMs,"HtotalMs","HtotalMs","MtotalMs","TtotalMs");
let _MbasicMs = dataSum("MbasicMs");
let _MinterMs = dataSum("MinterMs");
let _MavanzMs = dataSum("MavanzMs");
let _MsupMs = dataSum("MsupMs");
sumaDataFilas(_MbasicMs,_MinterMs,_MavanzMs,_MsupMs,"MtotalMs","HtotalMs","MtotalMs","TtotalMs");

// ? ----------------------------------------------------------

let _HbasicSup = dataSum("HbasicSup");
let _HinterSup = dataSum("HinterSup");
let _HavanzSup = dataSum("HavanzSup");
let _HsupSup = dataSum("HsupSup");
sumaDataFilas(_HbasicSup,_HinterSup,_HavanzSup,_HsupSup,"HtotalSup","HtotalSup","MtotalSup","TtotalSup");
let _MbasicSup = dataSum("MbasicSup");
let _MinterSup = dataSum("MinterSup");
let _MavanzSup = dataSum("MavanzSup");
let _MsupSup = dataSum("MsupSup");
sumaDataFilas(_MbasicSup,_MinterSup,_MavanzSup,_MsupSup,"MtotalSup","HtotalSup","MtotalSup","TtotalSup");

// ? ----------------------------------------------------------

let _HbasicPos = dataSum("HbasicPos");
let _HinterPos = dataSum("HinterPos");
let _HavanzPos = dataSum("HavanzPos");
let _HsupPos = dataSum("HsupPos");
sumaDataFilas(_HbasicPos,_HinterPos,_HavanzPos,_HsupPos,"HtotalPos","HtotalPos","MtotalPos","TtotalPos");
let _MbasicPos = dataSum("MbasicPos");
let _MinterPos = dataSum("MinterPos");
let _MavanzPos = dataSum("MavanzPos");
let _MsupPos = dataSum("MsupPos");
sumaDataFilas(_MbasicPos,_MinterPos,_MavanzPos,_MsupPos,"MtotalPos","HtotalPos","MtotalPos","TtotalPos");

// ? ----------------------------------------------------------

let _HbasicEmp = dataSum("HbasicEmp");
let _HinterEmp = dataSum("HinterEmp");
let _HavanzEmp = dataSum("HavanzEmp");
let _HsupEmp = dataSum("HsupEmp");
sumaDataFilas(_HbasicEmp,_HinterEmp,_HavanzEmp,_HsupEmp,"HtotalEmp","HtotalEmp","MtotalEmp","TtotalEmp");
let _MbasicEmp = dataSum("MbasicEmp");
let _MinterEmp = dataSum("MinterEmp");
let _MavanzEmp = dataSum("MavanzEmp");
let _MsupEmp = dataSum("MsupEmp");
sumaDataFilas(_MbasicEmp,_MinterEmp,_MavanzEmp,_MsupEmp,"MtotalEmp","HtotalEmp","MtotalEmp","TtotalEmp");

// ? ----------------------------------------------------------

let _HbasicEgr = dataSum("HbasicEgr");
let _HinterEgr = dataSum("HinterEgr");
let _HavanzEgr= dataSum("HavanzEgr");
let _HsupEgr = dataSum("HsupEmp");
sumaDataFilas(_HbasicEgr,_HinterEgr,_HavanzEgr,_HsupEgr,"HtotalEgr","HtotalEgr","MtotalEgr","TtotalEgr");
let _MbasicEgr = dataSum("MbasicEgr");
let _MinterEgr = dataSum("MinterEgr");
let _MavanzEgr = dataSum("MavanzEgr");
let _MsupEgr = dataSum("MsupEgr");
sumaDataFilas(_MbasicEgr,_MinterEgr,_MavanzEgr,_MsupEgr,"MtotalEgr","HtotalEgr","MtotalEgr","TtotalEgr");


// ? ----------------------------------------------------------

let _HbasicPg = dataSum("HbasicPg");
let _HinterPg = dataSum("HinterPg");
let _HavanzPg = dataSum("HavanzPg");
let _HsupPg = dataSum("HsupPg");
sumaDataFilas(_HbasicPg,_HinterPg,_HavanzPg,_HsupPg,"HtotalPg","HtotalPg","MtotalPg","TtotalPg");
let _MbasicPg = dataSum("MbasicPg");
let _MinterPg = dataSum("MinterPg");
let _MavanzPg = dataSum("MavanzPg");
let _MsupPg = dataSum("MsupPg");
sumaDataFilas(_MbasicPg,_MinterPg,_MavanzPg,_MsupPg,"MtotalPg","HtotalPg","MtotalPg","TtotalPg");

const selectIdioma = <HTMLSelectElement>document.getElementById('selectCont');
//const idioma = <HTMLInputElement>document.getElementById('idioma');
let elegirBTN = <HTMLInputElement> document.getElementById("elegirBTN");
let dtPidioma = <HTMLInputElement> document.getElementById("dtPidioma");
let dtsPASSado = <HTMLInputElement> document.getElementById("dtsPASSado");

elegirBTN.click();

   // Agregar un event listener para el evento 'change'
   selectIdioma.addEventListener('change', () => {
    // Obtener el valor seleccionado del select
    let idiomaSeleccionado = selectIdioma.value;
    
    // Verificar si se ha seleccionado un idioma válido
    if (idiomaSeleccionado !== "") {
        // Se ha seleccionado un idioma, puedes realizar acciones aquí
        console.log("Se ha seleccionado el idioma: " + idiomaSeleccionado);
        dtPidioma.value = idiomaSeleccionado;
        //idioma.value = idiomaSeleccionado;
        elegirBTN.click();

        dtsPASSado.click();

        selectIdioma.value = idiomaSeleccionado;

    } else {
        // No se ha seleccionado ningún idioma válido
        console.log("No se ha seleccionado ningún idioma");
    }

});



let btnGuardar = <HTMLElement>document.getElementById("btnGuardar");

btnGuardar.addEventListener('mouseover', () => {
    console.log("El mouse está sobre el botón guardar.");
    let form = <HTMLFormElement>document.getElementById("tableForm");
    if (form) {
        form.action = "guardarDataTable.php"; // Reemplaza "nueva_url" con la URL deseada
        let form2 = <HTMLFormElement>document.getElementById("tableForm");
        console.log("Nuevo action del formulario:", form2);
    }
});

btnGuardar.addEventListener('mouseout', () => {
    let form = <HTMLFormElement>document.getElementById("tableForm");
    if (form) {
        form.action = "indefinido"; // Restaura el action original
        let form2 = <HTMLFormElement>document.getElementById("tableForm");
        console.log("Nuevo action del formulario:", form2);
    }
});
let btnEnviar = <HTMLElement>document.getElementById("btnEnviar");

btnEnviar.addEventListener('mouseover', () => {
    console.log("El mouse está sobre el botón enviar.");
    let form = <HTMLFormElement>document.getElementById("tableForm");
    if (form) {
        form.action = "enviarDataTable.php"; // Reemplaza "nueva_url" con la URL deseada
        let form2 = <HTMLFormElement>document.getElementById("tableForm");
        console.log("Nuevo action del formulario:", form2);
    }
});

btnEnviar.addEventListener('mouseout', () => {
    let form = <HTMLFormElement>document.getElementById("tableForm");
    if (form) {
        form.action = "indefinido"; // Restaura el action original
        let form2 = <HTMLFormElement>document.getElementById("tableForm");
        console.log("Nuevo action del formulario:", form2);
    }
});


let btnNotifi = <HTMLElement>document.getElementById("btnNotifi");

btnNotifi.addEventListener('click', () => {
    let menuNotifi = document.getElementById("menuNotifi");

    if (menuNotifi) {
        if (menuNotifi.style.display === "flex") {
            menuNotifi.style.display = "none";
        } else {
            menuNotifi.style.display = "flex";
        }
    }
});
let btnMuser = <HTMLElement>document.getElementById("btnMuser");

btnMuser.addEventListener('click', () => {
    let menuUser = document.getElementById("menuUser");

    if (menuUser) {
        if (menuUser.style.display === "flex") {
            menuUser.style.display = "none";
        } else {
            menuUser.style.display = "flex";
        }
    }
});

function insertSpaceInInputs() {
    const inputs = document.querySelectorAll<HTMLInputElement>(".dataCeldas > input");
    
    inputs.forEach(input => {
        const start = input.selectionStart;
        const end = input.selectionEnd;
        if (start !== null && end !== null) {
            input.setRangeText(' ', start, end, 'end');
            
            // Despacha eventos de input y change para asegurar que cualquier listener se dispare
            const inputEvent = new Event('input', { bubbles: true });
            const changeEvent = new Event('change', { bubbles: true });
            input.dispatchEvent(inputEvent);
            input.dispatchEvent(changeEvent);
        }
    });
}

// Llama a la función
insertSpaceInInputs();

});