<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 24</title>
</head>
<body>
    <!-- Creamos la tabla encabezado con el encabezado BINGO -->
    <table border="1">
        <tr>
            <th>B</th>
            <th>I</th>
            <th>N</th>
            <th>G</th>
            <th>O</th>
        </tr>
        <?php
            $numeroIncremental = 1; //Inicializamos la variable del número incremental

            for ($i = 0 ; $i < 18 ; $i++)
            {
                //Creamos una nueva fila
                echo "<tr>";
                
                //Aumentamos numeroinceremental en uno y lo imprimimos
                for ($j = 0 ; $j < 5 ; $j++)
                {
                    echo "<td>". $numeroIncremental.  "</td>";
                    $numeroIncremental++;
                }
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
