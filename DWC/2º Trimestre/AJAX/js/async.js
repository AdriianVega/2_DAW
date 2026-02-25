document.getElementById("btnCargar").addEventListener('click', async function() {
    try {
        // Esperamos a que el servidor responda a la petición
        const resp = await fetch('datos.php');

        // Verificamos si la respuesta es válida
        if (!resp.ok) {
            throw new Error('Error en la petición:' + resp.status)
        }

        // Esperamos a que los datos se transformen al objeto JavaScript
        const usuarios = await resp.json();
        const lista = document.getElementById("lista");

        // Limpiamos la lista actual para evitar que cuando pulsemos el botón nuevamente se duplique el contenido
        lista.innerHTML = "";

        // Iteramos sobre los usuarios para crear e insertar los elementos en el DOM
        usuarios.forEach(user => {
            const li = document.createElement("li");
            li.textContent = `${user.nombre} - ${user.edad} años`;
            lista.appendChild(li);
        });
    } catch (error) {
        // Informamos por consola de cualquier error ocurrido dentro del bloque try
        console.error("Error en la petición:" + error);
    }
})