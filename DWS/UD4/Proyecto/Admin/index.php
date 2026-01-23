<?php
    function crear_sesion($datos) {

        session_regenerate_id(true);

        $_SESSION["nombre"] = $datos["nombre"];
        $_SESSION["email"]  = $datos["email"];
        $_SESSION["rol"]    = $datos["rol"];
        $_SESSION["icono"]  = $datos["icono"];
    }

    include "db/db.inc";

    session_start();

    if (isset($_SESSION["email"])) {
        header("location: ./menu/menu_inicio.php"); 
        die();
    }
    if (isset($_COOKIE["token"])) {

        $verificador =  explode(":", $_COOKIE["token"]);

        if (count($verificador) == 2) {
            $selector = $verificador[0];
            $validador = $verificador[1];

            $check = $conn->prepare(
            "SELECT t.id, t.validador, t.usuario_id, u.*
            FROM tokens t
            JOIN usuarios u ON t.usuario_id = u.id
            WHERE t.selector = ? AND t.expiracion > NOW()
            ");

            $check->bind_param("s", $selector);
            $check->execute();
            $res = $check->get_result();
            $datos = $res->fetch_assoc();

            if ($datos && hash_equals($datos["validador"], hash("sha256", $validador))) {
                crear_sesion($datos);

                header("location: ./menu/menu_inicio.php");
                die();
            }
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
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        
                        if (isset($_POST["email"]) && !empty($_POST["email"]) &&
                        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

                            if (isset($_POST["password"]) && !empty($_POST["password"])) {

                                $email = trim($_POST["email"]);
                                $password = $_POST["password"];

                                $check = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
                                $check->bind_param("s", $email);
                                
                                $check->execute();
                                
                                $res = $check->get_result();

                                $datos = $res->fetch_assoc();

                                if ($datos && password_verify($password, $datos["password"])) {
                                    crear_sesion($datos);

                                    $selector = bin2hex(random_bytes(6));
                                    $validador = bin2hex(random_bytes(12));
                                    $validador_hash = hash('sha256', $validador);

                                    $mes = (60 * 60 * 24 * 30);
                                    $expiracion = date('Y-m-d H:i:s', time() + $mes);

                                    $check = $conn->prepare("INSERT INTO tokens
                                                (selector, validador, usuario_id, expiracion)
                                                VALUES (?, ?, ?, ?)"
                                    );
                                    $check->bind_param("ssis", $selector, $validador_hash, $datos["id"], $expiracion);
                                    $check->execute();

                                    setcookie("token", "$selector:$validador", time() + $mes, "/", "", false, true);

                                    header("location: ./menu/menu_inicio.php");
                                    die();
                                } else {
                                // Si no existe el email o contraseña incorrectos
                                echo '<div class="alert alert-warning">⚠️ El email y/o la contraseña son incorrectos.</div>'; 
                                }
                            } else {
                                 // Password vacío o no enviado 
                                echo '<div class="alert alert-warning">⚠️ Error en el campo Password </div>';
                            }  
                        } else {
                            // Email no válido 
                            echo '<div class="alert alert-warning">⚠️ Introduce un email válido.</div>';
                        }
                    } 
                ?>
                <form method="post">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control mb-3" placeholder="example@gmail.com" data-bs-theme="dark" required>

                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="form-control" data-bs-theme="dark" required>

                    <input type="submit" value="Acceder" id="submit" name="submit" class="gradient-button btn btn-primary w-100 mt-4">
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
