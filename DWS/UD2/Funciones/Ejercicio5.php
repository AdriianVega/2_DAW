<?php
    //exponente = 2 por defecto
    function calcularPotencia($base, $exponente = 2)
    {
        return $base ** $exponente; //Devolvemos el cálculo
    }
    $base = 2;
    $exponente = 7;

    echo "$base elevado a $exponente = ". calcularPotencia($base, $exponente). "<br>";

    $base = 5;

    echo "$base elevado a $exponente = ". calcularPotencia($base); //Imprimimos por pantalla el resultado de las funciones
?>