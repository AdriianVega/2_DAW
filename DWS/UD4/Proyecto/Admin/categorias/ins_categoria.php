<?php
    session_start();
    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }
    include("../db/db.inc");

    if (isset($_POST["nombre"])) {
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $estado = intval($_POST["estado"]); // 1 o 0

        // Comprobar duplicados
        $check = mysqli_query($conn, "SELECT id FROM categorias WHERE nombre = '$nombre'");
        if(mysqli_num_rows($check) > 0){
            header("location:gestion_categorias.php?cat=1"); // Error: Duplicado
            die();
        }

        $sql = "INSERT INTO categorias (nombre, estado) VALUES ('$nombre', '$estado')";
        
        if (mysqli_query($conn, $sql)) {
            header("location:gestion_categorias.php?cat=0"); // Éxito
        } else {
            header("location:gestion_categorias.php?cat=2"); // Error SQL
        }
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>➕ Nueva Categoría</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la Categoría</label>
                        <input type="text" name="nombre" class="form-control" maxlength="50" required autofocus>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="1">Activa</option>
                            <option value="0">Inactiva</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <a href="gestion_categorias.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>