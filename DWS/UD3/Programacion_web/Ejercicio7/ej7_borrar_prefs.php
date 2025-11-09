<?php
    // Comprobamos si existe la cookie del nombre de usuario y la borramos
    if (isset($_COOKIE["nombreusu"]))
    {
        setcookie("nombreusu", "", time() - 3600);
    }
    // Comprobamos si existe la cookie del color de usuario y la borramos
    if (isset($_COOKIE["colorusu"]))
    {
        setcookie("colorusu", "", time() - 3600);
    }
    // Redirigimos al usuario a la página de preferencias indicando que se borraron las cookies
    header("location:ej7_preferencias.php?borrarPreferencias");
?>