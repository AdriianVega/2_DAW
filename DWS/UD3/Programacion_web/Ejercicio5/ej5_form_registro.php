<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        label:not(.radio), input:not([type="radio"])
        {
            display: block;
        }
        .radio
        {
            padding: 0 5px;
        }
        input:not([type="radio"])
        {
            margin: 10px 0;
            width: 200px;
        }
    </style>
    <title>Ejercicio 5</title>
</head>
<body>
    <?php
        // Comprobamos si se ha recibido un error y lo mostramos
        if (isset($_GET["error"]))
        {
            echo "<div class='alert alert-danger' role='alert'> ❌ Error: No se ha introducido el valor del campo nº ". ($_GET["error"] + 1);
        }
    ?>
    <form action="result_form_registro.php" method="post" class="p-3">
        <fieldset class="border border-primary p-3 rounded">
            <legend class="float-none w-auto px-2">Datos Personales</legend>

            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" id="name" name="name" class="form-control" >
            </div>

            <div>
                <label for="surname" class="form-label">Apellidos:</label>
                <input type="text" id="surname" name="surname" class="form-control" >
            </div>

            <div>
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" >
            </div>

            <div>
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" >
            </div>

            <p>Género:</p>
        
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="Masculino">
                <label class="form-check-label" for="male">Masculino</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="Femenino">
                <label class="form-check-label" for="female">Femenino</label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="gender" id="other" value="Otro">
                <label class="form-check-label" for="other">Otro</label>
            </div>

            <div>
                <label for="address" class="form-label">Dirección:</label>
                <input type="text" id="address" name="address" class="form-control" >
            </div>
            
            <div class="mb-3">
                <label for="postal_code" class="form-label">Código Postal:</label>
                <input type="text" id="postal_code" name="postal_code" class="form-control" >
            </div>

            <div class="mb-3">
                <label for="population" class="form-label">Población:</label>
                <input type="text" id="population" name="population" class="form-control" >
            </div>

            <div class="mb-3">
                <label for="spain_province" class="form-label">Provincia:</label>
                <select id="spain_province" name="spain_province" class="form-select w-25" >
                    <option value="">Selecciona una provincia</option>
                    <option value="Alava">Álava</option>
                    <option value="Albacete">Albacete</option>
                    <option value="Alicante">Alicante</option>
                    <option value="Almeria">Almería</option>
                    <option value="Asturias">Asturias</option>
                    <option value="Ávila">Ávila</option>
                    <option value="Badajoz">Badajoz</option>
                    <option value="Barcelona">Barcelona</option>
                    <option value="Burgos">Burgos</option>
                    <option value="Cáceres">Cáceres</option>
                    <option value="Cádiz">Cádiz</option>
                    <option value="Cantabria">Cantabria</option>
                    <option value="Castellón">Castellón</option>
                    <option value="Ciudad Real">Ciudad Real</option>
                    <option value="Córdoba">Córdoba</option>
                    <option value="Cuenca">Cuenca</option>
                    <option value="Girona">Girona</option>
                    <option value="Granada">Granada</option>
                    <option value="Guadalajara">Guadalajara</option>
                    <option value="Guipúzcoa">Guipúzcoa</option>
                    <option value="Huelva">Huelva</option>
                    <option value="Huesca">Huesca</option>
                    <option value="Islas Baleares">Islas Baleares</option>
                    <option value="Jaén">Jaén</option>
                    <option value="León">León</option>
                    <option value="Lleida">Lleida</option>
                    <option value="Lugo">Lugo</option>
                    <option value="Madrid">Madrid</option>
                    <option value="Málaga">Málaga</option>
                    <option value="Murcia">Murcia</option>
                    <option value="Navarra">Navarra</option>
                    <option value="Ourense">Ourense</option>
                    <option value="Palencia">Palencia</option>
                    <option value="Las Palmas">Las Palmas</option>
                    <option value="Pontevedra">Pontevedra</option>
                    <option value="La Rioja">La Rioja</option>
                    <option value="Salamanca">Salamanca</option>
                    <option value="Segovia">Segovia</option>
                    <option value="Sevilla">Sevilla</option>
                    <option value="Soria">Soria</option>
                    <option value="Tarragona">Tarragona</option>
                    <option value="Santa Cruz De Tenerife">Santa Cruz de Tenerife</option>
                    <option value="Teruel">Teruel</option>
                    <option value="Toledo">Toledo</option>
                    <option value="Valencia">Valencia</option>
                    <option value="Valladolid">Valladolid</option>
                    <option value="Vizcaya">Vizcaya</option>
                    <option value="Zamora">Zamora</option>
                    <option value="Zaragoza">Zaragoza</option>
                    <option value="Ceuta">Ceuta</option>
                    <option value="Melilla">Melilla</option>
                </select>
            </div>

            <div>
                <input type="submit" value="Enviar" name="submit" id="submit" class="btn btn-primary mt-4">
            </div>
        </fieldset>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>