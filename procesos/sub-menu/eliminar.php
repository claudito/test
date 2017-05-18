<?php

include('../../autoload.php');  		

$id        = addslashes(trim($_POST['id']));
$submenu   = new Submenu('?','?','?','?'); 
$valor     = $submenu -> eliminar($id);

if ($valor == 'existe') 
{
echo '<script>
    swal({
    title: "No se puede Eliminar",
    text: "El Menú ya tiene asociados Sub Menús",
    type:"warning",
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
    title: "Error de Eliminacion",
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
    

?>