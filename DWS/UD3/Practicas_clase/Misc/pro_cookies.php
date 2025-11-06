<?php
    // Crea una cookie llamada 'nombre_usuario' con el valor 'Paco'
    setcookie("nombre_usuario", "Paco");
    
    // Crea una cookie que caducará en 30 días
    $expiracion = time() + (30 * 24 * 60 * 60); // 30 días en segundos
    
    setcookie("recuerdame", "si", $expiracion);
    echo "Las cookies han sido configuradas.";

    // Verifica si la cookie 'nombre_usuario' está definida
    if (isset($_COOKIE["nombre_usuario"]))
    {
        echo "Hola, " . $_COOKIE["nombre_usuario"] . "! Bienvenido de nuevo.";
    }
    else
    {
    echo "Hola, invitado.";
    }
    // Para eliminar la cookie 'nombre_usuario'
    setcookie("nombre_usuario", "", time() - 3600); // time() - 3600 pone la fecha en el pasado
?>