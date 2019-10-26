<?php 
   
  class UsuarioDatos {

    private $mail;
    private $clave;

    public function __construct($ml,$pass){


        $this->mail = $ml;
        $this->clave = $pass;
    
    }
    //gettings
    
    public function getMail() { return $this->mail;}

    public function getClave() { return $this->clave;}
    
  }
 ?>