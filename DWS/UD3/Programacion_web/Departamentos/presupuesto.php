<?php
    //Evitamos que se acceda a nuestro sitio web desde fuera
    if( parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST'])
    {
        header("location:form_dep.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto de Departamento</title>
</head>
<body>
    <?php
        // Buscamos el presupuesto correspondiente al departamento
        function calcularPresupuestoCampo($campo)
        {
            $departamentos = array
            (
                "informatica" => 500,
                "lengua" => 300,
                "matematicas" => 300,
                "ingles" => 400
            );
            // Devolvemos el valor del presupuesto del departamento
            return $departamentos[$campo];
        }
        // Declaramos el departamento recibido
        $campo = $_POST["departamento"];
    ?>
    <h1>Presupuesto departamento <?= strtoupper($campo) ?></h1>
    <h2>El presupuesto del departamento de <?= $campo ?> son <?= calcularPresupuestoCampo($campo) ?> €</h2>
</body>
</html>