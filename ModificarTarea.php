<?php
require_once 'tarea.php';
require_once 'nuevaTarea.php';

session_start();

$id=$_SESSION['id'];
$tareaText=$_POST['tareaText'];
$tareaEtiqueta=$_POST['tareaEtiqueta'];
$tareaEstado=$_POST['tareaEstado'];

if($_POST['tareaAlarma']==""){
$tareaAlarma=null;
}else{
$tareaAlarma=$_POST['tareaAlarma'];	
}


$t= new Tarea($id,$tareaText,$tareaEtiqueta,$tareaEstado,$tareaAlarma);

$nT= new NuevaTarea();
echo $nT->ModificarTarea($t);
