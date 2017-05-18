<?php 

include'../../autoload.php';
include'../../session.php';
$id           =  $_POST['id'];
$subot        =  $_POST['subot'];
$cantidad     =  $_POST['cantidad'];
$entrega      =  $_POST['entrega'];
$saldo        =  $_POST['saldo'];
$fechainicio  =  $_POST['fechainicio'];
$fechafin     =  $_POST['fechafin'];
$notaingreso  =  $_POST['notaingreso'];
$tipo_entrega =  $_POST['tipo_entrega'];
$status       =  $_POST['status'];
$tipo_ot      =  $_POST['tipo_ot'];
$tipo_proceso =  $_POST['tipo_proceso'];

foreach ($id as $key => $valueid) 
{  
   $valuesubot         = $subot[$key];
   $valuecantidad      = $cantidad[$key];
   $valueentrega       = $entrega[$key];
   $valuesaldo         = $saldo[$key];
   $valuefechainicio   = date_format(date_create($fechainicio[$key]), FECHA);
   $valuefechafin      = date_format(date_create($fechafin[$key]), FECHA);
   $valuenotaingreso   = $notaingreso[$key];
   $valuetipo_entrega  = $tipo_entrega[$key];
   $valuestatus        = $status[$key];
   $valuetipo_ot       = $tipo_ot[$key];
   $valuetipo_proceso  = $tipo_proceso[$key];

   $cencosot  =  new Cencosot();
   $valor = $cencosot->actualizar_subot($valueid,$valuesubot,$valuecantidad,$valueentrega,$valuesaldo,$valuefechainicio,$valuefechafin,$valuenotaingreso,$valuetipo_entrega,$valuestatus,$valuetipo_ot,$valuetipo_proceso);

	if ($valor == 'ok')  
	{
	echo '<script>
	swal({
	title: "Buen Trabajo",
	text: "Lista de Sub Ot Actualizadas",
	type:"success",
	timer: 2000,
	showConfirmButton: false
	});
	</script>';
	}
	else
	{
	echo '<script>
	swal({
	title: "Error de Actualización",
	text: "Consulte al área de Soporte",
	type:"danger",
	timer: 2000,
	showConfirmButton: false
	});
	</script>';
	}

}

 ?>