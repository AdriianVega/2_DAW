<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
    <style>
        /* Creamos el css correspondiente */
        .max
        {
            background-color: blue;
            color: white;
        }
        .min
        {
            background-color: green;
            color: white;
        }
        td
        {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>
    <table border="1">
    <?php
        $matrizRandom = array();
        $max = 100;
        $maxPosicion;
        $min = 999;
        $minPosicion; //Declaramos e inicializamos las variables

        //Creamos el array de números random con la lógica para que no se repitan
        for ($i = 0 ; $i < 9 ; $i++)
        {
            array_push( $matrizRandom, array() );
            
            $j = 0;
            while ($j < 6)
            {
                $repetido = false;
                $numRandom = random_int(100, 999);
                
                for ($k = 0 ; $k <= $i && !$repetido; $k++)
                {
                    for ($l = 0 ; $l < count($matrizRandom[$k]) && !$repetido; $l++)
                    {
                        //Averiguamos si algún número de la matriz se repite
                        $repetido = $matrizRandom[$k][$l] == $numRandom;
                    }
                }
                if (!$repetido) //Si no se repite ningún número se averigua el máximo y mínimo acutales y se recoge su posición
                {
                    array_push($matrizRandom[$i], $numRandom);
                    
                    if ($numRandom > $max)
                    {
                        $max = $numRandom;
                        $maxPosicion = $j;
                    }
                    if ($numRandom < $min)
                    {
                        $min = $numRandom;
                        $minPosicion = $i;
                    }
                    $j++;
                }
            }
        }
        //Creamos la tabla con los colores correspondientes
        for ($i = 0 ; $i < count($matrizRandom) ; $i++)
        {
            echo "<tr>";

            for ($j = 0 ; $j < count($matrizRandom[$i]) ; $j++)
            {
                if ($i == $minPosicion)
                {
                    echo "<td class=\"min\">".  $matrizRandom[$i][$j]. "</td>";
                }
                else if ($j == $maxPosicion)
                {
                    echo "<td class=\"max\">".  $matrizRandom[$i][$j]. "</td>";
                }
                else
                {
                    echo "<td>". $matrizRandom[$i][$j]. "</td>";
                }
            }
            echo "</tr>";
        }
    ?>
    </table>
</body>
</html>

