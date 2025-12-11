<?php
    session_start();
    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }
    include("../db/db.inc");//mysqli

    if (isset($_POST["accion"]) && $_POST["accion"] == "editar") {// cuando pulse actualizar
        
        if(isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
            $nombre = htmlspecialchars(($_POST["nombre"]));
            $apellidos = htmlspecialchars(($_POST["apellidos"]));
            $email = htmlspecialchars(($_POST["email"]));
            $direccion = htmlspecialchars(($_POST["direccion"]));
            $genero = htmlspecialchars(($_POST["genero"]));
            $codpostal = htmlspecialchars(($_POST["codpostal"]));
            $poblacion = htmlspecialchars(($_POST["poblacion"]));
            $provincia = htmlspecialchars(($_POST["provincia"]));
            $id = $_POST["id"];
            
            $sql = "UPDATE clientes SET nombre = '$nombre', apellidos = '$apellidos', genero = '$genero', direccion = '$direccion', 
                    codpostal = '$codpostal', poblacion = '$poblacion', provincia = '$provincia', email = '$email' WHERE id = $id";

            $sql_email = "SELECT email FROM clientes";
            $res = mysqli_query($conn, $sql_email);
            
            if (mysqli_num_rows($res) <= 0 && mysqli_query($conn, $sql)) 
            {
                header("location:gestion_clientes.php?cli=0"); //Si todo ok
            }
            else 
            {
                header("location:gestion_clientes.php?cli=2"); //Si no actualizo
            }
            die();
        }
    }
    if(!isset($_GET["edit"])) {
        header("location:gestion_clientes.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <main class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="text-light">Registro de Cliente con MySQL</h2>
            </div>
            <div class="card-body">

            <?php
                $id = intval($_GET["edit"]);
                $sql = "SELECT * FROM clientes WHERE id = $id"; // consulta para obtener los datos del cliente
                $res = mysqli_query($conn, $sql); // ejecutar consulta
                if (mysqli_num_rows($res) > 0) { // comprobar si hay resultado
                    $cli = mysqli_fetch_assoc($res); // crear un array asociativo con los datos del cliente
                }
                else {
                    header("location:gestion_clientes.php");
                    die();
                }
            ?>

                <form method="POST">
                    <input type="hidden" name="id" value="<?=$id;?>">
                    <input type="hidden" name="accion" value="editar">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $cli["nombre"] ?>" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="apellidos" class="form-label">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= $cli["apellidos"] ?>" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $cli["email"] ?>" required>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="direccion" class="form-label">Direccion:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $cli["direccion"] ?>" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="codpostal" class="form-label">Codigo Postal:</label>
                            <input type="text" class="form-control" id="codpostal" name="codpostal" value="<?= $cli["codpostal"] ?>" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="poblacion" class="form-label">Poblacion:</label>
                            <input type="text" class="form-control" id="poblacion" name="poblacion" value="<?= $cli["poblacion"] ?>" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="provincia" class="form-label">Provicia:</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" value="<?= $cli["provincia"] ?>" required>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="genero" class="form-label">Genero:</label>
                            <select name="genero" id="genero" class="form-select">
                                <option value="default" selected disabled>Selecciona una opción</option>
                                    <?php
                                        $genero = $cli['genero'];

                                        echo $genero == 'M' ? '<option value="M" selected> Masculino </option>' : '<option value="M"> Masculino </option>';
                                        echo $genero == 'F' ? '<option value="F" selected> Femenino </option>' : '<option value="F"> Femenino </option>';
                                        echo $genero == 'O' ? '<option value="O" selected> Otro </option>' : '<option value="O"> Otro </option>';
                                    ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mt-5">Actualizar cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>