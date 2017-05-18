<?php

include('../../autoload.php');  		

$codigo             = addslashes(trim($_POST['codigo']));
$hora_ingreso       = addslashes(trim($_POST['hora_ingreso']));
$salida_refrigerio  = addslashes(trim($_POST['salida_refrigerio']));
$ingreso_refrigerio = addslashes(trim($_POST['ingreso_refrigerio']));
$hora_salida        = addslashes(trim($_POST['hora_salida']));


$turnos = new Turnos($codigo,$hora_ingreso,$salida_refrigerio,$ingreso_refrigerio,$hora_salida);
$valor  = $turnos -> agregar();

if ($valor == 'existe') 
{
echo '<script>
    swal({
    title: "Registro Dupiclado",
    text: "Verifique de nuevo",
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
else if ($valor == 'error')  
{
echo '<script>
    swal({
    title: "Error de Registro ",
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
    title: "Error de Registro ",
    text: "Consulte al área de Soporte",
    type:"danger",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}
    

?>