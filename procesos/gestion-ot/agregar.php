<?php 


include('../../autoload.php');
include('../../session.php');


$codigo        =  addslashes(trim($_POST['codigo']));
$ot            =  addslashes(trim($_POST['ot']));
$centro_costo  =  addslashes(trim($_POST['centro_costo']));
$subot         =  addslashes(trim($_POST['subot']));
$cantidad      =  addslashes(trim($_POST['cantidad']));
$entrega       =  addslashes(trim($_POST['entrega']));
$saldo         =  addslashes(trim($_POST['saldo']));
$centro_costo  =  addslashes(trim($_POST['centro_costo']));
$fechainicio   =  date_format(date_create(addslashes(trim($_POST['fechainicio']))), FECHA);
$fechafin      =  date_format(date_create(addslashes(trim($_POST['fechafin']))), FECHA);
$nota_ingreso  =  addslashes(trim($_POST['nota_ingreso']));
$tipo_entrega  =  addslashes(trim($_POST['tipo_entrega']));
$status        =  addslashes(trim($_POST['status']));
$tipo_ot       =  addslashes(trim($_POST['tipo_ot']));
$tipo_proceso  =  addslashes(trim($_POST['tipo_proceso']));


$cencosot = new Cencosot();
$valor = $cencosot -> registrar_subot($ot,$centro_costo,$subot,$codigo,$cantidad,$entrega,$saldo,$fechainicio,$fechafin,$nota_ingreso,$tipo_entrega,$status,$tipo_ot,$tipo_proceso);

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
    


 ?>