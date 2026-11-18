<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Inscripcion.php";
    class InscripcionBD {
        //M
        public function ingresar_inscripcion (Inscripcion $i, $plan_u) {
            $id_u = $i -> id_usuario;
            $id_c = $i -> id_curso;
            $estado = $i -> estado;
            //Verificar plan del usuario y que no exceda el limite
            $cant_ins = $this -> obtener_inscripciones($id_u);
            if (count($cant_ins) >= 3 && $plan_u == 'gratuito') {
                throw new Exception ("Usted ya alcanzo el limite de inscripciones (3).");
            }
            $qry = "
                INSERT INTO Tomo (U_ID_Tomo,C_ID_Tomo,Estado_Tomo)
                VALUES ('$id_u','$id_c','$estado')
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
        public function obtener_inscripcion ($id_u,$id_c) {
            $qry = "
                SELECT * FROM Tomo WHERE U_ID_Tomo = '$id_u' AND C_ID_Tomo = '$id_c'
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            $fila = mysqli_fetch_array($result);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $fila;
        }
        public function obtener_inscripciones ($id_u) {
            $lista_isn = array();
            $qry = "
                SELECT * FROM Tomo WHERE U_ID_Tomo = '$id_u'
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            while ($fila = mysqli_fetch_array($result)) {
                $lista_ins[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista_ins;
        }
    }
?>