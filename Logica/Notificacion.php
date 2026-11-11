<?php
    class Notificacion {
        //A
        private $id;
        private $id_pregunta;
        private $id_respuesta;
        private $id_usuario;
        private $texto;
        private $fecha;
        private $notleida;
        //C
        public function __construct ($texto ,$id_pregunta = null, $id_respuesta = null, $id_usuario = null,
        $fecha = null, $notleida = 0, $id = null
        ) {
            $this -> id = $id;
            $this -> id_pregunta = $id_pregunta;
            $this -> id_respuesta = $id_respuesta;
            $this -> id_usuario = $id_usuario;
            $this -> texto = $texto;
            $this -> fecha = $fecha;
            $this -> notleida = $notleida;
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