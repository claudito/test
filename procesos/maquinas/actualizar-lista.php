<?php 

include('../../autoload.php');
include('../../session.php');


$horometro = new Horometro('?','?','?','?');
$maquina   = new Maquina('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');
$periodos  = new Periodos();

foreach ($horometro->lista()  as $value_horometro) 
{
      $anio = $value_horometro['ANIO'];
      $mes  = sprintf("%0"."2"."s", "".$value_horometro['MES']."");

      foreach ($maquina->lista() as $value_maquina) 
      {
 
            if ($value_maquina['ESTADO']==1)
            {
            if ($periodos->validar_existencia_maquinadet($value_maquina['ID'],$anio,$mes)=='0') 
            {
            echo  $periodos->registrar_maquinadet($value_maquina['ID'],$anio,$mes)."</br>";
            } 
            else 
            {
            echo   "";#ya esta registrado el mes
            }
            }
            else
            {
            echo "";#La máquina esta inactiva
            }
             



      }
}


echo "
<meta charset='UTF-8'> 
<script>
alert('Detalle de Máquinas actualizado');
window.location='".PATH."pages/maquinas';
</script>";

 ?>