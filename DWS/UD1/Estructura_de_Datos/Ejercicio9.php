<?php
    for ($i = 1 ; $i <= 10 ; $i++)
    {
        echo $i != 10 ? "$i, " : "$i<br>";
    }
    $i = 1;

    while ($i <= 10)
    {
        echo $i != 10 ? "$i, " : "$i<br>";
        $i++;
    }
    $i = 1;

    do
    {
        echo $i != 10 ? "$i, " : "$i<br>";
        $i++;
    }
    while ($i <= 10);
?>