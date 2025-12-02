<?php
    session_start();
    if (isset($_SESSION["nombre"]))
    {
        header("location:index.php");
        die();
    }
    include("../db/db_pdo.inc"); // Incluimos la conexión a la BD
    // Obtener todos los clientes
    $clientes = $pdo->query("SELECT * FROM clientes ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-4">
        <h2 class="text-center mb-4">📋 Gestión de Clientes</h2>

        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                📋 Lista de Clientes
            </div>

            <div class="card-body">
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
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
