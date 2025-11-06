<?php
    $numero = 19;

    for ($i = 1; $i <= 50; $i++) 
    {
        if ($i == $numero)
        {
            continue;
        }
        echo $i. " ";
    }
?>