<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Inscripcion.php";
    class InscripcionBD {
        //M
        public function ingresar_inscripcion (Inscripcion $i) {
            $id_u = $i -> id_usuario;
            $id_c = $i -> id_curso;
            $estado = $i -> estado;
            $qry = "
                INSERT INTO Tomo (U_ID_Tomo,C_ID_Tomo,Estado_Tomo)
                VALUES ('$id_u','$id_c','$estado')
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
        public function obtener_inscripcion ($id_u) {
            $qry = "
                SELECT * FROM Tomo WHERE U_ID_Tomo = '$id_u'
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            $fila = mysqli_fetch_array($result);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $fila;
        }
    }
?>