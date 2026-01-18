const main = document.getElementsByTagName("main")[0];

const secciones = [
    { titulo: "Productos", imagen: "../img/menu/caja.svg", ruta: "../productos/gestion_productos.php"},
    { titulo: "Clientes", imagen: "../img/menu/personas.svg", ruta: "../clientes/gestion_clientes.php"},
    { titulo: "Pedidos", imagen: "../img/menu/entrega-de-pedidos.svg", ruta: "../pedidos/gestion_pedidos.php"},
    { titulo: "Categorías", imagen: "../img/menu/lista.svg", ruta: "../categorias/gestion_categorias.php"},
    { titulo: "Usuarios", imagen: "../img/menu/usuario.svg", ruta: "../usuarios/gestion_usuarios.php"},
    { titulo: "Configuración", imagen: "../img/menu/ajuste.svg", ruta: "../configuracion/configuracion.php"},
]

for (let seccion of secciones) {

    const enlace = document.createElement("a");
    enlace.href = seccion.ruta;

    const nuevaSeccion = document.createElement("article");

    const imagen = document.createElement("img");
    imagen.src = seccion.imagen

    const titulo = document.createElement("h3");
    titulo.textContent = seccion.titulo;

    nuevaSeccion.appendChild(imagen);
    nuevaSeccion.appendChild(titulo);

    enlace.appendChild(nuevaSeccion);

    main.appendChild(enlace)
}

