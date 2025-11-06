//Ejercicio 5 Hecho por Adrián Nataniel Vega Pérez

// Inicializamos un array vacío para guardar las notas
let notas = [];
let nota;

// Pedimos notas al usuario hasta que pulse "Cancelar"
do
{
    nota = prompt("Escriba una nota o varias separadas por una ','");

    // Añadimos las notas introducidas al array principal
    notas = addItems(notas, nota);
}
while (nota != null)

// Mostramos todas las notas introducidas
console.log(`Notas introducidas: ${notas}`);

// Limpiamos el array dejando solo las notas válidas (entre 0 y 10)
let notasLimpio = clearItems(notas);
console.log(`\nNotas válidas: ${notasLimpio}`);

// Mostramos la primera nota suspensa
console.log(`\nEl primer suspenso es ${primerSuspenso(notasLimpio)}`);

// Obtenemos las notas aprobadas y las mostramos
let numeroAprobados = aprobados(notasLimpio);
console.log(`\nHay ${numeroAprobados.length} aprobados: ${numeroAprobados}`);

// Calculamos y mostramos la nota media
console.log(`\nLa nota media es ${notaMedia(notasLimpio)}`);

// Incrementamos las notas un 10% y mostramos el resultado final
let notasFinales = cambiaNotas(notasLimpio, 10);
console.log(`\nLas notas finales son ${notasFinales}`);
