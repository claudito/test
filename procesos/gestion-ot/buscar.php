<?php 

include '../../autoload.php';
include '../../session.php';

$fechainicio                = $_POST['fechainicio'];
$fechafin                   = $_POST['fechafin'];
$estado                     = (empty($_POST['estado'])) ? "'ACTIVO','LIQUIDADO'" : $_POST['estado'] ;

$_SESSION['fechainicionot'] = $fechainicio;
$_SESSION['fechafinot']     = $fechafin;
$_SESSION['estadoot']       = $estado;

 ?>