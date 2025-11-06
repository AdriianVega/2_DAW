<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 23</title>
</head>
<body>
    <!-- Creamos ta tabla con su encabezado -->
    <table border="1">
        <tr>
            <th> Numero </th>
            <th> Cuadrado </th>
        </tr>
        <?php
            //Imprimimos en cada celda del 1 al 5 con su cuadrado a la celda de la derecha
            for ($i = 1; $i <= 5; $i++)
            {
                echo
                "<tr>
                <td> $i </td>
                <td>". ($i ** 2). "</td>
                </tr>";
            }
        ?>
    </table>
    <table  border="1">
        <tr>
            <th> Número </th>
            <th> Cuadrado </th>
        </tr>
        <?php
            $i = 1;
            
            //Método While
            while ($i <= 5)
            {
                echo
                "<tr>
                <td>". $i. "</td>
                <td>". ($i ** 2). "</td>
                </tr>";

                $i++;
            }
        ?>
    </table>
    <table border="1">
        <tr>
            <th> Número </th>
            <th> Cuadrado </th>
        </tr>
        <?php
            $i = 1;
            
            //Método Do-while
            do
            {
                echo
                "<tr>
                <td>". $i. "</td>
                <td>". ($i ** 2). "</td>
                </tr>";

                $i++;
            }
            while ($i <= 5);
        ?>
    </table>
</body>
</html>
