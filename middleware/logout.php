<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//*Este we limpia
$_SESSION = [];

//*Destruye la sesión
session_destroy();

//*Redirige al login
header("Location: /");
exit();
