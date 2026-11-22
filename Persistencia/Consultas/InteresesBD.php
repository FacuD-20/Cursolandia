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
        public function actualizar_intereses($id_u, $lista_ids = array()) {
            include RUTA_BASE . "/Persistencia/conexion.php";
            //Borramos los intereses anteriores para que no se repitan
            $qry_del = "DELETE FROM Intereses WHERE U_ID_Intereses = '$id_u'";
            mysqli_query($conexion, $qry_del);
            //Insertamos los nuevos intereses
            if (!empty($lista_ids)) {
                foreach ($lista_ids as $id_e) {
                    $qry_ins = "INSERT INTO Intereses (U_ID_Intereses, E_ID_Intereses) VALUES ('$id_u', '$id_e')";
                    mysqli_query($conexion, $qry_ins);
                }
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
    }
?>