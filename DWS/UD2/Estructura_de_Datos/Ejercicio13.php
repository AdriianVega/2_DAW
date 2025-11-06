<?php
    $letra = "2"; //Inicializamos la letra
    
    //Comprobamos si es vocal, cifra o consonante
    $respuesta = match($letra)
    {
        "a","e","i","o","u","A","E","I","O","U" => "$letra es una vocal",
        "0","1","2","3","4","5","6","7","8","9" => "$letra es una cifra",
        default => "$letra es una consonante"
    };
    //Imprimimos resultado
    echo $respuesta;
?>
