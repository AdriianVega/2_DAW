<?php
    function cuentaFunciones($a, $b)
    {
        //Empezamos por a e imprimimos hasta llegar a b
        for ( $i = $a; $i <= $b; $i++ )
        {
            /*Imprime comprobando si es el último valor
            si no lo es, añade una coma, si lo es, no la añade.*/
            echo $i != $b ? "$i, " : "$i";
        }
    }
    cuentaFunciones(3, 15); //Llamamos a la función
?>