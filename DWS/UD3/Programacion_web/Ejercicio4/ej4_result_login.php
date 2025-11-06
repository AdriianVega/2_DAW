<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Login</title>
</head>
<body>
    <?php
        function validarCampo($nombre_campo, $error)
        {
            if (isset($_POST[$nombre_campo]) && !empty($_POST[$nombre_campo]))
            {
                if ($nombre_campo == "email")
                {
                    return filter_var($_POST[$nombre_campo], FILTER_SANITIZE_EMAIL);
                }
                return htmlspecialchars($_POST[$nombre_campo]);
            }
            else
            {
                // header("location:ej4_form_login.php?error=$error");
                // die();
            }
        }
        $datos = array("email" => $_POST["email"] ?? '', "password" => $_POST["password"] ?? '');
        $datosSanatizados = array();
        $i = 1;

        foreach ($datos as $clave => $valor)
        {
            $datosSanatizados[$clave] = validarCampo($clave, $i);
            $i++;
        }
    ?>
    <h1>Email: <?= $datosSanatizados["email"] ?></h1>
    <h2>Contraseña: <?= $datosSanatizados["password"] ?></h2>
</body>
</html>