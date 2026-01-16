<?php
    session_start();
    if(!isset($_SESSION["nombre"])) { header("location:../index.php"); die(); }
    include("../db/db.inc");

    // PROCESAR FORMULARIO
    if (isset($_POST["cliente_id"])) {
        $cliente_id = intval($_POST["cliente_id"]);
        $usuario_id = intval($_POST["usuario_id"]);
        $producto_id = intval($_POST["producto_id"]);
        
        // Insertamos. La fecha es automática (current_timestamp)
        $sql = "INSERT INTO pedidos (cliente_id, usuario_id, producto_id) 
                VALUES ('$cliente_id', '$usuario_id', '$producto_id')";
        
        if (mysqli_query($conn, $sql)) {
            header("location:gestion_pedidos.php?msg=0");
        } else {
            header("location:gestion_pedidos.php?msg=error");
        }
        die();
    }

    // CARGAR LISTAS PARA LOS SELECTS
    $clientes = mysqli_query($conn, "SELECT id, nombre, apellidos FROM clientes ORDER BY nombre");
    $usuarios = mysqli_query($conn, "SELECT id, nombre FROM usuarios ORDER BY nombre"); // Asumo tabla usuarios
    $productos = mysqli_query($conn, "SELECT id, nombre, precio FROM productos WHERE estado = 1 ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 700px;">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4>➕ Registrar Nuevo Pedido</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select name="cliente_id" class="form-select" required>
                            <option value="" disabled selected>Seleccione un cliente...</option>
                            <?php while($c = mysqli_fetch_assoc($clientes)): ?>
                                <option value="<?= $c['id'] ?>">
                                    <?= htmlspecialchars($c['nombre'] . " " . $c['apellidos']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vendedor (Usuario)</label>
                        <select name="usuario_id" class="form-select" required>
                            <option value="" disabled selected>Seleccione usuario responsable...</option>
                            <?php while($u = mysqli_fetch_assoc($usuarios)): ?>
                                <option value="<?= $u['id'] ?>">
                                    <?= htmlspecialchars($u['nombre']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <select name="producto_id" class="form-select" required>
                            <option value="" disabled selected>Seleccione un producto...</option>
                            <?php while($p = mysqli_fetch_assoc($productos)): ?>
                                <option value="<?= $p['id'] ?>">
                                    <?= htmlspecialchars($p['nombre']) ?> - <?= $p['precio'] ?>€
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success">Registrar Pedido</button>
                        <a href="gestion_pedidos.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>