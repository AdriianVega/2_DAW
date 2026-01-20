<?php
    session_start();
    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }

    // Definimos el directorio donde guardaremos la imagen
    $directorio = "../img/usuarios/";
    $error = "";    
    
    include("../db/db.inc");

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

        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $rol = intval($_POST["rol"]);

        // Cifrado SHA1 para coincidir con char(40)
        $password = sha1($_POST["password"]); 

        if (empty($error))
        {
            $icono = $ruta_final;

            // 1. Comprobar si el email ya existe
            $check = mysqli_query($conn, "SELECT id FROM usuarios WHERE email = '$email'");
            if(mysqli_num_rows($check) > 0){
                header("location:gestion_usuarios.php?msg=error_mail"); // Podrías manejar este código en el listado
                die();
            }

            // 2. Insertar
            $sql = "INSERT INTO usuarios (nombre, email, password, rol, icono) 
                    VALUES ('$nombre', '$email', '$password', '$rol', '$icono')";
            
            if (mysqli_query($conn, $sql)) {
                header("location:gestion_usuarios.php?msg=0");
            } else {
                header("location:gestion_usuarios.php?msg=error");
            }
            die();
        }        
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tablas.css">
</head>
<body class="bg-light">
    <?php include "../php/panel_administrador.php"; ?>
    
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>➕ Alta de Usuario</h4>
            </div>
            <div class="card-body">
                <?php
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
                <form method="POST" autocomplete="off" enctype="multipart/form-data">
                    
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
                        <div class="form-text text-white">Se guardará cifrada en la base de datos.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rol</label>
                        <select name="rol" class="form-select">
                            <option value="0">Empleado</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="imagen">Seleccione una imagen:</label>
                        <input type="file" name="imagen" id="imagen" required>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success">Crear Usuario</button>
                        <a href="ins_usuario.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
