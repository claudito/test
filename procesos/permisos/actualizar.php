<?php 

include('../../autoload.php');
include('../../session.php');


$id      = $_GET['id'];
$usuario = $_GET['usuario'];
$estado  = $_GET['estado'];

$permisos = new Permisos();
$valor = $permisos -> actualizar($id,$usuario,$estado);

if ($valor=='ok')
{
 header('Location: '.PATH.'pages/permisos?id='.$usuario);
} 
else 
{
 echo "erro";
}





 ?>