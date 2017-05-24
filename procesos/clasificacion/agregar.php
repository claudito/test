<?php

include('../../autoload.php');
include '../../session.php';

$funciones = new Funciones();     

$nombre          = $funciones->validar_xss($_POST['nombre']);
$detalle         = $funciones->validar_xss($_POST['detalle']);
$abrv            = $funciones->validar_xss($_POST['abrv']);
$asistencia      = $funciones->validar_xss($_POST['asistencia']);
$tipo_stand_by   = $funciones->validar_xss($_POST['tipo_stand_by']);

$clasificacion   = new Clasificacion($nombre,$detalle,$abrv,$asistencia,$tipo_stand_by); 

$valor     = $clasificacion -> agregar();

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