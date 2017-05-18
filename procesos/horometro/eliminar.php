<?php 

include('../../autoload.php');


if (empty($_POST['id'])) 
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

$horometro = new Horometro('?','?',$horas_hombre,$horas_maquina);
$valor = $horometro -> eliminar($id);
 
if ($valor == 'ok')  
{
echo '<script>
    swal({
    title: "Buen Trabajo",
    text: "Eliminación Exitosa",
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
    title: "Error de Eliminación",
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
    title: "Error de Eliminación",
    text: "Consulte al área de Soporte",
    type:"danger",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}
    



}





 ?>