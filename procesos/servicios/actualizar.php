<?php 

include '../../autoload.php';
include '../../session.php';

$ot      =  addslashes(trim($_POST['ot']));
$subot   =  $_POST['subot'];
$ni      =  $_POST['ni'];
$os      =  addslashes(trim($_POST['os']));

foreach ($subot as $key => $valuesubot) 
{
    $valueni  = $ni[$key];
   
    $servicios  = new Servicios();
    $valor      = $servicios->agregar($ot,$valuesubot,$valueni,$os);
    if ($valor == 'actualizado')  
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
    else if ($valor == 'ok')  
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