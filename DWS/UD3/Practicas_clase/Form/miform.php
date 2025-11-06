<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Mi Formulario</title>
</head>
<body>
    <main class="container">
        <?php
            if(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST'])
            {
            echo "<div class='alert alert-error' role='alert'>❌ Error: Debe rellenar el
            formulario en nuestra web</div>";
            header("Refresh:2; url=form_example.php");
            }
            if(isset($_POST["nombre"]) && !empty($_POST["nombre"]))
            {
                $nombre = htmlspecialchars($_POST["nombre"]);
            }
            else
            {
                header("location:index.php?error=1");
                die();
            }
            if(isset($_POST["email"]) && !empty($_POST["email"]))
            {
                $email = htmlspecialchars($_POST["email"]);
            }
            else
            {
                header("location:index.php?error=2");
                die();
            }
            if(isset($_POST["password"]) && !empty($_POST["password"]))
            {
                $password = htmlspecialchars($_POST["password"]);
            }
            else
            {
                header("location:index.php?error=3");
                die();
            }
        ?>
        <h1>Hola, <?= $nombre ?> </h1>
        <p>El email pasado es: <strong><?= $email ?> </strong></p>
        <p>Y la contraseña es: <strong><?= $password ?> </strong></p>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>