<?php
    function sumarCifras($numero)
    {
        //Sacamos la última cifra
        $cifra = $numero % 10;

        //Si el número llega a 0 se acaba la recursividad
        if ($numero == 0)
        {
            return $numero;
        }
        //Suma cada cifra con las siguientes
        return $cifra + sumarCifras(floor($numero / 10));
    }
    $numero = 3433;

    echo "La suma de las cifras de $numero es: ". sumarCifras($numero); //Imprimimos resultado
?>