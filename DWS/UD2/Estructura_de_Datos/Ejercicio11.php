<?php
    $numImpares = 0;
    $i = 1; //Inicializamos numImpares para llevar la cuenta e i

    // El bucle se repite hasta que lleguemos a los 5 números impares, imprimiendo los números en el proceso
    while ($numImpares < 5)
    {
        if ($i % 2 != 0)
        {
            echo $i. " ";
            $numImpares++;
        }
        $i++;
    }
?>
