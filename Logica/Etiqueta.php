<?php
    class Etiqueta {
        //A
        private $id;
        private $nombre;
        //C
        public function __construct ($nombre, $id = null) {
            $this -> nombre = $nombre;
            $this -> id = $id;
        }
        //M
        public function __get ($var) {
            return $this -> $var;
        }
        public function __set ($var, $valor) {
            $this -> $var = $valor;
        }
    }
?>