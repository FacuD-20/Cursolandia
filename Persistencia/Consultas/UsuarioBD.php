<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Usuario.php";

    class UsuarioBD {
        //M
        public function registrar (Usuario $usuario) {
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
            $qry = "INSERT INTO Usuarios (U_Nom, U_Ape, U_DNI, U_FDN, U_Email, U_Contrasena,
            U_Plan, U_Rol, U_Ant, U_FotoDePerfil) 
            VALUES ('$nom','$ape','$dni','$fdn','$email','$contra','$plan','$rol',
            '$antecedentes','$fotoperfil')";
            
            $result = mysqli_query($conexion,$qry);

            if (!$result) {
                include RUTA_BASE . "/Persistencia/cerrar_c.php";
                throw new Exception ("Error: No se pudo registrar el usuario");
            }
            
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
    }
?>