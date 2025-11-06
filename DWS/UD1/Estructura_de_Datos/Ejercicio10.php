<?php
    for ($i = 10 ; $i >= 1 ; $i--)
    {
        echo $i != 1 ? "$i, " : "$i<br>";
    }
    $i = 10;

    while ($i >= 1)
    {
        echo $i != 1 ? "$i, " : "$i<br>";
        $i--;
    }
    $i = 10;

    do
    {
        echo $i != 1 ? "$i, " : "$i<br>";
        $i--;
    }
    while ($i >= 1);
?>