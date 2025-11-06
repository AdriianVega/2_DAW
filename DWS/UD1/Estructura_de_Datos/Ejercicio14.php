<?php
    $numero = 3450;
    $cifras = 1;

    while ($numero >= 10) 
    {
        $numero /= 10;
        $cifras++;
    }
    echo ($numero * 10 ** ($cifras - 1)). " tiene $cifras cifras";
?>