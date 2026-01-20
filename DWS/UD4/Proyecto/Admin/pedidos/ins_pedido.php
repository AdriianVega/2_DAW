<?php
    session_start();
    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }
    include "../db/db.inc";

    $nombre_usuario = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
    $pagina_activa = "pedidos";

    if(isset($_POST["cliente_id"]) && !empty($_POST["cliente_id"])) {
        
        $cliente_id = intval($_POST["cliente_id"]);
        $producto_id = intval($_POST["producto_id"]);
        
        try {
                $sql = "INSERT INTO pedidos (cliente_id, producto_id)
                VALUES ('$cliente_id', '$producto_id');";

                mysqli_query($conn, $sql);

                header("location:gestion_pedidos.php?msg=0");
            }
            catch (mysqli_sql_exception $e) {
                //mysqli_error($conn); die();
                header("location:gestion_pedidos.php?msg=error");
            }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tablas.css">
    <title>Nuevo Pedido</title>
</head>
<body class="bg-light">
    <?php include "../php/panel_control.php"; ?>
    
    <main class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h2 class="h4 mb-0">🧾 Añadir Pedido</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row g-3">
                        
                        <div class="col-md-6">
                            <label for="cliente_id" class="form-label">ID de Cliente</label>
                            <input type="number" class="form-control" id="cliente_id" name="cliente_id" required>
                        </div>

                        <div class="col-md-6">
                            <label for="producto_id" class="form-label">ID de Producto</label>
                            <input type="number" class="form-control" id="producto_id" name="producto_id" required>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100">Guardar Pedido</button>
                            <a href="gestion_pedidos.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>