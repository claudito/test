<?php 

include('../../autoload.php');
include('../../session.php');



$fechainicio             =   $_POST['fechainicio'];
$fechafin                =   $_POST['fechafin'];

$_SESSION['fechainicio_consumo'] = $fechainicio;
$_SESSION['fechafin_consumo']    = $fechafin;


 ?>