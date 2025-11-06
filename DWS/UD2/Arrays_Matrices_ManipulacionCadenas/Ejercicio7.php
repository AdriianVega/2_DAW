<?php
    $letras = array(); //Declaramos el array vacío

    //Añadimos aleatoriamente al array una "M" o una "F"
    for ($i = 0; $i < 100; $i++)
    {
        $numRandom = random_int(0,1);

        array_push($letras, $numRandom == 0 ? "M" : "F");
    }
    //Iniciamos el array asociativo para contar las letras
    $contLetras =   ["M" => 0,
                    "F" => 0];

    //Contamos las "M" y "F" que tiene el array
    foreach ($letras as $letra)
    {
        $letra == "M" ? $contLetras["M"]++ : $contLetras["F"]++;
    }
    //Imprimimos la cantidad de cada letra
    print_r($contLetras);
?>
