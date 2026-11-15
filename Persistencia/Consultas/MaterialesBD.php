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
                VALUE ('$id_c','$nombre','$tipo','$tam','$nom_archguardado')
            ";
            
            //Abrimos conexion
            include RUTA_BASE . "/Persistencia/conexion.php";
            $result = mysqli_query($conexion,$qry);
            
            //Cerramos conexion
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            
            //Actualizamos el destino con move_upload_files()
            move_uploaded_file($ruta, $nueva_r);
        }
    }
?>