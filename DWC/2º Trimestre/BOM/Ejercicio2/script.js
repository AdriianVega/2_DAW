// Abrimos una nueva ventana con dimensiones iniciales y posición específicas y la ventana recién creada al frente
const ventana = window.open("", "", "width=500, height=200, left=100, top=200");
ventana.focus();

// Función para alertar si se cancela la redimensión
cancelarRedimension = function() 
{
    alert("Se ha cancelado la redimensión de la ventana correctamente");
}

// Preguntamos al usuario si desea redimensionar la ventana
if (confirm('¿Desea redimensionar la ventana?')) 
{
    // Solicitamos al usuario que ingrese el ancho de la ventana
    let entradaAncho = prompt("Escriba el ancho de la ventana a redimensionar");
    console.log("Ancho: ", entradaAncho);

    //Si se ingresa un número
    if (entradaAncho !== null && !isNaN(Number(entradaAncho)))
        { 
            // Solicitamos al usuario que ingrese el alto de la ventana
            let entradaAlto = prompt("Escriba el alto de la ventana a redimensionar");
            console.log("Alto: ", entradaAlto); // Mostramos el valor ingresado por consola

            //Si se ingresa un número
            if (entradaAlto !== null && !isNaN(Number(entradaAlto))) 
            {
                // Pedimos confirmación al usuario para redimensionar
                if (confirm(`La ventana se va a redimensionar a ${entradaAncho} x ${entradaAlto}. ¿Está de acuerdo?`)) 
                {
                    console.log(`Redimensionando a ${entradaAncho} x ${entradaAlto}...`);

                    // Redimensionamos la ventana con los parámetros dados y notificamos
                    ventana.resizeTo(entradaAncho, entradaAlto); 

                    console.log("Redimensión completada")

                    alert("Se ha redimensionado la ventana correctamente.");
                }
                else 
                {
                    //  Si el usuario decide no redimensionar, llamamos a la función de cancelación
                    cancelarRedimension();
                    ventana.close();
                }
            } 
            else if (isNaN(Number(entradaAlto)))
            {
                //Si el usuario escribe un caracter en vez de número, cancelamos la operación
                alert("Error: Se ha introducido un número invalido, intente nuevamente")
                ventana.close();
            }
            else 
            {
                // Si el usuario cancela el ingreso del alto, llamamos a la función de cancelación
                cancelarRedimension();
                ventana.close();
            }
        }
        else if (isNaN(Number(entradaAncho)))
        {
            //Si el usuario escribe un caracter en vez de número, cancelamos la operación
            alert("Error: Se ha introducido un número invalido, intente nuevamente")
            ventana.close();
        }
        else 
        {
            // Si el usuario cancela el ingreso del ancho, llamamos a la función de cancelación
            cancelarRedimension();
            ventana.close();
        }
} 
else 
{
    // Si el usuario decide no redimensionar, llamamos a la función de cancelación
    cancelarRedimension();
    ventana.close();
}
