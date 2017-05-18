<?php 

class Horometro
{


protected $anio;
protected $mes;
protected $horas_hombre;
protected $horas_maquina;


function __construct($anio,$mes,$horas_hombre,$horas_maquina)
{

$this->anio          = $anio;
$this->mes           = $mes;
$this->horas_hombre  = $horas_hombre;
$this->horas_maquina = $horas_maquina;

}


function agregar()
{
	$conexion = new Conexion();
	$conexion -> sqlserver();
	$query  = "SELECT * FROM ".BD.".DBO.HOROMETRO WHERE ANIO='".trim($this->anio)."' AND MES='".trim($this->mes)."'";
	$result = mssql_query($query);
	if (mssql_num_rows($result) > 0) 
	{
	
	  return "existe";

	}
	else
	{
       $query  = "INSERT INTO ".BD.".DBO.HOROMETRO(ANIO,MES,HORAS_HOMBRE,HORAS_MAQUINA) VALUES('".trim($this->anio)."','".trim($this->mes)."','".trim($this->horas_hombre)."','".trim($this->horas_maquina)."')";
	$result = mssql_query($query);
	if ($result) 
	{
		return "ok";
	} 
	else 
	{
		return "error";
	}
	}

}


function actualizar($id)
{

$conexion = new Conexion();
$conexion -> sqlserver();
$query = "UPDATE ".BD.".DBO.HOROMETRO SET HORAS_HOMBRE='".trim($this->horas_hombre)."',HORAS_MAQUINA='".trim($this->horas_maquina)."' WHERE ID='".trim($id)."'";
$result = mssql_query($query);
if ($result) 
{
	return "ok";
} 
else 
{
	return "error";
}



}



function eliminar($id)
{

$conexion = new Conexion();
$conexion -> sqlserver();
$query = "DELETE FROM ".BD.".DBO.HOROMETRO WHERE ID='".$id."'";
$result = mssql_query($query);
if ($result) 
{
	return "ok";
} 
else 
{
	return "error";
}


}


function activar($id,$valor)
{

$conexion = new Conexion();
$conexion -> sqlserver();
$query_all      = "UPDATE  ".BD.".DBO.HOROMETRO SET ACTIVAR=0";
$query_maquina  = "UPDATE  ".BD.".DBO.MAQUINA SET ID_HOROMETRO='".$id."'";
$query          = "UPDATE  ".BD.".DBO.HOROMETRO SET ACTIVAR='".$valor."' WHERE ID='".$id."'";
$result_all     = mssql_query($query_all);

if ($result_all) 
{   
	$result         = mssql_query($query);
	$result_maquina = mssql_query($query_maquina);
	return "ok";
} 
else 
{
	return "error";
}


}




function lista()
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT  * FROM ".BD.".DBO.HOROMETRO";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
  $dato[] = $fila;
}

return $dato;

}




}


 ?>