<?php

    session_start();

    if (!isset($_SESSION["usuario"]))
    {
        //Evitamos que se acceda a nuestro sitio web desde fuera
        if( parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST'])
        {
            header("location:ej9_form_login.php");
            die();
        }
        // Función para validar campos
        function validarCampo($nombre_campo, $error)
        {
            // Comprobamos si el campo existe y no está vacío
            if (isset($_POST[$nombre_campo]) && !empty($_POST[$nombre_campo]))
            {
                // Sanitizamos el valor para evitar inyecciones
                return htmlspecialchars($_POST[$nombre_campo]);
            }
            else
            {
                // Redirigimos al formulario indicando el error si el campo está vacío
                header("location:ej9_form_login.php?error=$error");
                die();
            }
        }
        $datos = array("user", "password");

        $datosSanatizados = array();

        // Validamos cada campo del array
        foreach ($datos as $i => $dato)
        {
            $datosSanatizados[$dato] = validarCampo($dato, $i + 1);
        }
        // Verificamos que el usuario sea válido
        if ($datosSanatizados["user"] != "usuario" && $datosSanatizados["user"] != "admin")
        {
            header("location:ej9_form_login.php?error=3");
            die();
        }
        // Verificamos que la contraseña sea correcta
        if ($datosSanatizados["password"] != "1234")
        {
            header("location:ej9_form_login.php?error=4");
            die();
        }
        // Guardamos el nombre de usuario en la sesión
        $_SESSION["usuario"] = $datosSanatizados["user"];

        // Asignamos un rol según el usuario
        if ($datosSanatizados["user"] == "admin")
        {
            $_SESSION["rol"] = 1;

        }
        elseif ($datosSanatizados["user"] == "usuario")
        {
            $_SESSION["rol"] = 2;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php
            // Comprobamos si la sesión existe y el rol del usuario
            if (isset($_SESSION["rol"]) && $_SESSION["rol"] == 1)
            {
                // Aplicamos un fondo de color aquamarine para el rol de admin
                echo 'body
                {
                    background-color: aquamarine;
                }';
            }
            else
            {
                // Aplicamos un fondo de color aquamarine para el rol de usuario
                echo 'body
                {
                    background-color: salmon;
                }';
            }
        ?>
    </style>
    <title>Result Login</title>
</head>
<body>
    <h1>Hola, <?= $_SESSION["usuario"] ?></h1>

    <p><a href="ej9_form_login.php?logout">Desconectar</a></p>
</body>
</html>