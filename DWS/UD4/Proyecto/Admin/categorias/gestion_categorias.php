<?php
    session_start();
    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }
    include("../db/db.inc");

    // BORRAR PEDIDO
    if (isset($_GET["eliminar"])) {
        $id_pedido = intval($_GET["eliminar"]);
        $sql = "DELETE FROM pedidos WHERE id = $id_pedido";
        if(mysqli_query($conn, $sql)){
            header("location:gestion_pedidos.php?msg=deleted");
        } else {
            header("location:gestion_pedidos.php?msg=error");
        }
        exit;
    }

    // CONSULTA COMPLETA (JOIN)
    // Unimos las tablas para mostrar nombres en vez de IDs
    $sql = "SELECT p.id, p.fecha, 
                   c.nombre AS nombre_cliente, c.apellidos AS ap_cliente,
                   u.nombre AS nombre_usuario,
                   prod.nombre AS nombre_producto, prod.precio
            FROM pedidos p
            LEFT JOIN clientes c ON p.cliente_id = c.id
            LEFT JOIN usuarios u ON p.usuario_id = u.id
            LEFT JOIN productos prod ON p.producto_id = prod.id
            ORDER BY p.id DESC";
            
    $res = mysqli_query($conn, $sql);
    
    $nombre_usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <aside class="bg-primary text-white d-flex flex-column p-3" style="width: 260px; min-height: 100vh; position: fixed; left:0; top:0;">
        <h4 class="mb-4 text-center">Admin Panel</h4>
        <div class="list-group">
            <a href="../clientes/gestion_clientes.php" class="list-group-item list-group-item-action">👥 Clientes</a>
            <a href="../productos/gestion_productos.php" class="list-group-item list-group-item-action">📦 Productos</a>
            <a href="../categorias/gestion_categorias.php" class="list-group-item list-group-item-action">🏷️ Categorías</a>
            <a href="gestion_pedidos.php" class="list-group-item list-group-item-action active">🧾 Pedidos</a>
        </div>
        <div class="mt-auto">
            <a href="../logout.php" class="btn btn-danger w-100">Cerrar Sesión</a>
        </div>
    </aside>

    <div class="container mt-4" style="margin-left: 280px;">
        <h2 class="text-center mb-4">🧾 Gestión de Pedidos</h2>

        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Historial de Ventas</span>
                <a href="ins_pedido.php" class="btn btn-success btn-sm">➕ Nuevo Pedido</a>
            </div>
            <div class="card-body">
                
                <?php if(isset($_GET['msg'])): ?>
                    <?php if($_GET['msg'] == '0') echo '<div class="alert alert-success">✅ Pedido guardado.</div>'; ?>
                    <?php if($_GET['msg'] == 'deleted') echo '<div class="alert alert-success">🗑️ Pedido eliminado.</div>'; ?>
                    <?php if($_GET['msg'] == 'error') echo '<div class="alert alert-danger">❌ Error en la operación.</div>'; ?>
                <?php endif; ?>

                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Vendedor (Usuario)</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td>#<?= $row['id'] ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($row['fecha'])) ?></td>
                            <td><?= htmlspecialchars($row['nombre_cliente'] . " " . $row['ap_cliente']) ?></td>
                            <td><span class="badge bg-info text-dark"><?= htmlspecialchars($row['nombre_usuario']) ?></span></td>
                            <td><?= htmlspecialchars($row['nombre_producto']) ?></td>
                            <td><?= number_format($row['precio'], 2) ?> €</td>
                            <td class="text-end">
                                <a href="edit_pedido.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                                <button onclick="eliminar(<?= $row['id'] ?>)" class="btn btn-sm btn-danger">🗑️</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function eliminar(id) {
            if(confirm('¿Seguro que deseas eliminar este pedido?')) {
                window.location.href = 'gestion_pedidos.php?eliminar=' + id;
            }
        }
    </script>
</body>
</html>