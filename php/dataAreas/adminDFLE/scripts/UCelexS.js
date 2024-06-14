"use strict";

document.getElementById('SelectNivel').addEventListener('change', function() {
    var resultado = document.getElementById('ViewNivel');
    resultado.textContent = this.options[this.selectedIndex].text;
});
// Seleccionar todos los contenedores con la clase "contDtMS"
var resultado = document.getElementsByClassName("contDtMS");

// Seleccionar todos los contenedores con la clase "contDTS"
var resultado = document.getElementsByClassName("contDTS");

// Seleccionar todos los contenedores con la clase "contDtCI"
var resultado = document.getElementsByClassName("contDtCI");

// Seleccionar todos los contenedores con la clase "contDtCVDR"
var resultado = document.getElementsByClassName("contDtCVDR");

document.getElementById('SelectNivel').addEventListener('change', function() {
    // Obtener el valor seleccionado
    var nivelSeleccionado = this.value;
    
    // Ocultar todos los contenedores
    var contDtMS_contenedores = document.getElementsByClassName("contDtMS");
    for (var i = 0; i < contDtMS_contenedores.length; i++) {
        contDtMS_contenedores[i].style.display = 'none';
    }
    
    var contDTS_contenedores = document.getElementsByClassName("contDTS");
    for (var i = 0; i < contDTS_contenedores.length; i++) {
        contDTS_contenedores[i].style.display = 'none';
    }
    var contDtCI_contenedores = document.getElementsByClassName("contDtCI");
    for (var i = 0; i < contDtCI_contenedores.length; i++) {
        contDtCI_contenedores[i].style.display = 'none';
    }
    
    var contDtCVDR_contenedores = document.getElementsByClassName("contDtCVDR");
    for (var i = 0; i < contDtCVDR_contenedores.length; i++) {
        contDtCVDR_contenedores[i].style.display = 'none';
    }
    
    // Mostrar el contenedor asociado al nivel seleccionado
    var contenedorAsociado = document.getElementById(nivelSeleccionado);
    if (contenedorAsociado) {
        contenedorAsociado.style.display = 'grid';
    }
});


window.addEventListener('load', function () {
    console.log("DOM cargado UCelexS");
    // Seleccionar todos los checkboxes dentro de .Trim1
    var checkboxes = document.querySelectorAll('.Trim1 > input[type="checkbox"]');
    // Definir la variable para almacenar la suma
    var suma = 0;
    // Escuchar el evento input en cada checkbox
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            // Obtener el valor numérico del checkbox
            var valor = parseInt(checkbox.value);
            // Verificar si el checkbox está marcado o desmarcado
            if (checkbox.checked) {
                // Si está marcado, sumar su valor
                suma += valor;
            }
            else {
                // Si está desmarcado, restar su valor
                suma -= valor;
            }
            // Actualizar el contenido del contenedor donde deseas mostrar la suma
            document.getElementById('TotalTrim1').innerText = suma;
        });
    });
});


