<?php
    // Método for para imprimir los números del 10 al 1
    for ($i = 10 ; $i >= 1 ; $i--)
    {
        echo $i != 1 ? "$i, " : "$i<br>";
    }
    $i = 10;

    // Método While para imprimir los números del 10 al 1
    while ($i >= 1)
    {
        echo $i != 1 ? "$i, " : "$i<br>";
        $i--;
    }
    $i = 10;

    // Método Do-while para imprimir los números del 10 al 1
    do
    {
        echo $i != 1 ? "$i, " : "$i<br>";
        $i--;
    }
    while ($i >= 1);
?>
