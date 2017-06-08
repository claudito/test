<?php 

include '../../autoload.php';
include '../../session.php';

$item   = $_POST['item'];
$ot     = $_POST['ot'];
$subot  = $_POST['subot'];
$ni     = $_POST['ni'];


foreach ($item as $key => $value) 
{   
    $valueot    = $ot[$key];
    $valuesubot = $subot[$key];
  
    $consumos = new Consumos();
    $valor    = $consumos->agregar($value,$valueot,$valuesubot,$ni);
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