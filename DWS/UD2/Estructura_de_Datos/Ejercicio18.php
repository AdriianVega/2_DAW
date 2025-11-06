<?php
    for ($i = 1; $i <= 10; $i++) //Imprimimos por pantalla las tablas del 1 al 10
    {
        echo "Tabla del $i <br> **********<br>";

        for ($j = 1; $j <= 10; $j++)
        {
            echo "$i * $j = ". ($i * $j). "<br>";
        }
        echo "<br>";
    }
?>
