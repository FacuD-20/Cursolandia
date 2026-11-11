<?php
    class Inscripcion {
        //A
        private $id_usuario;
        private $id_curso;
        private $fecha;
        private $estado;
        //C
        public function __construct ($id_usuario, $id_curso, $fecha = null, $estado = "pendiente") {
            $this -> id_usuario = $id_usuario;
            $this -> id_curso = $id_curso;
            $this -> fecha = $fecha;
            $this -> estado = $estado;
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