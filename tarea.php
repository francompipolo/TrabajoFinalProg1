<?php 

  class Tarea {

    private $id; 
    private $tareaText;
    private $tareaEtiqueta;
    private $tareaEstado;
    private $tareaAlarma;

    public function __construct($tId,$tText,$tEti,$tEst,$tAlarm){

        $this->id=$tId;
        $this->tareaText=$tText;
        $this->tareaEtiqueta=$tEti;
        $this->tareaEstado=$tEst;
        $this->tareaAlarma=$tAlarm;
    }

    public function getId() { return $this->id;}
    public function getTareaText() { return $this->tareaText;}
    public function getTareaEtiqueta() { return $this->tareaEtiqueta;}
    public function getTareaEstado() { return $this->tareaEstado;}
    public function getTareaAlarma() { return $this->tareaAlarma;}

    
  }
 ?>