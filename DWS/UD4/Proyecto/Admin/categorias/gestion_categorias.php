<?php
    session_start();

    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }
    include "../db/db.inc";

    if (isset($_GET["crear_test"])) {

        $nombre = "Categoria Test " . random_int(1, 1000);
        $estado = 1;

        $sql = "INSERT INTO categorias (nombre, estado)
                VALUES ('$nombre', '$estado')";
        
        if(mysqli_query($conn, $sql)){
            header("location:gestion_categorias.php?msg=test_ok");
        } else {
            header("location:gestion_categorias.php?msg=error");
        }
        exit;
    }

    $registros_por_pagina = 15;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    if ($pagina < 1) {
            $pagina = 1;
    }

    $offset = ($pagina - 1) * $registros_por_pagina;

    $sql_total = "SELECT COUNT(*) as total FROM categorias";
    $result_total = mysqli_query($conn, $sql_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_registros = $row_total['total'];
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    if (isset($_GET["eliminar"])) {
        $id = intval($_GET["eliminar"]);

        $sql = "DELETE FROM categorias WHERE id = $id";
        
        if(mysqli_query($conn, $sql)){
            header("location:gestion_categorias.php?msg=deleted");
        } else {
            header("location:gestion_categorias.php?msg=error");
        }
        exit;
    }

    $sql = "SELECT * FROM categorias 
            ORDER BY id ASC
            LIMIT $offset, $registros_por_pagina";

    $res = mysqli_query($conn, $sql);

    $nombre_usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
    $pagina_activa = "categorias";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tablas.css">
</head>
<body class="bg-light">

    <?php include "../php/panel_control.php"; ?>

    <div class="container-fluid mt-4">
        <div class="card shadow mt-5">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Gestión de Categorías</span>

                <div>
                    <a href="?crear_test=1" class="btn btn-light btn-sm text-primary fw-bold me-2">
                        🎲 Generar Test
                    </a>
                    <a href="ins_categoria.php" class="btn btn-success btn-sm">
                        ➕ Nueva Categoría
                    </a>
                </div>
            </div>
            <div class="card-body">
                
                <?php if(isset($_GET['msg'])): ?>
                    <?php if($_GET['msg'] == 'test_ok') { echo '<div class="alert alert-info">🤖 Categoría de prueba generada.</div>'; } ?>
                    <?php if($_GET['msg'] == '0') { echo '<div class="alert alert-success">✅ Categoría guardada correctamente.</div>'; } ?>
                    <?php if($_GET['msg'] == 'deleted') { echo '<div class="alert alert-success">🗑️ Categoría eliminada.</div>'; } ?>
                    <?php if($_GET['msg'] == 'error') { echo '<div class="alert alert-danger">❌ Error en la base de datos. ¿Quizás hay productos vinculados a esta categoría?</div>'; } ?>
                <?php endif; ?>

                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><strong><?= htmlspecialchars($row['nombre']) ?></strong></td>
                            <td>
                                <?php if($row['estado'] == 0): ?>
                                    <span class="badge bg-danger">Inactivo</span>
                                <?php else: ?>
                                    <span class="badge bg-info text-dark">Activo</span>
                                <?php endif; ?>
                            </td>
                            <td><small><?= date("d/m/Y H:i", strtotime($row['create_time'])) ?></small></td>
                            <td class="text-end">
                                <a href="edit_categoria.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
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
    
    <?php include "../php/custom_delete.php"; ?>
</body>
</html>