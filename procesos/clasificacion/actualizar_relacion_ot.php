<?php 

include('../../autoload.php');  	

$id          = addslashes(trim($_GET['id']));
$relacion_ot = addslashes(trim($_GET['valor']));


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