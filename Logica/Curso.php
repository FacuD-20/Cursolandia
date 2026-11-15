<?php
    class Curso {
        //A
        private $id;
        private $id_usuario;
        private $titulo;
        private $descripcion;
        private $fdinicio;
        private $fdfin;
        private $costo;
        private $cupos;
        private $imagen;
        private $acceso;
        private $materiales;
        private $etiquetas;
        //C
        public function __construct (
            $id_usuario, $titulo, $descripcion, $fdinicio, $fdfin, $imagen, $costo = null, $cupos = null, 
            $acceso = "publico", $materiales = null, $etiquetas = null, $id = null
            ) {
            $this -> id_usuario = $id_usuario;
            $this -> titulo = $titulo;
            $this -> descripcion = $descripcion;
            $this -> fdinicio = $fdinicio;
            $this -> fdfin = $fdfin;
            $this -> costo = ($costo === "") ? 0 : $costo;
            $this -> cupos = ($cupos === "") ? null : $cupos;
            $this -> imagen = $imagen;
            $this -> acceso = $acceso;
            $this -> id = $id;
            $this -> materiales = $materiales;
            $this -> etiquetas = $etiquetas;
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