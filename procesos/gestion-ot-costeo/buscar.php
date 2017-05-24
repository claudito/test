<?php 

include '../../autoload.php';
include '../../session.php';

$fechainicio               = $_POST['fechainicio'];
$fechafin                  = $_POST['fechafin'];

$_SESSION['fechainiciocosteo'] = $fechainicio;
$_SESSION['fechafincosteo']     = $fechafin;

 ?>