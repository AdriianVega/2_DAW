<?php
    $numero1 = 11;
    $numero2 = 9;
    $numero3 = 8; // Inicializamos los 3 números

    //Ordenamos de menor a mayor usando if, else if y else
    if ($numero1 <= $numero2 && $numero1 <= $numero3)
    {
        echo $numero2 <= $numero3 ? "$numero1, $numero2, $numero3" : "$numero1, $numero3, $numero2";
    }
    elseif ($numero2 <= $numero1 && $numero2 <= $numero3)
    {
        echo $numero1 <= $numero3 ? "$numero2, $numero1, $numero3" : "$numero2, $numero3, $numero1";
    }
    else
    {
        echo $numero1 <= $numero2 ? "$numero3, $numero1, $numero2" : "$numero3, $numero2, $numero1";
    }
?>
