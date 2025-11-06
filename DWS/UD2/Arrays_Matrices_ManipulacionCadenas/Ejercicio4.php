<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <?php
        $num2 = array();
        $max = 0;
        $min = 100;
        $media = 0; //Declaramos e inicializamos las distintas variables
        
        //Añadimos los valores al array, apuntando el máximo y el mínimo y sumamos todos los números
        for ( $i = 0; $i < 30; $i++)
        {
            $numRandom = random_int( 1, 100);

            array_push($num2, $numRandom);
            
            $max = $numRandom > $max ? $numRandom : $max;
            $min = $numRandom < $min ? $numRandom : $min;
            $media += $numRandom;
        }
        echo
        "<h1> Número max: $max </h1>
        <h1> Número min: $min </h1>
        <h1> Media: ". ($media / 30). "</h1>"; //Imprimimos el número máximo y mínimo y calculamos la media
    ?>
</body>
</html>