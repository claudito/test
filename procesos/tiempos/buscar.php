<?php 

include('../../autoload.php');
include('../../session.php');

$funciones = new Funciones();

$fecha       = $_POST['fecha'];
$fechainicio =  $funciones->first_day_mes($fecha);
$fechafin    =  $funciones->last_day_mes($fecha);

$anio        = substr($fecha, 0,4);
$mes         = intval(substr($fecha, 5,7));

$_SESSION['fecha_tiempos']       = $fecha;
$_SESSION['fechainicio_tiempos'] = $fechainicio;
$_SESSION['fechafin_tiempos']    = $fechafin;
$_SESSION['anio_tiempos']        = $anio;
$_SESSION['mes_tiempos']         = $mes;




 ?>