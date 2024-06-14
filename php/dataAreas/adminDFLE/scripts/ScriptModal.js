

  window.addEventListener('load',()=>{
    console.log("DOM cargado");
    

  let contbtn = document.querySelectorAll('#contbtn');
  let contModalC = document.querySelectorAll('#contModal-1');
  for (let i = 0; i < contbtn.length; i++) {
    contbtn[i].addEventListener('click', () => {
      console.log("boton - " + i);
      let conteForm = contModalC[i].getAttribute('class');
      let contenedorF = document.getElementsByClassName(conteForm)[0];
      // Establecer el estilo del contenedor específico
      contenedorF.style.display = "none";
      console.log(contenedorF);
    });
  }
  
  
  let modalsModif = document.querySelectorAll('#Btn-AbrirModal');
  let contModalModif = document.querySelectorAll('#contModal-1');
  for (let i = 0; i < modalsModif.length; i++) {
    modalsModif[i].addEventListener('click', () => {
      console.log("boton - " + i);
      let conteForm = contModalModif[i].getAttribute('class');
      let contenedorF = document.getElementsByClassName(conteForm)[0];
      // Establecer el estilo del contenedor específico
      contenedorF.style.display = "flex";
      contenedorF.style.position = 'fixed';
      contenedorF.style.top = '0';
      contenedorF.style.left = '0';
      contenedorF.style.width = '100vw';
      contenedorF.style.height = '100vh';
      contenedorF.style.zIndex = '9999';
      console.log(contenedorF);
    });
  }
  


  let cancelar = document.querySelectorAll('#cancelar');
  let contModalEl = document.querySelectorAll('#contModal-2');
  for (let i = 0; i < cancelar.length; i++) {
    cancelar[i].addEventListener('click', () => {
      console.log("boton - " + i);
      let conteForm = contModalEl[i].getAttribute('class');
      let contenedorF = document.getElementsByClassName(conteForm)[0];
      // Establecer el estilo del contenedor específico
      contenedorF.style.display = "none";
      console.log(contenedorF);
    });
  }

  
  let AbrirModalElim = document.querySelectorAll('#Btn-AbrirModalElim');
  let contModalElim = document.querySelectorAll('#contModal-2');
  for (let i = 0; i < AbrirModalElim.length; i++) {
    AbrirModalElim[i].addEventListener('click', () => {
      console.log("boton - " + i);
      let conteForm = contModalElim[i].getAttribute('class');
      let contenedorF = document.getElementsByClassName(conteForm)[0];
      // Establecer el estilo del contenedor específico
      contenedorF.style.display = "flex";
      contenedorF.style.position = 'fixed';
      contenedorF.style.top = '0';
      contenedorF.style.left = '0';
      contenedorF.style.width = '100vw';
      contenedorF.style.height = '100vh';
      contenedorF.style.zIndex = '9999';
      console.log(contenedorF);
    });
  }






  let btnc3 = document.getElementById("contbtn3");

  if (btnc3 !== null) {
      btnc3.addEventListener('click', () => {
          console.log("se ha presionado el btn cerrar");
          let contModal3 = document.getElementById("contModal-3");
          if (contModal3 !== null) {
              contModal3.style.display = "none";
          } else {
              //console.error("Elemento con ID 'contModal-3' no encontrado.");
          }
      });
  } else {
      //console.error("Elemento con ID 'contbtn3' no encontrado.");
  }
  

  let btnAbrir3 = document.getElementById("Btn-AgregarReg");

  if (btnAbrir3 !== null) {
    btnAbrir3.addEventListener('click', () => {
          console.log("se ha presionado el btn cerrar");
          let contModal3 = document.getElementById("contModal-3");
          if (contModal3 !== null) {
              contModal3.style.display="flex";
              contModal3.style.position = 'fixed';
              contModal3.style.top = '0';
              contModal3.style.left = '0';
              contModal3.style.width = '100vw';
              contModal3.style.height = '100vh';
              contModal3.style.zIndex = '9999';
          } else {
              //console.error("Elemento con ID 'contModal-3' no encontrado.");
          }
      });
  } else {
      //console.error("Elemento con ID 'contbtn3' no encontrado.");
  }


  });