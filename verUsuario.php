<?php 

  class verUsuario {

    private $id;
    private $nombre;
    private $mail;
    private $ultimoingreso;
    private $admin;
    private $activo;

    public function __construct($uid,$un,$um,$ui,$uadm,$uac){

        $this->id=$uid;   
        $this->nombre=$un;
        $this->mail=$um;
        $this->ultimoingreso=$ui;
        $this->admin=$uadm;
        $this->activo=$uac;
    }
    public function getId() { return $this->id;}
    public function getNombre() { return $this->nombre;}
    public function getMail() { return $this->mail;}
    public function getUltimoIngreso() { return $this->ultimoingreso;}
    public function getAdmin() { return $this->admin;}
    public function getActivo() { return $this->activo;}

    
  }
 ?>