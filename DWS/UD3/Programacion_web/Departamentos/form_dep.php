<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        label, select, input
        {
            display: block;
        }
    </style>
    <title>Departamentos Inicio</title>
</head>
<body>
    <div class="p-3">
        <h1>Elegir Departamento</h1>
    </div>

    <form action="presupuesto.php" method="post" class="p-3">
        <div>
            <label for="departamento" class="fw-bold">Departamento:</label>
        </div>
        <div class="mb-3">
            <select id="departamento" name="departamento">
            <option value="informatica">Informática</option>
            <option value="lengua">Lengua</option>
            <option value="matematicas">Matemáticas</option>
            <option value="ingles">Inglés</option>
        </select>
        </div>
        <div>
            <input type="submit" value="Enviar" class="btn btn-primary">
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>