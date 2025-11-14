<?php
    // Iniciamos la sesión
    session_start();

    // Destruimos toda la sesión
    session_destroy();

    // Redirigimos al usuario a la página principal indicando que la sesión ha sido borrada
    header("location:ej9_form_login.php?sesion_borrada");
?>