window.addEventListener('load', function () {
    console.log("DOM cargado UCelexS");

    // Función para calcular la suma de los checkboxes dentro de .Trim1MS
    function calcularSumaTrim1() {
        var checkboxes = document.querySelectorAll('.Trim1MS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('TotalTrim1').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2MS
    function calcularSumaTrim2() {
        var checkboxes = document.querySelectorAll('.Trim2MS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('TotalTrim2').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3MS
    function calcularSumaTrim3() {
        var checkboxes = document.querySelectorAll('.Trim3MS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('TotalTrim3').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4MS
    function calcularSumaTrim4() {
        var checkboxes = document.querySelectorAll('.Trim4MS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('TotalTrim4').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim1SMS
    function calcularSumaTrim1S() {
        var checkboxes = document.querySelectorAll('.Trim1SMS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('TotalTrim1S').innerText = suma;
                calcularSumaTotal1T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2SMS
    function calcularSumaTrim2S() {
        var checkboxes = document.querySelectorAll('.Trim2SMS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('TotalTrim2S').innerText = suma;
                calcularSumaTotal1T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3SMS
    function calcularSumaTrim3S() {
        var checkboxes = document.querySelectorAll('.Trim3SMS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('TotalTrim3S').innerText = suma;
                calcularSumaTotal1T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4SMS
    function calcularSumaTrim4S() {
        var checkboxes = document.querySelectorAll('.Trim4SMS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('TotalTrim4S').innerText = suma;
                calcularSumaTotal1T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim1S
    function calcularSumaTrim1SS() {
        var checkboxes = document.querySelectorAll('.Trim1S > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total2Trim1').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2S
    function calcularSumaTrim2SS() {
        var checkboxes = document.querySelectorAll('.Trim2S > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total2Trim2').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3S
    function calcularSumaTrim3SS() {
        var checkboxes = document.querySelectorAll('.Trim3S > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total2Trim3').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4S
    function calcularSumaTrim4SS() {
        var checkboxes = document.querySelectorAll('.Trim4S > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total2Trim4').innerText = suma;
            });
        });
    }

       // Función para calcular la suma de los checkboxes dentro de .Trim1SS
        function calcularSumaTrim1SSS() {
        var checkboxes = document.querySelectorAll('.Trim1SS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total2Trim1S').innerText = suma;
                calcularSumaTotal2T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2SS
    function calcularSumaTrim2SSS() {
        var checkboxes = document.querySelectorAll('.Trim2SS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total2Trim2S').innerText = suma;
                calcularSumaTotal2T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3SS
    function calcularSumaTrim3SSS() {
        var checkboxes = document.querySelectorAll('.Trim3SS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total2Trim3S').innerText = suma;
                calcularSumaTotal2T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4SS
    function calcularSumaTrim4SSS() {
        var checkboxes = document.querySelectorAll('.Trim4SS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total2Trim4S').innerText = suma;
                calcularSumaTotal2T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim1CI
    function calcularSumaTrim1CI() {
        var checkboxes = document.querySelectorAll('.Trim1CI > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim1').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2CI
    function calcularSumaTrim2CI() {
        var checkboxes = document.querySelectorAll('.Trim2CI > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim2').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3CI
    function calcularSumaTrim3CI() {
        var checkboxes = document.querySelectorAll('.Trim3CI > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim3').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4CI
    function calcularSumaTrim4CI() {
        var checkboxes = document.querySelectorAll('.Trim4CI > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim4').innerText = suma;
            });
        });
    }

       // Función para calcular la suma de los checkboxes dentro de .Trim1CIS
        function calcularSumaTrim1CIS() {
        var checkboxes = document.querySelectorAll('.Trim1CIS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim1S').innerText = suma;
                calcularSumaTotal3T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2CI
    function calcularSumaTrim2CIS() {
        var checkboxes = document.querySelectorAll('.Trim2CIS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim2S').innerText = suma;
                calcularSumaTotal3T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3CIS
    function calcularSumaTrim3CIS() {
        var checkboxes = document.querySelectorAll('.Trim3CIS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim3S').innerText = suma;
                calcularSumaTotal3T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4CIS
    function calcularSumaTrim4CIS() {
        var checkboxes = document.querySelectorAll('.Trim4CIS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim4S').innerText = suma;
                calcularSumaTotal3T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim1CVDR
    function calcularSumaTrim1CVDR() {
        var checkboxes = document.querySelectorAll('.Trim1CVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim1').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2CVDR
    function calcularSumaTrim2CVDR() {
        var checkboxes = document.querySelectorAll('.Trim2CVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim2').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3CVDR
    function calcularSumaTrim3CVDR() {
        var checkboxes = document.querySelectorAll('.Trim3CVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim3').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4CVDR
    function calcularSumaTrim4CVDR() {
        var checkboxes = document.querySelectorAll('.Trim4CVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim4').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim1SCVDR
    function calcularSumaTrim1SCVDR() {
        var checkboxes = document.querySelectorAll('.Trim1SCVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim1S').innerText = suma;
                calcularSumaTotal4T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2SCVDR
    function calcularSumaTrim2SCVDR() {
        var checkboxes = document.querySelectorAll('.Trim2SCVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim2S').innerText = suma;
                calcularSumaTotal4T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3SCVDR
    function calcularSumaTrim3SCVDR() {
        var checkboxes = document.querySelectorAll('.Trim3SCVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim3S').innerText = suma;
                calcularSumaTotal4T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4SCVDR
    function calcularSumaTrim4SCVDR() {
        var checkboxes = document.querySelectorAll('.Trim4SCVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim4S').innerText = suma;
                calcularSumaTotal4T();
            });
        });
    }

// Función para calcular la suma de los checkboxes dentro de .Trim4SCVDR
    function calcularSumaTrim4SCVDR() {
        var checkboxes = document.querySelectorAll('.Trim4SCVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim4S').innerText = suma;
            });
        });
    }

// Función para calcular la suma de los checkboxes dentro de .CVDRCJT
function calcularSumaCVDRCJT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS1 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRCJT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRCHT
function calcularSumaCVDRCHT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS2 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRCHT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRCNT
function calcularSumaCVDRCNT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS3 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRCNT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRCLT
function calcularSumaCVDRCLT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS4 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRCLT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRDT
function calcularSumaCVDRDT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS5 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRDT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRLMT
function calcularSumaCVDRLMT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS6 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRLMT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRMZT
function calcularSumaCVDRMZT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS7 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRMZT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRMRT
function calcularSumaCVDRMRT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS8 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRMRT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDROXT
function calcularSumaCVDROXT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS9 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDROXT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRTMT
function calcularSumaCVDRTMT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS10 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRTMT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRTJT
function calcularSumaCVDRTJT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS11 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRTJT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRTXT
function calcularSumaCVDRTXT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS12 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRTXT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRCHIT
function calcularSumaCVDRCHIT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS13 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRCHIT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRVT
function calcularSumaCVDRVT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS14 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRVT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRGT
function calcularSumaCVDRGT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS15 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRGT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRPT
function calcularSumaCVDRPT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS16 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRPT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .Total4T
function calcularSumaTotal4T() {
    var checkboxes = document.querySelectorAll('.SCVDRT > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('Total4T').innerText = suma;
        });
    });
}

function calcularSumMDS1() {
    var checkboxes = document.querySelectorAll('.SumMDS1 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt1T').innerText = suma;
        });
    });
}

function calcularSumMDS2() {
    var checkboxes = document.querySelectorAll('.SumMDS2 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt2T').innerText = suma;
        });
    });
}

function calcularSumMDS3() {
    var checkboxes = document.querySelectorAll('.SumMDS3 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt3T').innerText = suma;
        });
    });
}

function calcularSumMDS4() {
    var checkboxes = document.querySelectorAll('.SumMDS4 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt4T').innerText = suma;
        });
    });
}

function calcularSumMDS5() {
    var checkboxes = document.querySelectorAll('.SumMDS5 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt5T').innerText = suma;
        });
    });
}

