<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indice</title>
    <?php
        // Comprobamos si existe la cookie que guarda el color favorito del usuario
        if (isset($_COOKIE["colorusu"]))
        {
            // Aplicamos el color de fondo al body usando el valor de la cookie
            echo '<style>
                    body
                    {
                        background-color:'. $_COOKIE["colorusu"].
                    '}
                </style>';
        }
    ?>
</head>
<body>
    <?php
        // Comprobamos si existe la cookie con el nombre del usuario
        if (isset($_COOKIE["nombreusu"]))
        {
            // Mostramos un mensaje de bienvenida personalizado con el nombre del usuario
            echo "<h1>Bienvenido ". $_COOKIE["nombreusu"]. "</h1>";
        }
        else
        {
            echo "<h1>Página de Inicio </h1>";
        }
        echo '<p><a href="ej7_preferencias.php">Volver a Preferencias</a></p>';
    ?>
    
</body>
</html>