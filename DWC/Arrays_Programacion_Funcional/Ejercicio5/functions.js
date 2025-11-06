//Ejercicio 5 Hecho por Adrián Nataniel Vega Pérez

// Añadimos nuevas notas al array desde una cadena separada por comas y eliminamos espacios
function addItems(notas, item)
{
    if (item)
    {
        notas.push(...item.split(",").map(numero => numero.trim()));
    }
    return notas;
}
// Convertimos los valores a número y filtramos los no válidos
function clearItems(notas)
{
    return notas.map(numero => Number(numero))
                .filter(item => !isNaN(Number(item)) && item >= 0 && item <= 10);
}
// Buscamos la primera nota suspensa
function primerSuspenso(notas)
{
    return notas.find(nota => nota < 5);
}
// Obtenemos las notas aprobadas
function aprobados(notas)
{
    return notas.filter(nota => nota >= 5);
}
// Calculamos la nota media y la devolvemos con dos decimales
function notaMedia(notas)
{
    return (notas.reduce((sumaNotas, nota) => sumaNotas + nota, 0) / notas.length).toFixed(2);
}
// Ajustamos las notas incrementándolas un 10% y redondeándolas al entero más cercano
function cambiaNotas(notas, incremento)
{
    return notas.map(nota => (nota + (nota * incremento / 100)).toFixed(0));
}
