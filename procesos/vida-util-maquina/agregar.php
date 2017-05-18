<?php 

include('../../autoload.php');


if (empty($_POST['mes']) || empty($_POST['tiempo_mes']) || empty($_POST['tiempo_anio']) ) 
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
$mes           = substr($_POST['mes'],-2);
$anio          = substr($_POST['mes'],0,4);
$tiempo_mes    = $_POST['tiempo_mes'];
$tiempo_anio   = $_POST['tiempo_anio'];
$tipo          = $_POST['tipo'];

$vidautilmaquina  = new Vidautilmaquina($anio,$mes,$tiempo_mes,$tiempo_anio,$tipo);
$valor = $vidautilmaquina -> agregar();

if ($valor == 'existe') 
{
echo '<script>
    swal({
    title: "Registro Duplicado",
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
    



}





 ?>