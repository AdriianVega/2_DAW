<?php
    session_start();

    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }
    include "../db/db.inc";

    if (isset($_GET["crear_test"])) {
        // Generamos un sufijo aleatorio de 6 caracteres hex
        $random_suffix = substr(md5(uniqid(mt_rand(), true)), 0, 6);
        
        $nombre = "Usuario Test " . $random_suffix;
        // Formato solicitado: randomizado + @gmail.com
        $email = "test_" . $random_suffix . "@gmail.com";
        $password = sha1("1234"); // Contraseña por defecto: 1234
        $rol = 0; // Rol empleado por defecto

        $sql = "INSERT INTO usuarios (nombre, email, password, rol)
                VALUES ('$nombre', '$email', '$password', '$rol')";
        
        if(mysqli_query($conn, $sql)){
            header("location:gestion_usuarios.php?msg=test_ok");
        } else {
            header("location:gestion_usuarios.php?msg=error");
        }
        exit;
    }

    // 1. CONFIGURACIÓN DE PAGINACIÓN
    $registros_por_pagina = 15;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if ($pagina < 1) {
            $pagina = 1;
    }

    $offset = ($pagina - 1) * $registros_por_pagina;

    // 2. OBTENER TOTAL DE REGISTROS (Para saber cuántas páginas hay)
    // Cambia 'productos' por la tabla que estés usando (clientes, pedidos, usuarios)
    $sql_total = "SELECT COUNT(*) as total FROM usuarios";
    $result_total = mysqli_query($conn, $sql_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_registros = $row_total['total'];
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    // 3. CONSULTA CON LÍMITE
    // OJO: Si tienes JOINs u ORDER BY, el LIMIT va siempre AL FINAL
    $sql = "SELECT * FROM usuarios ORDER BY id DESC LIMIT $offset, $registros_por_pagina";
    $res = mysqli_query($conn, $sql); // Aquí guardamos los resultados de ESTA página
    // BORRAR USUARIO
    if (isset($_GET["eliminar"])) {
        $id_usu = intval($_GET["eliminar"]);
        
        // Evitar que se borre al usuario 'admin' principal (id 1) por seguridad básica
        if($id_usu == 1) {
            header("location:gestion_usuarios.php?msg=error_admin");
            die();
        }

        $sql = "DELETE FROM usuarios WHERE id = $id_usu";
        if(mysqli_query($conn, $sql)){
            header("location:gestion_usuarios.php?msg=deleted");
        } else {
            header("location:gestion_usuarios.php?msg=error");
        }
        exit;
    }

    // LISTAR USUARIOS
    $sql = "SELECT * FROM usuarios ORDER BY id ASC LIMIT $offset, $registros_por_pagina";
    $res = mysqli_query($conn, $sql);
    
    $nombre_usuario = $_SESSION["nombre"];
    $rol_sesion = $_SESSION["rol"];
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

            <?php if ($rol_sesion == 1) { ?>
                <small class="badge bg-danger"> Administrador </small>
            <?php } else { ?>
                <small class="badge bg-info"> Empleado </small>
            <?php } ?>
        </div>
        <div class="list-group pt-3">
            <a href="../clientes/gestion_clientes.php" class="list-group-item list-group-item-action">👥 Clientes</a>
            <a href="../productos/gestion_productos.php" class="list-group-item list-group-item-action">📦 Productos</a>
            <a href="../categorias/gestion_categorias.php" class="list-group-item list-group-item-action">🏷️ Categorías</a>
            <a href="../pedidos/gestion_pedidos.php" class="list-group-item list-group-item-action">🧾 Pedidos</a>
            <a href="gestion_usuarios.php" class="list-group-item list-group-item-action active">🛡️ Usuarios</a>
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
                    <a href="ins_usuario.php" class="btn btn-success btn-sm">
                        ➕ Nuevo Usuario
                    </a>
                </div>
            </div>
            <div class="card-body">
                
                <?php if(isset($_GET['msg'])): ?>
                    <?php if($_GET['msg'] == 'test_ok') { echo '<div class="alert alert-info">🤖 Usuario de prueba generado (Pass: 1234).</div>'; } ?>
                    <?php if($_GET['msg'] == '0') { echo '<div class="alert alert-success">✅ Usuario guardado correctamente.</div>'; } ?>
                    <?php if($_GET['msg'] == 'deleted') { echo '<div class="alert alert-success">🗑️ Usuario eliminado.</div>'; } ?>
                    <?php if($_GET['msg'] == 'error') { echo '<div class="alert alert-danger">❌ Error en la base de datos.</div>'; } ?>
                    <?php if($_GET['msg'] == 'error_admin') { echo '<div class="alert alert-warning">⚠️ No puedes eliminar al Super Admin (ID 1).</div>'; } ?>
                <?php endif; ?>

                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Registro</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($res)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><strong><?= htmlspecialchars($row['nombre']) ?></strong></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td>
                                <?php if($row['rol'] == 1): ?>
                                    <span class="badge bg-danger">Administrador</span>
                                <?php else: ?>
                                    <span class="badge bg-info text-dark">Empleado</span>
                                <?php endif; ?>
                            </td>
                            <td><small><?= date("d/m/Y", strtotime($row['create_time'])) ?></small></td>
                            <td class="text-end">
                                <a href="edit_usuario.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                                <?php if($row['id'] != 1): // Ocultar borrar para ID 1 ?>
                                    <button onclick="eliminar(<?= $row['id'] ?>)" class="btn btn-sm btn-danger">🗑️</button>
                                <?php endif; ?>
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

    <script>
        function eliminar(id) {
            if(confirm('¿Estás seguro? Esta acción borrará el acceso al panel para este usuario.')) {
                window.location.href = 'gestion_usuarios.php?eliminar=' + id;
            }
        }
    </script>
</body>
</html>
