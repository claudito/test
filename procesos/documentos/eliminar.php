<?php 

include '../../autoload.php';
include '../../session.php';

$id          =  $_POST['id'];

$documentos  =  new Documentos();

$ruta        = utf8_encode($documentos->consulta($id,'RUTA'));

$archivo   = $_SERVER['DOCUMENT_ROOT'].'/app-costos/uploads/'.$ruta;


$valor       =  $documentos->eliminar($id);

if ($valor == 'ok')  
{

unlink($archivo);

echo '<script>
    swal({
    title: "Buen Trabajo",
    text: "Archivo Eliminado",
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


 ?>