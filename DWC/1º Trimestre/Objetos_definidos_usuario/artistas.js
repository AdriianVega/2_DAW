function menuPrincipal()
{
    menu = "----------------- MENÚ ARTISTAS -----------------\n" +
            "Opciones disponibles:\n" +
            "   1. Buscar Máximo\n" +
            "   2. Filtrar\n" +
            "   3. Contar\n" +
            "   4. Salir\n" +
            "-----------------------------------------------------\n" +
            "Seleccione una opción";

    switch (Number(prompt(menu)))
    {
        case 1:
            menuBuscarMaximo();
            break;
        case 2:
            menuFiltrar();
            break;
        case 3:
            menuContar();
            break;
        case 4:
            console.log("Saliendo del programa...");
            break;
        default:
            console.log("Por favor, elija una de entre las opciones disponibles");
    }
}
function menuBuscarMaximo()
{
    // Mostramos menú de opciones para buscar máximos
    let menu;
    let subOpcion;

    menu = "----------------- MENÚ BUSCAR MÁXIMO -----------------\n" +
        "Opciones disponibles:\n" +
        "   1. Buscar artista con más entradas vendidas\n" +
        "   2. Buscar artista con mayor recaudación conseguida\n" +
        "   3. Buscar artista con más copias vendidas\n" +
        "   4. Cancelar\n" +
        "---------------------------------------------------------------\n" +
        "Seleccione una opción";

    subOpcion = Number(prompt(menu));
    
    // Ejecutamos la función correspondiente según la opción elegida
    switch (subOpcion)
    {
        case 1:
            console.log(artistaConMasEntradasVendidas(artistas));
            break;
        case 2:
            console.log(artistaConMayorRecaudacion(artistas));
            break;
        case 3:
            console.log(artistaConMasCopias(artistas));
            break;
        case 4:
            console.log("Cancelando...");
            break;
        default:
            console.log("Por favor, elija una de entre las opciones disponibles");
    }
}
function menuFiltrar()
{
    // Mostramos menú de opciones para filtrar artistas
    let menu;
    let subOpcion;
    let entrada;

    menu = "----------------- MENÚ FILTRAR -----------------\n" +
        "Opciones disponibles:\n" +
        "   1. Filtrar solistas\n" +
        "   2. Filtrar por edad\n" +
        "   3. Filtrar por cantidad de discos\n" +
        "   4. Filtrar por disco en año determinado\n" +
        "   5. Cancelar\n" +
        "----------------------------------------------------\n" +
        "Seleccione una opción";

    subOpcion = Number(prompt(menu));

    // Ejecutamos la función correspondiente según la opción elegida
    switch (subOpcion)
    {
        case 1:
            console.log(artistasSolistas(artistas));
            break;
        case 2:
            entrada = prompt("Escriba la edad de el/los artista/s que desea buscar")
            console.log(artistasPorEdad(entrada, artistas));
            break;
        case 3:
            entrada = prompt("Escriba la cantidad mínima de discos, se buscarán los mayores a la cantidad proporcionada");
            console.log(artistasConMasDiscosQue(entrada, artistas));
            break;
        case 4:
            entrada = prompt("Introduzca el año para buscar artistas que hayan publicado disco ese año");
            console.log(artistasConDiscoEnAnyo(entrada, artistas));
            break;
        case 5:
            console.log("Cancelando...");
            break;
        default:
            console.log("Por favor, elija una de entre las opciones disponibles");
    }
}
function menuContar()
{
    // Mostramos menú de opciones para contar artistas por categoría
    let menu;
    let subOpcion;

    menu = "----------------- MENÚ CONTAR -----------------\n" +
        "Opciones disponibles:\n" +
        "   1. Contar artistas por instrumento\n" +
        "   2. Contar artistas por género\n" +
        "   3. Cancelar\n" +
        "---------------------------------------------------\n" +
        "Seleccione una opción";

    subOpcion = Number(prompt(menu));

    // Ejecutamos la función correspondiente según la opción elegida
    switch (subOpcion)
    {
        case 1:
            console.log(cantidadDeArtistasPorInstrumento(artistas));
            break;
        case 2:
            console.log(cantidadDeArtistasPorGenero(artistas));
            break;
        case 3:
            console.log("Cancelando...");
            break;
        default:
            console.log("Por favor, elija una de entre las opciones disponibles");
    }
}
