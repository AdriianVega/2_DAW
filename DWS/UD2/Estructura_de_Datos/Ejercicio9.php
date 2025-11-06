<?php
    // Método for para imprimir los números del 1 al 10
    for ($i = 1 ; $i <= 10 ; $i++)
    {
        echo $i != 10 ? "$i, " : "$i<br>";
    }
    $i = 1;
    
    // Método While para imprimir los números del 1 al 10
    while ($i <= 10)
    {
        echo $i != 10 ? "$i, " : "$i<br>";
        $i++;
    }
    $i = 1;

    // Método Do-while para imprimir los números del 1 al 10
    do
    {
        echo $i != 10 ? "$i, " : "$i<br>";
        $i++;
    }
    while ($i <= 10);
?>
