<?php 

include('../../autoload.php');


if (empty($_POST['id']) || empty($_POST['descripcion'])) 
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
$descripcion   = addslashes(utf8_decode($_POST['descripcion']));

$tipomaquina  = new Tipomaquina($descripcion);
$valor = $tipomaquina -> actualizar($id);

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
    title: "Error de Actualización",
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