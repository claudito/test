<?php 

class Funciones
{


function __construct()
{
	
}



function horastrabajo($inicio,$fin)
{

$dif=date("H:i", strtotime("00:00") + strtotime($fin) - strtotime($inicio) );
return $dif;

}


function sumarmin($horainicio,$minutos)
{

$horaInicial  = $horainicio;
$minutoAnadir = $minutos;
 
$segundos_horaInicial=strtotime($horaInicial);
 
$segundos_minutoAnadir=$minutoAnadir*60;
 
$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
 
return $nuevaHora;


}




function horashombre($hora)
{

$desglose=split(":", $hora);
$dec=$desglose[0]+$desglose[1]/60;
return $dec;

}






}



 ?>