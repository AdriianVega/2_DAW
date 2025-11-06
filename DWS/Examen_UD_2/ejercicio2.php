<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <h1 style="color: green;">Días de la semana</h1>
    <?php
        $diaSemana = random_int(1,7);
        $nombreDia = match ($diaSemana)
        {
            1 => "Lunes",
            2 => "Martes",
            3 => "Miércoles",
            4 => "Jueves",
            5 => "Viernes",
            6 => "Sábado",
            7 => "Domingo",
        };
        echo "<h3 style='color: yellow;'>El día elegido aleatoriamente es el nº: $diaSemana </h3>";
        echo "<p style='color: red;'> $nombreDia </p>";
    ?>
</body>
</html>