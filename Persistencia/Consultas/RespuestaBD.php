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
                ORDER BY R_ID ASC
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            while ($fila = mysqli_fetch_array($result)) {
                $lista[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista;
        }
        public function editar_respuesta($id_r, $nuevo_texto) {
            include RUTA_BASE . "/Persistencia/conexion.php";
            $qry = "UPDATE Respuestas SET R_Texto = '$nuevo_texto', R_FDEdicion = NOW() WHERE R_ID = '$id_r'";
            mysqli_query($conexion, $qry);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
        public function marcar_aceptada($id_r, $id_p) {
            include RUTA_BASE . "/Persistencia/conexion.php";
            //Marcamos la respuesta como aceptada
            $qry_r = "UPDATE Respuestas SET R_Aceptada = 1 WHERE R_ID = '$id_r'";
            mysqli_query($conexion, $qry_r);
            //Automaticamente cerramos la pregunta para que no se puedan sumar mas respuestas.
            $qry_p = "UPDATE Preguntas SET P_Cerrada = 1 WHERE P_ID = '$id_p'";
            mysqli_query($conexion, $qry_p);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
    }
?>