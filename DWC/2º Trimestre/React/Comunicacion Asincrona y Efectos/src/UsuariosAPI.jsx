import { useState, useEffect } from "react";
import styles from "./Usuarios.module.css";

function UsuariosAPI() {
    const URL = "https://jsonplaceholder.typicode.com/users";

    const [usuarios, setUsuarios] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        fetch(URL)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error en la respuesta del servidor");
                }
                return response.json();
            })
            .then((data) => {
                setUsuarios(data);
                setLoading(false);
            })
            .catch((error) => {
                setError("No se han podido cargar los usuarios");
                setLoading(false);
            });
    }, []);

    if (loading) return <p className={styles.loading}>Cargando usuarios...</p>;
    if (error) return <p className={styles.error}>{error}</p>;

    return (
        <ul className={styles.listaUsuarios}>
            {usuarios.map((usuario) => (
                <li key={usuario.id} className={styles.usuario}>
                    <h3 className={styles.titulo}>{usuario.name}</h3>
                    <p>{usuario.email}</p>
                    <small>{usuario.address.city}</small>
                </li>
            ))}
        </ul>
    );
}

export default UsuariosAPI;