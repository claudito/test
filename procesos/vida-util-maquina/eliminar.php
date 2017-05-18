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

$vidautilmaquina  = new Vidautilmaquina('?','?','?','?');
$valor = $vidautilmaquina -> eliminar($id);

if ($valor == 'ok')  
{
echo '<script>
    swal({
    title: "Buen Trabajo",
    text: "Registro Eliminado",
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
    title: "Error al Eliminar",
    text: "Revise de porfavor.",
    type:"error",
    timer: 2000,
    showConfirmButton: false
    });
    </script>';
}
else
{
echo '<script>
    swal({
    title: "Error al Eliminar",
    text: "Revise de porfavor.",
    type:"error",
    timer: 2000,
    showConfirmButton: false
    });
    </script>';
}
    



}





 ?>