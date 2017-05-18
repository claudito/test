<?php 

include('../../autoload.php');


if (empty($_POST['dni']))
{
 echo "
 <meta charset='UTF-8'>
 <script>
 alert('No ha seleccionado ningún registro');
 window.location='".PATH."pages/usuarios';
 </script>";
} 
else 
{
    $dni  =  $_POST['dni'];
    
    
    foreach ($dni as $key => $value) 
    {
    	 $usuarios = new Usuarios($value,'?','?','?');
    	 $valor = $usuarios->transferir();
    	 
    	 echo "<script>
    	 alert('Registros transferidos Correctamente');
    	 window.location='".PATH."pages/usuarios';
    	 </script>";


    }

 }







 ?>