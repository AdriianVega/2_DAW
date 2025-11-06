<?php
$mes = 2;
$anyo = 2024; //Inicializamos mes y año

//Dependiendo de que número sea el mes y el año, se le asigna los días que tiene
$diasMes = match($mes)
{
    4, 6, 9, 11 => 30,
    1, 3, 5, 7, 8, 10, 12 => 31,
    2 => ($anyo % 4 != 0) ? 28 : 29,
    default => -1
};
//Imprimimos los días correspondientes, si $diasmes es igual a -1 se marca que no se reconoce el valor númerico
echo $diasMes != -1 ? "El mes con el número $mes y anyo $anyo tiene $diasMes dias" : "No se reconoce el valor númerico de mes ($mes)";
?>


