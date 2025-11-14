<?php
    // Definimos la expiración de las cookies
    $expiracion = time() + (10 * 60);
    $existe_nombre = isset($_POST["name"]) && !empty($_POST["name"]);
    $existe_idioma = isset($_POST["language"]) && !empty($_POST["language"]);

    // Comprobamos si se han enviado datos para guardar
    if ($existe_nombre || $existe_idioma)
    {
        // Comprobamos si se ha enviado el nombre y lo guardamos en una cookie
        if ($existe_nombre)
        {
            setcookie("nombre_usuario", $_POST["name"], $expiracion);
        }
        // Comprobamos si se ha enviado el idioma y lo guardamos en una cookie
        if ($existe_idioma)
        {
            setcookie("idioma", $_POST["language"], $expiracion);
        }
        // Redirigimos al usuario a la página principal indicando que las cookies se guardaron
        header("location:ej6_cookies.php?cookie_guardada=1");
    }
    else
    {
        // Si se accede por url directa en vez de rellenar datos se devuelve a la página de inicio
        header("location:ej6_cookies.php");
    }
?>