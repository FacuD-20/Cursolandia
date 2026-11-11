<?php
    class Material {
        //A
        private $id;
        private $id_curso;
        private $nombre;
        private $ruta;
        private $tipo;
        private $tamano;
        private $fdsubida;
        //C
        public function __construct ($id_curso, $nombre, $ruta, $tipo, $tamano, $fdsubida, $id = null) {
            $this -> id_curso = $id_curso;
            $this -> nombre = $nombre;
            $this -> ruta = $ruta;
            $this -> tipo = $tipo;
            $this -> tamano = $tamano;
            $this -> fdsubida = $fdsubida;
            $this -> id = $id;
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