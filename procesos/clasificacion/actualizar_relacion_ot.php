<?php 

include('../../autoload.php');  	
include '../../session.php';

$funciones = new Funciones();

$id          = $funciones->validar_xss($_POST['id']);
$relacion_ot = $funciones->validar_xss($_POST['valor']);


$clasificacion   = new Clasificacion('?','?','?','?','?'); 

$valor     = $clasificacion -> actualizar_relacion_ot($id,$relacion_ot);

if ($valor=='ok')
{
 echo "
 <script>
 alert('Registro Actualizado');
 window.location='".PATH."pages/clasificacion';
 </script>";
}
else
{
 echo "
 <script>
 alert('Registro Actualizado');
 window.location='".PATH."pages/clasificacion';
 </script>";
}





 ?>