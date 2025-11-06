<?php
    $numero1 = 3;
    $numero2 = -5;

    if ($numero1 >= 0 && $numero2 >= 0) 
    {
        echo "Los dos números son positivos";
    }
    else if ($numero1 >= 0 || $numero2 >= 0)
    {
        echo "Uno de los números es positivo";
    }
    else
    {
        echo "Ninguno de los números es positivo";
    }
?>