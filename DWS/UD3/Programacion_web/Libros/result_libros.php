<?php
    //Evitamos que se acceda a nuestro sitio web desde fuera
    if( parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST'])
    {
        header("location:form_libros.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
</head>
<body>
    <?php
        // Validamos un campo recibido
        function validarCampo($nombre_campo, $error)
        {
            // Comprobamos si el campo está definido y no está vacío
            if (isset($_POST[$nombre_campo]) && !empty($_POST[$nombre_campo]))
            {
                // Sanitizamos el valor del campo para evitar inyecciones
                $campo = htmlspecialchars($_POST[$nombre_campo]);
            }
            else
            {
                // Redirigimos al formulario indicando el error si el campo está vacío
                header("location:form_libros.php?error=$error");
                die();
            }
            // Devolvemos el valor validado y sanitizado
            return $campo;
        }
        // Validamos los campos recibidos
        $libro = validarCampo("libro", 1);
        $opcion = validarCampo("opcion", 2);
        $tipo = validarCampo("tipo", 3);
    ?>
    <h1>Libro: <?= $libro ?></h1>
    <h2>Búsqueda hecha en: <?= $opcion ?></h2>
    <h2>Tipo de Libro seleccionado: <?= $tipo ?></h2>
</body>
</html>