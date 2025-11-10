<?php
    //Evitamos que se acceda a nuestro sitio web desde fuera
    if( parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST'])
    {
        header("location:ej4_form_login.php");
        die();
    }
?>
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

    $_SESSION["usuario"] = $datosSanatizados["user"];

    // Asignamos un rol según el usuario
    if ($datosSanatizados["email"] == "adrian@gmail.com" && $datosSanatizados["password"] == "1234")
    {
        session_start();

        $_SESSION["usuario"] = $datosSanatizados["email"];
        $_SESSION["logueado"] = true;
        
        header("location:ej4_pagina_usuario.php");
    }
?>
