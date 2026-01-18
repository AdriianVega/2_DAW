<?php
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
        header("location: ../../index.php");
    }
    $nombre = htmlspecialchars($_SESSION["nombre"]);
    $rol = $_SESSION["rol"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo_menu.css">
    <title>Menú</title>
</head>
<body>
    <header>
        <img src="../img/usuarios/admin.jpg" alt="Foto de perfil">
        <h1>Bienvenido <?= $nombre; ?> </h1>
        <h2>
            <?php
                if ($rol === 1)
                {
                    echo "Administrador";
                }
                else
                {
                    echo "Usuario";
                }
            ?>
        </h2>

    </header>
    <main>
        
    </main>
    <footer></footer>

    <script src="../js/secciones_menu.js"></script>
</body>
</html>