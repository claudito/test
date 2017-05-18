<?php 

include('../../autoload.php');
include('../../session.php');


$fecha  = date_format(date_create($_POST['fecha']), FECHA);

$_SESSION['fecha_horometro'] = $fecha;


$maquina = new Maquina('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');

foreach ($maquina->lista() as $key => $value) 
{
	$horometrodiario = new Horometrodiario($fecha,$value['ID'],0,0);
	$valor           = $horometrodiario->agregar();

    
    if ($valor == 'existe')  
	{
	echo '<script>
	swal({
	title: "Buen Trabajo",
	text: "Lista Actualizada",
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
	text: "Lista Actualizada",
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