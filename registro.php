<?php

require_once "bd.php";
require_once 'usuario.php';

Class Registro extends BD{

  public function CrearRegistro(Usuario $u){
    
    if(is_null(self::$conexion)) {
            return "Error al registrar el usuario";
    }


     $t = self::$conexion->prepare('Select * FROM usuarios where mail= ?');
    
     $datos=[$u->getMail()];

     $t->execute($datos);

     

     if($t->rowCount()){

      return "El email ya esta registrado";

     }else{

    try{

      self::$conexion->beginTransaction();

      $insercion = self::$conexion->prepare("INSERT INTO usuarios(nombre,mail,clave) VALUES (?, ?, ?);");
      
      $pass=password_hash($u->getClave(), PASSWORD_BCRYPT);

      $datos = [$u->getNombre(), $u->getMail(), $pass];
    
      $insercion->execute($datos);

  	  self::$conexion->commit();
    
    return "El usuario fue agregado!";
   

	}catch(PDOException $e){
   
      self::$conexion->rollback();
            
      return "Error al agregar el usuario . " . self::$error_conexion . " " . $e->getMessage();		

    
	}
   
   }

  }



}

