<?php

include('../../autoload.php');  
include('../../session.php');		

$dni                    = addslashes(trim($_POST['dni']));
$correo                 = addslashes(trim($_POST['correo']));
$tipo                   = addslashes(trim($_POST['tipo']));
$pass                   = addslashes((empty($_POST['passnuevo'])) ? $_POST['passactual'] : md5($_POST['passnuevo']));


$anio                   =  addslashes(trim($_POST['anio']));
$mes                    =  addslashes(trim($_POST['mes']));
$basico                 =  addslashes(trim($_POST['basico']));
$vacaciones             =  addslashes(trim($_POST['vacaciones']));
$gratificaciones        =  addslashes(trim($_POST['gratificaciones']));
$cts                    =  addslashes(trim($_POST['cts']));
$essalud                =  addslashes(trim($_POST['essalud']));
$sctr_salud             =  addslashes(trim($_POST['sctr_salud']));
$sctr_pension           =  addslashes(trim($_POST['sctr_pension']));
$sctr_vida              =  addslashes(trim($_POST['sctr_vida']));
$senati                 =  addslashes(trim($_POST['senati']));
$descanso_medico        =  addslashes(trim($_POST['descanso_medico']));
$bonificacion_ordinaria =  addslashes(trim($_POST['bonificacion_ordinaria']));
$bonificacion_variable  =  addslashes(trim($_POST['bonificacion_variable']));
$bonificacion_nocturna  =  addslashes(trim($_POST['bonificacion_nocturna']));
$asignacion_familiar    =  addslashes(trim($_POST['asignacion_familiar']));

$usuariosdet  =  new Usuariosdet($dni,$anio,$mes,$basico,$vacaciones,$gratificaciones,$cts,$essalud,$sctr_salud,$sctr_pension,$sctr_vida,$senati,$descanso_medico,$bonificacion_ordinaria,$bonificacion_variable,$bonificacion_nocturna,$asignacion_familiar);

$usuarios  = new Usuarios($dni,$tipo,$correo,$pass);

$valor_c = $usuarios     -> actualizar();
$valor_d = $usuariosdet -> actualizar();


 if ($valor_c == 'ok' AND $valor_d =='ok')  
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


?>