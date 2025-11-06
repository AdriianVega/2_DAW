<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 22</title>
</head>
<body>
    <?php
        $logueado = true; //Inicializamos el booleano logueado

        echo $logueado ? //Si el usuario está logueado o no imprimimos el h1 y p correspondientes
        "<h1> Bienvenido de nuevo </h1>
        <p> Este contenido es para usuarios registrados </p>" :
        "<h1> Por favor, inicia sesión </h1>
        <p> Crea una cuenta, o ingresa para acceder a más contenido </p>";
    ?>
</body>
</html>