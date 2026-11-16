<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Respuesta.php";
    
    class RespuestaBD {
        //M
        public function ingresar_respuesta (Respuesta $r) {
            $id_p = $r -> id_pregunta;
            $id_u = $r -> id_usuario;
            $texto = $r -> texto;
            $aceptada = $r -> aceptada;
            //Armamos la consulta sql
            $qry = "
                INSERT INTO Respuestas (P_ID_Pertenece,U_ID_Realiza,R_Texto,R_Aceptada)
                VALUES ('$id_p','$id_u','$texto','$aceptada')
            ";
            //abrimos conexion, insertamos y cerramos conexion
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }

        public function listar_respuestas($id_p) {
            $lista = array();
            $qry = "
                SELECT Respuestas.*, U_Nom, U_Ape
                FROM Respuestas, Usuarios
                WHERE U_ID_Realiza = U_ID AND P_ID_Pertenece = '$id_p'
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            while ($fila = mysqli_fetch_array($result)) {
                $lista[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista;
        }
    }
?>