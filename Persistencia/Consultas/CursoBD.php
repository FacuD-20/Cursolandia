<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Curso.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/C_E_Tiene.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/MaterialesBD.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/UsuarioBD.php";

    class CursoBD {
        //M
        public function crear_curso (Curso $c) {
            //Guardamos los atributos en variables (mas comodo)
            $id_u = $c -> id_usuario;
            $t = $c -> titulo;
            $des = $c -> descripcion;
            $fdinicio = $c -> fdinicio;
            $fdfin = $c -> fdfin;
            $costo = $c -> costo;
            $cupos = $c -> cupos;
            $img = $c -> imagen;
            $acc = $c -> acceso;
            $etiq = $c -> etiquetas;
            $mat = $c -> materiales;
            
            //Variable para un posible mensaje de error en materiales
            $merror_mat = "";
            
            //Instanciamos los objetos de las clases C_E_tiene y MaterialesBD
            $matbdd = new MaterialesBD();
            $cetiene = new Tiene();
            $ubdd = new UsuarioBD();
            
            //Obtenemos la cantidad de cursos y datos varios del usuario
            $cant = $ubdd -> cantidad_cursos($id_u);
            $datos_u = $ubdd -> datos_usuario($id_u);
            
            //Verificamos que los limites relacionas a los archivos
            if ($datos_u[1] == "gratuito" && !empty($mat)) {
                //Mas de cinco archivos
                if (count($mat) > 5) {
                    throw new Exception ("Supero el maximo de archivos subidos. Mejore su plan para subir sin limites.");
                }
                //Verificamos que el tamaño total no supere los 10mb
                $tam_total = 0;
                foreach ($mat as $m) {
                    //Verificamos que el tamaño individual no supere los 5mb
                    if ($m -> tamano > (5 * 1024 * 1024)) {
                        throw new Exception ("El tamaño individual del archivos supero el limite de subida. Mejore su plan para subir sin limites.");
                    }
                    $tam_total += $m -> tamano;
                }
                if ($tam_total > (10 * 1024 * 1024)) {
                    throw new Exception ("Supero el maximo de tamaño total de archivos subidos. Mejore su plan para subir sin limites.");
                }
            }
            
            //Volvemos a verificamos el plan y que no supere el limite de cursos creados
            if ($cant >= 3 && $datos_u[1] == 'gratuito') {
                throw new Exception ("Limite de cursos creados alcanzados, mejore su plan para crear mas.");
            }
            
            //Armamos la instruccion de insercion
            $qry = "
                INSERT INTO Cursos (U_ID_Crea, C_Titulo, C_Descripcion, C_FDInicio, C_FDFin,
                C_Costo, C_Cupos, C_Img, C_Acceso)
                VALUES ('$id_u','$t','$des','$fdinicio','$fdfin','$costo','$cupos','$img','$acc')
            ";
            
            //Abrimos la conexion
            include RUTA_BASE . "/Persistencia/conexion.php";
            
            //Intentamos insertar el nuevo curso
            try {
                $result = mysqli_query($conexion,$qry);
            } catch (Exception $e) {
                include RUTA_BASE . "/Persistencia/cerrar_c.php";
                throw new Exception ("Campos Obligatorios (*)");
            }
            
            //Obtenemos el id del curso
            $qry = "SELECT MAX(C_ID) FROM Cursos WHERE U_ID_Crea = '$id_u'";
            $result = mysqli_query($conexion,$qry);
            $id = mysqli_fetch_array($result);
            
            //Bucle para insertar sus etiquetas en la tabla "Tiene"
            foreach ($etiq as $id_e) {
                $cetiene -> insertar_etiquetas($id[0],$id_e);
            }
            
            //Cerramos la conexion
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            
            //Verificamos si hay materiales y los ingresamos.
            if (!empty($mat)) {
                foreach ($mat as $m) {
                    $matbdd -> ingresar_material($m,$id[0]);
                }
            }
            
            //Retornamos el mensaje de error de archivos.
            return $merror_mat;
        }
    }
?>