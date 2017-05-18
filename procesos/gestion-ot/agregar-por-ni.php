<?php 

include '../../autoload.php';
include '../../session.php';


$codigo        =  addslashes(trim($_POST['codigo']));
$ot  		   =  addslashes(trim($_POST['ot']));
$centro_costo  =  addslashes(trim($_POST['centro_costo']));
$fechainicio   =  date_format(date_create(addslashes(trim($_POST['fechainicio']))), FECHA);
$ni            =  $_POST['ni'];
$cantidad      =  $_POST['cantidad'];
$entrega       =  $_POST['entrega'];
$saldo         =  $_POST['saldo'];
$tipo_entrega  =  "ENTREGA PARCIAL";
$status        =  "LIQUIDADO";
$tipo_ot       =  "FABRICACIÓN";
$tipo_proceso  =  "MECANIZADO PARCIAL";
$fechafin      =  $_POST['fechafin'];
$subot         =  $_POST['subot'];


foreach ($ni as $keyni => $valueni) 
{   
   $valuecantidad  = $cantidad[$keyni];
   $valueentrega   = $entrega[$keyni];
   $valuesaldo     = $saldo[$keyni];
   $valuefechafin  = $fechafin[$keyni];
   $valuesubot     = $subot[$keyni];

   $cencosot  =  new Cencosot();
   $valor = $cencosot->registrar_subot($ot,$centro_costo,$valuesubot,$codigo,$valuecantidad,$valueentrega,$valuesaldo,$fechainicio,$valuefechafin,$valueni,$tipo_entrega,$status,$tipo_ot,$tipo_proceso);

  if ($valor == 'existe')  
{
echo '<script>
    swal({
    title: "Sub Ot Duplicada",
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
    
 

}

 ?>