<?php
    function palindromo($cadena)
    {
        $cadena = strtolower(str_replace(" ", "", $cadena));
        $cadenaInversa = "";

        for ($i = 0 ; $i < strlen($cadena) ; $i++)
        {
            $cadenaInversa = $cadenaInversa. $cadena[strlen($cadena) - 1 - $i];
        }
        return ($cadena == $cadenaInversa) ? " es un palíndromo" : "no es un palíndromo";
    }
    $cadena = "Isaac no ronca asi";

    echo 'La cadena "'. $cadena. '"'. palindromo($cadena);
?>