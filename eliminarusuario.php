<?php
require_once 'nuevatarea.php';
$id = $_GET['e'];

$t= new NuevaTarea();

$t->eliminarUsuario($id);

