// Preguntamos al usuario si desea activar un recordatorio personalizado
if (confirm("¿Desea activar el recordatorio personalizado?")) 
{
    // Solicitamos al usuario que escriba el mensaje del recordatorio
    let entrada = prompt('Escriba el recordatorio que quiere obtener (Ej: "Beber agua")');

    // Creamos un intervalo que mostrará el recordatorio cada 5 segundos
    const identificador = setInterval(() => 
    {
        // Mostramos un mensaje de confirmación con el recordatorio personalizado
        let recordatorio = confirm(`¡No te olvides de ${entrada}!`);
        
        // Si el usuario pulsa "Cancelar" en el confirm, detenemos el intervalo
        if (!recordatorio) 
        {
            clearInterval(identificador); // Cancelamos el setInterval
        }
    }, 5000);
} 
else 
{
    // Si el usuario decide no activar el recordatorio, mostramos un mensaje de cancelación
    alert("Recordatorio personalizado cancelado.");
}

