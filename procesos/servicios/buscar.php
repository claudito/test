<?php 

include('../../autoload.php');
include('../../session.php');



$fechainicio             =   $_POST['fechainicio'];
$fechafin                =   $_POST['fechafin'];

$_SESSION['fechainicio_servicio'] = $fechainicio;
$_SESSION['fechafin_servicio']    = $fechafin;



 ?>