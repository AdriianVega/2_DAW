<?php
    $numero = 43;
    $max = 100;
    $min = 1;
    $adivinado = false; //Inicializamos el número a adivinar, el max y min y el boolean adivinado

    for ($i = 1 ; $i <= 6 ; $i++) /*la entrada se elige al azar, si adivina se acaba el bucle
                                    si no max o min se actualizan dependiendo si se quedo corto o se paso*/
    {
        $entrada = random_int($min,$max);

        if ($entrada == $numero)
        {
            $adivinado = true;
            break;
        }
        elseif ($entrada > $numero)
        {
            echo "Te has pasado, el número es menor que $entrada<br>";
            $max = $entrada - 1;
        }
        else
        {
            echo "Te has quedado corto, el número es mayor que $entrada<br>";
            $min = $entrada + 1;
        }
    }
    //Imprime el resultado
    echo $adivinado ? "¡Has ganado!" : "¡Has perdido!";
?>
