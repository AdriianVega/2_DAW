<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <?php
        $num = array(); //Declaramos la variable array
        $numTotal = 0; //Inicializamos la variable para sumar los números

        //Añadimos 5 números aleatorios del 1 al 100 y calculamos el total
        for ( $i = 0; $i < 5; $i++)
        {
            array_push($num, random_int( 1, 100));
            
            $numTotal += $num[$i];
        }
        
        echo
        '<table border="1">
            <tr>';

        for ($i = count($num) - 1; $i >= 0 ; $i--)
        {
            echo "<th> $num[$i] </th>";
        }
        echo
            "</tr>
        </table>"; //Creamos una tabla con esos 5 números

        echo "<p> Total suma: $numTotal </p>"; //Imprimimos el total
    ?>
</body>
</html>
