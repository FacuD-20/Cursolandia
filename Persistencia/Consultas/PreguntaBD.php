<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Pregunta.php";
    class PreguntaBD {
        //M
        public function ingresar_pregunta (Pregunta $p) {
            //Guardamos sus valores dentro de variables
            $id_c = $p -> id_curso;
            $id_u = $p -> id_usuario;
            $t = $p -> titulo;
            $text = $p -> texto;
            $des = $p -> destacada;
            $cerrada = $p -> cerrada;
            //Armamos la instrucciond de insercion. Abrimo, obtenemos el resultado y cerramos la conexion
            $qry = "
                INSERT INTO Preguntas (C_ID_Contiene,U_ID_Inicia,P_Titulo,P_Texto,P_Destacada,P_Cerrada)
                VALUES ('$id_c','$id_u','$t','$text','$des','$cerrada')
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
        public function listar_preguntas ($id_c) {
            //Arreglo donde guardaremos las filas resultantes de la query
            $lista = array();
            /*Creamos la instruccion para obtener todas las preguntas, junto con los nombres,
            apellidos y foto de perfil de los usuarios que la hicieron mientras que sea del mismo curso*/
            $qry = "
                SELECT Preguntas.*, U_Nom, U_Ape, U_FotoDePerfil
                FROM Preguntas, Usuarios
                WHERE U_ID_Inicia = U_ID AND C_ID_Contiene = '$id_c'
                ORDER BY P_Destacada DESC, P_FDCreacion DESC
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            //While para llenar el array creado anteriormente
            while ($fila = mysqli_fetch_array($result)) {
                $lista[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista;
        }
        public function destacar_pregunta($id_p) {
            include RUTA_BASE . "/Persistencia/conexion.php";
            $qry = "UPDATE Preguntas SET P_Destacada = IF(P_Destacada = 1, 0, 1) WHERE P_ID = '$id_p'";
            mysqli_query($conexion, $qry);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
        public function eliminar_pregunta($id_p) {
            include RUTA_BASE . "/Persistencia/conexion.php";
            // Borramos primero las respuestas asociadas a la pregunta
            $qry_r = "DELETE FROM Respuestas WHERE P_ID_Pertenece = '$id_p'";
            mysqli_query($conexion, $qry_r);
            // Ahora borramos la pregunta
            $qry_p = "DELETE FROM Preguntas WHERE P_ID = '$id_p'";
            mysqli_query($conexion, $qry_p);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
    }
?>