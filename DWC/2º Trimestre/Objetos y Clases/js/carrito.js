// Clase para productos
class Producto {
    // Definimos campos privados
    #id;
    #nombre;
    #precio;
    #cantidad;
    #tieneImpuesto;
    
    // Inicializamos el producto con variables e id aleatorio y validamos el precio
    constructor(nombre, precio, cantidad, tieneImpuesto) {
        this.#id = this.#randomId();
        this.#nombre = nombre;
        this.cantidad = cantidad;
        this.#tieneImpuesto = tieneImpuesto;

        this.#validarPrecio(precio);
    }

    // Getters para los campos privados
    get id() { return this.#id; }
    get nombre() { return this.#nombre }
    get precio() { return this.#precio; }
    get cantidad() { return this.#cantidad; }
    get tieneImpuesto() { return this.#tieneImpuesto; }

    // Validamos y asignamos la cantidad
    set cantidad(valor) {
        if (valor > 0) {
            this.#cantidad = valor;
        }
        else {
            throw new ValueError("La cantidad no puede ser 0 o menor");
        }
    }

    // Validamos y asignamos el precio
    #validarPrecio(precio){
        if (precio > 0) {
            this.#precio = precio;
        }
        else {
            throw new ValueError("El precio no puede ser 0 o menor");
        }
    }

    // Generamos un id aleatorio
    #randomId() {
        return Math.floor(Math.random() * 100) + 1;
    }
}

// Clase para el carrito
class Carrito {
    // Inicializamos la lista de productos
    productos = []

    // Validamos la instancia y añadimos el producto
    agregarProducto(producto) {
        if (producto instanceof Producto) {
            this.productos.push(producto);
        } else {
            throw new ValueError("El objeto no es una instancia de Producto");
        }
    }

    // Actualizamos la cantidad buscando por id
    actualizarCantidadProducto(id, cantidad) {
        for (let producto of this.productos) {
            if (producto.id === id) {
                producto.cantidad = cantidad;
                console.log("Producto actualizado");
                return ;
            }
        }
        console.log("Producto no encontrado");
    }

    // Eliminamos el producto de la lista por id
    eliminarProducto(id) {
        for (let producto of this.productos) {
            if (producto.id === id) {
                const index = this.productos.indexOf(producto);
                this.productos.splice(index, 1);
                console.log("Producto eliminado");
                return;
            }
        }
        console.log("Producto no encontrado");
    }

    // Calculamos el total con impuestos incluidos
    calcularTotal() {
        let total = 0;
        for (let producto of this.productos) {
            if (!producto.tieneImpuesto) {
                total += producto.precio * producto.cantidad;
            }
        }
        return total + this.calcularImpuestoTotal();
    }

    // Calculamos solo el total de los impuestos
    calcularImpuestoTotal() {
        let total = 0;
        for (let producto of this.productos) {
            if (producto.tieneImpuesto) {
                total += producto.precio * producto.cantidad * 0.1;
            }
        }
        return total;
    }

    // Obtenemos la cantidad de items en el carrito
    obtenerCantidadTotal() {
        return this.productos.length;
    }

    // Pasamos el contenido del carrito a texto
    toString() {
        let resultado = "Productos:";
        for (let producto of this.productos) {
            resultado += `\n- ${producto.nombre} (${producto.cantidad}), ${producto.precio}€, ${producto.tieneImpuesto ? "Con impuesto" : "Sin impuesto"}`;
        }
        return resultado;
    }
}

console.log ("------------------ CARRITO ----------------------")
const producto1 = new Producto('Manzana', 1.5, 10, true);
const producto2 = new Producto('Pan', 2, 5, false);
const carrito = new Carrito();
carrito.agregarProducto(producto1);
carrito.agregarProducto(producto2);
console.log(carrito.toString());
console.log('Total con impuestos:', carrito.calcularTotal());
console.log('Total impuestos:', carrito.calcularImpuestoTotal());
console.log('Cantidad total de ítems:',
carrito.obtenerCantidadTotal());
carrito.actualizarCantidadProducto(producto1.id, 20);
console.log(carrito.toString());
carrito.eliminarProducto(producto2.id);
console.log(carrito.toString());

console.log ("-----------------------------------------------")