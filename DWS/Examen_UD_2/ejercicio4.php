<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <?php
        function esPrimo($numero)
        {
            $esNumeroPrimo = true;

            for ($i = 2 ; $i < $numero ; $i++)
            {
                if ($numero % $i == 0)
                {
                    $esNumeroPrimo = false;
                    break;
                }
            }
            return $esNumeroPrimo;
        }
        for ($i = 0 ; $i < 5 ; $i++)
        {
            $numero = random_int(1, 20);
            
            echo "El número $numero ". (esPrimo($numero) ? " es primo" : " no es primo"). "<br>";
        }
    ?>
</body>
</html>