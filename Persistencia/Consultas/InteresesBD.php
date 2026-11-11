<?php
    require_once __DIR__ . "/../../carga.php";
    class InteresesBD {
        //M
        public function insertar_intereses($id_u,$id_e) {
            include RUTA_BASE . "/Persistencia/conexion.php";
            $qry = "INSERT INTO Intereses VALUES ('$id_u','$id_e')";
            $result = mysqli_query($conexion,$qry);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
    }
?>