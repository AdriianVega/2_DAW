document.getElementById("btnCargar").addEventListener('click', function() {
    // Instanciamos el objeto
    const xhr = new XMLHttpRequest();

    // Definimos el método GET y la ruta del php
    xhr.open('GET', 'datos.php', true);

    // Envíamos la solicitud al servidor
    xhr.send();

    // Escuchamos los cambios de estado de la petición
    xhr.onreadystatechange = function () {
        // Verificamos si la petición ha finalizado y si la respuesta es válida (200 OK)
        if (xhr.readyState === 4) {
            if (xhr.status == 200) {
                // Transformamos la cadena JSON recibida en un objeto JavaScript
                const usuarios = JSON.parse(xhr.responseText);
                const lista = document.getElementById('lista');

                // Limpiamos la lista actual para evitar que cuando pulsemos el botón nuevamente en vez de borrarse se duplique
                lista.innerHTML = '';

                // Iteramos sobre los usuarios para crear e insertar los elementos en el DOM
                usuarios.forEach(user => {
                    const li = document.createElement('li');
                    li.textContent = `${user.nombre} - ${user.edad} años`;
                    lista.appendChild(li);
                })
            }
            else {
                // Informamos por consola si el servidor devuelve un error
                console.error("Fallo en la petición:", xhr.statusText);
            }
        }
    }
})