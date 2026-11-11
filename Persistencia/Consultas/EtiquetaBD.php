<?php
    require_once __DIR__ . "/../../carga.php";
    require_once RUTA_BASE . "/Logica/Etiqueta.php";

    class EtiquetaBD {
        //M
        public function listar_etiquetas () {
            $lista_e = array();

            include RUTA_BASE . "/Persistencia/conexion.php";
            $qry = "SELECT * FROM Etiquetas";
            $result = mysqli_query($conexion,$qry);

            while ($fila = mysqli_fetch_array($result)) {
                $e = new Etiqueta ($fila[1],$fila[0]);
                $lista_e[] = $e;
            }
            include RUTA_BASE . "/Persistencia/cerrar_c.php";
            
            return $lista_e;
        }
    }
?>