function calcularSumMDS6() {
    var checkboxes = document.querySelectorAll('.SumMDS6 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt6T').innerText = suma;
        });
    });
}

function calcularSumMDS7() {
    var checkboxes = document.querySelectorAll('.SumMDS7 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt7T').innerText = suma;
        });
    });
}

function calcularSumMDS8() {
    var checkboxes = document.querySelectorAll('.SumMDS8 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt8T').innerText = suma;
        });
    });
}

function calcularSumMDS9() {
    var checkboxes = document.querySelectorAll('.SumMDS9 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt9T').innerText = suma;
        });
    });
}

function calcularSumMDS10() {
    var checkboxes = document.querySelectorAll('.SumMDS10 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt10T').innerText = suma;
        });
    });
}

function calcularSumMDS11() {
    var checkboxes = document.querySelectorAll('.SumMDS11 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt11T').innerText = suma;
        });
    });
}

function calcularSumMDS12() {
    var checkboxes = document.querySelectorAll('.SumMDS12 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt12T').innerText = suma;
        });
    });
}

function calcularSumMDS13() {
    var checkboxes = document.querySelectorAll('.SumMDS13 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt13T').innerText = suma;
        });
    });
}

function calcularSumMDS14() {
    var checkboxes = document.querySelectorAll('.SumMDS14 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt14T').innerText = suma;
        });
    });
}

function calcularSumMDS15() {
    var checkboxes = document.querySelectorAll('.SumMDS15 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt15T').innerText = suma;
        });
    });
}

function calcularSumMDS16() {
    var checkboxes = document.querySelectorAll('.SumMDS16 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt16T').innerText = suma;
        });
    });
}

function calcularSumMDS17() {
    var checkboxes = document.querySelectorAll('.SumMDS17 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt17T').innerText = suma;
        });
    });
}

