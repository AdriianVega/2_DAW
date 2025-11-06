<?php
    $espacio2 = 0;
    $numero = 5; //Inicializamos espacio2 y numero

    // Dependiendo del numero elegido se imprime por pantalla un rombo con una medida
    for ($i = 0; $i < $numero ; $i++)
    {
        $espacio = ($numero * 2) - $espacio2; //Se van restando cada vez dos espacios de forma incremental

        for ($j = 0 ; $j < ($numero * 2 + 1) ; $j++) //Dependiendo de si la variable espacio es mayor a 0 se escriben o no asteriscos
        {
            echo $espacio <= 0 ? "*" : "&nbsp;";

            $espacio--;
        }
        $espacio2+= 2; //Se van incrementando los espacios que se restan para hacer el rombo
        echo "<br>";
    }
    // El mismo procedimiento pero de forma inversa para la parte de abajo del rombo
    for ($i = 0; $i < $numero + 1 ; $i++)
    {
        $espacio = ($numero * 2) - $espacio2;

        for ($j = 1 ; $j <= ($numero * 2) + 1 ; $j++)
        {
            echo $espacio <= 0 ? "*" : "&nbsp;";

            $espacio--;
        }
        $espacio2-= 2;
        echo "<br>";
    }
?>
