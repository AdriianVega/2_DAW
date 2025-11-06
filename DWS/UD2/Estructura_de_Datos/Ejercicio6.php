<?php
    $letra = "a"; // Inicializamos letra
    
    // Comprobamos si es vocal o consonante e imprimimos por pantalla
    $respuesta = match($letra)
    {
        "a","e","i","o","u","A","E","I","O","U" => "$letra es una vocal",
        default => "$letra es una consonante"
    };
    echo "$respuesta";
?>
