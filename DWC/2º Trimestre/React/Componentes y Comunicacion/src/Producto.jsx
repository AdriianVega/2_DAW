function Producto(props) {
    return (
        <div className="producto">
            <h3>{props.nombre}</h3>
                {props.children}
            <p>Precio: {props.precio}</p>
        </div>
    )
}

export default Producto