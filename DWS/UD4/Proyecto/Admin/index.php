<?php
    include("db/db.inc");
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

                            $email = htmlspecialchars(trim($_POST["email"]));
                            $password = htmlspecialchars(sha1($_POST["password"]));

                            $check = $conn->prepare(
                                "SELECT nombre, email, rol FROM usuarios
                                WHERE email = ? AND password = ?"
                            );

                            // Utilizamos bind_param para evitar inyecciones SQL
                            // Asocio las variables PHP a los placeholders (?)
                            $check->bind_param("ss", $email, $password);

                            // Ejecutamos la consulta
                            $check->execute();
                            $check->store_result();

                            // Si las credenciales son válidas -> hay una fila coincidente
                            if ($check->num_rows > 0) {

                                session_start();

                                // Vinculo las variables donde se guardarán los resultados
                                $check->bind_result($nombre, $emailDB, $rol);
                                $check->fetch();

                                $_SESSION["nombre"] = $nombre;
                                $_SESSION["rol"] = $rol;
                                $_SESSION["email"] = $emailDB;

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
                    <input type="password" id="password" name="password" placeholder="psswd1234" class="form-control" data-bs-theme="dark" required>

                    <input type="submit" value="Acceder" id="submit" name="submit" class="gradient-button btn btn-primary w-100 mt-4" required>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>