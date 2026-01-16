<?php
    session_start();
    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }

    // Incluimos la conexión a la BD
    include("../db/db_pdo.inc"); 
    
    // Obtener todos los PRODUCTOS
    // Asumo que la tabla se llama 'productos' basándome en los campos
    $productos = $pdo->query("SELECT * FROM productos ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    
    $nombre = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];

    // Lógica de eliminación
    if (isset($_GET["eliminar"])) {
        $id_prod = intval($_GET["eliminar"]);
        // Opcional: Aquí podrías añadir código para borrar el archivo físico de la imagen si fuera necesario
        $pdo->prepare("DELETE FROM productos WHERE id = ?")->execute([$id_prod]);
        header("location:gestion_productos.php"); // Asegúrate de que este archivo se llame así
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-light">
    <aside class="bg-primary text-white d-flex flex-column p-3"
            style="width: 260px; min-height: 100vh; position: fixed; left:0; top:0;">

        <div class="text-center mb-4">
            <img src="../img/admin.jpg"
                    class="rounded-circle mb-2" width="80" height="80" alt="avatar">

            <h5 class="mb-0"><?= htmlspecialchars($nombre) ?></h5>
            <small class="text-light"><?= htmlspecialchars($rol) == 1 ? "Administrador" : "Usuario" ?></small>

            <div class="mt-2">
                <a href="../logout.php" class="btn btn-danger">Cerrar sesión</a>
            </div>
        </div>

        <hr>

        <div class="list-group">
            <a href="../clientes/gestion_clientes.php" class="list-group-item list-group-item-action">
                👥 Clientes
            </a>

            <a href="gestion_productos.php" 
                class="list-group-item list-group-item-action active">
                📦 Productos
            </a>

            <a href="../pedidos/gestion_pedidos.php" class="list-group-item list-group-item-action">
                🧾 Pedidos
            </a>
        </div>
    </aside>

    <div class="container mt-4" style="margin-left: 280px;">

        <h2 class="text-center mb-4">📦 Gestión de Productos</h2>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">📋 Inventario</div>
            <div class="card-body">

                <?php
                    if (isset($_GET["prod"])) {
                        if ($_GET["prod"] == 0) echo '<div class="alert alert-success">✅ Producto añadido correctamente.</div>';
                        if ($_GET["prod"] == 1) echo '<div class="alert alert-warning">⚠️ Error en la operación.</div>';
                        if ($_GET["prod"] == 2) echo '<div class="alert alert-danger">❌ Error crítico al guardar.</div>';
                    }
                ?>

                <div class="row mb-3 me-2 float-end">
                    <a href="ins_producto.php" class="btn btn-success">➕ Nuevo Producto</a>
                </div>

                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoría</th> <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td>
                                <?php 
                                    $ruta_img = !empty($p['imagen']) ? "../img/" . htmlspecialchars($p['imagen']) : "../img/no-photo.png";
                                ?>
                                <img src="<?= $ruta_img ?>" alt="Prod" class="img-thumb">
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($p['nombre']) ?></strong><br>
                                <small class="text-muted"><?= substr(htmlspecialchars($p['descripcion']), 0, 50) ?>...</small>
                            </td>
                            <td><?= number_format($p['precio'], 2) ?> €</td>
                            <td>
                                <span class="badge <?= $p['stock'] < 5 ? 'bg-danger' : 'bg-success' ?>">
                                    <?= $p['stock'] ?> u.
                                </span>
                            </td>
                            <td class="text-center"><?= $p['categoria_id'] ?></td>
                            <td>
                                <?php if($p['estado'] == 1): ?>
                                    <span class="badge bg-primary">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit_producto.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(<?= $p['id']; ?>)">🗑️</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que deseas eliminar este <strong>Producto</strong>?</p>
                    <small class="text-muted">Esta acción no se puede deshacer.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function eliminarProducto(id) {
            const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();
            document.getElementById('confirmDeleteBtn').onclick = () => {
                // Asegúrate de que este archivo PHP sea el mismo en el que estás (self)
                window.location.href = '?eliminar=' + id;
                modal.hide();
            };
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>