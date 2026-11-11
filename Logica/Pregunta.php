<?php
    class Pregunta {
        //A
        private $id;
        private $id_usuario;
        private $id_curso;
        private $titulo;
        private $texto;
        private $destacada;
        private $cerrada;
        private $fdcreacion;
        //C
        public function __construct ($id_usuario, $id_curso, $titulo, $texto,
        $fdcreacion = null, $destacada = 0, $cerrada = 0, $id = null
        ) {
            $this -> id_usuario = $id_usuario;
            $this -> id_curso = $id_curso;
            $this -> titulo = $titulo;
            $this -> texto = $texto;
            $this -> fdcreacion = $fdcreacion;
            $this -> destacada = $destacada;
            $this -> cerrada = $cerrada;
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