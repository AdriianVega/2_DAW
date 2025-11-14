<?php
    session_start();

    if (!isset($_SESSION["logueado"]))
    {
        header("location:ej4_form_login.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Hola, <?= $_SESSION["usuario"] ?></h1>
</body>
</html>