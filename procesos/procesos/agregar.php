<?php

include('../../autoload.php');          

$nombre        = addslashes(trim($_POST['nombre']));
$detalle       = addslashes(trim($_POST['detalle']));
$facturable    = addslashes(trim($_POST['facturable']));
$productivo    = addslashes(trim($_POST['productivo']));
$tipo_stand_by = addslashes(trim($_POST['tipo_stand_by']));
$procesos      = new Procesos($nombre,$detalle,$facturable,$productivo,$tipo_stand_by); 

$valor     = $procesos -> agregar();

 if ($valor == 'existe')  
{
echo '<script>
    swal({
    title: "Código Duplicado",
    text: "Verifique porfavor",
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
    text: "Registro Exitoso",
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
    title: "Error de Registro",
    text: "Consulte al área de Soporte",
    type:"danger",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}
    

?>