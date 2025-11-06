<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
</head>
<body>
    <table border="1">
        <?php
            $matrizDatos = array(); //Declaramos el array vacío
            
            //Añadimos los valores al array asociativo
            array_push($matrizDatos, array("nombre" => "Aitor", "altura" => 182, "email" => "aitor@correo.com"));
            array_push($matrizDatos, array("nombre" => "Valeria", "altura" => 168, "email" => "valeria@correo.com"));
            array_push($matrizDatos, array("nombre" => "Diego", "altura" => 187, "email" => "diego@correo.com"));
            array_push($matrizDatos, array("nombre" => "Tomás", "altura" => 175, "email" => "tomas@correo.com"));
            array_push($matrizDatos, array("nombre" => "Sofía", "altura" => 170, "email" => "sofia@correo.com"));

            // Creamos el encabezado y añadimos los valores a la tabla
            echo "<tr>
                    <th> Nombre </th>
                    <th> Altura </th>
                    <th> Email </th>
                </tr>";
            
            foreach ($matrizDatos as $lista)
            {
                echo "<tr>";

                foreach($lista as $clave => $valor)
                {
                    echo "<td>". $valor. "</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>