<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Material.php";

    class MaterialesBD{
        //M
        public function ingresar_material (Material $m, $id_c) {
            
            //Guardamos los atributos de la clase en variables
            $nombre = $m -> nombre;
            $tipo = $m -> tipo;
            $tam = $m -> tamano;
            $ruta = $m -> ruta;
            
            //Guardamos el archivo en la carpeta Subidos
            $nom_archguardado = $id_c . "_" . $nombre;
            $nueva_r = RUTA_BASE . "/Subidos/Arch_c/" . $nom_archguardado;
            
            //Ingresamos los datos del archivo
            $qry = "
                INSERT INTO Materiales (C_ID_Adjunta,M_Nombre,M_Tipo,M_Tamano,M_Ruta)
                VALUES ('$id_c','$nombre','$tipo','$tam','$nom_archguardado')
            ";
            
            //Abrimos conexion
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            
            //Cerramos conexion
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            
            //Actualizamos el destino con move_upload_files()
            move_uploaded_file($ruta, $nueva_r);
        }
        public function listar_archivos ($id_c) {
            //Arreglo que guardara todas las filas de
            $lista = array();
            //Obtenemos todos los archivos de un curso
            $qry = "
                SELECT * FROM Materiales WHERE C_ID_Adjunta = '$id_c'
            ";
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            //Llenamos el array
            while ($fila = mysqli_fetch_array($result)) {
                $lista[] = $fila;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            return $lista;
        }
        public function agregar_archivo($id_c, $nombre, $ruta, $tipo, $tamano) {
            include RUTA_BASE . "/Persistencia/conexion.php";
            $qry = "
                INSERT INTO Materiales (C_ID_Adjunta, M_Nombre, M_Ruta, M_Tipo, M_Tamano)
                VALUES ('$id_c', '$nombre', '$ruta', '$tipo', '$tamano')
            ";
            mysqli_query($conexion, $qry);
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
        }
    }
?>