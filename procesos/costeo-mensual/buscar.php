<?php 

include('../../autoload.php');
include('../../session.php');



$fechainicio             =   $_POST['fechainicio'];
$fechafin                =   $_POST['fechafin'];

$_SESSION['fechainicio_costeomensual'] = $fechainicio;
$_SESSION['fechafin_costeomensual']    = $fechafin;


 ?>