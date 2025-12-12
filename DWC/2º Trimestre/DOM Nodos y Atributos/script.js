// Ejercicio 1
const listaUsuarios = document.getElementById("usuarios").getElementsByTagName("ul")[0];
const nuevoUsuario = document.createElement("li");

// Configuramos el texto y la clase del nuevo usuario
nuevoUsuario.textContent = "Carlos";
nuevoUsuario.classList.add("user");

listaUsuarios.appendChild(nuevoUsuario);

// Ejercicio 2
const usuarioNuevo = document.createElement("li");

// Creamos un usuario nuevo y lo añadimos al principio con prepend
usuarioNuevo.textContent = "Pedro";
usuarioNuevo.classList.add("user", "nuevo")

listaUsuarios.prepend(usuarioNuevo);

// Ejercicio 3
// Buscamos el usuario activo y lo eliminamos
let usuarioActivo = listaUsuarios.querySelector(".activo")

// Eliminamos el usuario marcado como activo
usuarioActivo.remove();

// Ejercicio 4
// Recorremos los nodos hijos de la lista para añadir la clase "verificado"
for (let usuario of listaUsuarios.children)
{
    // Añadimos la clase para indicar verificación
    usuario.classList.add("verificado");
}

// Ejercicio 5
const productos = document.getElementById("productos");

// Creamos los elementos para un nuevo producto
let nuevoProducto = document.createElement("div");
let tituloProducto = document.createElement("h3");
let precioProducto = document.createElement("p");

// Asignamos clases, atributos y contenido
nuevoProducto.classList.add("producto");
nuevoProducto.setAttribute("data-id", 103);
precioProducto.classList.add("precio");

tituloProducto.textContent = "Auriculares";
precioProducto.textContent = "49.99";

// Añadimos el nuevo producto a la sección
nuevoProducto.append(
    tituloProducto,
    precioProducto
);

productos.appendChild(nuevoProducto);

//Ejercicio 6
const productoTeclado = productos.getElementsByTagName("div")[0];

// Clonamos el teclado y modificamos sus datos para crear el Teclado PRO
nuevoProducto = productoTeclado.cloneNode(true);

nuevoProducto.setAttribute("data-id", 201);

// Accedemos al título para actualizarlo
tituloProduto = nuevoProducto.getElementsByTagName("h3")[0];

tituloProducto.textContent = "Teclado PRO";

// Añadimos el nuevo producto a la lista de productos
productos.appendChild(nuevoProducto);

//Ejercicio 7
let listaProductos = productos.getElementsByClassName("producto")

// Recorremos los productos para actualizar el precio y marcar los caros
for (let producto of listaProductos)
{
    let precioProducto = producto.getElementsByTagName("p")[0]

    // Transformamos de str a int y redondeamos a dos decimales
    precioProducto.textContent = (Number(precioProducto.textContent) + 5).toFixed(2);

    //Si supera los 30€ lo marcamos
    if (Number(precioProducto.textContent) > 30)
    {
        producto.classList.add("caro");
    }
}

//Ejercicio 8
const body = document.getElementsByTagName("body")[0];

// Creamos la nueva lista y el título
let nuevaLista = document.createElement("ul");
let tituloLista = document.createElement("h2");

tituloLista.textContent = "Productos";

//Añadimos el título y la lista al principio del body
body.prepend(nuevaLista);
body.prepend(tituloLista);

// Llenamos la nueva lista con los nombres de los productos existentes
for (let producto of listaProductos)
{
    let tituloProducto = producto.getElementsByTagName("h3")[0].textContent;
    let nuevoProducto =  document.createElement("li");

    // Asignamos el nombre del producto a la lista nueva
    nuevoProducto.textContent = tituloProducto;

    nuevaLista.appendChild(nuevoProducto);
}

//Ejercicio 9
let precioMayor = 0;
let productoMayor;

// Buscamos el producto con el precio mayor
for (let producto of listaProductos)
{
    let precioActual = Number(producto.getElementsByClassName("precio")[0].textContent);

    if (precioActual > precioMayor)
    {
        // Actualizamos el producto más caro encontrado
        precioMayor = precioActual;
        productoMayor = producto;
    }
}
// Buscamos el primer producto de la lista
let primerProducto = productos.getElementsByClassName("producto")[0];

// Movemos el producto más caro antes del primero
primerProducto.before(productoMayor)

//Ejercicio 10
const listadoActualizado = document.createElement("div");
const usuarios = document.getElementById("usuarios");

// Metemos la lista de usuarios en un nuevo contenedor "card"
listadoActualizado.classList.add("card");

// Creamos el título de la lista
let tituloUsuarios = document.createElement("h3");

tituloUsuarios.textContent = "Listado actualizado";

// Unimos los elementos correspondientes
listadoActualizado.appendChild(tituloUsuarios);
listadoActualizado.appendChild(listaUsuarios);
usuarios.appendChild(listadoActualizado);
