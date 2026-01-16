<?php
    session_start();
    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }
    include("../db/db.inc");

    // PROCESAR EDICIÓN
    if (isset($_POST["accion"]) && $_POST["accion"] == "editar") {
        $id = intval($_POST["id"]);
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $estado = intval($_POST["estado"]);

        // Validar duplicado (Nombre existe en OTRO ID diferente al actual)
        $sql_check = "SELECT id FROM categorias WHERE nombre = '$nombre' AND id != $id";
        $res = mysqli_query($conn, $sql_check);
        
        if (mysqli_num_rows($res) > 0) {
            header("location:gestion_categorias.php?cat=1"); // Error: Nombre ocupado
            die();
        }

        $sql = "UPDATE categorias SET nombre = '$nombre', estado = '$estado' WHERE id = $id";
        
        if (mysqli_query($conn, $sql)) {
            header("location:gestion_categorias.php?cat=0");
        } else {
            header("location:gestion_categorias.php?cat=2");
        }
        die();
    }

    // OBTENER DATOS
    if(!isset($_GET["id"])) { header("location:gestion_categorias.php"); die(); }
    
    $id = intval($_GET["id"]);
    $res = mysqli_query($conn, "SELECT * FROM categorias WHERE id = $id");
    
    if($row = mysqli_fetch_assoc($res)){
        $cat = $row;
    } else {
        header("location:gestion_categorias.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow">
            <div class="card-header bg-warning">
                <h4 class="mb-0">✏️ Editar Categoría</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id" value="<?= $cat['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" 
                            value="<?= htmlspecialchars($cat['nombre']) ?>" maxlength="50" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="1" <?= $cat['estado'] == 1 ? 'selected' : '' ?>>Activa</option>
                            <option value="0" <?= $cat['estado'] == 0 ? 'selected' : '' ?>>Inactiva</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="gestion_categorias.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>