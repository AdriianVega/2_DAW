<?php
    function contarPalabras($cadena)
    {
        $cadena = trim($cadena);
        $cantPalabras = 1;

        for ($i = 0 ; $i < strlen($cadena) ; $i++)
        {
            if ($cadena[$i] == " ")
            {
                $cantPalabras++;
            }
        }
        return $cantPalabras;
    }
    $cadena = "El león no controla sus emociones";

    echo 'La cadena "'. $cadena. '" tiene '. contarPalabras($cadena). " palabras";
?>