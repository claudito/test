<?php 

include('../../autoload.php');
include('../../session.php');


$horometro = new Horometro('?','?','?','?');
$usuarios  = new Usuarios('?','?','?','?');
$periodos  = new Periodos();

foreach ($horometro->lista()  as $value_horometro) 
{
      $anio = $value_horometro['ANIO'];
      $mes  = sprintf("%0"."2"."s", "".$value_horometro['MES']."");

      foreach ($usuarios->lista() as $value_usuarios) 
      {
      	   if ($periodos->validar_existencia_sueldo($value_usuarios['DNI'],$anio,$mes)=='0') 
      	   {
      	   	  echo  $periodos->registrar_sueldo_mensual($value_usuarios['DNI'],$anio,$mes)."</br>";
      	   } 
      	   else 
      	   {
      	   	  echo   "";
      	   }
      }
}

echo "<script>
alert('Registro de Sueldos Mensuales Actualizado');
window.location='".PATH."pages/horas-hombre';
</script>";

 ?>