import { useState } from "react";

function Formulario() {
    const [usuarios, setUsuarios] = useState([])
    const [texto, setTexto] = useState("")

    function anyadirUsuario(e, cantidad) {
        e.preventDefault()
        const id = cantidad === 0 ? 1 : cantidad + 1
        const nombre = texto

        if (nombre.trim() === "") return;

        setUsuarios([...usuarios, { id: id, nombre: nombre }])

        setTexto("");
    }

    return (
        <>
            <h2>Formulario</h2>
            
            <form className="formulario" id="form-usuario" onSubmit={(e) => anyadirUsuario(e, usuarios.length)}>
                <label htmlFor="lista">Lista de Usuarios</label>
                
                <input type="text" id="lista" name="lista" placeholder="Escribe un usuario" value={texto} onChange={(e) => setTexto(e.target.value)} />
                
                <button type="submit" 
                disabled={texto.trim() === ""}>
                    Añadir
                </button>
            </form>

            <h2>Lista de usuarios</h2>
            
            <ul className="usuarios" id="lista-usuarios">
                {usuarios.length === 0 ? 
                
                <li>No hay usuarios registrados</li> : 
                
                usuarios.map((usuario) => (
                    <li key={usuario.id} id={usuario.id}>{usuario.nombre}</li>
                ))}
            </ul>
        </>
    )
}

export default Formulario