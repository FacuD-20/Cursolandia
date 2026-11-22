<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Curso.php";
    require_once RUTA_BASE . "/Persistencia/Consultas/C_E_tiene.php";
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
            //Verificamos que las variables tengan un valor o no para no tener bugs en la BDD
            $costo_sql = ($costo === "" || $costo === null) ? 0 : "'$costo'";
            $cupos_sql = ($cupos === "" || $cupos === null) ? "NULL" : "'$cupos'";
            //Instanciamos los objetos de la Persistencia
            $matbdd = new MaterialesBD();
            $cetiene = new Tiene();
            $ubdd = new UsuarioBD();

            //Obtenemos la cantidad de cursos y datos varios del usuario
            $cant = $ubdd -> cantidad_cursos($id_u);
            $datos_u = $ubdd -> datos_usuario($id_u);
            
            //Verificamos que los limites relacionas a los archivos
            if ($datos_u["U_Plan"] == "Gratuito" && !empty($mat)) {
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
            
            //Verificamos el plan del usuario y que no supere el limite de cursos creados
            if (count($cant) >= 3 && $datos_u["U_Plan"] == 'Gratuito') {
                throw new Exception ("Limite de cursos creados alcanzados, mejore su plan para crear mas.");
            }
            
            //Armamos la instruccion de insercion
            $qry = "
                INSERT INTO Cursos (U_ID_Crea, C_Titulo, C_Descripcion, C_FDInicio, C_FDFin,
                C_Costo, C_Cupos, C_Img, C_Acceso)
                VALUES ('$id_u','$t','$des','$fdinicio','$fdfin',$costo_sql,$cupos_sql,'$img','$acc')
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
            
            //Retornamos el id del curso recien creado.
            return $id[0];
        }
        public function datos_curso ($id_c) {
            //Obtenemos los datos de x cursos y su creador.
            $qry = "
                SELECT Cursos.*, U_Nom, U_Ape, U_FotoDePerfil,
                GROUP_CONCAT(E_Nombre SEPARATOR ', ') AS Etiquetas
                FROM Cursos INNER JOIN Usuarios ON U_ID_Crea = U_ID
                LEFT JOIN Tiene ON C_ID_Tiene = C_ID
                LEFT JOIN Etiquetas ON E_ID_Tiene = E_ID
                WHERE C_ID = '$id_c'
                GROUP BY Cursos.C_ID
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            $fila = mysqli_fetch_array($result);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $fila;
        }
        public function listar_cursos ($f_etiquetas = array(), $f_gratis = 0, $f_pagos = 0,
            $f_nuevos = 0, $f_publicos = 0, $f_privados = 0) {
            /*Definimos la variable condicion, con base siempre verdadera, que guardara condiciones dependiendo los parametros.
            Array de lista*/
            $condiciones = "WHERE 1=1";
            $lista = array();
            //Si filtro por etiquetas
            if (!empty($f_etiquetas)) {
                //Guardamos las ids de las etiquetas en una variable para usarla en SQL
                $ids_e = implode(",",$f_etiquetas);
                $condiciones .= " AND C_ID IN (SELECT C_ID_Tiene FROM Tiene WHERE E_ID_Tiene IN ($ids_e))";
            }
            //Filtro por gratis/pagos
            if ($f_gratis == 0 && $f_pagos == 1) {
                $condiciones .= " AND C_Costo > 0";
            } elseif ($f_gratis == 1 && $f_pagos == 0) {
                $condiciones .= " AND (C_Costo = 0 OR C_Costo IS NULL)";
            }
            //Definimos una variable que, si fue tildada, tenga como valor el orden del mas nuevo publicado, sino no va a tener nada
            $order = ($f_nuevos == 1) ? "ORDER BY C_ID DESC" : "";
            //Filtro publico/privado
            if ($f_publicos == 1 && $f_privados == 0) {
                $condiciones .= " AND C_Acceso = 'publico'";
            } elseif ($f_publicos == 0 && $f_privados == 1) {
                $condiciones .= " AND C_Acceso = 'privado'";
            }
            //Armamos la query y la unimos con las variables para la misma.
            $qry = "
                SELECT Cursos.*, U_Nom, U_Ape, 
                GROUP_CONCAT(E_Nombre SEPARATOR ', ') AS Etiquetas
                FROM Cursos INNER JOIN Usuarios ON U_ID_Crea = U_ID
                LEFT JOIN Tiene ON C_ID = C_ID_Tiene
                LEFT JOIN Etiquetas ON E_ID_Tiene = E_ID
                $condiciones
                GROUP BY Cursos.C_ID
                $order
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            while ($fila = mysqli_fetch_array($result)) {
                $lista[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista;
        }
        public function buscar_curso ($palabra) {
            //Array que contiene la lista de cursos encontrados con x palabra
            $lista_c = array();
            $qry = "
                SELECT Cursos.*, U_Nom, U_Ape, 
                    GROUP_CONCAT(E_Nombre SEPARATOR ', ') AS Etiquetas 
                FROM Cursos INNER JOIN Usuarios ON U_ID_Crea = U_ID
                LEFT JOIN Tiene ON C_ID = C_ID_Tiene
                LEFT JOIN Etiquetas ON E_ID_Tiene = E_ID
                WHERE C_Acceso = 'publico'
            ";
            //Verificamos que la palabra no este vacia y que el titulo y/o descripcion tengan dicha palabra.
            if (!empty($palabra)) {
                $qry .= " AND (C_Titulo LIKE '%$palabra%' OR C_Descripcion LIKE '%$palabra%' OR E_Nombre LIKE '%$palabra%')";
            }
            //Terminamos de armar la qry
            $qry .= " GROUP BY C_ID";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            //Llenamos la lista con los cursos obtenidos
            while ($fila = mysqli_fetch_array($result)) {
                $lista_c[] = $fila;
            }
            //Cerramos conexion
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista_c;
        }
        public function listar_populares() {
            $lista_cp = array();
            /*Armamos la qry donde seleccionamos todos los datos de cursos, el nombre y apellido del creado,
            las etiquetas que tiene dicho curso y un contador que muestra cuantas inscripciones tiene.*/
            $qry = "
                SELECT Cursos.*, U_Nom, U_Ape,
                    GROUP_CONCAT(DISTINCT E_Nombre SEPARATOR ', ') AS Etiquetas,
                    COUNT(DISTINCT U_ID_Tomo) AS cant_inscriptos
                FROM Cursos 
                INNER JOIN Usuarios ON U_ID_Crea = U_ID
                LEFT JOIN Tomo ON C_ID = C_ID_Tomo AND Estado_Tomo = 'confirmada'
                LEFT JOIN Tiene ON C_ID = C_ID_Tiene
                LEFT JOIN Etiquetas ON E_ID_Tiene = E_ID
                WHERE C_Acceso = 'Publico'
                GROUP BY C_ID
                ORDER BY cant_inscriptos DESC
                LIMIT 4
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion, $qry);
            while ($fila = mysqli_fetch_array($result)) {
                $lista_cp[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista_cp;
        }
        public function listar_destacados_pro() {
            $lista_cd = array();
            //Armamos la qry para que seleccione todos los ultimos cursos creados por usuarios pro.
            $qry = "
                SELECT Cursos.*, U_Nom, U_Ape,
                GROUP_CONCAT(DISTINCT E_Nombre SEPARATOR ', ') AS Etiquetas
                FROM Cursos
                INNER JOIN Usuarios ON U_ID_Crea = U_ID
                LEFT JOIN Tiene ON C_ID = C_ID_Tiene
                LEFT JOIN Etiquetas ON E_ID_Tiene = E_ID
                WHERE C_Acceso = 'Publico' AND U_Plan = 'Pro'
                GROUP BY C_ID
                ORDER BY C_ID DESC
                LIMIT 4
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion, $qry);
            while ($fila = mysqli_fetch_array($result)) {
                $lista_cd[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista_cd;
        }
        public function listar_recomendados($id_u) {
            $lista_r = array();
            //Armamos la query donde obtenemos todos los cursos con las mismas etiquetas que tiene el usuario
            $qry = "
                SELECT Cursos.*, U_Nom, U_Ape,
                GROUP_CONCAT(DISTINCT E_Nombre SEPARATOR ', ') AS Etiquetas
                FROM Cursos
                INNER JOIN Usuarios ON U_ID_Crea = U_ID
                LEFT JOIN Tiene ON C_ID = C_ID_Tiene
                LEFT JOIN Etiquetas ON E_ID_Tiene = E_ID
                WHERE C_Acceso = 'Publico' AND U_ID_Crea != '$id_u'
                AND C_ID IN (SELECT C_ID_Tiene 
                            FROM Tiene 
                            INNER JOIN Intereses ON E_ID_Tiene = E_ID_Intereses
                            WHERE U_ID_Intereses = '$id_u')
                GROUP BY C_ID
                LIMIT 4
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion, $qry);
            while ($fila = mysqli_fetch_array($result)) {
                $lista_r[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista_r;
        }
    }
?>