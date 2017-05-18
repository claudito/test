<?php 

if (empty($_POST['id']) || empty($_POST['tiempo_mes']) || empty($_POST['tiempo_anio']) ) 
{
    echo '<script>
    swal({
    title: "Algún registro esta vació",
    text: "Verifique de nuevo",
    type:"warning",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}
else
{

$id            = $_POST['id'];
$tiempo_mes    = $_POST['tiempo_mes'];
$tiempo_anio   = $_POST['tiempo_anio'];
$tipo          = $_POST['tipo'];

$vidautilmaquina  = new Vidautilmaquina('?','?',$tiempo_mes,$tiempo_anio,$tipo);
$valor = $vidautilmaquina -> actualizar($id);

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
    



}




 ?>