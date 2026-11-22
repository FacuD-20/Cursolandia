<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Notificacion.php";
    class NotificacionBD {
        //M
        public function nueva_notificacion (Notificacion $n) {
            //Guardamos los datos en variables y nos aseguramos de ponerle NULL y no un texto vacio a la BDD
            $id_p = ($n -> id_pregunta !== null) ? $n -> id_pregunta : "NULL";
            $id_r = ($n -> id_respuesta !== null) ? $n -> id_respuesta : "NULL";
            $id_u = $n -> id_usuario;
            $texto = $n -> texto;
            //Armamos la qry para insertar las notificacion de pregunta o respuesta realizada
            $qry = "
                INSERT INTO Notificaciones (P_ID_Crea,R_ID_Crea,N_Texto)
                VALUES ($id_p,$id_r,'$texto')
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            //Obtenemos el id generado automaticamente por la ultima insercion
            $id_n = mysqli_insert_id($conexion);
            //Si el id  del usuario es distinto de null, notifica a los demas pero no a este.
            if ($id_u !== null) {
                $qry_notifica = "
                    INSERT INTO Notifica (N_ID_Notifica, U_ID_Notifica)
                    VALUES ('$id_n', '$id_u')
                ";
                mysqli_query($conexion, $qry_notifica);
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
    }
?>