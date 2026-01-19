<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }
    include "../db/db.inc";

    $nombre_usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];

    if (isset($_POST["accion"]) && $_POST["accion"] == "editar") {
        
        if(isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = intval($_POST["id"]);
            $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
            $apellidos = mysqli_real_escape_string($conn, $_POST["apellidos"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $direccion = mysqli_real_escape_string($conn, $_POST["direccion"]);
            $genero = mysqli_real_escape_string($conn, $_POST["genero"]);
            $codpostal = mysqli_real_escape_string($conn, $_POST["codpostal"]);
            $poblacion = mysqli_real_escape_string($conn, $_POST["poblacion"]);
            $provincia = mysqli_real_escape_string($conn, $_POST["provincia"]);

            // Lógica para actualizar password solo si se escribe una nueva
            $sql_pass = "";
            if (!empty($_POST["password"])) {
                $pass = md5(mysqli_real_escape_string($conn, $_POST["password"]));
                $sql_pass = ", password = '$pass'";
            }

            try {
                $sql = "UPDATE clientes SET
                        nombre = '$nombre',
                        apellidos = '$apellidos',
                        email = '$email',
                        direccion = '$direccion',
                        genero = '$genero',
                        codpostal = '$codpostal',
                        poblacion = '$poblacion',
                        provincia = '$provincia'
                        $sql_pass
                    WHERE id = $id";

                mysqli_query($conn, $sql);

                header("location:gestion_clientes.php?msg=0");
            }
            catch (mysqli_sql_exception $e) {
                //mysqli_error($conn); die();
                header("location:gestion_clientes.php?msg=error");
            }

            die();
        }
    }

    if(!isset($_GET["id"])) {
        header("location:gestion_clientes.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tablas.css">
    <title>Editar Cliente</title>
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
            <a href="gestion_clientes.php" class="list-group-item list-group-item-action active">👥 Clientes</a>
            <a href="../productos/gestion_productos.php" class="list-group-item list-group-item-action">📦 Productos</a>
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

            <a href="../index.php" class="btn btn-danger w-100">Cerrar Sesión</a>
        </div>
    </aside>

    <main class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="h4 mb-0">✏️ Editar Cliente</h2>
            </div>
            <div class="card-body">

            <?php
                $id = intval($_GET["id"]);
                $sql = "SELECT * FROM clientes WHERE id = $id";
                $res = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($res) > 0) {
                    $cli = mysqli_fetch_assoc($res);
                } else {
                    header("location:gestion_clientes.php");
                    die();
                }
            ?>

                <form method="POST">
                    <input type="hidden" name="id" value="<?=$id;?>">
                    <input type="hidden" name="accion" value="editar">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?= htmlspecialchars($cli["nombre"]) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellidos" class="form-label">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                                value="<?= htmlspecialchars($cli["apellidos"]) ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= htmlspecialchars($cli["email"]) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Contraseña (Dejar en blanco para mantener):</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="******">
                        </div>

                        <div class="col-12">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                value="<?= htmlspecialchars($cli["direccion"]) ?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="poblacion" class="form-label">Población:</label>
                            <input type="text" class="form-control" id="poblacion" name="poblacion"
                                value="<?= htmlspecialchars($cli["poblacion"]) ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="provincia" class="form-label">Provincia:</label>
                            <input type="text" class="form-control" id="provincia" name="provincia"
                                value="<?= htmlspecialchars($cli["provincia"]) ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label for="codpostal" class="form-label">C.P.:</label>
                            <input type="text" class="form-control" id="codpostal" name="codpostal" maxlength="5"
                                value="<?= htmlspecialchars($cli["codpostal"]) ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label for="genero" class="form-label">Género:</label>
                            <select class="form-select" id="genero" name="genero">
                                <option value="M" <?= ($cli['genero']=='M')?'selected':'' ?> >Hombre</option>
                                <option value="F" <?= ($cli['genero']=='F')?'selected':'' ?> >Mujer</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
                            <a href="gestion_clientes.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>