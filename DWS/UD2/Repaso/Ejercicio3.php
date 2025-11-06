<?php
    //Número random 1 al 15
    $alto = random_int(1, 15);

    echo "Alto: ". $alto ."<br><br>";

    for ($i = 0 ; $i < $alto ; $i++)
    {
        for ($j = $i ; $j < $alto ; $j++)
        {
            if ($i != 0 || $j != 0)
            {
                echo "* ";
            }
        }
        for ($k = 0 ; $k < $i * 2 - 1 ; $k++)
        {
            echo "&nbsp;&nbsp;&nbsp";
        }
        for ($l = $i ; $l < $alto ; $l++)
        {
            echo "* ";
        }
        echo "<br>";
    }
?>
<!-- * * * * * * * * * -->
<!-- * * * *   * * * * -->
<!-- * * *       * * * -->
<!-- * *           * * -->
<!-- *               * -->
