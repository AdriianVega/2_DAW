<?php
    session_start();
    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }
    include("../db/db.inc"); // Asegúrate de que este archivo contiene la conexión $conn (mysqli)

    // PROCESAR FORMULARIO (UPDATE)
    if (isset($_POST["accion"]) && $_POST["accion"] == "editar") {
        
        if(isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
            // Saneamiento básico para MySQLi procedural
            $id = intval($_POST["id"]);
            $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
            $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
            $precio = floatval($_POST["precio"]); // Forzamos tipo float
            $stock = intval($_POST["stock"]);     // Forzamos tipo int
            $categoria_id = intval($_POST["categoria_id"]);
            $imagen = mysqli_real_escape_string($conn, $_POST["imagen"]);
            $estado = intval($_POST["estado"]); // 1 o 0

            // Comprobar duplicados por nombre (opcional, excluyendo el propio ID)
            $sql_check = "SELECT * FROM productos WHERE nombre='$nombre' AND id != $id";
            $res = mysqli_query($conn, $sql_check);
            
            if (mysqli_num_rows($res) > 0) {
                // Código de error 1: Nombre duplicado
                header("location:gestion_productos.php?prod=1");
                die();
            }

            // Consulta UPDATE adaptada a la tabla productos
            $sql = "UPDATE productos SET 
                        nombre = '$nombre', 
                        descripcion = '$descripcion', 
                        precio = $precio, 
                        stock = $stock, 
                        categoria_id = $categoria_id, 
                        imagen = '$imagen', 
                        estado = $estado 
                    WHERE id = $id";
            
            if (mysqli_query($conn, $sql)) {
                header("location:gestion_productos.php?prod=0"); // Éxito
            } else {
                // Debug: descomentar si falla para ver el error real
                // echo mysqli_error($conn); die(); 
                header("location:gestion_productos.php?prod=2"); // Error SQL
            }
            die();
        }
    }

    // OBTENER DATOS (GET)
    if(!isset($_GET["id"])) { // Ojo: en tu tabla usas 'id', he unificado $_GET['id']
        header("location:gestion_productos.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Producto</title>
</head>
<body class="bg-light">
    <main class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="h4 mb-0">✏️ Editar Producto (MySQLi)</h2>
            </div>
            <div class="card-body">

            <?php
                $id = intval($_GET["id"]); // Asegúrate de que el enlace en gestion_productos sea edit_producto.php?id=X
                $sql = "SELECT * FROM productos WHERE id = $id";
                $res = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($res) > 0) {
                    $prod = mysqli_fetch_assoc($res);
                } else {
                    header("location:gestion_productos.php");
                    die();
                }
            ?>

                <form method="POST">
                    <input type="hidden" name="id" value="<?=$id;?>">
                    <input type="hidden" name="accion" value="editar">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre del Producto:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   value="<?= htmlspecialchars($prod["nombre"]) ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="categoria_id" class="form-label">ID Categoría:</label>
                            <input type="number" class="form-control" id="categoria_id" name="categoria_id" 
                                   value="<?= $prod["categoria_id"] ?>" required>
                        </div>

                        <div class="col-12">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="2" required><?= htmlspecialchars($prod["descripcion"]) ?></textarea>
                        </div>

                        <div class="col-md-4">
                            <label for="precio" class="form-label">Precio (€):</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" 
                                   value="<?= $prod["precio"] ?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="stock" class="form-label">Stock (uds):</label>
                            <input type="number" class="form-control" id="stock" name="stock" 
                                   value="<?= $prod["stock"] ?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado:</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <?php
                                    $est = $prod['estado'];
                                    // tinyint(1): 1 = Activo, 0 = Inactivo
                                    echo '<option value="1" ' . ($est == 1 ? 'selected' : '') . '>Activo</option>';
                                    echo '<option value="0" ' . ($est == 0 ? 'selected' : '') . '>Inactivo</option>';
                                ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="imagen" class="form-label">Nombre archivo imagen:</label>
                            <input type="text" class="form-control" id="imagen" name="imagen" 
                                value="<?= htmlspecialchars($prod["imagen"]) ?>" placeholder="ej: producto1.jpg">
                            <div class="form-text">Introduce solo el nombre del archivo. La imagen física debe existir en /img/</div>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100">💾 Guardar Cambios</button>
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