<?php
    require_once __DIR__ . "/../../carga.php";

    class Tiene {
        //M
        public function insertar_etiquetas ($id_c,$id_e) {
            //Armamos la query
            $qry = "INSERT INTO Tiene VALUES ('$id_c','$id_e')";
            //abrimos la conexion y hacemos la insercion
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            //Cerramos la conexion.
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        } 
    }
?>