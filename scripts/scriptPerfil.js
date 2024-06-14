"use strict";
window.addEventListener("load", function () {
    console.log("DOM cargado");
    var dataSum = function (dtHom) {
        var _HbasicMs = document.querySelector(dtHom);
        var dta = _HbasicMs === null || _HbasicMs === void 0 ? void 0 : _HbasicMs.getAttribute("id");
        var HbasicMs = document.querySelector("#" + dtHom + " > input");
        if (HbasicMs) {
            var newId = dta ? dta + "_input" : "input";
            HbasicMs.setAttribute("id", newId);
            return HbasicMs;
        }
        else {
            console.log("Elemento no encontrado.");
            return null;
        }
    };
    function dataSumNiv(dt1, dt2, dttotal) {
        if (dt1 && dt2) {
            dt1.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value + +dt2.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ''); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                }
            });
            dt2.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value + +dt2.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ''); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                }
            });
        }
    }
    var datosCeldas = document.querySelectorAll(".dataCeldas > input");
    for (var i = 0; i < datosCeldas.length; i++) {
        datosCeldas[i].addEventListener("input", function (event) {
            var input = event.target;
            var valor = input.value;
            // Remover cualquier carácter que no sea un número
            input.value = valor.replace(/\D/g, '');
        });
    }
    var HbasicMS = dataSum("HbasicMs");
    var MbasicMS = dataSum("MbasicMs");
    dataSumNiv(HbasicMS, MbasicMS, "TbasicMs");
    var HinterMs = dataSum("HinterMs");
    var MinterMs = dataSum("MinterMs");
    dataSumNiv(HinterMs, MinterMs, "TinterMs");
    var HavanzMs = dataSum("HavanzMs");
    var MavanzMs = dataSum("MavanzMs");
    dataSumNiv(HavanzMs, MavanzMs, "TavanzMs");
    var HsupMs = dataSum("HsupMs");
    var MsupMs = dataSum("MsupMs");
    dataSumNiv(HsupMs, MsupMs, "TsupMs");
    var HbasicSup = dataSum("HbasicSup");
    var MbasicSup = dataSum("MbasicSup");
    dataSumNiv(HbasicSup, MbasicSup, "TbasicSup");
    var HinterSup = dataSum("HinterSup");
    var MinterSup = dataSum("MinterSup");
    dataSumNiv(HinterSup, MinterSup, "TinterSup");
    var HavanzSup = dataSum("HavanzSup");
    var MavanzSup = dataSum("MavanzSup");
    dataSumNiv(HavanzSup, MavanzSup, "TavanzSup");
    var HsupSup = dataSum("HsupSup");
    var MsupSup = dataSum("MsupSup");
    dataSumNiv(HsupSup, MsupSup, "TsupSup");
    var HbasicPos = dataSum("HbasicPos");
    var MbasicPos = dataSum("MbasicPos");
    dataSumNiv(HbasicPos, MbasicPos, "TbasicPos");
    var HinterPos = dataSum("HinterPos");
    var MinterPos = dataSum("MinterPos");
    dataSumNiv(HinterPos, MinterPos, "TinterPos");
    var HavanzPos = dataSum("HavanzPos");
    var MavanzPos = dataSum("MavanzPos");
    dataSumNiv(HavanzPos, MavanzPos, "TavanzPos");
    var HsupPos = dataSum("HsupPos");
    var MsupPos = dataSum("MsupPos");
    dataSumNiv(HsupPos, MsupPos, "TsupPos");
    var HbasicEgr = dataSum("HbasicEgr");
    var MbasicEgr = dataSum("MbasicEgr");
    dataSumNiv(HbasicEgr, MbasicEgr, "TbasicEgr");
    var HinterEgr = dataSum("HinterEgr");
    var MinterEgr = dataSum("MinterEgr");
    dataSumNiv(HinterEgr, MinterEgr, "TinterEgr");
    var HavanzEgr = dataSum("HavanzEgr");
    var MavanzEgr = dataSum("MavanzEgr");
    dataSumNiv(HavanzEgr, MavanzEgr, "TavanzEgr");
    var HsupEgr = dataSum("HsupEgr");
    var MsupEgr = dataSum("MsupEgr");
    dataSumNiv(HsupEgr, MsupEgr, "TsupEgr");
    var HbasicEmp = dataSum("HbasicEmp");
    var MbasicEmp = dataSum("MbasicEmp");
    dataSumNiv(HbasicEmp, MbasicEmp, "TbasicEmp");
    var HinterEmp = dataSum("HinterEmp");
    var MinterEmp = dataSum("MinterEmp");
    dataSumNiv(HinterEmp, MinterEmp, "TinterEmp");
    var HavanzEmp = dataSum("HavanzEmp");
    var MavanzEmp = dataSum("MavanzEmp");
    dataSumNiv(HavanzEmp, MavanzEmp, "TavanzEmp");
    var HsupEmp = dataSum("HsupEmp");
    var MsupEmp = dataSum("MsupEmp");
    dataSumNiv(HsupEmp, MsupEmp, "TsupEmp");
    var HbasicPg = dataSum("HbasicPg");
    var MbasicPg = dataSum("MbasicPg");
    dataSumNiv(HbasicPg, MbasicPg, "TbasicPg");
    var HinterPg = dataSum("HinterPg");
    var MinterPg = dataSum("MinterPg");
    dataSumNiv(HinterPg, MinterPg, "TinterPg");
    var HavanzPg = dataSum("HavanzPg");
    var MavanzPg = dataSum("MavanzPg");
    dataSumNiv(HavanzPg, MavanzPg, "TavanzPg");
    var HsupPg = dataSum("HsupPg");
    var MsupPg = dataSum("MsupPg");
    dataSumNiv(HsupPg, MsupPg, "TsupPg");
    var bloqueaIntputs = function (arraySup, status) {
        for (var i = 0; i < arraySup.length; i++) {
            var input = document.querySelector('#' + arraySup[i] + ' > input');
            if (input instanceof HTMLInputElement) {
                if (status === true) {
                    input.readOnly = true;
                }
                else {
                    input.readOnly = false;
                }
            }
        }
    };
    var nivMS = document.getElementById("nivS");
    var arraySup = [
        'HbasicSup',
        'MbasicSup',
        'HinterSup',
        'MinterSup',
        'HavanzSup',
        'MavanzSup',
        'HsupSup',
        'MsupSup'
    ];
    bloqueaIntputs(arraySup, true);
    nivMS.addEventListener('click', function () {
        var block_cont1 = document.getElementById("block-cont1");
        if (block_cont1) {
            if (block_cont1.style.display === "flex") {
                block_cont1.style.display = "none";
                bloqueaIntputs(arraySup, false);
            }
            else {
                block_cont1.style.display = "flex";
                bloqueaIntputs(arraySup, true);
            }
        }
    });
    nivMS.click();
    var nivPos = document.getElementById("nivPos");
    var arrayPos = [
        'HbasicPos',
        'MbasicPos',
        'HinterPos',
        'MinterPos',
        'HavanzPos',
        'MavanzPos',
        'HsupPos',
        'MsupPos'
    ];
    bloqueaIntputs(arrayPos, true);
    nivPos.addEventListener('click', function () {
        var block_cont = document.getElementById("block-cont2");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayPos, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayPos, true);
            }
        }
    });
    nivPos.click();
    var nivEg = document.getElementById("nivEg");
    var arrayEgr = [
        'HbasicEgr',
        'MbasicEgr',
        'HinterEgr',
        'MinterEgr',
        'HavanzEgr',
        'MavanzEgr',
        'HsupEgr',
        'MsupEgr'
    ];
    bloqueaIntputs(arrayEgr, true);
    nivEg.addEventListener('click', function () {
        var block_cont = document.getElementById("block-cont3");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayEgr, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayEgr, true);
            }
        }
    });
    nivEg.click();
    var nivEmp = document.getElementById("nivEmp");
    var arrayEmp = [
        'HbasicEmp',
        'MbasicEmp',
        'HinterEmp',
        'MinterEmp',
        'HavanzEmp',
        'MavanzEmp',
        'HsupEmp',
        'MsupEmp'
    ];
    bloqueaIntputs(arrayEmp, true);
    nivEmp.addEventListener('click', function () {
        var block_cont = document.getElementById("block-cont4");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayEmp, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayEmp, true);
            }
        }
    });
    nivEmp.click();
    var nivPG = document.getElementById("nivPG");
    var arrayPg = [
        'HbasicPg',
        'MbasicPg',
        'HinterPg',
        'MinterPg',
        'HavanzPg',
        'MavanzPg',
        'HsupPg',
        'MsupPg'
    ];
    bloqueaIntputs(arrayPg, true);
    nivPG.addEventListener('click', function () {
        var block_cont = document.getElementById("block-cont5");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayPg, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayPg, true);
            }
        }
    });
    nivPG.click();
    var nivMS_ = document.getElementById("nivMS");
    var arrayMs = [
        'HbasicMs',
        'MbasicMs',
        'HinterMs',
        'MinterMs',
        'HavanzMs',
        'MavanzMs',
        'HsupMs',
        'MsupMs'
    ];
    nivMS_.addEventListener('click', function () {
        var block_cont = document.getElementById("block-cont0");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayMs, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayMs, true);
            }
        }
    });
    function sumaDataFilas(dt1, dt2, dt3, dt4, dttotal, totaloriguen, totaldestino, totaltolal) {
        var updateTotal = function () {
            if (dt1 && dt2 && dt3 && dt4) {
                var total = +dt1.value + +dt2.value + +dt3.value + +dt4.value;
                var newValue = total.toString().replace(/\D/g, '');
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    dt2Element.value = newValue;
                    var input1 = dataSum(String(totaloriguen));
                    var input2 = dataSum(String(totaldestino));
                    if (input1 && input2) {
                        var totalValue = +input1.value + +input2.value;
                        console.log("Total de HtotalMs y MtotalMs: " + totalValue);
                        var salida = dataSum(String(totaltolal));
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
    var _HbasicMs = dataSum("HbasicMs");
    var _HinterMs = dataSum("HinterMs");
    var _HavanzMs = dataSum("HavanzMs");
    var _HsupMs = dataSum("HsupMs");
    sumaDataFilas(_HbasicMs, _HinterMs, _HavanzMs, _HsupMs, "HtotalMs", "HtotalMs", "MtotalMs", "TtotalMs");
    var _MbasicMs = dataSum("MbasicMs");
    var _MinterMs = dataSum("MinterMs");
    var _MavanzMs = dataSum("MavanzMs");
    var _MsupMs = dataSum("MsupMs");
    sumaDataFilas(_MbasicMs, _MinterMs, _MavanzMs, _MsupMs, "MtotalMs", "HtotalMs", "MtotalMs", "TtotalMs");
    // ? ----------------------------------------------------------
    var _HbasicSup = dataSum("HbasicSup");
    var _HinterSup = dataSum("HinterSup");
    var _HavanzSup = dataSum("HavanzSup");
    var _HsupSup = dataSum("HsupSup");
    sumaDataFilas(_HbasicSup, _HinterSup, _HavanzSup, _HsupSup, "HtotalSup", "HtotalSup", "MtotalSup", "TtotalSup");
    var _MbasicSup = dataSum("MbasicSup");
    var _MinterSup = dataSum("MinterSup");
    var _MavanzSup = dataSum("MavanzSup");
    var _MsupSup = dataSum("MsupSup");
    sumaDataFilas(_MbasicSup, _MinterSup, _MavanzSup, _MsupSup, "MtotalSup", "HtotalSup", "MtotalSup", "TtotalSup");
    // ? ----------------------------------------------------------
    var _HbasicPos = dataSum("HbasicPos");
    var _HinterPos = dataSum("HinterPos");
    var _HavanzPos = dataSum("HavanzPos");
    var _HsupPos = dataSum("HsupPos");
    sumaDataFilas(_HbasicPos, _HinterPos, _HavanzPos, _HsupPos, "HtotalPos", "HtotalPos", "MtotalPos", "TtotalPos");
    var _MbasicPos = dataSum("MbasicPos");
    var _MinterPos = dataSum("MinterPos");
    var _MavanzPos = dataSum("MavanzPos");
    var _MsupPos = dataSum("MsupPos");
    sumaDataFilas(_MbasicPos, _MinterPos, _MavanzPos, _MsupPos, "MtotalPos", "HtotalPos", "MtotalPos", "TtotalPos");
    // ? ----------------------------------------------------------
    var _HbasicEmp = dataSum("HbasicEmp");
    var _HinterEmp = dataSum("HinterEmp");
    var _HavanzEmp = dataSum("HavanzEmp");
    var _HsupEmp = dataSum("HsupEmp");
    sumaDataFilas(_HbasicEmp, _HinterEmp, _HavanzEmp, _HsupEmp, "HtotalEmp", "HtotalEmp", "MtotalEmp", "TtotalEmp");
    var _MbasicEmp = dataSum("MbasicEmp");
    var _MinterEmp = dataSum("MinterEmp");
    var _MavanzEmp = dataSum("MavanzEmp");
    var _MsupEmp = dataSum("MsupEmp");
    sumaDataFilas(_MbasicEmp, _MinterEmp, _MavanzEmp, _MsupEmp, "MtotalEmp", "HtotalEmp", "MtotalEmp", "TtotalEmp");
    // ? ----------------------------------------------------------
    var _HbasicEgr = dataSum("HbasicEgr");
    var _HinterEgr = dataSum("HinterEgr");
    var _HavanzEgr = dataSum("HavanzEgr");
    var _HsupEgr = dataSum("HsupEmp");
    sumaDataFilas(_HbasicEgr, _HinterEgr, _HavanzEgr, _HsupEgr, "HtotalEgr", "HtotalEgr", "MtotalEgr", "TtotalEgr");
    var _MbasicEgr = dataSum("MbasicEgr");
    var _MinterEgr = dataSum("MinterEgr");
    var _MavanzEgr = dataSum("MavanzEgr");
    var _MsupEgr = dataSum("MsupEgr");
    sumaDataFilas(_MbasicEgr, _MinterEgr, _MavanzEgr, _MsupEgr, "MtotalEgr", "HtotalEgr", "MtotalEgr", "TtotalEgr");
    // ? ----------------------------------------------------------
    var _HbasicPg = dataSum("HbasicPg");
    var _HinterPg = dataSum("HinterPg");
    var _HavanzPg = dataSum("HavanzPg");
    var _HsupPg = dataSum("HsupPg");
    sumaDataFilas(_HbasicPg, _HinterPg, _HavanzPg, _HsupPg, "HtotalPg", "HtotalPg", "MtotalPg", "TtotalPg");
    var _MbasicPg = dataSum("MbasicPg");
    var _MinterPg = dataSum("MinterPg");
    var _MavanzPg = dataSum("MavanzPg");
    var _MsupPg = dataSum("MsupPg");
    sumaDataFilas(_MbasicPg, _MinterPg, _MavanzPg, _MsupPg, "MtotalPg", "HtotalPg", "MtotalPg", "TtotalPg");
    var selectIdioma = document.getElementById('selectCont');
    //const idioma = <HTMLInputElement>document.getElementById('idioma');
    var elegirBTN = document.getElementById("elegirBTN");
    var dtPidioma = document.getElementById("dtPidioma");
    var dtsPASSado = document.getElementById("dtsPASSado");
    elegirBTN.click();
    // Agregar un event listener para el evento 'change'
    selectIdioma.addEventListener('change', function () {
        // Obtener el valor seleccionado del select
        var idiomaSeleccionado = selectIdioma.value;
        // Verificar si se ha seleccionado un idioma válido
        if (idiomaSeleccionado !== "") {
            // Se ha seleccionado un idioma, puedes realizar acciones aquí
            console.log("Se ha seleccionado el idioma: " + idiomaSeleccionado);
            dtPidioma.value = idiomaSeleccionado;
            //idioma.value = idiomaSeleccionado;
            elegirBTN.click();
            dtsPASSado.click();
            selectIdioma.value = idiomaSeleccionado;
        }
        else {
            // No se ha seleccionado ningún idioma válido
            console.log("No se ha seleccionado ningún idioma");
        }
    });
    var btnGuardar = document.getElementById("btnGuardar");
    btnGuardar.addEventListener('mouseover', function () {
        console.log("El mouse está sobre el botón guardar.");
        var form = document.getElementById("tableForm");
        if (form) {
            form.action = "guardarDataTable.php"; // Reemplaza "nueva_url" con la URL deseada
            var form2 = document.getElementById("tableForm");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    btnGuardar.addEventListener('mouseout', function () {
        var form = document.getElementById("tableForm");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            var form2 = document.getElementById("tableForm");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    var btnEnviar = document.getElementById("btnEnviar");
    btnEnviar.addEventListener('mouseover', function () {
        console.log("El mouse está sobre el botón enviar.");
        var form = document.getElementById("tableForm");
        if (form) {
            form.action = "enviarDataTable.php"; // Reemplaza "nueva_url" con la URL deseada
            var form2 = document.getElementById("tableForm");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    btnEnviar.addEventListener('mouseout', function () {
        var form = document.getElementById("tableForm");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            var form2 = document.getElementById("tableForm");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    var btnNotifi = document.getElementById("btnNotifi");
    btnNotifi.addEventListener('click', function () {
        var menuNotifi = document.getElementById("menuNotifi");
        if (menuNotifi) {
            if (menuNotifi.style.display === "flex") {
                menuNotifi.style.display = "none";
            }
            else {
                menuNotifi.style.display = "flex";
            }
        }
    });
    var btnMuser = document.getElementById("btnMuser");
    btnMuser.addEventListener('click', function () {
        var menuUser = document.getElementById("menuUser");
        if (menuUser) {
            if (menuUser.style.display === "flex") {
                menuUser.style.display = "none";
            }
            else {
                menuUser.style.display = "flex";
            }
        }
    });
    function insertSpaceInInputs() {
        var inputs = document.querySelectorAll(".dataCeldas > input");
        inputs.forEach(function (input) {
            var start = input.selectionStart;
            var end = input.selectionEnd;
            if (start !== null && end !== null) {
                input.setRangeText(' ', start, end, 'end');
                // Despacha eventos de input y change para asegurar que cualquier listener se dispare
                var inputEvent = new Event('input', { bubbles: true });
                var changeEvent = new Event('change', { bubbles: true });
                input.dispatchEvent(inputEvent);
                input.dispatchEvent(changeEvent);
            }
        });
    }
    // Llama a la función
    insertSpaceInInputs();
});
