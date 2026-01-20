<?php
    session_start();
    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }
    include "../db/db.inc";

    $nombre_usuario = $_SESSION["nombre"];
    $rol= $_SESSION["rol"];
    $pagina_activa = "productos";

    if(isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
        
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
        
        
        $precio = floatval($_POST["precio"]);
        $stock = intval($_POST["stock"]);
        $categoria_id = intval($_POST["categoria_id"]);
        
        
        $imagen = mysqli_real_escape_string($conn, $_POST["imagen"]);
        $estado = intval($_POST["estado"]); // 1 o 0

        
        $sql_check = "SELECT * FROM productos WHERE nombre='$nombre'";
        $res = mysqli_query($conn, $sql_check);
        
        if (mysqli_num_rows($res) > 0)
        {
            
            header("location:gestion_productos.php?prod=1");
            die();
        }
        
        try {
                $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id, imagen, estado)
                VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$categoria_id', '$imagen', '$estado');";

                mysqli_query($conn, $sql);

                header("location:gestion_productos.php?msg=0");
            }
            catch (mysqli_sql_exception $e) {

                // Debug: descomentar si falla para ver el error real
                //mysqli_error($conn); die();
                header("location:gestion_productos.php?msg=error");
            }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tablas.css">
    <title>Nuevo Producto</title>
</head>
<body class="bg-light">
    <?php include "../php/panel_control.php"; ?>
    
    <main class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h2 class="h4 mb-0">📦 Añadir Producto</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row g-3">
                        
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="col-md-6">
                            <label for="categoria_id" class="form-label">ID de Categoría</label>
                            <input type="number" class="form-control" id="categoria_id" name="categoria_id" required>
                        </div>

                        <div class="col-12">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="2" required></textarea>
                        </div>

                        <div class="col-md-4">
                            <label for="precio" class="form-label">Precio (€)</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                        </div>

                        <div class="col-md-4">
                            <label for="stock" class="form-label">Stock (Unidades)</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>

                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="imagen" class="form-label">Nombre del archivo de imagen</label>
                            <input type="text" class="form-control" id="imagen" name="imagen" placeholder="Ej: monitor.jpg">
                            <div class="form-text">Asegúrate de subir el archivo físico a la carpeta /img/productos/ manualmente.</div>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100">Guardar Producto</button>
                            <a href="gestion_productos.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
