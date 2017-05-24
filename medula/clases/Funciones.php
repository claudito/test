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



function validar_xss($cadena)
{
	$cadena = htmlspecialchars(trim($cadena), ENT_QUOTES,'UTF-8');
	return $cadena;
}


function first_day_mes()
{
 
 $my_date = new DateTime();
 $my_date->modify('first day');
 return $my_date->format('Y-m-d');

}


function last_day_mes()
{

 $my_date = new DateTime();
 $my_date->modify('last day');
 return $my_date->format('Y-m-d');
	
}


function add_day($date,$day)
{
	 
$newdate = new DateTime($date);
$newdate->modify('+'.$day.' day');
return $newdate->format('Y-m-d');

}


}



 ?>