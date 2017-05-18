<?php 

include'../../autoload.php';
include'../../session.php';

$id  =  addslashes(trim($_POST['id']));

$cencosot  = new Cencosot();

$valor = $cencosot->eliminar_subot($id);

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