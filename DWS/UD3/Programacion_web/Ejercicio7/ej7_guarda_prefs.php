<?php
    // Definimos la expiración de las cookies
    $expiracion = time() + (5 * 60);

    // Comprobamos si se ha enviado el nombre y lo guardamos en una cookie, sanitizando el valor
    if (isset($_POST["name"]) && !empty($_POST["name"]))
    {
        setcookie("nombreusu", htmlspecialchars($_POST["name"]), $expiracion);
    }
    // Comprobamos si se ha enviado el color y lo guardamos en una cookie
    if (isset($_POST["color"]) && !empty($_POST["color"]))
    {
        setcookie("colorusu", $_POST["color"], $expiracion);
    }
    // Redirigimos al usuario a la página principal
    header("location:ej7_index.php");
?>