<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Usuario.php";

    class UsuarioBD {
        //M
        public function registrar_usuario (Usuario $usuario) {
            $nom = $usuario -> nombre;
            $ape = $usuario -> apellido;
            $dni = $usuario -> dni;
            $fdn = $usuario -> fdn;
            $email = $usuario -> email;
            $contra = $usuario -> contra;
            $plan = $usuario -> plan;
            $rol = $usuario -> rol;
            $antecedentes = $usuario -> antec;
            $fotoperfil = $usuario -> fotoperfil;

            include RUTA_BASE . "/Persistencia/conexion.php";
            //Verificamos que no hayan DNI ni EMAIL repetido, y si los hay, mandamos un mensaje al usuario.
            $qry = "SELECT U_ID FROM Usuarios WHERE U_DNI = '$dni' OR U_Email = '$email'";
            $result = mysqli_query($conexion,$qry);

            if (mysqli_num_rows($result) > 0) {
                include RUTA_BASE . "/Persistencia/cerrar_c.php";
                throw new Exception ("ERROR: Ya hay una cuenta con este DNI y/o email.");
            }
            //Insertamos el nuevo usuario a la base de datos.
            $qry = "INSERT INTO Usuarios (U_Nom, U_Ape, U_DNI, U_FDN, U_Email, U_Contrasena,
            U_Plan, U_Rol, U_Ant, U_FotoDePerfil) 
            VALUES ('$nom','$ape','$dni','$fdn','$email','$contra','$plan','$rol',
            '$antecedentes','$fotoperfil')";
            /*Try - Catch para que si hubo un error con las datos de entrada
            capturarlo y lanzar una excepcion con un mensaje para el usuario.*/
            try {
                $result = mysqli_query($conexion,$qry);
            } catch (Exception $e) {
                include RUTA_BASE . "/Persistencia/cerrar_c.php";
                throw new Exception ("ERROR: Todos los campos son obligatorios.");
            }

            //Obtener id auto gerenerado por la BDD del usuario recien creado
            $qry = "SELECT U_ID FROM Usuarios WHERE U_DNI = '$dni'";
            $result = mysqli_query($conexion,$qry);

            $fila = mysqli_fetch_array($result);

            include RUTA_BASE . "/Persistencia/cerrar_c.php";

            return $fila[0];
        }
        public function actualizar_columna ($id_u,$colum,$valor) {
            include RUTA_BASE . "/Persistencia/conexion.php";
            //Obtenemos el valor seguro, impidiendo que caracteres especiales cierren la cadena de $valor
            $valor_seg = mysqli_real_escape_string($conexion, $valor);
            $qry = "UPDATE Usuarios SET $colum = '$valor_seg' WHERE U_ID = '$id_u'";
            try {
                $result = mysqli_query($conexion,$qry);
            } catch (Exceptcion $e) {
                throw new Exceptcion ("El email ingresado ya fue utilizado.");
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
        public function iniciar_sesion ($email,$contra) {

            include RUTA_BASE . "/Persistencia/conexion.php";
            $qry = "SELECT * FROM Usuarios WHERE U_Email = '$email' AND 
            U_Contrasena = '$contra'";
            $result = mysqli_query($conexion,$qry);
            
            if (mysqli_num_rows($result) == 0) {
                include RUTA_BASE . "/Persistencia/cerrar_c.php";
                throw new Exception ("Los datos no coinciden.");
            } else {
                $fila = mysqli_fetch_array($result);
                include RUTA_BASE . "/Persistencia/cerrar_c.php";

                $nu = new Usuario ($fila['U_Nom'],$fila['U_Ape'],$fila['U_DNI'],$fila['U_FDN'],$fila['U_Email'],
                $fila['U_Contrasena'],$fila['U_Plan'],$fila['U_Rol'],$fila['U_Ant'],
                $fila['U_FotoDePerfil'],$fila['U_ID']);

                return $nu;
            }
        }
        public function cantidad_cursos ($id_u) {
            $cant_c = array();
            //Armamos la instruccion
            $qry = "
                SELECT * 
                FROM Cursos
                WHERE U_ID_Crea = '$id_u'
            ";
            //Abrimos la conexion y guardamos el resultado
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            //Guardamos la cantidad de filas en una variable
            while ($fila = mysqli_fetch_array($result)) {
                $cant_c[] = $fila;
            }
            //Cerramos la conexion
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            //Retornamos la variable con la cantidad de filas guardadas
            return $cant_c;
        }
        public function inscripciones_a_cursos ($id_u) {
            $cant_ins = array();
            $qry = "
                SELECT Cursos.*, Estado_Tomo
                FROM Tomo, Cursos 
                WHERE U_ID_Tomo = '$id_u' AND C_ID_Tomo = C_ID
                AND Estado_Tomo != 'rechazada'
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            while ($fila = mysqli_fetch_array($result)) {
                $cant_ins[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $cant_ins;
        }
        public function datos_usuario ($id_u) {
            $qry = "
                SELECT Usuarios.*, 
                GROUP_CONCAT(E_Nombre SEPARATOR ', ') AS Etiquetas
                FROM Usuarios
                LEFT JOIN Intereses ON U_ID = U_ID_Intereses
                LEFT JOIN Etiquetas ON E_ID_Intereses = E_ID
                WHERE U_ID = '$id_u'
                GROUP BY U_ID
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            //Guardamos los datos en el array
            $fila = mysqli_fetch_array($result);
            //Cerramos la conexion
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            //retornamos la fila del usuario resultante
            return $fila;
        }
    }
?>