<?php
    // Definimos la expiración de las cookies
    $expiracion = time() + (10 * 60);

    // Comprobamos si se ha enviado el nombre y lo guardamos en una cookie
    if (isset($_POST["name"]) && !empty($_POST["name"]))
    {
        setcookie("nombre_usuario", $_POST["name"], $expiracion);
    }
    // Comprobamos si se ha enviado el idioma y lo guardamos en una cookie
    if (isset($_POST["language"]) && !empty($_POST["language"]))
    {
        setcookie("idioma", $_POST["language"], $expiracion);
    }
    // Redirigimos al usuario a la página principal indicando que las cookies se guardaron
    header("location:ej6_cookies.php?cookie_guardada=1");
?>