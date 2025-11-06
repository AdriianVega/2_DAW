<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Practica 1</title>
</head>
<body>
    <?php
    // Crea una cookie llamada 'nombre_usuario' con el valor 'Paco'
    setcookie("nombre_usuario", "Paco");
    
    // Crea una cookie que caducará en 30 días
    $expiracion = time() + (30 * 24 * 60 * 60); // 30 días en segundos
    
    setcookie("recuerdame", "si", $expiracion);
    echo "Las cookies han sido configuradas. ";

    // Verifica si la cookie 'nombre_usuario' está definida
    if (isset($_COOKIE["nombre_usuario"]))
    {
        echo "Hola, " . $_COOKIE["nombre_usuario"] . "! Bienvenido de nuevo.";
    }
    else
    {
    echo "Hola, invitado.";
    }

        if (isset($_GET["error"]) && !empty($_GET["error"]))
        {
            for ($i = 0 ; $i < count($campos) ; $i++)
            {
                if ($_GET["error"] == $i + 1)
                {
                    echo "<div class='alert alert-error' role='alert'>❌ Error: Debe rellenar el
                    campo ". $campos[$i]. " correctamente</div>";
                }
            }
        }
    ?>
    <main class="container mt-3">
        <form name="registro" method="post" action="miform.php">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp" name="nombre" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"  name="email">
                <div id="emailHelp" class="form-text">Nunca compartiremos tu email con nadie.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
                <button type="submit" class="btn btn-primary w-100" name="enviar"> Enviar</button>
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>