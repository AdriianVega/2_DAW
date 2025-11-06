<?php
    $numero = 43;
    $max = 100;
    $min = 1;
    $adivinado = false;

    for ($i = 1 ; $i <= 6 ; $i++)
    {
        $entrada = random_int($min,$max);

        if ($entrada == $numero)
        {
            $adivinado = true;
            break;
        }
        else if ($entrada > $numero)
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
    echo $adivinado ? "¡Has ganado!" : "¡Has perdido!";
?>