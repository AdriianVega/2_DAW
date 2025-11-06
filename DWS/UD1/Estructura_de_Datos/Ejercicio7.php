<?php
    $numero1 = 11;
    $numero2 = 9;
    $numero3 = 8;

    if ($numero1 <= $numero2 && $numero1 <= $numero3)
    {
        echo $numero2 <= $numero3 ? "$numero1, $numero2, $numero3" : "$numero1, $numero3, $numero2";
    }
    else if ($numero2 <= $numero1 && $numero2 <= $numero3)
    {
        echo $numero1 <= $numero3 ? "$numero2, $numero1, $numero3" : "$numero2, $numero3, $numero1";
    }
    else
    {
         echo $numero1 <= $numero2 ? "$numero3, $numero1, $numero2" : "$numero3, $numero2, $numero1";
    }
?>