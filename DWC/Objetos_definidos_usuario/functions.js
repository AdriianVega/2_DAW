function artistasSolistas(artistas)
{
    // Devolvemos un array con los artistas que son solistas
    return artistas.filter(artista => artista.solista);
}
function artistasPorEdad(edad, artistas)
{
    // Filtramos los artistas cuya edad coincide con la indicada
    let artistasEdadBuscada = artistas.filter(artista => artista.edad === Number(edad));

    // Devolvemos el array de artistas o un mensaje si no hay coincidencias
    return artistasEdadBuscada.length !== 0 
        ? artistasEdadBuscada 
        : "No se han encontrado artistas con esa edad";
}
function cantidadDeArtistasPorInstrumento(artistas)
{
    // Generamos un objeto con la cantidad de artistas por instrumento
    let conteoInstrumentos = artistas.reduce((cantidad, artista) => 
    {
        // Inicializamos en 0 el instrumento si aún no existe
        if (!cantidad[artista.instrumento])
        {
            cantidad[artista.instrumento] = 0;
        }
        // Sumamos 1 al instrumento correspondiente
        cantidad[artista.instrumento]++;

        // Retornamos el objeto actualizado
        return cantidad;
    }, {}); // {} es el valor inicial del acumulador

    return conteoInstrumentos;
}
function cantidadDeArtistasPorGenero(artistas)
{
    // Generamos un objeto con la cantidad de artistas por género
    let conteoGenero = artistas.reduce((cantidad, artista) =>
    {
        // Inicializamos en 0 el género si aún no existe
        if (!cantidad[artista.genero])
        {
            cantidad[artista.genero] = 0;
        }
        // Sumamos 1 al género correspondiente
        cantidad[artista.genero]++;

        // Retornamos el objeto actualizado
        return cantidad;
    }, {}); // Objeto vacío como acumulador inicial

    return conteoGenero;
}
function artistasConMasDiscosQue(cantidadDeDiscos, artistas)
{
    // Filtramos artistas que tengan más discos que la cantidad indicada
    let arrayArtistas = [...artistas].filter(artista => artista.discos.length > cantidadDeDiscos).sort((a, b) => b.discos.length - a.discos.length);

    // Devolvemos el array o un mensaje si no hay coincidencias
    return arrayArtistas.length !== 0 
        ? arrayArtistas
        : "No se han encontrado artistas que superen esa cantidad de discos";
}
function artistaConMasEntradasVendidas(artistas)
{
    // Recorremos todos los artistas para encontrar el que vendió más entradas
    let artistaMayorVentas = artistas.reduce((maxVenta, artista) => 
    {
        //Accedemos a las entradas vendidas de cada artista
        let artistaMaxVentas = maxVenta.ultimoRecital.entradasVendidas;
        let artistaActual = artista.ultimoRecital.entradasVendidas;

        // Retornamos el artista con mayor cantidad de entradas vendidas en cada iteración
        return artistaActual > artistaMaxVentas 
            ? artista
            : maxVenta;
    });

    return artistaMayorVentas;
}
function artistaConMayorRecaudacion(artistas)
{
    // Recorremos todos los artistas para encontrar el que recaudó más en su último recital
    let artistaMayorRecaudacion = artistas.reduce((maxArtista, artista) =>
    {
        // Calculamos el total de recaudación de cada artista
        let artistaMaxRecaudacion = maxArtista.ultimoRecital.entradasVendidas * maxArtista.ultimoRecital.costoEntradas;
        let artistaActual = artista.ultimoRecital.entradasVendidas * artista.ultimoRecital.costoEntradas;

        // Retornamos el artista con mayor recaudación en cada iteración
        return artistaActual > artistaMaxRecaudacion
            ? artista
            : maxArtista;
    });

    return artistaMayorRecaudacion;
}
function artistasConDiscoEnAnyo(anyo, artistas)
{
    // Filtramos artistas que hayan publicado algún disco en el año indicado
    let artistasDiscoPublicado = artistas.filter(artista => 
        artista.discos.some(disco => disco.anioLanzamiento === Number(anyo))
    );

    // Devolvemos el array o un mensaje si no hay coincidencias
    return artistasDiscoPublicado.length !== 0 
        ? artistasDiscoPublicado 
        : "No se han encontrado artistas que hayan publicado un disco el año especificado";
}
function artistaConMasCopias(artistas)
{
    // Recorremos todos los artistas para encontrar el que vendió más copias sumando todos sus discos
    let artistaMayorCopias = artistas.reduce((maxArtista, artista) => 
    {
        // Calculamos el total de cada artista
        let artistaMaxCopias = maxArtista.discos.reduce((acum, disco) => acum + disco.copiasVendidas, 0);
        let artistaActual = artista.discos.reduce((acum, disco) => acum + disco.copiasVendidas, 0);

        // Retornamos el artista que vendió más copias en cada iteración
        return artistaActual > artistaMaxCopias ? artista : maxArtista;
    });

    return artistaMayorCopias;
}