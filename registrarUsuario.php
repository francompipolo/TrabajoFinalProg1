<?php
require_once 'usuario.php';
require_once 'registro.php';


    $nombre=$_POST['nombre'];
    $mail=$_POST['mail'];
    $clave=$_POST['password'];

    $u= new Usuario($nombre,$mail,$clave);


    $r= new Registro();
    echo $r->CrearRegistro($u);
    

  ?>