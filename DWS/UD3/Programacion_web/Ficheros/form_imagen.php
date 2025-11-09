<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        label, input
        {
            display: block;
        }
    </style>
    <title>Formulario Imagen</title>
</head>
<body>
    <?php
        // Definimos un array con los mensajes de error posibles
        $errores = array
        (
            1 => "No se ha subido una imagen o la imagen es demasiado grande",
            2 => "Sólo se permiten imagenes",
            3 => "Se ha producido un error subiendo el archivo"
        );
        // Comprobamos si se ha recibido un error y mostramos un mensaje de alerta correspondiente al error indicado
        if (isset($_GET["error"]))
        {
            echo "<div class='alert alert-danger' role='alert'>❌ Error: ". $errores[$_GET['error']]. "</div>";
        }
    ?>
    <div class="p-3">
        <div class="mb-3">
            <h1>Subir Imagen</h1>
        </div>

        <form action="subir_imagen.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="imagen">Seleccione una imagen:</label>
                <input type="file" name="imagen" id="imagen">
            </div>
    
            <div >
                <input type="submit" value="Enviar" class="btn btn-primary">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>