function calcularSumMDS18() {
    var checkboxes = document.querySelectorAll('.SumMDS18 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt18T').innerText = suma;
        });
    });
}

function calcularSumMDS19() {
    var checkboxes = document.querySelectorAll('.SumMDS19 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCecyt19T').innerText = suma;
        });
    });
}

function calcularSumCetMDS1() {
    var checkboxes = document.querySelectorAll('.SumCetMDS1 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCet1T').innerText = suma;
        });
    });
}

function calcularSumSS1() {
    var checkboxes = document.querySelectorAll('.SumSS1 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCICSmaT').innerText = suma;
        });
    });
}

function calcularSumSS2() {
    var checkboxes = document.querySelectorAll('.SumSS2 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConCICSstT').innerText = suma;
        });
    });
}

function calcularSumSS3() {
    var checkboxes = document.querySelectorAll('.SumSS3 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConENBAT').innerText = suma;
        });
    });
}

function calcularSumSS4() {
    var checkboxes = document.querySelectorAll('.SumSS4 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConENCBT').innerText = suma;
        });
    });
}

function calcularSumSS5() {
    var checkboxes = document.querySelectorAll('.SumSS5 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConENMHT').innerText = suma;
        });
    });
}

function calcularSumSS6() {
    var checkboxes = document.querySelectorAll('.SumSS6 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESCAstT').innerText = suma;
        });
    });
}

function calcularSumSS7() {
    var checkboxes = document.querySelectorAll('.SumSS7 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESCAtT').innerText = suma;
        });
    });
}

function calcularSumSS8() {
    var checkboxes = document.querySelectorAll('.SumSS8 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESCOMT').innerText = suma;
        });
    });
}

function calcularSumSS9() {
    var checkboxes = document.querySelectorAll('.SumSS9 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESET').innerText = suma;
        });
    });
}

function calcularSumSS10() {
    var checkboxes = document.querySelectorAll('.SumSS10 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESEOT').innerText = suma;
        });
    });
}

function calcularSumSS11() {
    var checkboxes = document.querySelectorAll('.SumSS11 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESFEMT').innerText = suma;
        });
    });
}

function calcularSumSS12() {
    var checkboxes = document.querySelectorAll('.SumSS12 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESIAtecT').innerText = suma;
        });
    });
}

function calcularSumSS13() {
    var checkboxes = document.querySelectorAll('.SumSS13 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESIAtT').innerText = suma;
        });
    });
}

function calcularSumSS14() {
    var checkboxes = document.querySelectorAll('.SumSS14 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESIAzT').innerText = suma;
        });
    });
}

function calcularSumSS15() {
    var checkboxes = document.querySelectorAll('.SumSS15 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESIMEaT').innerText = suma;
        });
    });
}

function calcularSumSS16() {
    var checkboxes = document.querySelectorAll('.SumSS16 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESIMEcT').innerText = suma;
        });
    });
}

function calcularSumSS17() {
    var checkboxes = document.querySelectorAll('.SumSS17 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConEsimetT').innerText = suma;
        });
    });
}

function calcularSumSS18() {
    var checkboxes = document.querySelectorAll('.SumSS18 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESIMEzT').innerText = suma;
        });
    });
}

function calcularSumSS19() {
    var checkboxes = document.querySelectorAll('.SumSS19 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESIQUIET').innerText = suma;
        });
    });
}

function calcularSumSS20() {
    var checkboxes = document.querySelectorAll('.SumSS20 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESITT').innerText = suma;
        });
    });
}

function calcularSumSS21() {
    var checkboxes = document.querySelectorAll('.SumSS21 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESMT').innerText = suma;
        });
    });
}

function calcularSumSS22() {
    var checkboxes = document.querySelectorAll('.SumSS22 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConESTT').innerText = suma;
        });
    });
}

function calcularSumSS23() {
    var checkboxes = document.querySelectorAll('.SumSS23 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConUPIBIT').innerText = suma;
        });
    });
}

function calcularSumSS24() {
    var checkboxes = document.querySelectorAll('.SumSS24 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConUPIEMT').innerText = suma;
        });
    });
}

function calcularSumSS25() {
    var checkboxes = document.querySelectorAll('.SumSS25 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConUPIICT').innerText = suma;
        });
    });
}

