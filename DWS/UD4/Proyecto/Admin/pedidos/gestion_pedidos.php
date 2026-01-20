<?php
    session_start();

    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }
    include "../db/db.inc";

    if (isset($_GET["crear_test"])) {

        // Asignamos IDs aleatorios asumiendo que existen esos registros 
        // en las tablas clientes y productos para testear
        $cliente_id = 1;
        $producto_id = 1;

        $sql = "INSERT INTO pedidos (cliente_id, producto_id)
                VALUES ('$cliente_id', '$producto_id')";
        
        if(mysqli_query($conn, $sql)){
            header("location:gestion_pedidos.php?msg=test_ok");
        } else {
            header("location:gestion_pedidos.php?msg=error");
        }
        exit;
    }

    $registros_por_pagina = 15;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    if ($pagina < 1) {
            $pagina = 1;
    }

    $offset = ($pagina - 1) * $registros_por_pagina;

    $sql_total = "SELECT COUNT(*) as total FROM pedidos";
    $result_total = mysqli_query($conn, $sql_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_registros = $row_total['total'];
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    if (isset($_GET["eliminar"])) {
        $id = intval($_GET["eliminar"]);

        $sql = "DELETE FROM pedidos WHERE id = $id";
        
        if(mysqli_query($conn, $sql)){
            header("location:gestion_pedidos.php?msg=deleted");
        } else {
            header("location:gestion_pedidos.php?msg=error");
        }
        exit;
    }

    // Consulta con JOINS para obtener nombres en lugar de IDs
    $sql = "SELECT p.*, c.nombre AS nombre_cliente, pr.nombre AS nombre_producto
            FROM pedidos p
            LEFT JOIN clientes c ON p.cliente_id = c.id
            LEFT JOIN productos pr ON p.producto_id = pr.id
            ORDER BY p.id DESC
            LIMIT $offset, $registros_por_pagina";

    $res = mysqli_query($conn, $sql);

    $nombre_usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
    $pagina_activa = "pedidos";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tablas.css">
</head>
<body class="bg-light">

    <?php include "../php/panel_administrador.php"; ?>

    <div class="container-fluid mt-4">
        <div class="card shadow mt-5">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Gestión de Pedidos</span>

                <div>
                    <a href="?crear_test=1" class="btn btn-light btn-sm text-primary fw-bold me-2">
                        🎲 Generar Test
                    </a>
                    <a href="ins_pedido.php" class="btn btn-success btn-sm">
                        ➕ Nuevo Pedido
                    </a>
                </div>
            </div>
            <div class="card-body">
                
                <?php if(isset($_GET['msg'])): ?>
                    <?php if($_GET['msg'] == 'test_ok') { echo '<div class="alert alert-info">🤖 Pedido de prueba generado.</div>'; } ?>
                    <?php if($_GET['msg'] == '0') { echo '<div class="alert alert-success">✅ Pedido guardado correctamente.</div>'; } ?>
                    <?php if($_GET['msg'] == 'deleted') { echo '<div class="alert alert-success">🗑️ Pedido eliminado.</div>'; } ?>
                    <?php if($_GET['msg'] == 'error') { echo '<div class="alert alert-danger">❌ Error en la base de datos. Verifique que los clientes/productos existan.</div>'; } ?>
                <?php endif; ?>

                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Fecha Registro</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><strong><?= htmlspecialchars($row['nombre_cliente'] ?? "Desconocido/Borrado") ?></strong></td>
                            <td><?= htmlspecialchars($row["nombre_producto"] ?? "Desconocido/Borrado") ?></td>
                            <td><small><?= date("d/m/Y H:i", strtotime($row['create_time'])) ?></small></td>
                            <td class="text-end">
                                <a href="edit_pedido.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
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
                    ¿Seguro que deseas eliminar este Pedido?
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
            window.location.href = 'gestion_pedidos.php?eliminar=' + id;
            modal.hide();
            };
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>