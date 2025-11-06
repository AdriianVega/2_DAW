<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    <h1>Ejercicio 5 Array</h1>
    <?php
        $arrayDesordenado = array();
        $arrayOrdenado = array();

        echo "<h2> Array desordenado </h2>";

        echo "<table style='border:1px solid black'; border='1'>
                <tr>";

        for ($i = 0 ; $i < 20 ; $i++)
        {
            $numeroAleatorio = random_int(0,100);
            
            array_push($arrayDesordenado, $numeroAleatorio);

            echo "<td> $numeroAleatorio </td>";
        }
        echo    "</tr>
            </table>";

        echo "<h2> Array Ordenado Pares-Impares </h2>";
        
        echo "<table style='border: 1px solid black'; border='1'>
                <tr>";

        foreach ($arrayDesordenado as $numero)
        {
            if ($numero % 2 == 0)
            {
                array_push($arrayDesordenado, $numero);
                echo "<td> $numero </td>";
            }
        }
        foreach ($arrayDesordenado as $numero)
        {
            if ($numero % 2 != 0)
            {
                array_push($arrayDesordenado, $numero);
                echo "<td> $numero </td>";
            }
        }
        echo    "</tr>
            </table>";
    ?>
</body>
</html>