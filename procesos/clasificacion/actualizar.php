<?php

include('../../autoload.php');  		

$id              = addslashes(trim($_POST['id']));
$nombre          = addslashes(trim($_POST['nombre']));
$detalle         = addslashes(trim($_POST['detalle']));
$abrv            = addslashes(trim($_POST['abrv']));
$asistencia      = addslashes(trim($_POST['asistencia']));
$tipo_stand_by   = addslashes(trim($_POST['tipo_stand_by']));

$clasificacion   = new Clasificacion($nombre,$detalle,$abrv,$asistencia,$tipo_stand_by); 

$valor     = $clasificacion -> actualizar($id);

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