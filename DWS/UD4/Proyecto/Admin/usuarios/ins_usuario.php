<?php
    session_start();
    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }
    include("../db/db.inc");

    if (isset($_POST["email"])) {
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $rol = intval($_POST["rol"]);
        // Cifrado SHA1 para coincidir con char(40)
        $password = sha1($_POST["password"]); 

        // 1. Comprobar si el email ya existe
        $check = mysqli_query($conn, "SELECT id FROM usuarios WHERE email = '$email'");
        if(mysqli_num_rows($check) > 0){
            header("location:gestion_usuarios.php?msg=error_mail"); // Podrías manejar este código en el listado
            die();
        }

        // 2. Insertar
        $sql = "INSERT INTO usuarios (nombre, email, password, rol) 
                VALUES ('$nombre', '$email', '$password', '$rol')";
        
        if (mysqli_query($conn, $sql)) {
            header("location:gestion_usuarios.php?msg=0");
        } else {
            header("location:gestion_usuarios.php?msg=error");
        }
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <a href="gestion_categorias.php" class="list-group-item list-group-item-action active">🏷️ Categorías</a>
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
    
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>➕ Alta de Usuario</h4>
            </div>
            <div class="card-body">
                <form method="POST" autocomplete="off">
                    
                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email (Usuario de acceso)</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                        <div class="form-text">Se guardará cifrada en la base de datos.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rol / Permisos</label>
                        <select name="rol" class="form-select">
                            <option value="0">Empleado / Editor</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success">Crear Usuario</button>
                        <a href="gestion_usuarios.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
