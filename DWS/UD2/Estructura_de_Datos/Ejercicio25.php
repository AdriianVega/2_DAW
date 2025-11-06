<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 25</title>
    <style>
        /* Creamos los estilos de los colores y centramos td */
        .azul
        {
            background-color: blue;
            color: white;
            border-color: blue;
            width: 20px;
        }
        .naranja
        {
            background-color: orange;
            color: white;
            border-color: orange;
            font-weight: bold;
        }
        td
        {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Creamos la tabla con el th en azul -->
    <table border="1">
        <tr>
        <!-- Añadimos la x -->
        <th class="azul">x</th>
        <?php
            //Imprimimos los primeros números con el estilo azul
            for ($i = 0 ; $i < 11 ; $i++)
            {
                echo '<th class="azul">'. $i. "</th>";
            }
        ?>
        </tr>
        <?php
            //Añadimos la primera fila en naranja y los demás números
            for ($i = 0 ; $i < 11 ; $i++)
            {
                echo '<tr>
                    <td class="naranja">'. $i. "</td>";

                for ($j = 0 ; $j < 11 ; $j++)
                {
                    echo "<td>". ($i * $j). "</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>