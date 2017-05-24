<?php 

include '../../autoload.php';
include '../../session.php';

$cencostot = new Cencosot();
$funciones = new Funciones();

$subot     =  $funciones->validar_xss($_POST['subot']);
$cantidad  =  $funciones->validar_xss($_POST['cantidad']);


$valor =  $cencostot->actualizar_vua($cantidad,$subot);

if ($valor == 'ok')  
{
echo '<script>
    swal({
    title: "Buen Trabajo",
    text: "Actualización Exitosa",
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
    title: "Error de Actualización ",
    text: "Consulte al área de Soporte",
    type:"danger",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}


 ?>