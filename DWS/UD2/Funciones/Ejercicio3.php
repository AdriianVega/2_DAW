<?php
    //Añadimos el signo "&" para que el valor de las variables se guarde en el programa
    function intercambia(&$num1, &$num2)
    {
        $numTemp = $num1; //Variable temporal para guardar el valor de uno
        $num1 = $num2;
        $num2 = $numTemp;
    }
    $num1 = 43;
    $num2 = 27;

    intercambia($num1, $num2); //Llamamos a la función

    echo "Número 1: $num1 <br>Número 2: $num2"; //Imprimimos
?>