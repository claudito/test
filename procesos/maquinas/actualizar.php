<?php 

include('../../autoload.php');


if (empty($_POST['id'])) 
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

    $id                 = addslashes($_POST['id']);
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
    $estado             = addslashes($_POST['estado']);
    $anio               = addslashes($_POST['anio']);
    $mes                = addslashes($_POST['mes']);
    $mes_depreciado     = addslashes($_POST['mes_depreciado']);
    $mes_faltante       = addslashes($_POST['mes_faltante']);


     $maquina  =  new Maquina($codigo_interno,$fecha_adquisicion,$fecha_inicio,$cantidad,$fecha_termino,$meses_deprec,$meses_faltan,$contrato_factura,$descripcion,$tipo,$descripcion_abrv,$modelo,$serie,$marca,$valorcontable);

     
     $maquinadet = new Maquinadet($id,$anio,$mes,$mes_depreciado,$mes_faltante);


     $valor_cab = $maquina    -> actualizar($id,$estado);
     $valor_det = $maquinadet -> actualizar();

  if ($valor_cab == 'ok' AND $valor_det == 'ok')  
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
    title: "Error de Actualización ",
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