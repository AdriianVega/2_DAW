// Función para activar los eventos de tipo bubbling
// Primero borramos los eventos anteriores y se actualiza el texto informativo
// Luego asignamos los eventos de clic a los elementos usando bubbling
function clickBubbling() {
    borrarEventos();
    texto.textContent = "BUBBLING";
    myDiv.addEventListener("click", clickNaranja);
    myP.addEventListener("click", clickBlanco);
}

// Función para activar los eventos de tipo capturing
// Primero borramos los eventos anteriores y se actualiza el texto informativo
// Luego asignamos los eventos de clic a los elementos usando captura
function clickCapturing() {
    borrarEventos();
    texto.textContent = "CAPTURING";
    myDiv.addEventListener("click", clickNaranja, true);
    myP.addEventListener("click", clickBlanco, true);
}

// Función que se ejecuta al hacer clic sobre el div naranja
// Mostramos una alerta indicando que se ha hecho clic en el div
function clickNaranja() {
    alert("Has hecho clic en el naranja");
}

// Función que se ejecuta al hacer clic sobre el párrafo blanco
// Mostramos una alerta indicando que se ha hecho clic en el párrafo
function clickBlanco() {
    alert("Has hecho click en el blanco");
}

// Función que elimina todos los eventos de clic asignados a los elementos
// También actualizamos el texto informativo
function borrarEventos() {
    texto.textContent = "EVENTO CLIC DESACTIVADO:";

    //Borramos los eventos tanto de captura como de bubbling
    myDiv.removeEventListener("click", clickNaranja);
    myDiv.removeEventListener("click", clickNaranja, true);
    myP.removeEventListener("click", clickBlanco);
    myP.removeEventListener("click", clickBlanco, true);
}

// Obtenemos los elementos del DOM que serán usados para asignar eventos
const botBub = document.getElementById("botBub");
const botCapt = document.getElementById("botCapt");
const botStop = document.getElementById("botStop");
const myDiv = document.getElementById("myDiv");
const myP = document.getElementById("myP");

// Obtenemos el elemento h2 dentro del div para mostrar mensajes informativos
let texto = myDiv.getElementsByTagName("h2")[0];

// Asignamos eventos de clic a los botones
// Cada botón ejecuta la función correspondiente para activar bubbling, capturing o borrar eventos
botBub.addEventListener("click", clickBubbling);
botCapt.addEventListener("click", clickCapturing);
botStop.addEventListener("click", borrarEventos);
