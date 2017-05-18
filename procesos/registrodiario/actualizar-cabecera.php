<?php 

include('../../autoload.php');
include('../../session.php');


$fechatrabajo    = date_format(date_create($_POST['fechatrabajo']), FECHA); 
$fechaproduccion = date_format(date_create($_POST['fechaproduccion']), FECHA); 
$maquina         = addslashes(trim($_POST['maquina']));
$turno           = addslashes(trim($_POST['turno']));
$usuario         = $_SESSION[KEY.USUARIO];


$registrodiario_cab  = new Registrodiario_cab($fechatrabajo,$fechaproduccion,$maquina,$turno,$usuario);

$valor = $registrodiario_cab->agregar();


if ($valor=='ok')
 {
	 echo "
     <meta charset='UTF-8'>
	 <script>
	 alert('Actualización Exitosa');
     window.location='".PATH."pages/registro-diario';
	 </script>";
} 
else
 {
	 echo "
     <meta charset='UTF-8'>
	 <script>
	 alert('Error de Registro');
     window.location='".PATH."pages/registro-diario';
	 </script>";
}






 ?>