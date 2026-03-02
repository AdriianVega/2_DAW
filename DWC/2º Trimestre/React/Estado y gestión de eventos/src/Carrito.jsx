import { useState } from "react";

function Carrito() {
    // Iniciamos con dos productos base
    const [carrito, setCarrito] = useState([
        { nombre: "Producto A", precio: 99 },
        { nombre: "Producto B", precio: 149 },
    ]);

    const agregarProducto = () => {
        // Definimos los nuevos productos y expandimos el carrito actual sumandolos
        const productos = [
            { nombre: "Producto A", precio: 99 },
            { nombre: "Producto B", precio: 149 }
        ];
        setCarrito([...carrito, ...productos]);
    };

    // Limpiamos el carrito
    const vaciarCarrito = () => setCarrito([]);

    const ajustarCantidad = (n) => {
        // Guarda el valor del input y si no tiene valor empieza en 0
        const valor = Number.parseInt(n) || 0;

        // Si el valor es menos o igual a 0 devolvemos el carrito vacio
        // Así evitamos números negativos
        if (valor <= 0) {
            return setCarrito([]);
        }
        
        // Introducimos los productos según el valor del input
        // Si es impar, producto A, si no, producto B
        const nuevoCarrito = Array.from({ length: valor }, (_, i) => ({
            nombre: i % 2 === 0 ? "Producto A" : "Producto B",
            precio: i % 2 === 0 ? 99 : 149
        }));
        setCarrito(nuevoCarrito);
    };

    // Sumamos el precio total del carrito
    const precioTotal = carrito.reduce((total, p) => total + p.precio, 0);

    return (
        <div style={{ padding: "20px", fontFamily: "sans-serif" }}>
            <h2>Carrito de Compras</h2>
            
            <button onClick={agregarProducto} style={{ padding: "10px", marginRight: "10px" }}>
                Agregar Pack
            </button>
            
            <button onClick={vaciarCarrito} disabled={carrito.length === 0} style={{ padding: "10px" }}>
                Vaciar Carrito
            </button>

            <input
                type="number"
                min="0"
                value={carrito.length}
                onChange={(e) => ajustarCantidad(e.target.value)}
                style={{ marginLeft: "15px", padding: "10px", width: "50px" }}
                step="2"
            />

            <h3>Productos ({carrito.length}):</h3>
            <ul style={{ listStyleType: "none", padding: 0 }}>
                {carrito.length === 0 ? (
                    <li>El carrito está vacío</li>
                ) : (
                    // Mapeamos los objetos para dibujarlos en la lista
                    carrito.map((p, index) => (
                        <li key={index}>{p.nombre} - {p.precio}€</li>
                    ))
                )}
            </ul>

            {carrito.length >= 5 && <p><strong>Aviso:</strong> Tienes más de 5 productos.</p>}
            <p><strong>Precio total:</strong> {precioTotal}€</p>
        </div>
    );
}

export default Carrito;