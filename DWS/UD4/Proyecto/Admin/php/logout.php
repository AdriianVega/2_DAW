<?php

    include "../db/db.inc";
    
    session_start();
    session_unset();
    session_destroy();

    if (isset($_COOKIE["token"])) {
        $partes = explode(":", $_COOKIE["token"]);
        if (count($partes) == 2) {
            $selector = $partes[0];

            $check = $conn->prepare("DELETE FROM tokens where selector = ?");

            $check->bind_param("s", $selector);
            
            $check->execute();
        }
        setcookie("token", "", time() - 3600, "/");   
    }
    header("location: ../index.php");
    die();
?>

