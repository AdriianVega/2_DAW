import { Link } from "react-router-dom";

export default function ProductoCard({ producto }) {
    return (
        <div className="tarjeta">
        <h3>{producto.nombre}</h3>
        <p className="precio">Precio: {producto.precio}€</p>
        {producto.oferta && <span className="badge-oferta">¡Oferta!</span>}
        <br />
        <Link to={`/producto/${producto.id}`} className="btn-detalle">
            Ver detalle
        </Link>
        </div>
    );
}