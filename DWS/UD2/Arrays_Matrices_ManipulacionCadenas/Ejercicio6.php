<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    <table border="1">
        <?php
            $matriz = array();
            $max = 0; //Declaramos las variables

            //Añadimos los números a la tabla y averiguamos el número máximo
            for ($i = 0; $i < 10; $i++)
            {
                echo "<tr>";
                array_push($matriz, array());

                for ( $j = 0; $j < 10; $j++)
                {
                    array_push($matriz[$i], random_int(0,50));
                    $max = $matriz[$i][$j] > $max ? $matriz[$i][$j] : $max;

                    echo "<td>". $matriz[$i][$j]. "</td>";
                }
                echo "</tr>";
            }
            echo "El número mas alto de la matriz es ". $max; //Imprimimos el número máximo
        ?>
    </table>
    
</body>
</html>

