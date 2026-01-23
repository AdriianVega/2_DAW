<aside id="sidebar" class="text-white d-flex flex-column p-3">
        <h4 class="mb-4 text-center">Panel de Control</h4>

        <div class="d-flex flex-column justify-content-center align-items-center border-bottom pb-4">
            <?php
                $ruta_icono = $_SESSION["icono"];

        
            ?>
            <img src="<?= $ruta_icono ?>" alt="Icono Usuario" style="width: 50%;">
            
            <span> <?= $nombre_usuario ?></span>

            <?php if ($rol == 1) { ?>
                <small class="badge bg-danger"> Administrador </small>
            <?php } else { ?>
                <small class="badge bg-info"> Empleado </small>
            <?php } ?>
        </div>
        <div class="list-group pt-3">
            <a href="../clientes/gestion_clientes.php" class="list-group-item list-group-item-action <?php echo ($pagina_activa == "clientes") ? "active" : ""; ?>">👥 Clientes</a>
            <a href="../productos/gestion_productos.php" class="list-group-item list-group-item-action <?php echo ($pagina_activa == "productos") ? "active" : ""; ?>">📦 Productos</a>
            <a href="../categorias/gestion_categorias.php" class="list-group-item list-group-item-action <?php echo ($pagina_activa == "categorias") ? "active" : ""; ?>">🏷️ Categorías</a>
            <a href="../pedidos/gestion_pedidos.php" class="list-group-item list-group-item-action <?php echo ($pagina_activa == "pedidos") ? "active" : ""; ?>">🧾 Pedidos</a>
            <a href="../usuarios/gestion_usuarios.php" class="list-group-item list-group-item-action <?php echo ($pagina_activa == "usuarios") ? "active" : ""; ?>"">🛡️ Usuarios</a>
        </div>

        <div class="mt-auto">
            <div class="d-flex justify-content-between mb-3 fs-5">
                <a href="../menu/menu_inicio.php">
                    <span>🏠️</span>
                </a>

                <a href="../configuracion/configuracion.php" class="text-decoration-none">
                    <span>⚙️</span>
                </a>
                
            </div>

            <a href="../php/logout.php" class="btn btn-danger w-100">Cerrar Sesión</a>
        </div>
    </aside>