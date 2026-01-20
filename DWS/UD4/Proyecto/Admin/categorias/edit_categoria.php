<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }
    include "../db/db.inc";

    $nombre_usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
    $pagina_activa = "categorias";

    if (isset($_POST["accion"]) && $_POST["accion"] == "editar") {
        
        if(isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
            $id = intval($_POST["id"]);
            $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
            $estado = intval($_POST["estado"]);

            try {
                $sql = "UPDATE categorias SET
                        nombre = '$nombre',
                        estado = $estado
                    WHERE id = $id";

                mysqli_query($conn, $sql);

                header("location:gestion_categorias.php?msg=0");
            }
            catch (mysqli_sql_exception $e) {
                //mysqli_error($conn); die();
                header("location:gestion_categorias.php?msg=error");
            }

            die();
        }
    }

    if(!isset($_GET["id"])) {
        header("location:gestion_categorias.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tablas.css">
    <title>Editar Categoría</title>
</head>
<body class="bg-light">

    <?php include "../php/panel_administrador.php"; ?>

    <main class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="h4 mb-0">✏️ Editar Categoría</h2>
            </div>
            <div class="card-body">

            <?php
                $id = intval($_GET["id"]);
                $sql = "SELECT * FROM categorias WHERE id = $id";
                $res = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($res) > 0) {
                    $cat = mysqli_fetch_assoc($res);
                } else {
                    header("location:gestion_categorias.php");
                    die();
                }
            ?>

                <form method="POST">
                    <input type="hidden" name="id" value="<?=$id;?>">
                    <input type="hidden" name="accion" value="editar">
                    
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="nombre" class="form-label">Nombre de la Categoría:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?= htmlspecialchars($cat["nombre"]) ?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado:</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <?php
                                    $est = $cat['estado'];
                                    echo '<option value="1" ' . ($est == 1 ? 'selected' : '') . '>Activo</option>';
                                    echo '<option value="0" ' . ($est == 0 ? 'selected' : '') . '>Inactivo</option>';
                                ?>
                            </select>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
                            <a href="gestion_categorias.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
