const main = document.getElementsByTagName("main")[0];

const secciones = [
    { titulo: "Productos", imagen: "../img/menu/caja.svg", ruta: "inicio.php"},
    { titulo: "Clientes", imagen: "../img/menu/personas.svg", ruta: "inicio.php"},
    { titulo: "Pedidos", imagen: "../img/menu/entrega-de-pedidos.svg", ruta: "inicio.php"},
    { titulo: "Categorías", imagen: "../img/menu/lista.svg", ruta: "inicio.php"},
    { titulo: "Configuración", imagen: "../img/menu/ajuste.svg", ruta: "inicio.php"},
]

for (let seccion of secciones) {

    const enlace = document.createElement("a");
    enlace.href = seccion.ruta;

    const nuevaSeccion = document.createElement("article");
    nuevaSeccion.style.border = "3px solid blue";

    const imagen = document.createElement("img");
    imagen.src = seccion.imagen

    const titulo = document.createElement("h3");
    titulo.textContent = seccion.titulo;

    nuevaSeccion.appendChild(imagen);
    nuevaSeccion.appendChild(titulo);

    enlace.appendChild(nuevaSeccion);

    main.appendChild(enlace)
}

