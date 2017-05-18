<?php 

include('../../autoload.php');
include('../../session.php');

$registrodiario_cab = new Registrodiario_cab('?','?','?','?','?');
$funciones          = new Funciones();
$clasificacion      = new Clasificacion('?','?','?','?','?');
$procesos           = new Procesos('?','?','?','?','?');

$usuario            = $_SESSION[KEY.USUARIO];
$fechatrabajo       = date_format(date_create($registrodiario_cab->consulta('FECHA_TRABAJO')), FECHA);
$fechaproduccion    = date_format(date_create($registrodiario_cab->consulta('FECHA_PRODUCCION')),FECHA);
$maquinacab         = $registrodiario_cab->consulta('IDMAQUINA');

$turno              = $registrodiario_cab->consulta('IDTURNO');


$id                 = addslashes(trim($_POST['id']));
$ot                 = addslashes(trim($_POST['ot']));
$cantidad_ot        = addslashes(trim($_POST['cantidad']));
$horainicio         = addslashes(trim($_POST['horainicio']));
$horafin            = addslashes(trim($_POST['horafin']));
$horastrabajo       = $funciones->horastrabajo($horainicio,$horafin);
$horashombre        = $funciones->horashombre($horastrabajo);
$detalle            = addslashes(trim($_POST['detalle']));
$observacion        = addslashes(trim($_POST['observacion']));
$update             = (!isset($_POST['update'])) ? "0" : $_POST['update'];
if ($update == 1)
{

$idclasificacion = addslashes($_POST['clasificacion']);
$idprocesos      = addslashes((!isset($_POST['procesos'])) ? "0" : $_POST['procesos']);
$idmaquina       = addslashes((!isset($_POST['maquina'])) ? "0" : $_POST['maquina']);

if ($clasificacion->consulta($idclasificacion,'TIPO_STAND_BY')==3 || $procesos->consulta($idprocesos,'TIPO_STAND_BY')==3) 
{
   $registrodiario_det_1  = new Registrodiario_det('?','?',$horainicio,$horafin,$horastrabajo,$horashombre,$detalle,$observacion,$ot,$cantidad_ot,'?','?',$idclasificacion,$idprocesos,$idmaquina,'?');

    $registrodiario_det_2  = new Registrodiario_det($fechatrabajo,$fechaproduccion,$horainicio,$horafin,$horastrabajo,$horashombre,$detalle,$observacion,$ot,$cantidad_ot,$turno,$usuario,$idclasificacion,$idprocesos,$maquinacab,'2');
    
    $valor_3  = $registrodiario_det_1 -> eliminar($id,2);
    $valor_1  = $registrodiario_det_1 -> actualizar($id);
    $valor_2  = $registrodiario_det_2->  agregar();

    $valor   = ($valor_1=='ok' || $valor_2=='ok' || $valor_3=='ok') ? "ok" : "error" ;

} 
else 
{
 $registrodiario_det  = new Registrodiario_det('?','?',$horainicio,$horafin,$horastrabajo,$horashombre,$detalle,$observacion,$ot,$cantidad_ot,'?','?',$idclasificacion,$idprocesos,$idmaquina,'?');
  $valor_1 = $registrodiario_det -> actualizar($id);
  $valor_2 = $registrodiario_det -> eliminar($id,2);
  $valor   = ($valor_1=='ok' || $valor_2=='ok') ? "ok" : "error" ;
}


}
else
{

$idclasificacion = addslashes($_POST['clasificacion-actual']);
$idprocesos      = addslashes((!isset($_POST['procesos-actual'])) ? "0" : $_POST['procesos-actual']);
$idmaquina       = addslashes((!isset($_POST['maquina-actual'])) ? "0" : $_POST['maquina-actual']);
$registrodiario_det  = new Registrodiario_det('?','?',$horainicio,$horafin,$horastrabajo,$horashombre,$detalle,$observacion,$ot,$cantidad_ot,'?','?',$idclasificacion,$idprocesos,$idmaquina,'?');

$valor_1 = $registrodiario_det -> actualizar($id);

$valor   = ($valor_1=='ok') ? "ok" : "error" ;

}



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
else 
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