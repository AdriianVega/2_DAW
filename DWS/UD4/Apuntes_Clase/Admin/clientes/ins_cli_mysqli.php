<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Registro de Cliente con Mysqli</h5>
        </div>

        <div class="card-body">
            <form action="" method="POST">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" id="apellidos" name="apellidos" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label for="genero" class="form-label">Género</label>
                        <select id="genero" name="genero" class="form-select">
                            <option value="" selected>Seleccione...</option>
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" id="direccion" name="direccion" class="form-control">
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="postal" class="form-label">Código Postal</label>
                        <input type="text" id="postal" name="postal" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="poblacion" class="form-label">Población</label>
                        <input type="text" id="poblacion" name="poblacion" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label for="provincia" class="form-label">Provincia</label>
                        <input type="text" id="provincia" name="provincia" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-success float-end">
                    Guardar Cliente
                </button>

            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