function calcularSumSS26() {
    var checkboxes = document.querySelectorAll('.SumSS26 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConUPIICSAT').innerText = suma;
        });
    });
}

function calcularSumSS27() {
    var checkboxes = document.querySelectorAll('.SumSS27 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConUPIIGT').innerText = suma;
        });
    });
}

function calcularSumSS28() {
    var checkboxes = document.querySelectorAll('.SumSS28 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConUPIIHT').innerText = suma;
        });
    });
}

function calcularSumSS29() {
    var checkboxes = document.querySelectorAll('.SumSS29 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConUPIIPT').innerText = suma;
        });
    });
}

function calcularSumSS30() {
    var checkboxes = document.querySelectorAll('.SumSS30 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConUPIITT').innerText = suma;
        });
    });
}

function calcularSumSS31() {
    var checkboxes = document.querySelectorAll('.SumSS31 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConUPIITAT').innerText = suma;
        });
    });
}

function calcularSumSS32() {
    var checkboxes = document.querySelectorAll('.SumSS32 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('ConUPIIZT').innerText = suma;
        });
    });
}

    // Función para calcular la suma de los checkboxes dentro de .Trim1CI
    function calcularSumaTrim1CI() {
        var checkboxes = document.querySelectorAll('.Trim1CI > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim1').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2CI
    function calcularSumaTrim2CI() {
        var checkboxes = document.querySelectorAll('.Trim2CI > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim2').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3CI
    function calcularSumaTrim3CI() {
        var checkboxes = document.querySelectorAll('.Trim3CI > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim3').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4CI
    function calcularSumaTrim4CI() {
        var checkboxes = document.querySelectorAll('.Trim4CI > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim4').innerText = suma;
            });
        });
    }

       // Función para calcular la suma de los checkboxes dentro de .Trim1CIS
        function calcularSumaTrim1CIS() {
        var checkboxes = document.querySelectorAll('.Trim1CIS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim1S').innerText = suma;
                calcularSumaTotal3T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2CI
    function calcularSumaTrim2CIS() {
        var checkboxes = document.querySelectorAll('.Trim2CIS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim2S').innerText = suma;
                calcularSumaTotal3T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3CIS
    function calcularSumaTrim3CIS() {
        var checkboxes = document.querySelectorAll('.Trim3CIS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim3S').innerText = suma;
                calcularSumaTotal3T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4CIS
    function calcularSumaTrim4CIS() {
        var checkboxes = document.querySelectorAll('.Trim4CIS > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total3Trim4S').innerText = suma;
                calcularSumaTotal3T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim1CVDR
    function calcularSumaTrim1CVDR() {
        var checkboxes = document.querySelectorAll('.Trim1CVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim1').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2CVDR
    function calcularSumaTrim2CVDR() {
        var checkboxes = document.querySelectorAll('.Trim2CVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim2').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3CVDR
    function calcularSumaTrim3CVDR() {
        var checkboxes = document.querySelectorAll('.Trim3CVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim3').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4CVDR
    function calcularSumaTrim4CVDR() {
        var checkboxes = document.querySelectorAll('.Trim4CVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim4').innerText = suma;
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim1SCVDR
    function calcularSumaTrim1SCVDR() {
        var checkboxes = document.querySelectorAll('.Trim1SCVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim1S', 'Trim1SMS').innerText = suma;
                calcularSumaTotal4T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim2SCVDR
    function calcularSumaTrim2SCVDR() {
        var checkboxes = document.querySelectorAll('.Trim2SCVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim2S', 'Trim2SMS').innerText = suma;
                calcularSumaTotal4T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim3SCVDR
    function calcularSumaTrim3SCVDR() {
        var checkboxes = document.querySelectorAll('.Trim3SCVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim3S', 'Trim3SMS').innerText = suma;
                calcularSumaTotal4T();
            });
        });
    }

    // Función para calcular la suma de los checkboxes dentro de .Trim4SCVDR
    function calcularSumaTrim4SCVDR() {
        var checkboxes = document.querySelectorAll('.Trim4SCVDR > input[type="checkbox"]');
        var suma = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('input', function () {
                var valor = parseInt(checkbox.value);
                if (checkbox.checked) {
                    suma += valor;
                } else {
                    suma -= valor;
                }
                document.getElementById('Total4Trim4S', 'Trim4SMS').innerText = suma;
                calcularSumaTotal4T();
            });
        });
    }


// COMIENZAN SUMA HORIZONTAL//


// Función para calcular la suma de los checkboxes dentro de .CVDRCJT
function calcularSumaCVDRCJT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS1 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRCJT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRCHT
function calcularSumaCVDRCHT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS2 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRCHT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRCNT
function calcularSumaCVDRCNT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS3 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRCNT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRCLT
function calcularSumaCVDRCLT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS4 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRCLT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRDT
function calcularSumaCVDRDT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS5 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRDT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRLMT
function calcularSumaCVDRLMT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS6 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRLMT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRMZT
function calcularSumaCVDRMZT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS7 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRMZT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRMRT
function calcularSumaCVDRMRT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS8 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRMRT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDROXT
function calcularSumaCVDROXT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS9 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDROXT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRTMT
function calcularSumaCVDRTMT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS10 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRTMT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRTJT
function calcularSumaCVDRTJT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS11 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRTJT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRTXT
function calcularSumaCVDRTXT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS12 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRTXT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRCHIT
function calcularSumaCVDRCHIT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS13 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRCHIT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRVT
function calcularSumaCVDRVT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS14 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRVT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRGT
function calcularSumaCVDRGT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS15 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRGT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CVDRPT
function calcularSumaCVDRPT() {
    var checkboxes = document.querySelectorAll('.SumCVDRS16 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CVDRPT').innerText = suma;
        });
    });
}


        
        
