<?php
require_once 'usuariodatos.php';
require_once 'login.php';


    $mail=$_POST['mail'];
    $clave=$_POST['password'];

    $u= new UsuarioDatos($mail,$clave);
    
    $r= new Login();
    echo $r->loguear($u);
    

  ?>