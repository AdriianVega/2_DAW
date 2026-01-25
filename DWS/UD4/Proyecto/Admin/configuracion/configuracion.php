<?php
    session_start();

    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }

    include "../db/db.inc";

    $nombre_usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tablas.css">
</head>
<body class="bg-light">

    <?php include "../php/panel_control.php"; ?>

    <div class="container-fluid mt-4">
        <div class="card shadow mt-5">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Configuración</span>

                <span>Menú de Configuración en desarrollo.</span>

            </div>
        </div>
    </div>

    <?php include "../php/custom_delete.php"; ?>
</body>
</html>
