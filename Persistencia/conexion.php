<?php
    require_once __DIR__ . "/../carga.php";
    require_once RUTA_BASE . "/Persistencia/configuracion.php";

    $conexion = mysqli_connect (DB_HOST,DB_USER,DB_PASS,DB_NAME);
?>