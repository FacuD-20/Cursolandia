<?php
    class Material {
        //A
        private $id;
        private $id_curso;
        private $nombre;
        private $tipo;
        private $tamano;
        private $ruta;
        //C
        public function __construct ($nombre, $tipo, $tamano, $ruta, $id = null, $id_curso = null) {
            $this -> nombre = $nombre;
            $this -> ruta = $ruta;
            $this -> tipo = $tipo;
            $this -> tamano = $tamano;
            $this -> id = $id;
            $this -> id_curso = $id_curso;
        }
        //M
        public function __get ($var) {
            return $this -> $var;
        }
        public function __set ($var,$valor) {
            $this -> $var = $valor;
        }
    }
?>