const main = document.getElementsByTagName("main")[0];

const secciones = [
    { titulo: "Productos", imagen: "imagen.svg", ruta: "inicio.php"},
    { titulo: "Clientes", imagen: "imagen.svg", ruta: "inicio.php"},
    { titulo: "Productos", imagen: "imagen.svg", ruta: "inicio.php"},
    { titulo: "Productos", imagen: "imagen.svg", ruta: "inicio.php"},
    { titulo: "Productos", imagen: "imagen.svg", ruta: "inicio.php"},
    { titulo: "Configuración", imagen: "imagen.svg", ruta: "inicio.php"},
]

for (let seccion of secciones) {

    const enlace = document.createElement("a");
    enlace.href = seccion.ruta;

    const nuevaSeccion = document.createElement("article");
    nuevaSeccion.style.border = "1px solid black";

    const imagen = document.createElement("img");
    imagen.src = seccion.imagen

    const titulo = document.createElement("h3");
    titulo.textContent = seccion.titulo;

    nuevaSeccion.appendChild(imagen);
    nuevaSeccion.appendChild(titulo);

    enlace.appendChild(nuevaSeccion);

    main.appendChild(enlace)
}

