<?php
    $variable = "a-a-r-e-f-a";

    $variable = str_replace("a", "tortuga", $variable);

    $variable = explode("-", $variable);

    rsort($variable);

    $nuevaVariable = array();

    foreach ($variable as $palabra)
    {
        if (!str_contains($palabra,"a"))
        {
            array_push( $nuevaVariable, $palabra);
        }
    }
    echo "La nueva variable tiene ". count($nuevaVariable). " elementos";
?>
    <!-- Ordenar array forma descendente -->
    <!-- Crea un nuevo array y añade unicamente los valores del array anterior sin a -->
    <!-- Muestra por pantalla la cantidad de valores del ultimo array (3) -->