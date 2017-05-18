<?php

include('../../autoload.php');  		

$nombre = addslashes(trim($_POST['nombre']));
$item = addslashes(trim($_POST['item']));
$id     = addslashes(trim($_POST['id']));
$menu   = new Menu($nombre,$item); 
$valor  = $menu -> actualizar($id);

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