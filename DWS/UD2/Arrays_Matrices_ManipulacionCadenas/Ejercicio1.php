<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <?php
        $compras = array(); //Declaramos el array vacío

        array_push($compras, "Leche");
        array_push($compras, "Pan");
        array_push($compras, "Huevos"); //Añadimos los valores

        echo "<ul>";

        for ($i = 0 ; $i < count($compras) ; $i++)
        {
            echo "<li> $compras[$i] </li>";
        }
        echo "</ul>"; //Creamos la lista desordenada e imprimimos por pantalla

        array_pop($compras); //Eliminamos el último elemento

        echo "<ol>";

        for ($i = 0 ; $i < count($compras) ; $i++)
        {
            echo "<li> $compras[$i] </li>";
        }
        echo "</ol>"; //Creamos la lista ordenada e imprimimos por pantalla
    ?>
</body>
</html>