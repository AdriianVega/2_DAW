import { useState } from "react";
import { productos } from "../data/productos";
import ProductoCard from "../components/ProductoCard";

export default function Productos() {
    const [busqueda, setBusqueda] = useState("");
    const [categoria, setCategoria] = useState("");

    const productosFiltrados = productos.filter((p) => {
        const coincideTexto = p.nombre.toLowerCase().includes(busqueda.toLowerCase());
        const coincideCat = categoria === "" || p.categoria === categoria;
        return coincideTexto && coincideCat;
    });

    const limpiarFiltros = () => {
        setBusqueda("");
        setCategoria("");
    };

    return (
        <div>
        <h2>Listado de Productos</h2>
        
        <div className="filtros">
            <input 
            type="text" 
            placeholder="Buscar por nombre..." 
            value={busqueda}
            onChange={(e) => setBusqueda(e.target.value)} 
            />
            
            <select value={categoria} onChange={(e) => setCategoria(e.target.value)}>
            <option value="">Todas las categorías</option>
            <option value="Deporte">Deporte</option>
            <option value="Electrónica">Electrónica</option>
            <option value="Accesorios">Accesorios</option>
            </select>

            <button onClick={limpiarFiltros}>Limpiar filtros</button>
        </div>

        <p className="contador">
            Mostrando {productosFiltrados.length} de {productos.length} productos
        </p>

        <div className="grid-productos">
            {productosFiltrados.length > 0 ? (
            productosFiltrados.map((producto) => (
                <ProductoCard key={producto.id} producto={producto} />
            ))
            ) : (
            <p>No hay resultados</p>
            )}
        </div>
        </div>
    );
}