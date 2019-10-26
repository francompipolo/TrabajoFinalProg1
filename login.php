<?php
require_once "bd.php";
require_once 'usuariodatos.php';

class Login extends BD{

  public function loguear(UsuarioDatos $u){

     if(is_null(self::$conexion)) {
            return "Error al Loguear el usuario";
     }

  	 $t = self::$conexion->prepare('Select * FROM usuarios where mail= ?');
    
     $datos=[$u->getMail()];

     $t->execute($datos);

     $array= $t->fetch(PDO::FETCH_ASSOC);

     if($t->rowCount()){
     
     $clave1=$array['clave'];
     $clave0=$u->getClave();

     if (password_verify($clave0,$clave1)) {
    
     session_start();
     $_SESSION['id']  = $array['id'];
     
     $_SESSION['admin']  = $array['es_administrador'];


     $id= $t->fetch(PDO::FETCH_OBJ)->mail;

     $_SESSION['nombre']  = $array['nombre'];

      self::UltimoIngreso();
       
      header("location: index.php");
     } else {
      echo 'La contraseña no es válida.';
     }
     



     }else{
      return "El usuario no existe.";
     }

  }

  public function logout(){
  	
      session_start();
      session_destroy();
      header("location: login.html");      
      
  }
   
   public function UltimoIngreso(){

     $ultimodia = self::$conexion->prepare('update usuarios set ultimo_ingreso=? WHERE id= ? ');

     $dia= date("y/m/d");

     $id= $_SESSION['id'];
     
     $datosdia=[$dia,$id];

     $ultimodia->execute($datosdia);

   }
}