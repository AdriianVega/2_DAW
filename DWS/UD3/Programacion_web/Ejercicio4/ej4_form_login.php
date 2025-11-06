<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *
        {
            max-width: 100%;
            height: auto;
        }
        footer
        {
            background-color: #008cffff;
            height: 50px;
        }
        #register a
        {
            text-decoration: underline;
            color: red;
        }
        #forgotPassword
        {
            text-decoration: underline;
            color: black;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <?php
        $campos = array("1º Campo", "2º Campo");

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
    <main class="container my-5">
        <section class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-4">
            
            <img src="https://ael.es/_next/image?url=%2Fimages%2FloginImage.webp&w=3840&q=75"
                alt="Login"
                class="img-fluid mb-3 mb-md-0"
                style="height: 300px; width: auto;">

            <form action="ej4_result_login.php" method="post" class="d-flex flex-column w-100" style="max-width: 300px;">
                
                <input type="email" name="email" id="email" placeholder="Email" class="form-control mb-1">
                <small class="text-muted">Email</small>

                <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control mb-1">
                <small class="text-muted">Password</small>

                <div class="d-flex gap-3">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="checkbox">
                        <label class="form-check-label" for="checkbox">Recuérdame</label>
                    </div>
                    <p><a href="#" id="forgotPassword">Olvidaste contraseña?</a></p>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <small id="register" class="mt-4">
                    <strong>¿Todavía no tienes cuenta?</strong> <a href="#">Regístrate</a>
                </small>
            </form>
        </section>
    </main>
    <footer class="d-flex align-items-center p-5 mt-5 text-white">
        <p>Copyright &copy; 2025, Todos los derechos reservados</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>