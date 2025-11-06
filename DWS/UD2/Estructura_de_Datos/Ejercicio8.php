<?php
    $numero1 = 3;
    $numero2 = -5; //Inicializamos los dos números

    //Comprobamos si los números son positivos o negativos e imprimimos por pantalla
    if ($numero1 >= 0 && $numero2 >= 0)
    {
        echo "Los dos números son positivos";
    }
    elseif ($numero1 >= 0 || $numero2 >= 0)
    {
        echo "Uno de los números es positivo";
    }
    else
    {
        echo "Ninguno de los números es positivo";
    }
?>
