<?php

require_once 'nuevaTarea.php';
session_start();
if( $_SESSION['id'] == null || $_SESSION['id'] == ""){
	header("location: login.html");
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
    Hola <?php echo $_SESSION['nombre'];?>, estas son tus tareas:
  </a>

   <?php if ($_SESSION['admin']==1) { echo '<a class="nav-item nav-link active" href="AdminUsuarios.php">Administrar usuarios <span class="sr-only">(current)</span></a>';} ?>
   <a class="nav-item nav-link active" href="logout.php">Cerrar Sesion <span class="sr-only">(current)</span></a>
</nav>
	<div class="container">
		<div class="content">
<center>    
	        <h2>Alarmas</h2>

			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th style="display:none;" >ID</th>
                    <th>Tarea</th>
					<th>Estado</th>
					<th>Etiqueta</th>
                    <th>Fecha de Alarma</th>
                    <th>Modificar</th>

				</tr>
				 <?php 

                 $trA= new NuevaTarea();
                 $tareas2= $trA->getAllAlarmahoy();

                 foreach ($tareas2 as $otrasTareas2) {
                 	     echo '<tr>';
                 	     echo '<td style="display:none;">' .$otrasTareas->getid() . '</td>';
                         echo '<td>' . $otrasTareas2->getTareaText() . '</td>';


                         if($otrasTareas2->getTareaestado()==1){echo '<td><span class="badge badge-secondary">Pendiente</span></td>'; }
                         if($otrasTareas2->getTareaestado()==2){echo '<td><span class="badge badge badge-success"">Activa</span></td>'; }



                         echo '<td>' . $otrasTareas2->getTareaetiqueta() . '</td>';
                         echo '<td>' . $otrasTareas2->getTareaAlarma() . '</td>';

                         $idtarea= "eliminartarea.php?e=" . $otrasTareas2->getid();
                         echo '<td><a  href='.$idtarea.' type="button" class="btn"><i  class="fa fa-trash" aria-hidden="true"></i></td>';
                         echo '</tr>';




                 }  ?>

                        
 				
			</table>
			</div>
		</div>
	</div>
</center>

<div class="container">
		<div class="content">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Agregar Tarea
</button>			
<center>    
	        <h3>Tareas Pendientes</h3>





<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
       <form action="registroTarea.php" method="post">

        <input type="text" class="form-control" required="true" name="tareaText" placeholder="Escriba la tarea a hacer * (Requerido)">         
       	<br> 
       	<input type="text" class="form-control" name="tareaEtiqueta" placeholder="Etiquetas (Opcional)">         
       	<br>
        <select required class="form-control"  name="tareaEstado" id="exampleFormControlSelect1">
        
        <option selected disabled value="">Seleccione el estado de la tarea</option>

        <option value="1">Pendiente</option>
        <option value="2">Activa</option>
        
        </select>
        
        <br>

        <input type="text" name="tareaAlarma" placeholder="Ingrese horario de la alarma (Opcional)" class="form-control  fj-date" readonly>

        <script>
       $('.fj-date').datepicker({

        format: "yyyy-mm-dd",
        startDate: "-today",
        todayBtn: "linked",
        clearBtn: true,
        language: "es"

       });
       </script>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Agregar </button>
      </div>

      </form>
    </div>
  </div>
</div>
            






			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr> 
					<th style="display:none;">ID</th>
                    <th>Tarea</th>
					<th>Estado</th>
					<th>Etiqueta</th>
					<th>Modificar</th>

				</tr>

                <?php

                 $tr= new NuevaTarea();
                 $tareas= $tr->getAll();

                 ?>
                 
                 <?php foreach ($tareas as $otrasTareas) {
                 	     echo '<tr>';
                 	     echo '<td style="display:none;">' .$otrasTareas->getid() . '</td>';
                         echo '<td>' . $otrasTareas->getTareaText() . '</td>';
                         if($otrasTareas->getTareaestado()==1){echo '<td><span class="badge badge-secondary">Pendiente</span></td>'; }
                         if($otrasTareas->getTareaestado()==2){echo '<td><span class="badge badge badge-success"">Activa</span></td>'; }

                         echo '<td>' . $otrasTareas->getTareaetiqueta() . '</td>';
                         $idtarea= "eliminartarea.php?e=" . $otrasTareas->getid();
                         echo '<td><a type="button" class="btn editboton"><i  class="fa fa-pencil" aria-hidden="true"></i><a  href='.$idtarea.' type="button" class="btn"><i  class="fa fa-trash" aria-hidden="true"></i></td>';
                         

                         echo '</tr>';




                 }  ?>
		
			</table>
			</div>
		</div>
	</div>
</center>




<!-- ############################################################################### modal en el loop ############################################### -->

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modificar Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
       <form action="ModificarTarea.php" method="post">

        <input type="text" class="form-control" required="true" id="tareahacer" name="tareaText" placeholder="Escriba la tarea a hacer * (Requerido)">         
       	<br> 
       	<input type="text" class="form-control" name="tareaEtiqueta"id="tareaetiqueta" placeholder="Etiquetas (Opcional)">         
       	<br>
        <select required class="form-control"  name="tareaEstado" id="tareaestado">
        
        <option selected disabled value="">Seleccione el estado de la tarea</option>

        <option value="1">Pendiente</option>
        <option value="2">Activa</option>
        
        </select>
        
        <br>

        <input type="text" name="tareaAlarma" id="tareaalarma" placeholder="Ingrese horario de la alarma (Opcional)" class="form-control  fj-date" readonly>

        <script>
       $('.fj-date').datepicker({

        format: "yyyy-mm-dd",
        startDate: "-today",
        todayBtn: "linked",
        clearBtn: true,
        language: "es"

       });
       </script>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios </button>
      </div>

      </form>
    </div>
  </div>
</div>


<script>
	
	$(document).ready(function () {

		$('.editboton').on("click",function(){
              

 			$('#editmodal').modal('show');

 
            $tr = $(this).closest('tr'); 

 			var data =$tr.children("td").map(function(){

 				return $(this).text();

 			}).get();
             $('#idtarea').val(data[0]);
 			$('#tareahacer').val(data[1]);
 			$('#tareaetiqueta').val(data[3]);
 			$('#tareaestado').val(data[2]);
 			$('#tareaalarma').val(data[4]);



		});

	});


</script>


<!-- ############################################################################### modal en el loop ############################################### -->








<div class="container">
		<div class="content">
<center>    
	        <h3>Tareas pendientes con alarmas</h3>

			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>Tarea</th>
					<th>Estado</th>
					<th>Etiqueta</th>
                    <th>Fecha de Alarma</th>
                    <th>Modificar</th>

				</tr>

                 <?php 

                 $trA= new NuevaTarea();
                 $tareas2= $trA->getAllAlarma();

                 foreach ($tareas2 as $otrasTareas2) {
                 	     echo '<tr>';
                         echo '<td>' . $otrasTareas2->getTareaText() . '</td>';


                         if($otrasTareas2->getTareaestado()==1){echo '<td><span class="badge badge-secondary">Pendiente</span></td>'; }
                         if($otrasTareas2->getTareaestado()==2){echo '<td><span class="badge badge badge-success"">Activa</span></td>'; }



                         echo '<td>' . $otrasTareas2->getTareaetiqueta() . '</td>';
                         echo '<td>' . $otrasTareas2->getTareaAlarma() . '</td>';
                         $idtarea= "eliminartarea.php?e=" . $otrasTareas2->getid();
                         echo '<td><a  type="button" class="btn editboton"><i  class="fa fa-pencil" aria-hidden="true"></i><a  href='.$idtarea.' type="button" class="btn"><i  class="fa fa-trash" aria-hidden="true"></i></td>';
                         echo '</tr>';




                 }  ?>


				
			</table>
			</div>
		</div>
	</div>
</center>

</body>
</html>
