<?php
    //descuento = 0 por defecto
    function calcularDto($precio, $descuento = 0)
    {
        //Imprimimos el precio sin y con descuento
        echo "Precio sin descuento: $precio <br>";
        echo "Precio con un $descuento% de descuento: ". ($precio - ($precio * ($descuento / 100))). "<br>";
    }
    calcularDto(230, 10);
    calcularDto(95); //Llamamos a las funciones
?>