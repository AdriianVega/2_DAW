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

    $directorio = "../img/usuarios/";
    $error = "";

    $nombre_usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
    $icono = $_SESSION["icono"];
    $pagina_activa = "usuarios";

    if (isset($_POST["email"])) {
        // Obtenemos la ruta temporal y el nombre original del archivo subido
        $archivo_temporal = $_FILES["imagen"]["tmp_name"];
        $archivo_original = uniqid().$_FILES["imagen"]["name"];

        // Comprobamos si se ha subido un archivo correctamente
        if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] != 0)
        {
            $error = "No se ha subido una imagen o la imagen es demasiado grande";
        }
        // Verificamos si el archivo subido es una imagen
        elseif (getimagesize($archivo_temporal))
        {
            // Construimos la ruta final donde guardaremos la imagen
            $ruta_final = $directorio . $archivo_original;

            // Movemos la imagen desde la ruta temporal al directorio final
            if(move_uploaded_file($archivo_temporal, $ruta_final))
            {
                echo "<h1> $archivo_original </h1>";
                echo "<img src='$ruta_final' alt='$archivo_original'>";
            }
            //Si ha ocurrido un error mostramos por pantalla
            else
            {
                $error = "Se ha producido un error subiendo el icono";
            }
        }
        else
        {
            // Redirigimos al formulario con error si el archivo no es una imagen
            $error = "Sólo se permiten imagenes";
        }
    }
    if (empty($error))
    {
        if (isset($_POST["accion"]) && $_POST["accion"] == "editar") {
        
            if(isset($_POST["id"]) && !empty($_POST["id"])) {
                $id = intval($_POST["id"]);
                $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
                $email = mysqli_real_escape_string($conn, $_POST["email"]);
                $rol = intval($_POST["rol"]);
                $icono = $ruta_final;

                // Lógica para actualizar password solo si se escribe una nueva
                $sql_pass = "";
                if (!empty($_POST["password"])) {
                    $pass = md5(mysqli_real_escape_string($conn, $_POST["password"]));
                    $sql_pass = ", password = '$pass'";
                }

                try {
                    $sql = "UPDATE usuarios SET
                            nombre = '$nombre',
                            email = '$email',
                            rol = $rol,
                            icono = '$icono'
                            $sql_pass
                        WHERE id = $id";

                    mysqli_query($conn, $sql);

                    header("location:gestion_usuarios.php?msg=0");
                }
                catch (mysqli_sql_exception $e) {
                    //mysqli_error($conn); die();
                    header("location:gestion_usuarios.php?msg=error");
                }

                die();
            }
        }
    }

    if(!isset($_GET["id"])) {
        header("location:gestion_usuarios.php");
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
    <title>Editar Usuario</title>
</head>
<body class="bg-light">
    <?php include "../php/panel_control.php"; ?>

    <main class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="h4 mb-0">✏️ Editar Usuario</h2>
            </div>
            <div class="card-body">

            <?php
                $id = intval($_GET["id"]);
                $sql = "SELECT * FROM usuarios WHERE id = $id";
                $res = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($res) > 0) {
                    $user = mysqli_fetch_assoc($res);
                } else {
                    header("location:gestion_usuarios.php");
                    die();
                }

                // Comprobamos si se ha recibido un error y mostramos un mensaje de alerta correspondiente al error indicado
                if (!empty($error))
                {
                    echo "<div class='alert alert-danger' role='alert'>❌ Error: ". $error. "</div>";
                }
                else
                {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $icono = $ruta_final;

                        header("location:gestion_usuarios.php?msg=0");
                    }

                }
            ?>

                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$id;?>">
                    <input type="hidden" name="accion" value="editar">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre de Usuario:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?= htmlspecialchars($user["nombre"]) ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="rol" class="form-label">Rol:</label>
                            <select name="rol" id="rol" class="form-select" required>
                                <option value="1" <?= ($user['rol'] == 1) ? 'selected' : '' ?>>Administrador</option>
                                <option value="0" <?= ($user['rol'] == 0) ? 'selected' : '' ?>>Empleado</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= htmlspecialchars($user["email"]) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="imagen">Seleccione una imagen:</label>
                            <input type="file" name="imagen" id="imagen" required>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
                            <a href="gestion_usuarios.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </div>

                        
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>