<?php
    require_once __DIR__ . "/../carga.php";
    //Mantenemos la session
    session_start();
    //Desahemos todas las variables guardadas en $_SESSION
    session_unset();
    //Destruimos la sesion activo
    session_destroy();
    //Reedirigimos a la pagina principal.
    header("Location: " . URL_BASE . "/index.php");
    exit;
?>