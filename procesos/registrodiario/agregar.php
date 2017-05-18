<?php 

include('../../autoload.php');
include('../../session.php');


$registrodiario_cab = new Registrodiario_cab('?','?','?','?','?');
$funciones          = new Funciones();
$clasificacion      = new Clasificacion('?','?','?','?','?');
$procesos           = new Procesos('?','?','?','?','?');

$usuario         = $_SESSION[KEY.USUARIO];
$fechatrabajo    = date_format(date_create($registrodiario_cab->consulta('FECHA_TRABAJO')), FECHA);
$fechaproduccion = date_format(date_create($registrodiario_cab->consulta('FECHA_PRODUCCION')),FECHA);
$maquinacab      = $registrodiario_cab->consulta('IDMAQUINA');

$turno           = $registrodiario_cab->consulta('IDTURNO');
$ot              = addslashes($_POST['ot']);
$cantidad_ot     = addslashes($_POST['cantidad']);
$idclasificacion = addslashes($_POST['clasificacion']);
$idprocesos      = addslashes((!isset($_POST['procesos'])) ? "0" : $_POST['procesos']);
$idmaquina       = addslashes((!isset($_POST['maquina'])) ? "0" : $_POST['maquina']);
$horainicio      = addslashes($_POST['horainicio']);
$horafin         = addslashes($_POST['horafin']);
$horastrabajo    = $funciones->horastrabajo($horainicio,$horafin);
$horashombre     = $funciones->horashombre($horastrabajo);
$detalle         = addslashes(trim($_POST['detalle']));
$observacion     = addslashes(trim($_POST['observacion']));

if ($clasificacion->consulta($idclasificacion,'TIPO_STAND_BY')==3 || $procesos->consulta($idprocesos,'TIPO_STAND_BY')==3) 
{
	$registrodiario_det_1  = new Registrodiario_det($fechatrabajo,$fechaproduccion,$horainicio,$horafin,$horastrabajo,$horashombre,$detalle,$observacion,$ot,$cantidad_ot,$turno,$usuario,$idclasificacion,$idprocesos,$idmaquina,'1');

	$registrodiario_det_2  = new Registrodiario_det($fechatrabajo,$fechaproduccion,$horainicio,$horafin,$horastrabajo,$horashombre,$detalle,$observacion,$ot,$cantidad_ot,$turno,$usuario,$idclasificacion,$idprocesos,$maquinacab,'2');

	$valor_1  = $registrodiario_det_1->agregar();
    $valor_2  = $registrodiario_det_2->agregar();

     
if ($valor_1 == 'existe' || $valor_2 == 'existe') 
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
else if ($valor_1 == 'ok' || $valor_2 == 'ok')  
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
    title: "Error de Registro ",
    text: "Consulte al área de Soporte",
    type:"danger",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}

} 
else 
{

$registrodiario_det  = new Registrodiario_det($fechatrabajo,$fechaproduccion,$horainicio,$horafin,$horastrabajo,$horashombre,$detalle,$observacion,$ot,$cantidad_ot,$turno,$usuario,$idclasificacion,$idprocesos,$idmaquina,'1');

$valor  = $registrodiario_det->agregar();

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