<?php
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
        function validarCampo($nombre_campo, $error)
        {
            if (isset($_POST[$nombre_campo]) && !empty($_POST[$nombre_campo]))
            {
                $campo = htmlspecialchars($_POST[$nombre_campo]);
            }
            else
            {
                header("location:form_libros.php?error=$error");
                die();
            }
            return $campo;
        }
        $libro = validarCampo("libro", 1);
        $opcion = validarCampo("opcion", 2);
        $tipo = validarCampo("tipo", 3);
    ?>
    <h1>Libro: <?= $libro ?></h1>
    <h2>Búsqueda hecha en: <?= $opcion ?></h2>
    <h2>Tipo de Libro seleccionado: <?= $tipo ?></h2>
</body>
</html>