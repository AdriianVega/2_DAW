<?php
    //Evitamos que se acceda a nuestro sitio web desde fuera
    if( parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST'])
    {
        header("location:ej5_form_registro.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado Registro</title>
</head>
<body>
    <?php
        // Validamos un campo recibido
        function validar_campo($campo, $error)
        {
            // Comprobamos si el campo está definido y no está vacío
            if (isset($_POST[$campo]) && !empty($_POST[$campo]))
            {
                // Si el campo es email, lo sanitizamos específicamente como email
                if ($campo == "email")
                {
                    return filter_var($_POST[$campo], FILTER_SANITIZE_EMAIL);
                }
                // Para otros campos, sanitizamos usando htmlspecialchars
                return htmlspecialchars($_POST[$campo]);
            }
            else
            {
                // Redirigimos al formulario indicando el error si el campo está vacío
                header("location:ej5_form_registro.php?error=$error");
                die();
            }
        }
        // Definimos los campos que queremos validar
        $datos = array("name", "surname", "email", "password", "gender",
            "address", "postal_code", "population", "spain_province");

        $datos_sanitizados = array();

        // Validamos cada campo del array
        foreach ($datos as $i => $dato)
        {
            $datos_sanitizados[$dato] = validar_campo($dato, $i);
        }
        
        // Definimos los nombres traducidos para mostrar en pantalla
        $datos_traducidos = array("Nombre", "Apellidos", "Email", "Contraseña", "Género",
            "Dirección", "Código Postal", "Población", "Provincia");
        $i = 1;

        // Mostramos el primer dato por separado (Nombre)
        echo "<h1>". $datos_traducidos[0]. ": ". $datos_sanitizados["name"] ."</h1>";

        // Eliminamos el primer dato del array para evitar repetirlo
        array_shift($datos_sanitizados);

        // Mostramos el resto de los datos con sus nombres traducidos
        foreach ($datos_sanitizados as $clave)
        {
            echo "<h2>". $datos_traducidos[$i]. ": ". $clave ."</h2>";
            $i++;
        }
    ?>
</body>
</html>