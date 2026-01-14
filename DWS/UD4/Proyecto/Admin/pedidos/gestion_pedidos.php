<?php
    session_start();
    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }

    // Incluimos la conexión a la BD
    include("../db/db_pdo.inc"); 
    // Obtener todos los clientes
    $clientes = $pdo->query("SELECT * FROM clientes ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    $nombre = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];

    if (isset($_GET["eliminar"])) {
        $id_cliente = intval($_GET["eliminar"]); // código en mi bd del cliente a eliminar
        $pdo->prepare("DELETE FROM clientes WHERE id = ?")->execute([$id_cliente]);
        header("location:gestion_pedidos.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

            <a href="gestion_pedidos.php"
                class="list-group-item list-group-item-action"
                <?= basename($_SERVER['PHP_SELF']) == 'gestion_pedidos.php' ? 'active' : '' ?>">
                👥 Clientes
            </a>

            <a href="../productos/gestion_productos.php" 
                class="list-group-item list-group-item-action">
                📦 Productos
            </a>

            <a href="../pedidos/gestion_pedidos.php" 
                class="list-group-item list-group-item-action">
                🧾 Pedidos
            </a>

        </div>

    </aside>

    <div class="container mt-4" style="margin-left: 280px;">

        <h2 class="text-center mb-4">📋 Gestión de Clientes</h2>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">📋 Lista de Clientes</div>
            <div class="card-body">

                <?php
                    if (isset($_GET["cli"])) {
                        if ($_GET["cli"] == 0) {
                            echo '<div class="alert alert-success">✅ Cliente insertado correctamente.</div>';
                        }
                        if ($_GET["cli"] == 1) {
                            echo '<div class="alert alert-warning">⚠️ El email ya existe en la base de datos.</div>';
                        }
                        if ($_GET["cli"] == 2) {
                            echo '<div class="alert alert-danger">❌ Ha ocurrido un error al intentar insertar el usuario.</div>';
                        }
                    }
                ?>

                <div class="row mb-3 me-2 float-end">
                    <a href="ins_cli_mysqli.php" class="btn btn-success">➕ Nuevo Cliente</a>
                </div>

                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Género</th>
                            <th>Dirección</th>
                            <th>Código Postal</th>
                            <th>Población</th>
                            <th>Provincia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['nombre']) ?></td>
                            <td><?= htmlspecialchars($c['apellidos']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= $c['genero'] ?></td>
                            <td><?= htmlspecialchars($c['direccion']) ?></td>
                            <td><?= $c['codpostal'] ?></td>
                            <td><?= htmlspecialchars($c['poblacion']) ?></td>
                            <td><?= htmlspecialchars($c['provincia']) ?></td>
                            <td>
                                <a href="edit_cli_mysqli.php?edit=<?= $c['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                                <button type="button" class="btn btn-danger" onclick="eliminarCliente(<?=
                                $c['id']; ?>)">🗑️ </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Modal de confirmación (añádelo al final del body) -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    ¿Seguro que deseas eliminar este Cliente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function eliminarCliente(numcliente) 
        {
            const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();
            document.getElementById('confirmDeleteBtn').onclick = () => 
            {
                window.location.href = 'gestion_pedidos.php?eliminar=' + numcliente;
                modal.hide();
            };
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
