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
                throw new Exception ("ERRO: Ya hay una cuenta con este DNI y/o email.");
                exit;
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
    }
?>