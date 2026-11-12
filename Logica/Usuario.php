<?php
    class Usuario {
        //A
        private $id;
        private $nombre;
        private $apellido;
        private $dni;
        private $fdn;
        private $email;
        private $contra;
        private $intereses;
        private $plan;
        private $rol;
        private $antec;
        private $fotoperfil;
        //C
        public function __construct (
            $nombre, $apellido, $dni, $fdn, $email, $contra,
            $plan = "gratuito", $rol = "usuario", $antec = null, 
            $fotoperfil = "avatar_pordefecto.png", $id = null
            ) {
            $this -> id = $id;
            $this -> nombre = $nombre;
            $this -> apellido = $apellido;
            $this -> dni = $dni;
            $this -> fdn = $fdn;
            $this -> email = $email;
            $this -> contra = $contra;
            $this -> intereses = array();
            $this -> plan = $plan;
            $this -> rol = $rol;
            $this -> antec = $antec;
            $this -> fotoperfil = $fotoperfil;
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