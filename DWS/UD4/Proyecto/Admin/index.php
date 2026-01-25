<?php
    // Función para crear la sesión con los datos del usuario
    function crearSesion($datos) {

        $directorio = "../img/usuarios/";

        // Regeneramos el ID para mayor seguridad
        session_regenerate_id(true);

        // Metemos los datos del usuario en la sesión
        $_SESSION["nombre"] = $datos["nombre"];
        $_SESSION["email"]  = $datos["email"];
        $_SESSION["rol"]    = $datos["rol"];
        $_SESSION["icono"]  = $directorio. $datos["icono"];
    }
    
    // Iniciamos la sesión
    session_start();
    
    // Conectamos a la base de datos
    include "db/db.inc";

    // Definimos la ruta del menú de inicio, esto es por escalabilidad y para evitar repetir código
    define('MENU_INICIO_LOCATION', "location: ./menu/menu_inicio.php");

    // Cargamos las librerías para el envío de correos
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require './php/PHPMailer/src/Exception.php';
    require './php/PHPMailer/src/PHPMailer.php';
    require './php/PHPMailer/src/SMTP.php';

    // Si ya hay una sesión activa, mandamos directamente al menú
    if (isset($_SESSION["email"])) {
        header(MENU_INICIO_LOCATION);
        die();
    }

    // Lógica para recordar sesión mediante cookies y tokens
    if (isset($_COOKIE["token"])) {

        // Sacamos el selector y el validador de la cookie
        $verificador =  explode(":", $_COOKIE["token"]);

        if (count($verificador) == 2) {
            $selector = $verificador[0];
            $validador = $verificador[1];

            // Buscamos el selector en la base de datos y miramos que no haya caducado
            $check = $conn->prepare(
            "SELECT t.id, t.validador, t.usuario_id, u.*
            FROM tokens t
            JOIN usuarios u ON t.usuario_id = u.id
            WHERE t.selector = ? AND t.expiracion > NOW()
            ");

            // Mandamos el selector a la consulta con bind_param para evitar inyecciones SQL
            $check->bind_param("s", $selector);

            // Ejecutamos la consulta
            $check->execute();

            // Sacamos los datos del token y el usuario
            $res = $check->get_result();
            $datos = $res->fetch_assoc();

            // Comprobamos que el validador sea correcto
            // Esto quiere decir:
            // "Si los datos existen y el validador de la base de datos coincide con el hash del validador de la cookie"
            if ($datos && hash_equals($datos["validador"], hash("sha256", $validador))) {
                // Creamos la sesión
                crearSesion($datos);

                // Mandamos al menú de inicio
                header(MENU_INICIO_LOCATION);
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
                    // Procesamos el login cuando se manda el formulario
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        
                        // Comprobamos que el email sea válido
                        if (isset($_POST["email"]) && !empty($_POST["email"]) &&
                            filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

                            // Comprobamos que la contraseña no esté vacía
                            if (isset($_POST["password"]) && !empty($_POST["password"])) {

                                // Recogemos y limpiamos los datos del formulario
                                $email = trim($_POST["email"]);
                                $password = $_POST["password"];

                                // Buscamos al usuario por su email
                                $check = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");

                                // Mandamos el email a la consulta con bind_param para evitar inyecciones SQL
                                $check->bind_param("s", $email);
                                $check->execute();

                                /* Sacamos los datos del usuario usando get_result y fetch_assoc
                                get_result sirve para obtener el conjunto de resultados de una consulta
                                y fetch_assoc para obtener una fila como un array asociativo */
                                $res = $check->get_result();
                                $datos = $res->fetch_assoc();

                                // Verificamos la contraseña con el hash de la base de datos
                                if ($datos && password_verify($password, $datos["password"])) {
                                    crearSesion($datos);

                                    // Generamos tokens para recordar la sesión
                                    // Usamos bin2hex y random_bytes para generar tokens seguros
                                    // bin2hex convierte datos binarios en una representación hexadecimal
                                    // random_bytes genera bytes aleatorios seguros criptográficamente
                                    $selector = bin2hex(random_bytes(6));
                                    $validador = bin2hex(random_bytes(12));
                                    $validador_hash = hash('sha256', $validador);

                                    // Le damos un mes de vida a la cookie
                                    $mes = (60 * 60 * 24 * 30);

                                    // Calculamos la fecha de expiración y le damos formato
                                    $expiracion = date('Y-m-d H:i:s', time() + $mes);

                                    // Metemos el token en la base de datos
                                    $check = $conn->prepare("INSERT INTO tokens
                                                (selector, validador, usuario_id, expiracion)
                                                VALUES (?, ?, ?, ?)"
                                    );
                                    $check->bind_param("ssis", $selector, $validador_hash, $datos["id"], $expiracion);
                                    $check->execute();

                                    // Lógica para mandar un aviso de seguridad por correo
                                    $mail = new PHPMailer(true);
                                    $email_propietario = ''; // Aquí iría el correo del propietario

                                    try {
                                            $mail->isSMTP(); // Usando servidor SMTP
                                            $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
                                            $mail->SMTPAuth = true; // Habilitamos la autenticación SMTP
                                            $mail->Username = $email_propietario; // Usuario
                                            $mail->Password = ''; // Pass de aplicación de Google
                                            $mail->SMTPSecure = 'tls'; // Cifrado TLS
                                            $mail->Port = 587; // Puerto SMTP
                                            $mail->setFrom($email_propietario, 'Aviso Sistema'); // Remitente
                                            $mail->addAddress($email); // Destinatario
                                            $mail->isHTML(true); // Formato HTML
                                            $mail->Subject = 'Aviso de seguridad'; // Asunto
                                            $mail->Body = "
                                                        <h2>Aviso de Seguridad</h2>
                                                        <p>Se ha detectado un inicio de sesión en el sistema.</p>
                                                        <ul>
                                                            <li><b>Usuario:</b> " . $_SESSION['nombre'] . "</li>
                                                            <li><b>Email:</b> " . $email . "</li>
                                                            <li><b>Fecha:</b> " . date("d/m/Y H:i:s") . "</li>
                                                            <li><b>IP:</b> " . $_SERVER['REMOTE_ADDR'] . "</li>
                                                        </ul>"; // Cuerpo del mensaje
                                            $mail->send(); // Función para enviar el correo
                                            
                                    } catch (Exception $e) {
                                        // Error silencioso para no dar pistas en el login
                                    }

                                    // Colocamos la cookie en el navegador
                                    setcookie("token", "$selector:$validador", time() + $mes, "/", "", false, true);

                                    header(MENU_INICIO_LOCATION);
                                    die();
                                } else {
                                    // Error si los datos no coinciden
                                    echo '<div class="alert alert-warning">⚠️ El email y/o la contraseña son incorrectos.</div>';
                                }
                            } else {
                                echo '<div class="alert alert-warning">⚠️ Error en el campo Password </div>';
                            }
                        } else {
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
