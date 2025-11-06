<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Ejercicio 2</title>
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <?php
        $categoria = random_int(21,24);
        
        echo "Categoría: ". $categoria. "<br><br>";

        echo '<table class="table table-striped table-dark">
                <tr>
                    <th scope="col">Nombre</th>
                </tr>';

        $aProductos = array
        (
            array( 'categoria' => 21, 'nombre' => 'Zapatos Nike'),
            array( 'categoria' => 24, 'nombre' => 'Camisas Adidas'),
            array( 'categoria' => 22, 'nombre' => 'Pantalones Puma'),
            array( 'categoria' => 23, 'nombre' => 'Zapatillas Fila'),
            array( 'categoria' => 21, 'nombre' => 'Pantalones Adidas'),
            array( 'categoria' => 24, 'nombre' => 'Camisas Nike'),
            array( 'categoria' => 23, 'nombre' => 'Ropa Interior Puma'),
            array( 'categoria' => 21, 'nombre' => 'Pantalones Fila')
        );
        for ($i = 0 ; $i < count($aProductos) ; $i++)
        {
            if ($categoria == $aProductos[$i]['categoria'])
            {
                echo "<tr>";
                    echo "<td>". $aProductos[$i]["nombre"]. "</td>";
                echo "</tr>";
            }
        }
    ?>
    </table>
</body>
</html>