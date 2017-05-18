<?php

include('../../autoload.php');  		

$id                 =  addslashes(trim($_POST['id']));
$codigo             = addslashes(trim($_POST['codigo']));
$hora_ingreso       = addslashes(trim($_POST['hora_ingreso']));
$salida_refrigerio  = addslashes(trim($_POST['salida_refrigerio']));
$ingreso_refrigerio = addslashes(trim($_POST['ingreso_refrigerio']));
$hora_salida        = addslashes(trim($_POST['hora_salida']));


$turnos = new Turnos($codigo,$hora_ingreso,$salida_refrigerio,$ingreso_refrigerio,$hora_salida);
$valor  = $turnos -> actualizar($id);

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