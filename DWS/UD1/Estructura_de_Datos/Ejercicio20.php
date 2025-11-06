<?php
    $espacio = 5;

    for ($i = 1; $i <= 4 ; $i += 2) 
    {
        for ($j = 1 ; $j <= 7 ; $j++)
        {
            if ($espacio != 0)
            {
                echo "&nbsp";
            }
            else
            {
                echo "*";
            }
            $espacio --;
        }
        echo "<br>";
    }
    for ($i = 5; $i >= 1 ; $i -= 2) 
    {
        for ($j = 1 ; $j <= $i ; $j++)
        {
            echo "*";
        }
        echo "<br>";
    }
?>