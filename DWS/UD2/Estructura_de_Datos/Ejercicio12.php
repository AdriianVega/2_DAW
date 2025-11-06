<?php
    $sumPares = 0; // Inicializamos la variable para sumar pares

    //Sumamos los pares del 1 al 30
    for ($i = 1 ; $i <= 30 ; $i++)
    {
        if ($i % 2 == 0)
        {
            $sumPares += $i;
        }
    }
    //Imprimimos el resultado
    echo "La suma de los primeros 30 números pares es $sumPares";
?>
