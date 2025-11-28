<?php
    $host = "localhost"; //Dirección del servidor
    $nombreBD = "videojuegos"; //Nombre de la BD
    $usuario = "root"; //usuario con acceso a la BD
    $password = ""; //Contraseña del usuario
    // Crear conexión
    $conn = new mysqli($host, $usuario, $password, $nombreBD);
    // Verificar conexión

    if ($conn->connect_error) 
    {
        die ("Conexión fallida - ERROR de conexión: " . $conn->
        connect_error);
    }
?>