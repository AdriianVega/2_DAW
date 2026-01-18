<?php
    session_start();
    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }
    include("../db/db.inc");

    // PROCESAR EDICIÓN
    if (isset($_POST["accion"]) && $_POST["accion"] == "editar") {
        $id = intval($_POST["id"]);
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $rol = intval($_POST["rol"]);

        // Validar email duplicado (excluyendo el propio ID)
        $check = mysqli_query($conn, "SELECT id FROM usuarios WHERE email = '$email' AND id != $id");
        if(mysqli_num_rows($check) > 0){
            // Aquí deberías redirigir con un error, por brevedad redirijo al listado
            header("location:gestion_usuarios.php?msg=error");
            die();
        }

        // Construcción dinámica de la query
        // Si el campo password NO está vacío, lo actualizamos. Si está vacío, lo ignoramos.
        $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', rol='$rol'";
        
        if(!empty($_POST['password'])) {
            $pass_hash = sha1($_POST['password']);
            $sql .= ", password='$pass_hash'";
        }

        $sql .= " WHERE id=$id";
        
        if (mysqli_query($conn, $sql)) {
            header("location:gestion_usuarios.php?msg=0");
        } else {
            header("location:gestion_usuarios.php?msg=error");
        }
        die();
    }

    // OBTENER DATOS
    if(!isset($_GET["id"])) { header("location:gestion_usuarios.php"); die(); }
    $id = intval($_GET["id"]);
    $res = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = $id");
    
    if(!($usu = mysqli_fetch_assoc($res))){
        header("location:gestion_usuarios.php"); die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow">
            <div class="card-header bg-warning">
                <h4 class="mb-0">✏️ Editar Perfil: <?= htmlspecialchars($usu['nombre']) ?></h4>
            </div>
            <div class="card-body">
                <form method="POST" autocomplete="off">
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id" value="<?= $usu['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control"
                            value="<?= htmlspecialchars($usu['nombre']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" 
                               value="<?= htmlspecialchars($usu['email']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="(Dejar en blanco para no cambiar)">
                        <div class="form-text">Solo rellena este campo si quieres generar una nueva contraseña.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rol</label>
                        <select name="rol" class="form-select">
                            <option value="0" <?= $usu['rol'] == 0 ? 'selected' : '' ?>>Empleado</option>
                            <option value="1" <?= $usu['rol'] == 1 ? 'selected' : '' ?>>Administrador</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                        <a href="gestion_usuarios.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
