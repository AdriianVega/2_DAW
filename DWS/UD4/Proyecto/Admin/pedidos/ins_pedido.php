<?php
    session_start();
    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }
    include "../db/db.inc";

    $nombre_usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];

    if(isset($_POST["cliente_id"]) && !empty($_POST["cliente_id"])) {
        
        $cliente_id = intval($_POST["cliente_id"]);
        $producto_id = intval($_POST["producto_id"]);
        
        try {
                $sql = "INSERT INTO pedidos (cliente_id, producto_id)
                VALUES ('$cliente_id', '$producto_id');";

                mysqli_query($conn, $sql);

                header("location:gestion_pedidos.php?msg=0");
            }
            catch (mysqli_sql_exception $e) {
                //mysqli_error($conn); die();
                header("location:gestion_pedidos.php?msg=error");
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
    <title>Nuevo Pedido</title>
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

            <span> <?= $nombre_usuario ?></span>

            <?php if ($rol == 1) { ?>
                <small class="badge bg-danger"> Administrador </small>
            <?php } else { ?>
                <small class="badge bg-info"> Empleado </small>
            <?php } ?>
        </div>
        <div class="list-group pt-3">
            <a href="../clientes/gestion_clientes.php" class="list-group-item list-group-item-action">👥 Clientes</a>
            <a href="../productos/gestion_productos.php" class="list-group-item list-group-item-action">📦 Productos</a>
            <a href="../categorias/gestion_categorias.php" class="list-group-item list-group-item-action ">🏷️ Categorías</a>
            <a href="gestion_pedidos.php" class="list-group-item list-group-item-action active">🧾 Pedidos</a>
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
            <div class="card-header bg-success text-white">
                <h2 class="h4 mb-0">🧾 Añadir Pedido</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row g-3">
                        
                        <div class="col-md-6">
                            <label for="cliente_id" class="form-label">ID de Cliente</label>
                            <input type="number" class="form-control" id="cliente_id" name="cliente_id" required>
                        </div>

                        <div class="col-md-6">
                            <label for="producto_id" class="form-label">ID de Producto</label>
                            <input type="number" class="form-control" id="producto_id" name="producto_id" required>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100">Guardar Pedido</button>
                            <a href="gestion_pedidos.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>