<?php
    function conectar_DB($conn, $email_post, $password_post, $psswd_encriptada = false) {
        
        $email = htmlspecialchars(trim($email_post));

        if ($psswd_encriptada) {
            $password = $password_post;
        }
        else {
            $password = htmlspecialchars(sha1($password_post));
        }

        $check = $conn->prepare(
            "SELECT nombre, email, rol, icono FROM usuarios
            WHERE email = ? AND password = ?"
        );

        // Utilizamos bind_param para evitar inyecciones SQL
        // Asocio las variables PHP a los placeholders (?)
        $check->bind_param("ss", $email, $password);

        // Ejecutamos la consulta
        $check->execute();
        $check->store_result();

        return $check;
    }
    function crear_sesion($check) {

        /*Línea necesaria para que el compilador PHP no salte diciendo
        que las variables no están definidas aunque se definan en bind_result*/
        $nombre = $emailDB = $rol = $icono = null;

        // Vinculo las variables donde se guardarán los resultados
        $check->bind_result($nombre, $emailDB, $rol, $icono);

        $check->fetch();

        $_SESSION["nombre"] = $nombre;
        $_SESSION["email"]  = $emailDB;
        $_SESSION["rol"]    = $rol;
        $_SESSION["icono"]  = $icono;
    }

    include "db/db.inc";

    session_start();

    if (isset($_SESSION["email"])) {
        header("location: ./menu/menu_inicio.php"); 
        die();
    }
    else if (isset($_COOKIE["email"]) && isset($_COOKIE["password"])) {

        $check = conectar_DB($conn, $_COOKIE["email"], $_COOKIE["password"], true);

        if ($check->num_rows > 0) {
            
            crear_sesion($check);

            header("location: ./menu/menu_inicio.php");
            die();
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Formulario</title>
</head>
<body>
    <main class="container">

        <div class="col-4 mx-auto vh-100 d-flex align-items-center border-3">
            <div class="gradient-border-card bg-white w-100 p-5 rounded-2">
                <div class="text-center mb-4">
                    <img src="./img/menu/logo.png" alt="Logo" class="img-fluid" style="max-width: 200px;">
                </div>

                <?php
                    if (isset($_POST["email"]) && !empty($_POST["email"]) &&
                        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

                        if (isset($_POST["password"]) && !empty($_POST["password"])) {
                            
                            $check = conectar_DB($conn, $_POST["email"], $_POST["password"]);

                            // Si las credenciales son válidas -> hay una fila coincidente
                            if ($check->num_rows > 0) {

                                crear_sesion($check);

                                $expiracion = time() + (60 * 60 * 24 * 30);
                                
                                setcookie("email", $email, $expiracion, "/");
                                setcookie("password", htmlspecialchars(sha1($_POST["password"])), $expiracion, "/");

                                header("location: ./menu/menu_inicio.php");
                                die();

                            } else {
                                // Si no existe el email o contraseña incorrectos
                                echo '<div class="alert alert-warning">⚠️ El email y la contraseña NO existen.</div>';
                            }

                        } else {
                            // Password vacío o no enviado
                            echo '<div class="alert alert-warning">⚠️ Error en el campo Password.</div>';
                        }

                    } else {
                        // Email no válido
                        if (isset($_POST["email"])) {
                            echo '<div class="alert alert-warning">⚠️ El email no es válido.</div>';
                        }
                    }
                ?>
                <form method="post">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control mb-3" placeholder="example@gmail.com" data-bs-theme="dark" required>

                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="contraseña" class="form-control" data-bs-theme="dark" required>

                    <input type="submit" value="Acceder" id="submit" name="submit" class="gradient-button btn btn-primary w-100 mt-4">
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
