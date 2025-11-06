<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    <?php
        $frutas = array("naranja", "pera", "manzana", "piña", "plátano"); //Declaramos el array

        echo "<ul>";

        foreach($frutas as $fruta)
        {
            echo "<li>$fruta</li>";
        }
        echo "</ul>"; //Creamos la lista desordenada con las frutas
    ?>
</body>
</html>