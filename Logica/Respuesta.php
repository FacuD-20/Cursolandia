<?php
    class Respuesta {
        //A
        private $id;
        private $id_usuario;
        private $id_pregunta;
        private $texto;
        private $aceptada;
        private $fdcreacion;
        private $fdedicion;
        //C
        public function __construct ($id_usuario, $id_pregunta, $texto,
        $fdcreacion = null, $fdedicion = null, $aceptada = 0, $id = null
        ) {
            $this -> id_usuario = $id_usuario;
            $this -> id_pregunta = $id_pregunta;
            $this -> texto = $texto;
            $this -> aceptada = $aceptada;
            $this -> fdcreacion = $fdcreacion;
            $this -> fdedicion = $fdedicion;
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