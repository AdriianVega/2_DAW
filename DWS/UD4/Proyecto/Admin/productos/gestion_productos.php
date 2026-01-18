<?php
    session_start();

    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }
    include "../db/db.inc";

    if (isset($_GET["crear_test"])) {

        $nombre = "Producto Test ";
        $descripcion = "Producto usado para testear la base de datos";
        $precio = random_int(0, 100000);
        $stock = random_int(0, 500);
        $categoria_id = 1;
        $imagen = "../img/fondo.jpg";
        $estado = 1;

        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id, imagen, estado)
                VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$categoria_id', '$imagen', '$estado')";
        
        if(mysqli_query($conn, $sql)){
            header("location:gestion_productos.php?msg=test_ok");
        } else {
            header("location:gestion_productos.php?msg=error");
        }
        exit;
    }

    $registros_por_pagina = 15;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    if ($pagina < 1) {
            $pagina = 1;
    }

    $offset = ($pagina - 1) * $registros_por_pagina;

    $sql_total = "SELECT COUNT(*) as total FROM productos";
    $result_total = mysqli_query($conn, $sql_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_registros = $row_total['total'];
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    $sql = "SELECT * FROM productos ORDER BY id DESC LIMIT $offset, $registros_por_pagina";
    $res = mysqli_query($conn, $sql);

    if (isset($_GET["eliminar"])) {
        $id = intval($_GET["eliminar"]);

        $sql = "DELETE FROM productos WHERE id = $id";
        
        if(mysqli_query($conn, $sql)){
            header("location:gestion_productos.php?msg=deleted");
        } else {
            header("location:gestion_productos.php?msg=error");
        }
        exit;
    }

    $sql = "SELECT p.*, c.nombre AS nombre_categoria
            FROM productos p
            LEFT JOIN categorias c ON p.categoria_id = c.id
            ORDER BY p.id ASC
            LIMIT $offset, $registros_por_pagina";

    $res = mysqli_query($conn, $sql);

    $nombre_usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tablas.css">
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

            <a href="../logout.php" class="btn btn-danger w-100">Cerrar Sesión</a>
        </div>
    </aside>

    <div class="container-fluid mt-4">
        <div class="card shadow mt-5">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Equipo de Administración</span>

                <div>
                    <a href="?crear_test=1" class="btn btn-light btn-sm text-primary fw-bold me-2">
                        🎲 Generar Test
                    </a>
                    <a href="ins_producto.php" class="btn btn-success btn-sm">
                        ➕ Nuevo Producto
                    </a>
                </div>
            </div>
            <div class="card-body">
                
                <?php if(isset($_GET['msg'])): ?>
                    <?php if($_GET['msg'] == 'test_ok') { echo '<div class="alert alert-info">🤖 Producto de prueba generado.</div>'; } ?>
                    <?php if($_GET['msg'] == '0') { echo '<div class="alert alert-success">✅ Producto guardado correctamente.</div>'; } ?>
                    <?php if($_GET['msg'] == 'deleted') { echo '<div class="alert alert-success">🗑️ Producto eliminado.</div>'; } ?>
                    <?php if($_GET['msg'] == 'error') { echo '<div class="alert alert-danger">❌ Error en la base de datos. ¿Quizás se escribió una clave foránea que no existe?</div>'; } ?>
                <?php endif; ?>

                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><img src="<?= $row['imagen'] ?>" alt="Preview del producto" style="width: 200px; text-align:center;"></td>
                            <td><strong><?= htmlspecialchars($row['nombre']) ?></strong></td>
                            <td><?= htmlspecialchars($row["nombre_categoria"] ?? "NaN") ?></td>
                            <td><?= htmlspecialchars($row['descripcion']) ?></td>
                            <td><?= htmlspecialchars($row['precio']) ?> €</td>
                            <td><?= htmlspecialchars($row['stock']) ?> u</td>
                            <td>
                                <?php if($row['estado'] == 0): ?>
                                    <span class="badge bg-danger">Inactivo</span>
                                <?php else: ?>
                                    <span class="badge bg-info text-dark">Activo</span>
                                <?php endif; ?>
                            </td>
                            <td><small><?= date("d/m/Y", strtotime($row['create_time'])) ?></small></td>
                            <td class="text-end">
                                <a href="edit_producto.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                                <button onclick="eliminar(<?= $row['id'] ?>)" class="btn btn-sm btn-danger">🗑️</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <nav aria-label="Navegación de página" class="mt-4">
                    <ul class="pagination justify-content-center">
                        
                        <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $pagina - 1 ?>" aria-label="Anterior">
                                <span aria-hidden="true">&laquo; Anterior</span>
                            </a>
                        </li>

                        <li class="page-item disabled">
                            <span class="page-link">
                                Página <?= $pagina ?> de <?= $total_paginas ?>
                            </span>
                        </li>

                        <li class="page-item <?= ($pagina >= $total_paginas) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $pagina + 1 ?>" aria-label="Siguiente">
                                <span aria-hidden="true">Siguiente &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    ¿Seguro que deseas eliminar este Producto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function eliminar(id)
        {
            const modal = new
            bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();
            document.getElementById('confirmDeleteBtn').onclick = () => {
            window.location.href = 'gestion_productos.php?eliminar=' + id;
            modal.hide();
            };
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
