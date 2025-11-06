<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    <h1>Ejercicio 6 Matriz</h1>
    <h2>Matriz</h2>
    <?php
        $matrizRandom = array();
        $sumaTotal = 0;

        echo "<table style='border:1px solid black'; text-align='center'; border='1'>";
        for ($i = 0; $i < 5; $i++)
        {
            echo "<tr>";

            array_push($matrizRandom, array());
            for ($j = 0; $j < 6; $j++)
            {
                $numeroAleatorio = random_int(1,50);
                $sumaFila = 0;
                $sumaColumna = 0;

                array_push($matrizRandom[$i], $numeroAleatorio);

                if ($i == 4 && ($j == 5))
                {
                    echo "<td style='background-color: blue;'> $sumaTotal </td>";
                }
                elseif ($i == 4)
                {
                    for ($k = 0 ; $k < $i ; $k++)
                    {
                        $sumaColumna += $matrizRandom[$k][$j];
                    }
                    $sumaTotal += $sumaColumna;
                    echo "<td style='background-color: green;'> $sumaColumna </td>";
                }
                else if ($j == 5)
                {
                    for ($k = 0 ; $k < $j ; $k++)
                    {
                        $sumaFila += $matrizRandom[$i][$k];
                    }
                    echo "<td style='background-color: yellow;'> $sumaFila </td>";
                }
                else
                {
                    echo "<td> $numeroAleatorio </td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>