<?php 

include'autoload.php';

$session = new Session();

if ($session->existe()=='existe') 
{
	include('templates/home.php');
}
else
{
	include('templates/acceso.php');
}

?>
