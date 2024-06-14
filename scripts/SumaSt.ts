"use strict";

window.addEventListener("load", () => {
    console.log("script Suma St cargado");
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

    function dataSumNiv(
        dt1: HTMLInputElement | null,
        dt2: HTMLInputElement | null,
        dttotal: string
    ) {
        if (dt1 && dt2) {
            dt1.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (+dt1.value + +dt2.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                }
            });
            dt2.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (+dt1.value + +dt2.value).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                }
            });
        }
    }

    /* ingles*/
    let hIngst = dataSum("hIngst");
    let mIngst = dataSum("mIngst");
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

    function datasumtotal(
        dt1: HTMLInputElement | null,
        dt2: HTMLInputElement | null,
        dt3: HTMLInputElement | null,
        dt4: HTMLInputElement | null,
        dt5: HTMLInputElement | null,
        dt6: HTMLInputElement | null,
        dt7: HTMLInputElement | null,
        dt8: HTMLInputElement | null,
        dt9: HTMLInputElement | null,
        dt10: HTMLInputElement | null,
        dt11: HTMLInputElement | null,
        dt12: HTMLInputElement | null,
        dttotal: string
    ) {
        if (
            dt1 &&
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
            dt12
        ) {
            dt1.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
            dt2.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });

            dt3.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });

            dt4.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });

            dt5.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });

            dt6.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });

            dt7.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });

            dt8.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });

            dt9.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });

            dt10.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });

            dt11.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });

            dt12.addEventListener("input", () => {
                let dt2Element = dataSum(dttotal) as HTMLInputElement;
                if (dt2Element) {
                    let newValue = (
                        +dt1.value +
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
                        +dt12.value
                    ).toString(); // Suma de los valores
                    newValue = newValue.replace(/\D/g, ""); // Reemplazo de caracteres no numéricos
                    dt2Element.value = newValue; // Asignar el nuevo valor al elemento
                    datosSim();
                }
            });
        }
    }
    //totales hombres
    let _hIngst = dataSum("hIngst");
    let _hFrast = dataSum("hFrast");
    let _hAlest = dataSum("hAlest");
    let _hItast = dataSum("hItast");
    let _hJapst = dataSum("hJapst");
    let _hChiMst = dataSum("hChiMst");
    let _hPorst = dataSum("hPorst");
    let _hRusst = dataSum("hRusst");
    let _hNahst = dataSum("hNahst");
    let _hEspst = dataSum("hEspst");
    let _hSeñMst = dataSum("hSeñMst");
    let _hCorst = dataSum("hCorst");
    datasumtotal(
        _hIngst,
        _hFrast,
        _hAlest,
        _hItast,
        _hJapst,
        _hChiMst,
        _hPorst,
        _hRusst,
        _hNahst,
        _hEspst,
        _hSeñMst,
        _hCorst,
        "hTotalst"
    );
    //totales mujeres
    let _mIngst = dataSum("mIngst");
    let _mFrast = dataSum("mFrast");
    let _mAlest = dataSum("mAlest");
    let _mItast = dataSum("mItast");
    let _mJapst = dataSum("mJapst");
    let _mChiMst = dataSum("mChiMst");
    let _mPorst = dataSum("mPorst");
    let _mRusst = dataSum("mRusst");
    let _mNahst = dataSum("mNahst");
    let _mEspst = dataSum("mEspst");
    let _mSeñMst = dataSum("mSeñMst");
    let _mCorst = dataSum("mCorst");
    datasumtotal(
        _mIngst,
        _mFrast,
        _mAlest,
        _mItast,
        _mJapst,
        _mChiMst,
        _mPorst,
        _mRusst,
        _mNahst,
        _mEspst,
        _mSeñMst,
        _mCorst,
        "mTotalst"
    );

    function datosSim() {
        let contHSum: HTMLInputElement | null =
            document.querySelector("#hTotalst > input");
        let contMSum: HTMLInputElement | null =
            document.querySelector("#mTotalst > input");
        let tTotalst: HTMLInputElement | null =
            document.querySelector("#tTotalst > input");
    
        if (contHSum !== null && contMSum !== null && tTotalst !== null) {
            const updateTotal = () => {
                const parseValue = (value: string | null) => {
                    return value === "<empty string>" ? 0 : parseInt(value || "0", 10);
                };
    
                const hValue = parseValue(contHSum.value);
                const mValue = parseValue(contMSum.value);
    
                let nuevoValor = (
                    hValue + mValue
                ).toString();
    
                tTotalst.value = nuevoValor;
                console.log("Nuevo valor :", nuevoValor);
            };
    
            updateTotal();
            console.log(contHSum);
            console.log("valor ");
            console.log(contHSum?.value);
            console.log(contMSum?.value);
        } else {
            console.log("none");
        }
    }
    
    

    let bloqueaIntputs = (arraySup: string[], status: boolean) => {
        for (let i = 0; i < arraySup.length; i++) {
            let input = document.querySelector("#" + arraySup[i] + " > input");
            if (input instanceof HTMLInputElement) {
                if (status === true) {
                    input.readOnly = true;
                } else {
                    input.readOnly = false;
                }
            }
        }
    };

    let arrayIng = ["hIngst", "mIngst"];
    let btnlengIng = <HTMLElement>document.getElementById("lengIng");

    btnlengIng.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-1");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayIng, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayIng, true);
            }
        }
    });

    let arrayFra = ["hFrast", "mFrast"];
    let lengFra = <HTMLElement>document.getElementById("lengFra");

    lengFra.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-2");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayFra, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayFra, true);
            }
        }
    });
    lengFra.click();

    let arrayAle = ["hAlest", "mAlest"];
    let lengAle = <HTMLElement>document.getElementById("lengAle");

    lengAle.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-3");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayAle, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayAle, true);
            }
        }
    });
    lengAle.click();

    let arrayIta = ["hItast", "mItast"];
    let lengIta = <HTMLElement>document.getElementById("lengIta");

    lengIta.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-4");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayIta, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayIta, true);
            }
        }
    });
    lengIta.click();

    let arrayJap = ["hJapst", "mJapst"];
    let lengJap = <HTMLElement>document.getElementById("lengJap");

    lengJap.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-5");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayJap, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayJap, true);
            }
        }
    });
    lengJap.click();

    let arrayChiM = ["hChiMst", "mChiMst"];
    let lengChiM = <HTMLElement>document.getElementById("lengChiM");

    lengChiM.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-6");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayChiM, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayChiM, true);
            }
        }
    });
    lengChiM.click();

    let arrayPor = ["hPorst", "hPorst"];
    let lengPor = <HTMLElement>document.getElementById("lengPor");

    lengPor.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-7");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayPor, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayPor, true);
            }
        }
    });
    lengPor.click();

    let arrayRus = ["hRusst", "mRusst"];
    let lengRus = <HTMLElement>document.getElementById("lengRus");

    lengRus.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-8");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayRus, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayRus, true);
            }
        }
    });
    lengRus.click();

    let arrayNah = ["hNahst", "mNahst"];
    let legNah = <HTMLElement>document.getElementById("legNah");

    legNah.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-9");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayNah, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayNah, true);
            }
        }
    });
    legNah.click();

    let arrayEsp = ["hEspst", "mEspst"];
    let legEsp = <HTMLElement>document.getElementById("legEsp");

    legEsp.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-10");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayEsp, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayEsp, true);
            }
        }
    });
    legEsp.click();


    let arraySeñm = ["hSeñMst", "mSeñMst"];
    let legSeñM = <HTMLElement>document.getElementById("legSeñM");

    legSeñM.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-11");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arraySeñm, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arraySeñm, true);
            }
        }
    });
    legSeñM.click();

    let arrayCor = ["hCorst", "mCorst"];
    let legCor = <HTMLElement>document.getElementById("legCor");

    legCor.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-12");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
                bloqueaIntputs(arrayCor, false);
            } else {
                block_cont.style.display = "flex";
                bloqueaIntputs(arrayCor, true);
            }
        }
    });
    legCor.click();

    let Total = <HTMLElement>document.getElementById("Total");

    Total.addEventListener("click", () => {
        let block_cont = document.getElementById("contbloq-13");

        if (block_cont) {
            if (block_cont.style.display === "flex") {
                block_cont.style.display = "none";
            } else {
                block_cont.style.display = "flex";
            }
        }
    });
    Total.click();
    Total.click();




        
    let idSubmitGdr: HTMLElement | null  = document.getElementById("idSubmitGdr");

    idSubmitGdr?.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón guardar.");
        let form = <HTMLFormElement>document.getElementById("contTable");
        if (form) {
            form.action = "guardarDataTableProfesoresST.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = <HTMLFormElement>document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });

    idSubmitGdr?.addEventListener('mouseout', () => {
        let form = <HTMLFormElement>document.getElementById("contTable");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = <HTMLFormElement>document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    let btnEnviar: HTMLElement | null  = document.getElementById("idSubmitEnv");

    btnEnviar?.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón enviar.");
        let form = <HTMLFormElement>document.getElementById("contTable");
        if (form) {
            form.action = "enviarDataTableProfesoresST.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = <HTMLFormElement>document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });

    btnEnviar?.addEventListener('mouseout', () => {
        let form = <HTMLFormElement>document.getElementById("contTable");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = <HTMLFormElement>document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });

    let idDataOld: HTMLElement | null  = document.getElementById("idDataOld");

    idDataOld?.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón enviar.");
        let form = <HTMLFormElement>document.getElementById("contTable");
        if (form) {
            form.action = "traerDatosPasadosST.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = <HTMLFormElement>document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });

    idDataOld?.addEventListener('mouseout', () => {
        let form = <HTMLFormElement>document.getElementById("contTable");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = <HTMLFormElement>document.getElementById("contTable");
            console.log("Nuevo action del formulario:", form2);
        }
    });    


    //---------------------------------------------------
    let btnZac1: HTMLElement | null  = document.getElementById("btnZac1");

    btnZac1?.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón guardar.");
        let form = <HTMLFormElement>document.getElementById("contTableZAC");
        if (form) {
            form.action = "guardarDataTableProfesoresZAC.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = <HTMLFormElement>document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });

    btnZac1?.addEventListener('mouseout', () => {
        let form = <HTMLFormElement>document.getElementById("contTableZAC");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = <HTMLFormElement>document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });
    let btnZac2: HTMLElement | null  = document.getElementById("btnZac2");

    btnZac2?.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón enviar.");
        let form = <HTMLFormElement>document.getElementById("contTableZAC");
        if (form) {
            form.action = "enviarDataTableProfesoresZAC.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = <HTMLFormElement>document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });

    btnZac2?.addEventListener('mouseout', () => {
        let form = <HTMLFormElement>document.getElementById("contTableZAC");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = <HTMLFormElement>document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });

    let btnZac3: HTMLElement | null = document.getElementById("btnZac3");

    btnZac3?.addEventListener('mouseover', () => {
        console.log("El mouse está sobre el botón enviar.");
        let form = <HTMLFormElement>document.getElementById("contTableZAC");
        if (form) {
            form.action = "traerDatosPasadosZAC.php"; // Reemplaza "nueva_url" con la URL deseada
            let form2 = <HTMLFormElement>document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });

    btnZac3?.addEventListener('mouseout', () => {
        let form = <HTMLFormElement>document.getElementById("contTableZAC");
        if (form) {
            form.action = "indefinido"; // Restaura el action original
            let form2 = <HTMLFormElement>document.getElementById("contTableZAC");
            console.log("Nuevo action del formulario:", form2);
        }
    });
});
