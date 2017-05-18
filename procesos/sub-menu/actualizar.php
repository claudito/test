<?php

include('../../autoload.php');  		

$id        = addslashes(trim($_POST['id']));
$nombre    = addslashes(trim($_POST['submenu']));
$idmenu    = addslashes(trim($_POST['menu']));
$url       = addslashes(trim($_POST['url']));
$item      = addslashes(trim($_POST['item']));
$submenu   = new Submenu($nombre,$idmenu,$url,$item); 

$valor     = $submenu -> actualizar($id);

 if ($valor == 'ok')  
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
    

?>