// Ejercicio 1
const listaUsuarios = document.getElementById("usuarios").getElementsByTagName("ul")[0];
const nuevoUsuario = document.createElement("li");

nuevoUsuario.textContent = "Carlos";
nuevoUsuario.classList.add("user");

listaUsuarios.appendChild(nuevoUsuario);

// Ejercicio 2
const usuarioNuevo = document.createElement("li");

usuarioNuevo.textContent = "Pedro";
usuarioNuevo.classList.add("user", "nuevo")

listaUsuarios.appendChild(usuarioNuevo);

for (let usuario of listaUsuarios.children)
{
    if (usuario.classList.contains("nuevo"))
    {
        listaUsuarios.insertBefore(usuario, listaUsuarios.firstChild);
    }
}

// Ejercicio 3
for (let usuario of listaUsuarios.children)
{
    if (usuario.classList.contains("activo"))
    {
        listaUsuarios.removeChild(usuario);
    }
}

// Ejercicio 4
for (let usuario of listaUsuarios.children)
{
    usuario.classList.add("verificado");
}

// Ejercicio 5
const productos = document.getElementById("productos");

let nuevoProducto = document.createElement("div");
let tituloProducto = document.createElement("h3");
let precioProducto = document.createElement("p");

nuevoProducto.classList.add("producto");
nuevoProducto.setAttribute("data-id", 103);
precioProducto.classList.add("precio");

tituloProducto.textContent = "Auriculares";
precioProducto.textContent = "49.99";

nuevoProducto.append(
    tituloProducto,
    precioProducto
);

productos.appendChild(nuevoProducto);

//Ejercicio 6
const productoTeclado = productos.getElementsByTagName("div")[0];

nuevoProducto = productoTeclado.cloneNode(true);

nuevoProducto.setAttribute("data-id", 201);

tituloProducto = nuevoProducto.getElementsByTagName("h3")[0];

tituloProducto.textContent = "Teclado PRO";

productos.appendChild(nuevoProducto);

//Ejercicio 7
let listaProductos = productos.getElementsByClassName("producto")

for (let producto of listaProductos)
{
    let precioProducto = producto.getElementsByTagName("p")[0]

    precioProducto.textContent = (Number(precioProducto.textContent) + 5).toFixed(2);

    if (Number(precioProducto.textContent) > 30)
    {
        producto.classList.add("caro");
    }
}

//Ejercicio 8
const body = document.getElementsByTagName("body")[0];

let nuevaLista = document.createElement("ul");

body.insertBefore(nuevaLista, body.firstChild);

let tituloLista = document.createElement("h2");

tituloLista.textContent = "Productos";

body.insertBefore(tituloLista, body.firstChild);

for (let producto of listaProductos)
{
    let tituloProducto = producto.getElementsByTagName("h3")[0].textContent;

    let nuevoProducto =  document.createElement("li");

    nuevoProducto.textContent = tituloProducto;

    nuevaLista.appendChild(nuevoProducto);
}

//Ejercicio 9
let precioMayor = 0;
let tituloMayor;

for (let producto of listaProductos)
{
    let precioActual = Number(producto.getElementsByClassName("precio")[0].textContent);

    if (precioActual > precioMayor)
    {
        precioMayor = precioActual;
        tituloMayor = producto.getElementsByTagName("h3")[0];
    }
}
for (let producto of nuevaLista.children)
{
    if (producto.textContent === tituloMayor.textContent)
    {
        nuevaLista.insertBefore(producto, nuevaLista.firstChild);
    }
}

//Ejercicio 10
const listadoActualizado = document.createElement("div");
const usuarios = document.getElementById("usuarios");

listadoActualizado.classList.appendChild("card");

let tituloUsuarios = document.createElement("h3");

tituloUsuarios.textContent = "Listado actualizado";

listadoActualizado.appendChild(tituloUsuarios);

listadoActualizado.appendChild(listaUsuarios);

usuarios.appendChild(listaUsuarios);
