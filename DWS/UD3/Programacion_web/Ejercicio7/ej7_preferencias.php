<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Preferencias</title>
</head>
<body class="p-4">
    <?php
        // Comprobamos si se ha recibido la señal para borrar preferencias por GET
        if (isset($_GET["borrarPreferencias"]))
        {
            echo "<div class='alert alert-success' role='alert'> ✅ Las Cookies han sido borradas con éxito </div>";
        }
    ?>
    <form action="ej7_guarda_prefs.php" method="post">
        <fieldset>
            <legend>Preferencias de Cookies</legend>

            <div>
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control mb-4" style="width: 200px;">
            </div>
            
            <div class="mb-4">
                <label for="color" class="form-label mb-2">Color Favorito: </label>
                <input type="color" name="color" id="color" class="form-control form-control-color">
            </div>
            
            <input type="submit" value="Enviar" class="btn btn-primary mb-4">
        </fieldset>
    </form>
    <?php
        // Comprobamos si existen las cookies de nombre o color de usuario
        if (isset($_COOKIE["nombreusu"]) || isset($_COOKIE["colorusu"]))
        {
            echo '<p><a href="ej7_borrar_prefs.php">Borrar Preferencias</a></p>';
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>