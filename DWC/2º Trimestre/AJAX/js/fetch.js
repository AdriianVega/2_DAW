document.getElementById('btnCargar').addEventListener('click', function() {
    // Iniciamos la petición asíncrona al servidor usando API Fetch
    fetch('datos.php')
        .then(resp => {
            // Comprobamos si la respuesta es válida
            if (!resp.ok) throw new Error("Fallo en la petición:" + resp.status + resp.statusText)
            
            // Transformamos la respuesta recibida en un objeto JavaScript mediante el método json()
            return resp.json();
        })
        .then(usuarios => {
            const lista = document.getElementById("lista");
            
            // Limpiamos la lista actual para evitar que cuando pulsemos el botón nuevamente se duplique el contenido
            lista.innerHTML = "";

            // Iteramos sobre los usuarios para crear e insertar los elementos en el DOM
            usuarios.forEach(usuario => {
                const li = document.createElement("li");
                li.textContent = `${usuario.nombre} - ${usuario.edad} años`;
                lista.appendChild(li);
            })
        })
        .catch (error => {
            // Informamos por consola si ocurre un error durante la petición 
            console.error("Fallo en la petición:" + error)
        })
})