// Función para calcular la suma de los checkboxes dentro de .CICICT
function calcularSumaCICICT() {
    var checkboxes = document.querySelectorAll('.SumCIS1 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CICICT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CICITEDIT
function calcularSumaCICITEDIT() {
    var checkboxes = document.querySelectorAll('.SumCIS2 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CICITEDIT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CICICATALT
function calcularSumaCICICATALT() {
    var checkboxes = document.querySelectorAll('.SumCIS3 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CICICATALT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CICICATAAT
function calcularSumaCICICATAAT() {
    var checkboxes = document.querySelectorAll('.SumCIS4 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CICICATAAT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CICICATAQT
function calcularSumaCICICATAQT() {
    var checkboxes = document.querySelectorAll('.SumCIS5 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CICICATAQT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CICICATAMT
function calcularSumaCICICATAMT() {
    var checkboxes = document.querySelectorAll('.SumCIS6 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CICICATAMT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CIBATT
function calcularSumaCIBATT() {
    var checkboxes = document.querySelectorAll('.SumCIS7 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CIBATT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CIITECT
function calcularSumaCIITECT() {
    var checkboxes = document.querySelectorAll('.SumCIS8 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CIITECT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CIDETECT
function calcularSumaCIDETECT() {
    var checkboxes = document.querySelectorAll('.SumCIS9 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CIDETECT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CMPLT
function calcularSumaCMPLT() {
    var checkboxes = document.querySelectorAll('.SumCIS10 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CMPLT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CICIMART
function calcularSumaCICIMART() {
    var checkboxes = document.querySelectorAll('.SumCIS11 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CICIMART').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CIIEMADT
function calcularSumaCIIEMADT() {
    var checkboxes = document.querySelectorAll('.SumCIS12 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CIIEMADT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CEPROBIT
function calcularSumaCEPROBIT() {
    var checkboxes = document.querySelectorAll('.SumCIS13 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CEPROBIT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CIIDIRDT
function calcularSumaCIIDIRDT() {
    var checkboxes = document.querySelectorAll('.SumCIS14 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CIIDIRDT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CIIDIRMT
function calcularSumaCIIDIRMT() {
    var checkboxes = document.querySelectorAll('.SumCIS15 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CIIDIRMT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CIIDIROT
function calcularSumaCIIDIROT() {
    var checkboxes = document.querySelectorAll('.SumCIS16 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CIIDIROT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CIIDIRST
function calcularSumaCIIDIRST() {
    var checkboxes = document.querySelectorAll('.SumCIS17 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CIIDIRST').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CBGTT
function calcularSumaCBGTT() {
    var checkboxes = document.querySelectorAll('.SumCIS18 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CBGTT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .CIECASTT
function calcularSumaCIECASTT() {
    var checkboxes = document.querySelectorAll('.SumCIS19 > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('CIECASTT').innerText = suma;
        });
    });
}

// Función para calcular la suma de los checkboxes dentro de .Total3T
function calcularSumaTotal3T() {
    var checkboxes = document.querySelectorAll('.ToyalCIT > input[type="checkbox"]');
    var suma = 0;
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('input', function () {
            var valor = parseInt(checkbox.value);
            if (checkbox.checked) {
                suma += valor;
            } else {
                suma -= valor;
            }
            document.getElementById('Total3T').innerText = suma;
        });
    });
}

// COMIENZA SUMA CASILLA TOTAL//

    // Función para actualizar la suma total en TotalTMS
    function calcularSumaTotal1T() {
        // Extraer el contenido de los elementos
        var total1 = parseInt(document.getElementById('TotalTrim1S').textContent) || 0;
        var total2 = parseInt(document.getElementById('TotalTrim2S').textContent) || 0;
        var total3 = parseInt(document.getElementById('TotalTrim3S').textContent) || 0;
        var total4 = parseInt(document.getElementById('TotalTrim4S').textContent) || 0;
        
        // Sumar los valores extraídos
        var totalSum = total1 + total2 + total3 + total4;
        
        // Actualizar el contenido del elemento Total4T con la suma total
        document.getElementById('Total1T').textContent = totalSum;
    }

    // Función para actualizar la suma total en Total2TSUP
    function calcularSumaTotal2T() {
        // Extraer el contenido de los elementos
        var total1 = parseInt(document.getElementById('Total2Trim1S').textContent) || 0;
        var total2 = parseInt(document.getElementById('Total2Trim2S').textContent) || 0;
        var total3 = parseInt(document.getElementById('Total2Trim3S').textContent) || 0;
        var total4 = parseInt(document.getElementById('Total2Trim4S').textContent) || 0;
        
        // Sumar los valores extraídos
        var totalSum = total1 + total2 + total3 + total4;
        
        // Actualizar el contenido del elemento Total4T con la suma total
        document.getElementById('Total2T').textContent = totalSum;
    }
    // Función para actualizar la suma total en Total4TCVDR
    function calcularSumaTotal4T() {
        // Extraer el contenido de los elementos
        var total1 = parseInt(document.getElementById('Total4Trim1S').textContent) || 0;
        var total2 = parseInt(document.getElementById('Total4Trim2S').textContent) || 0;
        var total3 = parseInt(document.getElementById('Total4Trim3S').textContent) || 0;
        var total4 = parseInt(document.getElementById('Total4Trim4S').textContent) || 0;
        
        // Sumar los valores extraídos
        var totalSum = total1 + total2 + total3 + total4;
        
        // Actualizar el contenido del elemento Total4T con la suma total
        document.getElementById('Total4T').textContent = totalSum;
    }

    // Función para actualizar la suma total en Total3TCI
    function calcularSumaTotal3T() {
        // Extraer el contenido de los elementos
        var total1 = parseInt(document.getElementById('Total3Trim1S').textContent) || 0;
        var total2 = parseInt(document.getElementById('Total3Trim2S').textContent) || 0;
        var total3 = parseInt(document.getElementById('Total3Trim3S').textContent) || 0;
        var total4 = parseInt(document.getElementById('Total3Trim4S').textContent) || 0;
        
        // Sumar los valores extraídos
        var totalSum = total1 + total2 + total3 + total4;
        
        // Actualizar el contenido del elemento Total3T con la suma total
        document.getElementById('Total3T').textContent = totalSum;
    }








    // Llamar a cada función para iniciar la lógica
    calcularSumaTrim1();
    calcularSumaTrim2();
    calcularSumaTrim3();
    calcularSumaTrim4();
    calcularSumaTrim1S();
    calcularSumaTrim2S();
    calcularSumaTrim3S();
    calcularSumaTrim4S();
    calcularSumaTrim1SS();
    calcularSumaTrim2SS();
    calcularSumaTrim3SS();
    calcularSumaTrim4SS();
    calcularSumaTrim1SSS();
    calcularSumaTrim2SSS();
    calcularSumaTrim3SSS();
    calcularSumaTrim4SSS();
    calcularSumaTrim1CI();
    calcularSumaTrim2CI();
    calcularSumaTrim3CI();
    calcularSumaTrim4CI();
    calcularSumaTrim1CIS();
    calcularSumaTrim2CIS();
    calcularSumaTrim3CIS();
    calcularSumaTrim4CIS();
    calcularSumaTrim1CVDR();
    calcularSumaTrim2CVDR();
    calcularSumaTrim3CVDR();
    calcularSumaTrim4CVDR();
    calcularSumaTrim1SCVDR();
    calcularSumaTrim2SCVDR();
    calcularSumaTrim3SCVDR();
    calcularSumaTrim4SCVDR();
    calcularSumaCVDRCJT();
    calcularSumaCVDRCHT();
    calcularSumaCVDRCNT();
    calcularSumaCVDRCLT();
    calcularSumaCVDRDT();
    calcularSumaCVDRLMT();
    calcularSumaCVDRMZT();
    calcularSumaCVDRMRT();
    calcularSumaCVDROXT();
    calcularSumaCVDRTMT();
    calcularSumaCVDRTJT();
    calcularSumaCVDRTXT();
    calcularSumaCVDRCHIT();
    calcularSumaCVDRVT();
    calcularSumaCVDRGT();
    calcularSumaCVDRPT();
    calcularSumaTotal4T();
    
    //suma en horizontal
    calcularSumMDS1();
    calcularSumMDS2();
    calcularSumMDS3();
    calcularSumMDS4();
    calcularSumMDS5();
    calcularSumMDS6();
    calcularSumMDS7();
    calcularSumMDS8();
    calcularSumMDS9();
    calcularSumMDS10();
    calcularSumMDS11();
    calcularSumMDS12();
    calcularSumMDS13();
    calcularSumMDS14();
    calcularSumMDS15();
    calcularSumMDS16();
    calcularSumMDS17();
    calcularSumMDS18();
    calcularSumMDS19();
    calcularSumCetMDS1();

    calcularSumSS1();
    calcularSumSS2();
    calcularSumSS3();
    calcularSumSS4();
    calcularSumSS5();
    calcularSumSS6();
    calcularSumSS7();
    calcularSumSS8();
    calcularSumSS9();
    calcularSumSS10();
    calcularSumSS11();
    calcularSumSS12();
    calcularSumSS13();
    calcularSumSS14();
    calcularSumSS15();
    calcularSumSS16();
    calcularSumSS17();
    calcularSumSS18();
    calcularSumSS19();
    calcularSumSS20();
    calcularSumSS21();
    calcularSumSS22();
    calcularSumSS23();
    calcularSumSS24();
    calcularSumSS25();
    calcularSumSS26();
    calcularSumSS27();
    calcularSumSS28();
    calcularSumSS29();
    calcularSumSS30();
    calcularSumSS31();
    calcularSumSS32();
    calcularSumaCVDRCJT();
    calcularSumaCVDRCHT();
    calcularSumaCVDRCNT();
    calcularSumaCVDRCLT();
    calcularSumaCVDRDT();
    calcularSumaCVDRLMT();
    calcularSumaCVDRMZT();
    calcularSumaCVDRMRT();
    calcularSumaCVDROXT();
    calcularSumaCVDRTMT();
    calcularSumaCVDRTJT();
    calcularSumaCVDRTXT();
    calcularSumaCVDRCHIT();
    calcularSumaCVDRVT();
    calcularSumaCVDRGT();
    calcularSumaCVDRPT();
    calcularSumaTotal4T();
    calcularSumaCICICT();
    calcularSumaCICITEDIT();
    calcularSumaCICICATALT();
    calcularSumaCICICATAAT();
    calcularSumaCICICATAQT();
    calcularSumaCICICATAMT();
    calcularSumaCIBATT();
    calcularSumaCIITECT();
    calcularSumaCIDETECT();
    calcularSumaCMPLT();
    calcularSumaCICIMART();
    calcularSumaCIIEMADT();
    calcularSumaCEPROBIT();
    calcularSumaCIIDIRDT();
    calcularSumaCIIDIRMT();
    calcularSumaCIIDIROT();
    calcularSumaCIIDIRST();
    calcularSumaCBGTT();
    calcularSumaCIECASTT();
    calcularSumaTotal3T();
});
