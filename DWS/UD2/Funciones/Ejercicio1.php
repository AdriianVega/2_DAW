<?php
    function sumar()
    {
        $numero1 = random_int(1,20);
        $numero2 = random_int(1,20);
        $numero3 = random_int(1,20);
        $numero4 = random_int(1,20); //Creamos 4 números aleatorios
        
        echo "<strong>El primer valor entero generado: ". $numero1. "<br>";
        echo "El segundo valor entero generado: ". $numero2. "<br>";
        echo "El tercer valor entero generado: ". $numero3. "<br>";
        echo "El cuarto valor entero generado: ". $numero4. "<br>"; //Imprimimos los números random que dió
        echo "=============================================<br>";
        echo "Suma de valores = ". ($numero1 + $numero2 + $numero3 + $numero4)." <br>"; //Los sumamos


    }
    function multiplicar()
    {
        $numero1 = random_int(1,20);
        $numero2 = random_int(1,20);
        $numero3 = random_int(1,20);
        $numero4 = random_int(1,20); //Creamos 4 números aleatorios

        echo "<strong>El primer valor entero generado:". $numero1. "<br>";
        echo "El segundo valor entero generado:". $numero2. "<br>";
        echo "El tercer valor entero generado:". $numero3. "<br>";
        echo "El cuarto valor entero generado:". $numero4. "<br>"; //Imprimimos los números random que dió
        echo "=============================================<br>";
        echo "Suma de valores = ". ($numero1 * $numero2 * $numero3 * $numero4)."</strong><br>"; //Hacemos el producto
    }
    sumar();
    multiplicar(); //Llamamos a las funciones
?>