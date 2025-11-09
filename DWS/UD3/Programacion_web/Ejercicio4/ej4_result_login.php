<?php
    //Evitamos que se acceda a nuestro sitio web desde fuera
    if( parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST'])
    {
        header("location:ej4_form_login.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Login</title>
</head>
<body>
    <?php
        // Validamos un campo recibido
        function validarCampo($nombre_campo, $error)
        {
            // Comprobamos si el campo está definido y no está vacío
            if (isset($_POST[$nombre_campo]) && !empty($_POST[$nombre_campo]))
            {
                // Si el campo es email, lo sanitizamos específicamente como email
                if ($nombre_campo == "email")
                {
                    return filter_var($_POST[$nombre_campo], FILTER_SANITIZE_EMAIL);
                }
                // Para otros campos, sanitizamos usando htmlspecialchars
                return htmlspecialchars($_POST[$nombre_campo]);
            }
            else
            {
                // Redirigimos al formulario indicando el error si el campo está vacío
                header("location:ej4_form_login.php?error=$error");
                die();
            }
        }
        $datos = array("email", "password");

        $datosSanatizados = array();

        // Filtramos y validamos cada campo del array
        foreach ($datos as $i => $dato)
        {
            $datosSanatizados[$dato] = validarCampo($dato, $i);
        }
    ?>
    <h1>Email: <?= $datosSanatizados["email"] ?></h1>
    <h2>Contraseña: <?= $datosSanatizados["password"] ?></h2>
    <p><a href="ej4_form_login.php">Volver</a></p>
</body>
</html>