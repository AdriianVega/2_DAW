import { Link } from "react-router-dom";

export default function Navbar() {
    return (
        <nav className="navbar">
        <h2>Mi Tienda SPA</h2>
        <div className="links">
            <Link to="/">Productos</Link>
            <Link to="/sobre">Sobre nosotros</Link>
        </div>
        </nav>
    );
}