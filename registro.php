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

      return'<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<link rel="stylesheet" href="css/estilos.css">
<title>
ERROR!
</title>
</head>
<body  class="p-3 mb-2 bg-dark text-white">

<div class="container">
<div class="abs-center">

<form class="rounded border border-info login p-3 mb-2 bg-info text-white">
<center>
<label>El email ya esta registrado!</label>
<br>
<a href="registro.html"><input type="button" value="Volver" class="btn btn-secondary"></a>

</center>  


</form>

</div>
</div>

</body>
</html>';

     }else{

    try{

      self::$conexion->beginTransaction();

      $insercion = self::$conexion->prepare("INSERT INTO usuarios(nombre,mail,clave) VALUES (?, ?, ?);");
      
      $pass=password_hash($u->getClave(), PASSWORD_BCRYPT);

      $datos = [$u->getNombre(), $u->getMail(), $pass];
    
      $insercion->execute($datos);

  	  self::$conexion->commit();
    
return'<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<link rel="stylesheet" href="css/estilos.css">
<title>
ERROR!
</title>
</head>
<body  class="p-3 mb-2 bg-dark text-white">

<div class="container">
<div class="abs-center">

<form class="rounded border border-info login p-3 mb-2 bg-info text-white">
<center>
<label>El usuario fue correctamente añadido!</label>
<br>
<a href="login.html"><input type="button" value="Loguearse" class="btn btn-secondary"></a>

</center>  


</form>

</div>
</div>

</body>
</html>';
   

	}catch(PDOException $e){
   
      self::$conexion->rollback();
            
      return "Error al agregar el usuario . " . self::$error_conexion . " " . $e->getMessage();		

    
	}
   
   }

  }



}

