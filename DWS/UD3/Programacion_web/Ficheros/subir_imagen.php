<?php
    //Evitamos que se acceda a nuestro sitio web desde fuera
    if( parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST'])
    {
        header("location:form_imagen.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen</title>
</head>
<body>
    <?php
        // Definimos el directorio donde guardaremos la imagen
        $directorio = "img/";

        // Obtenemos la ruta temporal y el nombre original del archivo subido
        $archivo_temporal = $_FILES["imagen"]["tmp_name"];
        $archivo_original = uniqid().$_FILES["imagen"]["name"];

        // Comprobamos si se ha subido un archivo correctamente
        if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] != 0)
        {
            // Redirigimos al formulario con error si no hay archivo o hubo un fallo
            header("location:form_imagen.php?error=1");
            die();
        }
        // Verificamos si el archivo subido es una imagen
        elseif (getimagesize($archivo_temporal))
        {
            // Construimos la ruta final donde guardaremos la imagen
            $ruta_final = $directorio . $archivo_original;

            // Movemos la imagen desde la ruta temporal al directorio final
            if(move_uploaded_file($archivo_temporal, $ruta_final))
            {
                echo "<h1> $archivo_original </h1>";
                echo "<img src='$ruta_final' alt='$archivo_original'>";
            }
            //Si ha ocurrido un error mostramos por pantalla
            else
            {
                header("location:form_imagen.php?error=3");
                die();
            }
        }
        else
        {
            // Redirigimos al formulario con error si el archivo no es una imagen
            header("location:form_imagen.php?error=2");
            die();
        }
    ?>
</body>
</html>l