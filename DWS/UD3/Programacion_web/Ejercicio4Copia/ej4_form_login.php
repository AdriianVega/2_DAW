<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        footer
        {
            background-color: #008cffff;
            height: 50px;
        }
        img
        {
            height: 300px;
            width: auto;
        }
        #login
        {
            width: 120px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <?php
        // Comprobamos si se ha recibido un error y lo mostramos
        if (isset($_GET["error"]))
        {
            echo "<div class='alert alert-danger' role='alert'>❌ Error: Debe rellenar el ". ($_GET["error"] + 1). "º campo correctamente</div>";
        }
    ?>
    <main class="container my-5">
        <section class="d-flex align-items-center justify-content-center gap-4">
            
            <img src="https://ael.es/_next/image?url=%2Fimages%2FloginImage.webp&w=3840&q=75" alt="Login" class="mb-3">

            <form action="ej4_result_login.php" method="post">

                <input type="email" name="email" id="email" placeholder="Email" class="form-control mb-1">
                <small class="text-muted">Email</small>

                <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control mb-1 mt-4">
                <small class="text-muted">Password</small>

                <div class="d-flex gap-3 my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkbox">
                        <label class="form-check-label" for="checkbox">Recuérdame</label>
                    </div>
                    <p><a href="#" class="text-black">Olvidaste contraseña?</a></p>
                </div>
                <button type="submit" id="login" class="d-block btn btn-primary mb-2 ">Login</button>
                <small class="mt-4">
                    <strong>¿Todavía no tienes cuenta? <a href="#" class="text-danger">Regístrate</a></strong>
                </small>
            </form>
        </section>
    </main>
    <footer class="d-flex align-items-center p-5 text-white">
        Copyright &copy; 2025, Todos los derechos reservados
    </footer>
    <?php
        if (isset($_GET["error"]))
        {

    ?>
    <script>
        // Calcula el retraso en milisegundos (8 segundos * 1000 ms)
        var retraso = 8000;
        // Redirige a la misma página, pero sin los parámetros GET
        window.setTimeout(function()
        {
            window.location.href = window.location.pathname;
        }, retraso);
    </script>
    <?php
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>