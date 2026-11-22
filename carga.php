<?php

    /*Se define automaticamente la  URL Base local o servidor)*/
    if (isset($_SERVER['HTTP_HOST']) && (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false)) {
        define('URL_BASE', '/Cursolandia');
    } else {
        define('URL_BASE', '');
    }

    /*Definicion de la Ruta Base*/
    define('RUTA_BASE', __DIR__);

?>