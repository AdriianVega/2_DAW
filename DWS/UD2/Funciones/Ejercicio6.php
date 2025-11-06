<?php
    function factorialNumero($numero)
    {
        //Capturamos errores
        try
        {
            /*Si el número es 0 devuelve 1, 0! = 1
            Además, sirve para detener la recursividad al llegar a 0*/
            if ($numero == 0)
            {
                return 1;
            }
            //Se va restando uno en cada llamada hasta llegar a 0 y se multiplican por numero
            return $numero * factorialNumero(($numero - 1));
        }
        catch (Exception $e)
        {
            //Si no es posible hacer el factorial devuelve -1
            return -1;
        }
    }
    $numero = 5;
    echo "El factorial de $numero es ". factorialNumero($numero). "<br>";

    $numero = 3;
    echo "El factorial de $numero es ". factorialNumero($numero). "<br>";

    $numero = 0;
    echo "El factorial de $numero es ". factorialNumero($numero). "<br>"; //Imprimimos los factoriales de cada número
?>