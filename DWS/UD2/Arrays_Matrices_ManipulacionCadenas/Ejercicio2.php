<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <?php
        $historial = array(); //Declaramos el array vacío

        array_push($historial,"Inicio");
        array_push($historial,"Productos");
        array_push($historial,"Carrito");
        array_push($historial,"Pago"); //Añadimos los valores al array

        echo
        '<table border="1">
            <tr>
                <th> Páginas </th>';
        
        for ( $i = 0; $i < count($historial); $i++ )
        {
            echo "<th> $historial[$i] </th>";
            
        }
        echo
            "</tr>
        </table><br>"; //Creamos la tabla con los elementos del array

        array_pop($historial); //Eliminamos el último elemento del array

        echo
        '<table border="1">
            <tr>
                <th> Páginas </th>';
        
        for ( $i = 0; $i < count($historial); $i++ )
        {
            echo
            "<tr>
            <th> $historial[$i] </th>
            </tr>";
            
        }
        echo "</table>"; //Creamos la segunda tabla pero con el elemento "Pago" eliminado
    ?>
    <table b></table>
</body>
</html>