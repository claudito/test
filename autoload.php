<?php 

include('config.php');
spl_autoload_register(function ($clase)
{
	include'medula/clases/'.$clase.'.php';
});



 ?>