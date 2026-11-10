<?php
    class Solicitud_p {
        //A
        private $id;
        private $id_solicita;
        private $id_administrador;
        private $texto;
        private $comprobante;
        private $fde;
        private $fdv;
        private $estado;
        //C
        public function __construct (
            $id_solicita, $texto, $comprobante, $fde,
            $fdv = null, $estado = "pendiente", $id = null, $id_administrador = null
            ) {
            $this -> id_solicita = $id_solicita;
            $this -> texto = $texto;
            $this -> comprobante = $comprobante;
            $this -> fde = $fde;
            $this -> fdv = $fdv;
            $this -> estado = $estado;
            $this -> id = $id;
            $this -> id_administrador = $id_administrador;
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