<?php
    $numero = 19; //Inicializamos numero

    for ($i = 1; $i <= 50; $i++) //Imprimimos todos los números menos el número marcado
    {
        if ($i == $numero)
        {
            continue;
        }
        echo $i. " ";
    }
?>
