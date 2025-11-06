<?php
    $numero = 3450;
    $cifras = 1; //Inicializamos numero y cifras

    //Hacemos un bucle while para contar las cifras del número
    while ($numero >= 10)
    {
        $numero /= 10;
        $cifras++;
    }
    /*Imprimimos por pantalla el resultado, haciendo la operación inversa para
    mostrar el número correctamente en la pantalla*/
    echo ($numero * 10 ** ($cifras - 1)). " tiene $cifras cifras";
?>
