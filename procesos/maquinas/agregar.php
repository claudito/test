<?php 

include('../../autoload.php');


if (empty($_POST['codigo_interno'])) 
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
     
    $codigo_interno     = addslashes(utf8_decode($_POST['codigo_interno']));
    $fecha_adquisicion  = date_format(date_create($_POST['fecha_adquisicion']), FECHA);
    $fecha_inicio       = date_format(date_create($_POST['fecha_inicio']), FECHA);
    $cantidad           = addslashes($_POST['cantidad']);
    $fecha_termino      = date_format(date_create($_POST['fecha_termino']), FECHA);
    $meses_deprec       = addslashes($_POST['meses_deprec']);
    $meses_faltan       = addslashes($_POST['meses_faltan']);
    $contrato_factura   = addslashes(utf8_decode($_POST['contrato_factura']));
    $descripcion        = addslashes(utf8_decode($_POST['descripcion']));
    $tipo               = addslashes($_POST['tipo']);
    $descripcion_abrv   = addslashes(utf8_decode($_POST['descripcion_abrv']));
    $modelo             = addslashes(utf8_decode($_POST['modelo']));
    $serie              = addslashes(utf8_decode($_POST['serie']));
    $marca              = addslashes(utf8_decode($_POST['marca']));
    $valorcontable      = addslashes($_POST['valorcontable']);


     $maquina  =  new Maquina($codigo_interno,$fecha_adquisicion,$fecha_inicio,$cantidad,$fecha_termino,$meses_deprec,$meses_faltan,$contrato_factura,$descripcion,$tipo,$descripcion_abrv,$modelo,$serie,$marca,$valorcontable);
     $valor = $maquina -> agregar();

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




}





 ?>