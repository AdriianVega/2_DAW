<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }
    include "../db/db.inc";

    $nombre = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];

    if (isset($_POST["accion"]) && $_POST["accion"] == "editar") {
        
        if(isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
            $id = intval($_POST["id"]);
            $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
            $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
            $precio = floatval($_POST["precio"]);
            $stock = intval($_POST["stock"]);
            $categoria_id = intval($_POST["categoria_id"]);
            $imagen = mysqli_real_escape_string($conn, $_POST["imagen"]);
            $estado = intval($_POST["estado"]);
            $sql_check = "SELECT * FROM productos WHERE nombre='$nombre' AND id != $id";
            $res = mysqli_query($conn, $sql_check);

            try {
                $sql = "UPDATE productos SET
                        nombre = '$nombre',
                        descripcion = '$descripcion',
                        precio = $precio,
                        stock = $stock,
                        categoria_id = $categoria_id,
                        imagen = '$imagen',
                        estado = $estado
                    WHERE id = $id";

                mysqli_query($conn, $sql);

                header("location:gestion_productos.php?msg=0");
            }
            catch (mysqli_sql_exception $e) {

                // Debug: descomentar si falla para ver el error real
                //mysqli_error($conn); die();
                header("location:gestion_productos.php?msg=error");
            }

            die();
        }
    }

    if(!isset($_GET["id"])) {
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
    <link rel="stylesheet" href="../css/tablas.css">
    <title>Editar Producto</title>
</head>
<body class="bg-light">

    <aside id="sidebar" class="text-white d-flex flex-column p-3">
        <h4 class="mb-4 text-center">Admin Panel</h4>

        <div class="d-flex flex-column justify-content-center align-items-center border-bottom pb-4">
            <?php
                $ruta_icono = "../img/usuarios/" . $_SESSION["nombre"] .".jpg";

                if (!file_exists($ruta_icono)) {
                    $ruta_icono = "../img/usuarios/admin.jpg";
                }
            ?>
            <img src="<?= $ruta_icono ?>" alt="Icono Usuario">

            <span> <?= $nombre ?></span>

            <?php if ($rol == 1) { ?>
                <small class="badge bg-danger"> Administrador </small>
            <?php } else { ?>
                <small class="badge bg-info"> Empleado </small>
            <?php } ?>
        </div>
        <div class="list-group pt-3">
            <a href="../clientes/gestion_clientes.php" class="list-group-item list-group-item-action">👥 Clientes</a>
            <a href="gestion_productos.php" class="list-group-item list-group-item-action active">📦 Productos</a>
            <a href="../categorias/gestion_categorias.php" class="list-group-item list-group-item-action">🏷️ Categorías</a>
            <a href="../pedidos/gestion_pedidos.php" class="list-group-item list-group-item-action">🧾 Pedidos</a>
            <a href="../usuarios/gestion_usuarios.php" class="list-group-item list-group-item-action">🛡️ Usuarios</a>
        </div>

        <div class="mt-auto">
            <div class="d-flex justify-content-between mb-3 fs-5">
                <a href="../menu/menu_inicio.php">
                    <span>🏠️</span>
                </a>

                <a href="../configuracion/configuracion.php" class="text-decoration-none">
                    <span>⚙️</span>
                </a>
                
            </div>

            <a href="../index.php" class="btn btn-danger w-100">Cerrar Sesión</a>
        </div>
    </aside>

    <main class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="h4 mb-0">✏️ Editar Producto</h2>
            </div>
            <div class="card-body">

            <?php
                $id = intval($_GET["id"]);
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
                                    echo '<option value="1" ' . ($est == 1 ? 'selected' : '') . '>Activo</option>';
                                    echo '<option value="0" ' . ($est == 0 ? 'selected' : '') . '>Inactivo</option>';
                                ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="imagen" class="form-label">Nombre archivo imagen:</label>
                            <input type="text" class="form-control" id="imagen" name="imagen"
                                value="<?= htmlspecialchars($prod["imagen"]) ?>" placeholder="ej: producto1.jpg">
                            <div class="form-text text-white">Introduce solo el nombre del archivo. La imagen física debe existir en /img/</div>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
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
