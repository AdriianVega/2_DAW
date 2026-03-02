import { useState } from "react"

function Carrito() {
    const [carrito, setCarrito] = useState([["Producto A", "99€"], ["Producto B", "149€"]])

    function agregarAlCarrito(producto) {
        setCarrito([...carrito, producto])
    }

    function vaciarCarrito() {
        setCarrito([])
    }

    function cantidadCarrito(value) {
        const n = Number(value) || 0
        const nuevo = Array.from({ length: n }, () => [["Producto A", "99€"], ["Producto B", "149€"]])
        setCarrito(nuevo)
    }

    return (
        <div>
            <h2>Carrito de Compras</h2>
            <button 
                onClick={() => agregarAlCarrito([["Producto A", "99€"], ["Producto B", "149€"]])} 
                style={{ padding: "15px", marginRight: "25px" }}>
                Agregar Producto
            </button>
            <button 
                onClick={vaciarCarrito} 
                style={{ padding: "15px" }}
                disabled={carrito.length === 0}>
                    Vaciar Carrito
            </button>

            <input
                type="number"
                onChange={(e) => cantidadCarrito(e.target.value)}
                style={{ marginLeft: "15px", padding: "10px" }} 
                defaultValue={1}
                value={carrito.length}
                id={"cantidad"}
            />

            <h3>Productos en el Carrito:</h3>
            <ul style={{ listStyleType: "none", padding: 0 }}>
                {carrito.length === 0 
                ? <li>El carrito está vacío</li> 
                : carrito.map((producto, index) => (
                    <li key={index}>{producto[0]} - {producto[1]}</li>
                ))}
            </ul>
            <p>{carrito.length >= 5 ? "La cantidad de productos es mayor a 5" : null}</p>
            <p>Precio total: {carrito.reduce((total, producto) => total + parseFloat(producto[1].replace("€", "")), 0)}€</p>
        </div>
    )
}

export default Carrito