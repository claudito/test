<?php 

class Maquinadet
{

protected $idmaquina;
protected $anio;
protected $mes;
protected $mes_depreciado;
protected $mes_faltante;

	
function __construct($idmaquina,$anio,$mes,$mes_depreciado,$mes_faltante)
{

$this->idmaquina               = $idmaquina;
$this->anio                    = $anio;
$this->mes                     = $mes;
$this->mes_depreciado          = $mes_depreciado;
$this->mes_faltante            = $mes_faltante;



}



function agregar()
{ 


}



function actualizar()
{ 

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "UPDATE  ".BD.".DBO.MAQUINA_DET SET 
MES_DEPRECIADO='".$this->mes_depreciado."',
MES_FALTANTE='".$this->mes_faltante."'
WHERE ID_MAQUINA='".$this->idmaquina."'
AND ANIO='".$this->anio."' AND MES='".$this->mes."'
";
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


function eliminar()
{ 





}


   

function lista_meses()
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "SELECT ANIO,MES FROM ".BD.".DBO.MAQUINA_DET  WHERE ID_MAQUINA='".$this->idmaquina."'
GROUP BY ANIO,MES ORDER BY ANIO,MES
	";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}


function consulta($campo)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "SELECT * FROM ".BD.".DBO.MAQUINA_DET  WHERE ID_MAQUINA='".$this->idmaquina."' AND ANIO+MES='".$this->anio.$this->mes."'";
$result = mssql_query($query);
$dato   = mssql_fetch_array($result);
return $dato[$campo];

}






}



 ?>