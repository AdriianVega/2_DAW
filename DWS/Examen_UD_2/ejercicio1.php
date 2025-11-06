<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .precio
        {
            text-align: right;
        }
    </style>
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Desglose de la compra</h1>
    <table>
    <?php
        $anchoBandera = random_int(10,40);
        $altoBandera = random_int(10,40);
        $escudo = random_int(0,1);

        $precioMedida = $anchoBandera * $altoBandera / 10;
        $precioEscudo = $escudo ? 2.50 : 0.00;
        $precioEnvio = 3.25;
        $totalPrecio = $precioMedida + $precioEscudo + $precioEnvio;

        echo    "<tr>
                    <td> Bandera de ($anchoBandera, $altoBandera) ". ($anchoBandera * $altoBandera). "cm. </td>
                    <td class='precio'> $precioMedida € </td>
                </tr>
                <tr>
                    <td> Con escudo </td>
                    <td class='precio'> $precioEscudo €</td>
                </tr>
                <tr>
                    <td> Gastos de Envío </td>
                    <td class='precio'> $precioEnvio €</td>
                </tr>
                <tr>
                    <td> Total a pagar </td>
                    <td class='precio'> $totalPrecio €</td>
                </tr>";
    ?>
    </table>
</body>
</html>