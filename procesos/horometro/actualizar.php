<?php 

include('../../autoload.php');


if (empty($_POST['id']) || empty($_POST['horas_hombre']) || empty($_POST['horas_maquina'])) 
{
	echo '<script>
    swal({
    title: "Algún registro esta vació",
    text: "Verifique de nuevo",
    type:"warning",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}
else
{

$id            = $_POST['id'];
$horas_hombre  = $_POST['horas_hombre'];
$horas_maquina = $_POST['horas_maquina'];


$horometro = new Horometro('?','?',$horas_hombre,$horas_maquina);
$valor = $horometro -> actualizar($id);
 
if ($valor == 'ok')  
{
echo '<script>
    swal({
    title: "Buen Trabajo",
    text: "Actualización Exitosa",
    type:"success",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}
else if ($valor == 'error')  
{
echo '<script>
    swal({
    title: "Error de Actualización ",
    text: "Consulte al área de Soporte",
    type:"danger",
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