<?php 

include('../../autoload.php');
include('../../session.php');


$id              = addslashes($_POST['id']);
$cant_inicial    = addslashes($_POST['cant_inicial']);
$cant_final      = addslashes($_POST['cant_final']);

$horometrodiario = new Horometrodiario(date(FECHA),'?',$cant_inicial,$cant_final);
$valor           = $horometrodiario->actualizar($id);

    
    if ($valor == 'existe')  
	{
	echo '<script>
	swal({
	title: "Buen Trabajo",
	text: "Registro Actualizado",
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
	text: "Registro  Actualizado",
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