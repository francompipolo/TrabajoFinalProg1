<?php 

  class Usuario {

    private $nombre;
    private $mail;
    private $clave;

    public function __construct($nmb,$ml,$pass){

        $this->nombre = $nmb;
        $this->mail = $ml;
        $this->clave = $pass;
    
    }

    public function getNombre() { return $this->nombre;}
    public function getMail() { return $this->mail;}
    public function getClave() { return $this->clave;}
    
  }
 ?>