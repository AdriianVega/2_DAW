<?php
    $sumPares = 0;

    for ($i = 1 ; $i <= 30 ; $i++)
    {
        if ($i % 2 == 0)
            $sumPares += $i;   
    }
    echo "La suma de los primeros 30 números pares es $sumPares";
?>