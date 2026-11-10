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
            $id_usuario, $titulo, $descripcion, $fdinicio, $fdfin, $costo = null, $cupos = null, $acceso = "publico", 
            $imagen = "imgcurso_pordefecto.png", $id = null
            ) {
            $this -> id_usuario = $id_usuario;
            $this -> titulo = $titulo;
            $this -> descripcion = $descripcion;
            $this -> fdinicio = $fdinicio;
            $this -> fdfin = $fdfin;
            $this -> costo = $costo;
            $this -> cupos = $cupos;
            $this -> imagen = $imagen;
            $this -> acceso = $acceso;
            $this -> id = $id;
            $this -> materiales = array();
            $this -> etiquetas = array();
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