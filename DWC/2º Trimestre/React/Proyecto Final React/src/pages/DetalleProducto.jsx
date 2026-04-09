import { useParams, Link } from "react-router-dom";
import { productos } from "../data/productos";

export default function DetalleProducto() {
    const { id } = useParams();
    const producto = productos.find((p) => p.id === parseInt(id));

    if (!producto) {
        return (
        <div>
            <h2>Producto no encontrado</h2>
            <Link to="/">Volver al listado</Link>
        </div>
        );
    }

    return (
        <div className="detalle-producto">
        <h2>{producto.nombre}</h2>
        <p className="categoria-tag">Categoría: {producto.categoria}</p>
        <h3>Precio: {producto.precio}€</h3>
        <p>{producto.descripcion}</p>
        
        <Link to="/" className="btn-volver">← Volver al listado</Link>
        </div>
    );
}