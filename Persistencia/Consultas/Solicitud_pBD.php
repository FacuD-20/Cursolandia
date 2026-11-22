<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Solicitud_p.php";
    
    class SolicitudProBD {
        //M
        public function ingresar_solicitud (Solicitud_p $sp) {
            $id_u = $sp -> id_solicita;
            $texto = $sp -> texto;
            $comprobante = $sp -> comprobante;
            $fde = $sp -> fde;
            $estado = $sp -> estado;
            $qry = "
                INSERT INTO Solicitudes_Pros (U_ID_Solicita, SP_Texto, SP_Comprobante, SP_FDEmision, SP_Estado)
                VALUES ('$id_u', '$texto', '$comprobante', '$fde', '$estado')
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            mysqli_query($conexion, $qry);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
        public function procesar_solicitud($id_sp, $id_u_solicita, $id_admin, $accion) {
            include RUTA_BASE . "/Persistencia/conexion.php";
            if ($accion === 'aprobada') {
                //Actualizamos el estado de la solicitud por aprobada y el id del administrador que lo hizo
                $qry_sp = "
                    UPDATE Solicitudes_Pros 
                    SET SP_Estado = 'aprobada', U_ID_Administra = '$id_admin', 
                    SP_FDVencimiento = DATE_ADD(CURDATE(), INTERVAL 1 MONTH)
                    WHERE SP_ID = '$id_sp'
                ";
                mysqli_query($conexion, $qry_sp);
                //Actualizamos la cuenta del usuario colocandole el plan pro
                $qry_u = "UPDATE Usuarios SET U_Plan = 'Pro' WHERE U_ID = '$id_u_solicita'";
                mysqli_query($conexion, $qry_u);
            } elseif ($accion === 'rechazada') {
                //Actualizamos el estado de la solicitud por rechazado y el id del administrador que lo hizo
                $qry_sp = "
                    UPDATE Solicitudes_Pros 
                    SET SP_Estado = 'rechazada', U_ID_Administra = '$id_admin'
                    WHERE SP_ID = '$id_sp'
                ";
                mysqli_query($conexion, $qry_sp);
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
        public function listar_pendientes() {
            $lista = array();
            $qry = "
                SELECT Solicitudes_Pros.*, U_Nom, U_Ape, U_Email 
                FROM Solicitudes_Pros INNER JOIN Usuarios ON U_ID_Solicita = U_ID
                WHERE SP_Estado = 'pendiente'
                ORDER BY SP_FDEmision ASC
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion, $qry);
            while ($fila = mysqli_fetch_array($result)) {
                $lista[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista;
        }
    }
?>