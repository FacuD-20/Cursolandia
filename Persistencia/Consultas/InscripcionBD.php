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
            if (count($cant_ins) >= 3 && $plan_u == 'Gratuito') {
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
            $lista_ins = array();
            $qry = "
                SELECT * FROM Tomo WHERE U_ID_Tomo = '$id_u' AND Estado_Tomo != 'rechazada'
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            while ($fila = mysqli_fetch_array($result)) {
                $lista_ins[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista_ins;
        }
        public function inscripciones_pendientes_curso($id_c) {
            $lista_ip = array();
            $qry = "
                SELECT Tomo.*, U_Nom, U_Ape, U_Email
                FROM Tomo
                INNER JOIN Usuarios ON U_ID_Tomo = U_ID
                WHERE C_ID_Tomo = '$id_c' AND Estado_Tomo = 'pendiente'
                ORDER BY Fecha_Tomo ASC
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion, $qry);
            while ($fila = mysqli_fetch_array($result)) {
                $lista_ip[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista_ip;
        }
        public function cambiar_estado($id_u, $id_c, $nuevo_estado) {
            include RUTA_BASE . "/Persistencia/conexion.php";
            $qry = "
                UPDATE Tomo SET Estado_Tomo = '$nuevo_estado'
                WHERE U_ID_Tomo = '$id_u' AND C_ID_Tomo = '$id_c'
            ";
            mysqli_query($conexion, $qry);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
    }
?>