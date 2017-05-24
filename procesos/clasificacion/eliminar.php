<?php

include('../../autoload.php');
include '../../session.php';          

$funciones = new Funciones();

$id              = $funciones->validar_xss($_POST['id']);
$clasificacion   = new Clasificacion('?','?','?','?','?'); 

$valor           = $clasificacion -> eliminar($id);

 if ($valor == 'ok')  
{
echo '<script>
    swal({
    title: "Buen Trabajo",
    text:  "Registro Eliminado",
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
    

?>