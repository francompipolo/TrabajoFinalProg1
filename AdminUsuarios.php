<?php

require_once 'nuevaTarea.php';
session_start();
if( $_SESSION['admin'] == null || $_SESSION['admin'] == 0){
	header("location: index.php");
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
 
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tareas</title>
   
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
   <!-- plugin de tiempo-->

	<script src="js/bootstrap-datepicker.min.js" charset="utf-8" ></script>
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

	<style>
		.content {
			margin-top: 80px;
		}
	</style>
 
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.3/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Hola <?php echo $_SESSION['nombre'];?>, estos son los usuarios:
  </a>

   <?php if ($_SESSION['admin']==1) { echo '<a class="nav-item nav-link active" href="AdminUsuarios.php">Administrar usuarios <span class="sr-only">(current)</span></a>';} ?>
   <a class="nav-item nav-link active" href="index.php">Volver a inicio <span class="sr-only">(current)</span></a>
   <a class="nav-item nav-link active" href="logout.php">Cerrar Sesion <span class="sr-only">(current)</span></a>
</nav>
	<div class="container">
		<div class="content">

<center>    
          <h2>Usuarios</h2>

      <div class="table-responsive">
      <table class="table table-striped table-hover">
        <tr>
          <th>Usuario</th>
          <th>Nombre</th>
          <th>Ultimo Ingreso</th>
          <th>Admin</th>
          <th>Estado</th>
          <th>Modificar</th>


        </tr>

         <?php 

                 $trA= new NuevaTarea();
                 $tareas2= $trA->getAllUsuarios();

                 foreach ($tareas2 as $otrasTareas2) {
                       echo '<tr>';
                         echo '<td>' . $otrasTareas2->getMail() . '</td>';
                          echo '<td>' . $otrasTareas2->getNombre() . '</td>';
                           echo '<td>' . $otrasTareas2->getUltimoIngreso() . '</td>';
                            if( $otrasTareas2->getAdmin()==0){echo '<td><span class="badge badge-secondary">Usuario Normal</span></td>'; }else{echo '<td><span class="badge badge badge-success"">Usuario Admin</span></td>';}

                            if( $otrasTareas2->getActivo()==0){echo '<td><span class="badge badge-secondary">Inactivo</span></td>'; }else{echo '<td><span class="badge badge badge-success"">Activo</span></td>';}

                            echo '<td><a  href="" type="button" class="btn"><i  class="fa fa-pencil" aria-hidden="true"></i><a  href="" type="button" class="btn"><i  class="fa fa-trash" aria-hidden="true"></i></td>';

                         
                        



                      



                 }  ?>
                        
        
      </table>
      </div>
    </div>
  </div>
</center> 

</body>
</html>
