<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Cookies</title>
</head>
<body class="m-4">
    <?php
        // Comprobamos si la cookie de idioma está definida y es español
        if (isset($_COOKIE["idioma"]) && $_COOKIE["idioma"] == "spanish")
        {
            // Mostramos un mensaje si las cookies se han guardado correctamente
            if (isset($_GET["cookie_guardada"]))
            {
                echo "<div class='alert alert-success w-25' role='alert'>✅ Las cookies se han guardado correctamente</div>";
            }
            // Mostramos un mensaje de bienvenida personalizado si existe la cookie del nombre de usuario
            if (isset($_COOKIE["nombre_usuario"]))
            {
                echo '<h1>Bienvenido de nuevo '. $_COOKIE["nombre_usuario"]. '</h1>';
            }
            else
            {
                echo '<h1>Bienvenido</h1>';
            }
            // Mostramos el formulario en español
            echo '<form action="ej6_guarda_pref.php" method="post" class="my-4">
                    <div>
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" name="name" id="name" class="form-control mb-4" style="width: 200px;">
                    </div>
                    <div>
                        <label for="language" class="form-label m">Idioma:</label>
                        <select name="language" id="language">
                            <option value="spanish">Español</option>
                            <option value="english">Inglés</option>
                        </select>
                    </div>

                    <input type="submit" value="Enviar" class="btn btn-primary mt-4">
                </form>';
        }
        else
        {
            // Mostramos un mensaje si las cookies se han guardado correctamente en inglés
            if (isset($_GET["cookie_guardada"]))
            {
                echo "<div class='alert alert-success w-25' role='alert'>✅ Cookies have been saved correctly</div>";
            }
            // Mostramos un mensaje de bienvenida personalizado en inglés
            if (isset($_COOKIE["nombre_usuario"]))
            {
                echo '<h1>Welcome again '. $_COOKIE["nombre_usuario"]. '</h1>';
            }
            else
            {
                echo '<h1>Welcome</h1>';
            }
            // Mostramos el formulario en inglés
            echo '<form action="ej6_guarda_pref.php" method="post" class="my-4">
                    <div>
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control mb-4" style="width: 200px;">
                    </div>
                    <div>
                        <label for="language" class="form-label m">Language:</label>
                        <select name="language" id="language">
                            <option value="spanish">Spanish</option>
                            <option value="english">English</option>
                        </select>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary mt-4">
                </form>';
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>