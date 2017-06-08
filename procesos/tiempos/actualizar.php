<?php 

include '../../autoload.php';
include '../../session.php';

$tiempos    = new Tiempos();
$funciones  = new Funciones();

$id         = $funciones->validar_xss($_POST['id']);
$subot      = $funciones->validar_xss($_POST['subot']);


$valor      = $tiempos->actualizar($id,$subot);

 if ($valor == 'ok')  
	{
	echo '<script>
	swal({
	title: "Buen Trabajo",
	text: "SUB OT Actualizada",
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


 ?>