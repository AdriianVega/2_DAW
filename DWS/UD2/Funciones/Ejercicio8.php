<?php
    function invertirNumero($numero1)
    {
        //Sacamos el último dígito y se lo quitamos a número (Usé floor porque no se me ocurría otra forma de sacarlo)
        $ultimoDigito = $numero1 % 10;
        $siguienteNumero = floor($numero1 / 10);

        //Si el siguiente número es igual a 0 se paran las llamadas y devolvemos la cifra faltante
        if ($siguienteNumero == 0)
        {
            return $numero1;
        }
        //Le damos la vuelta al número calculando el dígito sacado por 10 elevado a las cifras que quedan (ejemplo: 3 se convertiría en 300)
        return $ultimoDigito * (10 ** strlen($siguienteNumero)) + invertirNumero($siguienteNumero);
    }
    //Imprimimos el resultado
    echo "invertirNumero: ". invertirNumero(numero1: 54321);
?>