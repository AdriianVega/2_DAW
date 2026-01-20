<?php

    session_start();
    session_unset();
    session_destroy();

    if (isset($_COOKIE["email"])) {
        setcookie("email", "", time() - 3600, '/');
    }

    if (isset($_COOKIE["password"])) {
        setcookie("password", "", time() - 3600, '/');
    }
    header("location: ../index.php");
?>

