<?php 

  class verUsuario {

    
    private $nombre;
    private $mail;
    private $ultimoingreso;
    private $admin;
    private $activo;

    public function __construct($un,$um,$ui,$uadm,$uac){

        $this->nombre=$un;
        $this->mail=$um;
        $this->ultimoingreso=$ui;
        $this->admin=$uadm;
        $this->activo=$uac;
    }

    public function getNombre() { return $this->nombre;}
    public function getMail() { return $this->mail;}
    public function getUltimoIngreso() { return $this->ultimoingreso;}
    public function getAdmin() { return $this->admin;}
    public function getActivo() { return $this->activo;}

    
  }
 ?>