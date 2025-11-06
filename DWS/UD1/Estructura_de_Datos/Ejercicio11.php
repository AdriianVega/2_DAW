<?php
    $numImpares = 0;
    $i = 1;

    while ($numImpares < 5)
    {
        if ($i % 2 != 0)
        {
            echo $i. " ";
            $numImpares++;
        }
        $i++;
    }
?>