<?php
require_once "bd.php";
require_once "tarea.php";
require_once "verUsuario.php";
class NuevaTarea extends BD{

   public function crearTarea(Tarea $t){


    self::$conexion->beginTransaction();

      $insercion = self::$conexion->prepare("INSERT INTO Tareas(texto,etiquetas,fecha_alarma,fecha_creacion,id_usuario,estados_id) VALUES (?, ?, ? ,? ,? ,? );");
    
      $dia =date("Y/m/d");
      $datosTarea = [$t->getTareaText(), $t->getTareaEtiqueta(),$t->getTareaAlarma(),$dia,$t->getId(),$t->getTareaEstado()];
    
      $insercion->execute($datosTarea);

  	  self::$conexion->commit();
    
    header("location: index.php");


   }

   public function getAll(){

    $e = [];
   	$sql = "Select * FROM tareas where id_usuario=".$_SESSION['id']." and fecha_alarma is null";
    $r = self::$conexion->query($sql, PDO::FETCH_ASSOC);
   
    while ( $fila = $r->fetch() ) {
                // Creamos un nuevo objeto de clase Equipo y lo agregamos al
                // array $e:
                $e[] = new Tarea($fila['id'],$fila['texto'],$fila['etiquetas'], $fila['estados_id'],$fila['fecha_alarma']);

            }

            return $e;


   }

   public function getAllAlarma(){

    $e = [];
   	$sql = "Select * FROM tareas where id_usuario=".$_SESSION['id']." and fecha_alarma is not null ORDER BY fecha_alarma ASC";
    $r = self::$conexion->query($sql, PDO::FETCH_ASSOC);
   
    while ( $fila = $r->fetch() ) {
                // Creamos un nuevo objeto de clase Equipo y lo agregamos al
                // array $e:
                $e[] = new Tarea($fila['id'],$fila['texto'],$fila['etiquetas'], $fila['estados_id'],$fila['fecha_alarma']);

            }

            return $e;


   }

      public function getAllAlarmahoy(){

    $dia=date("y/m/d");
    
    $e = [];
   	$sql = "Select * FROM tareas where id_usuario=".$_SESSION['id']." and fecha_alarma <= '".$dia."'  ORDER BY fecha_alarma ASC";
    $r = self::$conexion->query($sql, PDO::FETCH_ASSOC);
   
    while ( $fila = $r->fetch() ) {
                // Creamos un nuevo objeto de clase Equipo y lo agregamos al
                // array $e:
                $e[] = new Tarea($fila['id'],$fila['texto'],$fila['etiquetas'], $fila['estados_id'],$fila['fecha_alarma']);

            }

            return $e;


   }

   public function getAllUsuarios(){

    $e = [];
   	$sql = "Select * FROM usuarios";
    $r = self::$conexion->query($sql, PDO::FETCH_ASSOC);
   
    while ( $fila = $r->fetch() ) {
                // Creamos un nuevo objeto de clase Equipo y lo agregamos al
                // array $e:
                $e[] = new verUsuario($fila['nombre'],$fila['mail'],$fila['ultimo_ingreso'], $fila['es_administrador'],$fila['activo']);

            }

            return $e;


   }



   public function eliminarTarea($id)
   {
   	$sql = "DELETE FROM tareas where id= $id ";
    $r = self::$conexion->query($sql);
    header("location: index.php");
   }



}