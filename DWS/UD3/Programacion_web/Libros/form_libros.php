<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        label
        {
            display: block;
        }
        input[type='text']
        {
            width: 300px;
        }
    </style>
    <title>Libros</title>
</head>
<body>
    <?php
        // Comprobamos si se ha recibido un error y lo mostramos
        if (isset($_GET["error"]))
        {
            echo "<div class='alert alert-danger' role='alert'>❌ Error: Debe rellenar el " .$_GET["error"]. "º Campo correctamente</div>";
        }
    ?>
    <h1>Buscador de Libros</h1>
    <form autocomplete="off" action="result_libros.php" method="post">
        <label for="libro">Texto de búsqueda</label>
        <input type="text" name="libro" id="libro">

        <label for="opcion">Buscar en:</label>
        <label><input type="radio" name="opcion" value="Titulo del libro">Título del libro</label>
        <label><input type="radio" name="opcion" value="Nombre del autor">Nombre del autor</label>
        <label><input type="radio" name="opcion" value="Editorial">Editorial</label>

        <label for="tipo" >Tipo de Libro</label>
        <select name="tipo" id="tipo">
            <option value="" selected disabled>Selecciona una opción</option>
            <option value="Narrativa">Narrativa</option>
            <option value="Libros de texto">Libros de texto</option>
            <option value="Guías y Mapas">Guías y Mapas</option>
        </select> <br> <br>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>