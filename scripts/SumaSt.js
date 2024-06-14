"use strict";
window.addEventListener("load", function () {
    console.log("script Suma St cargado");
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
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                }
            });
            dt2.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value + +dt2.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                }
            });
        }
    }
    /* ingles*/
    var hIngst = dataSum("hIngst");
    var mIngst = dataSum("mIngst");
    dataSumNiv(hIngst, mIngst, "tIngst");
    /*frances*/
    var hFrast = dataSum("hFrast");
    var mFrast = dataSum("mFrast");
    dataSumNiv(hFrast, mFrast, "tFrast");
    /*aleman*/
    var hAlest = dataSum("hAlest");
    var mAlest = dataSum("mAlest");
    dataSumNiv(hAlest, mAlest, "tAlest");
    /*italiano*/
    var hItast = dataSum("hItast");
    var mItast = dataSum("mItast");
    dataSumNiv(hItast, mItast, "tItast");
    /*japonés*/
    var hJapst = dataSum("hJapst");
    var mJapst = dataSum("mJapst");
    dataSumNiv(hJapst, mJapst, "tJapst");
    /*chino-mandarín*/
    var hChiMst = dataSum("hChiMst");
    var mChiMst = dataSum("mChiMst");
    dataSumNiv(hChiMst, mChiMst, "tChiMst");
    /*portugues*/
    var hPorst = dataSum("hPorst");
    var mPorst = dataSum("mPorst");
    dataSumNiv(hPorst, mPorst, "tPorst");
    /*ruso*/
    var hRusst = dataSum("hRusst");
    var mRusst = dataSum("mRusst");
    dataSumNiv(hRusst, mRusst, "tRusst");
    /*nahuatl*/
    var hNahst = dataSum("hNahst");
    var mNahst = dataSum("mNahst");
    dataSumNiv(hNahst, mNahst, "tNahst");
    /*español*/
    var hEspst = dataSum("hEspst");
    var mEspst = dataSum("mEspst");
    dataSumNiv(hEspst, mEspst, "tEspst");
    /*señas mexicanas*/
    var hSeñMst = dataSum("hSeñMst");
    var mSeñMst = dataSum("mSeñMst");
    dataSumNiv(hSeñMst, mSeñMst, "tSeñMst");
    /*coreano*/
    var hCorst = dataSum("hCorst");
    var mCorst = dataSum("mCorst");
    dataSumNiv(hCorst, mCorst, "tCorst");
    /*totales*/
    function datasumtotal(dt1, dt2, dt3, dt4, dt5, dt6, dt7, dt8, dt9, dt10, dt11, dt12, dttotal) {
        if (dt1 &&
            dt2 &&
            dt3 &&
            dt4 &&
            dt5 &&
            dt6 &&
            dt7 &&
            dt8 &&
            dt9 &&
            dt10 &&
            dt11 &&
            dt12) {
            dt1.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt2.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt3.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt4.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt5.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt6.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt7.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt8.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt9.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt10.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt11.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt12.addEventListener("input", function () {
                var dt2Element = dataSum(dttotal);
                if (dt2Element) {
                    var newValue = (+dt1.value +
                        +dt2.value +
                        +dt3.value +
                        +dt4.value +
                        +dt5.value +
                        +dt6.value +
                        +dt7.value +
                        +dt8.value +
                        +dt9.value +
                        +dt10.value +
                        +dt11.value +
                        +dt12.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
        }
    }
    //totales hombres
    var _hIngst = dataSum("hIngst");
    var _hFrast = dataSum("hFrast");
    var _hAlest = dataSum("hAlest");
    var _hItast = dataSum("hItast");
    var _hJapst = dataSum("hJapst");
    var _hChiMst = dataSum("hChiMst");
    var _hPorst = dataSum("hPorst");
    var _hRusst = dataSum("hRusst");
    var _hNahst = dataSum("hNahst");
    var _hEspst = dataSum("hEspst");
    var _hSeñMst = dataSum("hSeñMst");
    var _hCorst = dataSum("hCorst");
    datasumtotal(_hIngst, _hFrast, _hAlest, _hItast, _hJapst, _hChiMst, _hPorst, _hRusst, _hNahst, _hEspst, _hSeñMst, _hCorst, "hTotalst");
    //totales mujeres
    var _mIngst = dataSum("mIngst");
    var _mFrast = dataSum("mFrast");
    var _mAlest = dataSum("mAlest");
    var _mItast = dataSum("mItast");
    var _mJapst = dataSum("mJapst");
    var _mChiMst = dataSum("mChiMst");
    var _mPorst = dataSum("mPorst");
    var _mRusst = dataSum("mRusst");
    var _mNahst = dataSum("mNahst");
    var _mEspst = dataSum("mEspst");
    var _mSeñMst = dataSum("mSeñMst");
    var _mCorst = dataSum("mCorst");
    datasumtotal(_mIngst, _mFrast, _mAlest, _mItast, _mJapst, _mChiMst, _mPorst, _mRusst, _mNahst, _mEspst, _mSeñMst, _mCorst, "mTotalst");
    function datosSim() {
        var contHSum = document.querySelector("#hTotalst > input");
        var contMSum = document.querySelector("#mTotalst > input");
        var tTotalst = document.querySelector("#tTotalst > input");
        if (contHSum !== null && contMSum !== null && tTotalst !== null) {
            var updateTotal = function () {
                var parseValue = function (value) {
                    return value === "<empty string>" ? 0 : parseInt(value || "0", 10);
                };
                var hValue = parseValue(contHSum.value);
                var mValue = parseValue(contMSum.value);
                var nuevoValor = (hValue + mValue).toString();
                tTotalst.value = nuevoValor;
                console.log("Nuevo valor :", nuevoValor);
            };
            updateTotal();
            console.log(contHSum);
            console.log("valor ");
            console.log(contHSum === null || contHSum === void 0 ? void 0 : contHSum.value);
            console.log(contMSum === null || contMSum === void 0 ? void 0 : contMSum.value);
        }
        else {
            console.log("none");
        }
    }
    var bloqueaIntputs = function (arraySup, status) {
        for (var i = 0; i < arraySup.length; i++) {
            var input = document.querySelector("#" + arraySup[i] + " > input");
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
    var arrayIng = ["hIngst", "mIngst"];
    var btnlengIng = document.getElementById("lengIng");
    btnlengIng.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-1");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayIng, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayIng, true);
            }
        }
    });
    var arrayFra = ["hFrast", "mFrast"];
    var lengFra = document.getElementById("lengFra");
    lengFra.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-2");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayFra, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayFra, true);
            }
        }
    });
    lengFra.click();
    var arrayAle = ["hAlest", "mAlest"];
    var lengAle = document.getElementById("lengAle");
    lengAle.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-3");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayAle, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayAle, true);
            }
        }
    });
    lengAle.click();
    var arrayIta = ["hItast", "mItast"];
    var lengIta = document.getElementById("lengIta");
    lengIta.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-4");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayIta, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayIta, true);
            }
        }
    });
    lengIta.click();
    var arrayJap = ["hJapst", "mJapst"];
    var lengJap = document.getElementById("lengJap");
    lengJap.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-5");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayJap, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayJap, true);
            }
        }
    });
    lengJap.click();
    var arrayChiM = ["hChiMst", "mChiMst"];
    var lengChiM = document.getElementById("lengChiM");
    lengChiM.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-6");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayChiM, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayChiM, true);
            }
        }
    });
    lengChiM.click();
    var arrayPor = ["hPorst", "hPorst"];
    var lengPor = document.getElementById("lengPor");
    lengPor.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-7");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayPor, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayPor, true);
            }
        }
    });
    lengPor.click();
    var arrayRus = ["hRusst", "mRusst"];
    var lengRus = document.getElementById("lengRus");
    lengRus.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-8");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayRus, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayRus, true);
            }
        }
    });
    lengRus.click();
    var arrayNah = ["hNahst", "mNahst"];
    var legNah = document.getElementById("legNah");
    legNah.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-9");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayNah, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayNah, true);
            }
        }
    });
    legNah.click();
    var arrayEsp = ["hEspst", "mEspst"];
    var legEsp = document.getElementById("legEsp");
    legEsp.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-10");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayEsp, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayEsp, true);
            }
        }
    });
    legEsp.click();
    var arraySeñm = ["hSeñMst", "mSeñMst"];
    var legSeñM = document.getElementById("legSeñM");
    legSeñM.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-11");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arraySeñm, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arraySeñm, true);
            }
        }
    });
    legSeñM.click();
    var arrayCor = ["hCorst", "mCorst"];
    var legCor = document.getElementById("legCor");
    legCor.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-12");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayCor, false);
            }
            else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayCor, true);
            }
        }
    });
    legCor.click();
    var Total = document.getElementById("Total");
    Total.addEventListener("click", function () {
        var block_cont = document.getElementById("contbloq-13");
        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
            }
            else {
                block_cont.style.display = "flex";
            }
        }
    });
    Total.click();
    Total.click();
    var idSubmitGdr = document.getElementById("idSubmitGdr");
    idSubmitGdr === null || idSubmitGdr === void 0 ? void 0 : idSubmitGdr.addEventListener('mouseover', function () {
        console.log("El mouse está sobre el botón guardar.");
        var form = document.getElementById("contTable");
        if (form) {
            form.action = "guardarDataTableProfesoresST.php"; // Reemplaza "nueva_url" con la URL deseada
            var form2 = document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    idSubmitGdr === null || idSubmitGdr === void 0 ? void 0 : idSubmitGdr.addEventListener('mouseout', function () {
        var form = document.getElementById("contTable");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            var form2 = document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    var btnEnviar = document.getElementById("idSubmitEnv");
    btnEnviar === null || btnEnviar === void 0 ? void 0 : btnEnviar.addEventListener('mouseover', function () {
        console.log("El mouse está sobre el botón enviar.");
        var form = document.getElementById("contTable");
        if (form) {
            form.action = "enviarDataTableProfesoresST.php"; // Reemplaza "nueva_url" con la URL deseada
            var form2 = document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    btnEnviar === null || btnEnviar === void 0 ? void 0 : btnEnviar.addEventListener('mouseout', function () {
        var form = document.getElementById("contTable");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            var form2 = document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    var idDataOld = document.getElementById("idDataOld");
    idDataOld === null || idDataOld === void 0 ? void 0 : idDataOld.addEventListener('mouseover', function () {
        console.log("El mouse está sobre el botón enviar.");
        var form = document.getElementById("contTable");
        if (form) {
            form.action = "traerDatosPasadosST.php"; // Reemplaza "nueva_url" con la URL deseada
            var form2 = document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    idDataOld === null || idDataOld === void 0 ? void 0 : idDataOld.addEventListener('mouseout', function () {
        var form = document.getElementById("contTable");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            var form2 = document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    //---------------------------------------------------
    var btnZac1 = document.getElementById("btnZac1");
    btnZac1 === null || btnZac1 === void 0 ? void 0 : btnZac1.addEventListener('mouseover', function () {
        console.log("El mouse está sobre el botón guardar.");
        var form = document.getElementById("contTableZAC");
        if (form) {
            form.action = "guardarDataTableProfesoresZAC.php"; // Reemplaza "nueva_url" con la URL deseada
            var form2 = document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    btnZac1 === null || btnZac1 === void 0 ? void 0 : btnZac1.addEventListener('mouseout', function () {
        var form = document.getElementById("contTableZAC");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            var form2 = document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    var btnZac2 = document.getElementById("btnZac2");
    btnZac2 === null || btnZac2 === void 0 ? void 0 : btnZac2.addEventListener('mouseover', function () {
        console.log("El mouse está sobre el botón enviar.");
        var form = document.getElementById("contTableZAC");
        if (form) {
            form.action = "enviarDataTableProfesoresZAC.php"; // Reemplaza "nueva_url" con la URL deseada
            var form2 = document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    btnZac2 === null || btnZac2 === void 0 ? void 0 : btnZac2.addEventListener('mouseout', function () {
        var form = document.getElementById("contTableZAC");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            var form2 = document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    var btnZac3 = document.getElementById("btnZac3");
    btnZac3 === null || btnZac3 === void 0 ? void 0 : btnZac3.addEventListener('mouseover', function () {
        console.log("El mouse está sobre el botón enviar.");
        var form = document.getElementById("contTableZAC");
        if (form) {
            form.action = "traerDatosPasadosZAC.php"; // Reemplaza "nueva_url" con la URL deseada
            var form2 = document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    btnZac3 === null || btnZac3 === void 0 ? void 0 : btnZac3.addEventListener('mouseout', function () {
        var form = document.getElementById("contTableZAC");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            var form2 = document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });
});
