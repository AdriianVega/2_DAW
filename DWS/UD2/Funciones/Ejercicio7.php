<?php
    function mcd($numero1 , $numero2)
    {
        //Sacamos el max y el min
        $max = $numero1 > $numero2 ? $numero1 : $numero2;
        $min = $numero1 < $numero2 ? $numero1 : $numero2;

        /*Si el resto de la división entre max y min da 0
        se acaba la recursividad y devuelve min */
        if($max % $min == 0)
        {
            return $min;
        }
        //En cada llamada max se vuelve min y min se convierte en el resto de max / min
        return mcd($min,  $max % $min);
    }
    $numero1 = 256;
    $numero2 = 354;

    echo "El máximo común divisor de $numero1 y $numero2 es ". mcd($numero1, $numero2). "<br>";

    $numero1 = 100;
    $numero2 = 25;

    echo "El máximo común divisor de $numero1 y $numero2 es ". mcd($numero1, $numero2). "<br>";
    
    $numero1 = 256;
    $numero2 = 354;

    //Imprimimos los diferentes máximo común divisor
    echo "El máximo común divisor de $numero1 y $numero2 es ". mcd($numero1, $numero2). "<br>";
?>