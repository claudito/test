<?php 


class Horometrodiario
{


protected $fecha;
protected $maquina;
protected $cant_inicial;
protected $cant_final;

function __construct($fecha='',$maquina='',$cant_inicial='',$cant_final='')
{

$this->fecha         = date_format(date_create($fecha), FECHA);
$this->maquina       = $maquina;
$this->cant_inicial  = $cant_inicial;
$this->cant_final    = $cant_final;

}


function agregar()
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query    = "SELECT * FROM ".BD.".DBO.HOROMETRO_DIARIO_MAQUINA WHERE 
 ID_MAQUINA='".$this->maquina."' AND FECHA='".$this->fecha."'";
$result   = mssql_query($query);
if (mssql_num_rows($result)>0)
{
   return "existe";
}
else 
{

 $query  =   "INSERT INTO ".BD.".DBO.HOROMETRO_DIARIO_MAQUINA(FECHA,ID_MAQUINA,CANTIDAD_INICIAL,CANTIDAD_FINAL)
VALUES('".$this->fecha."','".$this->maquina."',0,0)";
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


function lista()
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT HM.ID,M.CODIGO_INTERNO,M.DESCRIPCION,HM.FECHA,HM.CANTIDAD_INICIAL,HM.CANTIDAD_FINAL
 FROM ".BD.".DBO.HOROMETRO_DIARIO_MAQUINA AS HM INNER JOIN 
".BD.".DBO.MAQUINA AS M  ON HM.ID_MAQUINA=M.ID
 WHERE HM.FECHA='".$this->fecha."'";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
  $dato[] = $fila;
}

return $dato;

}


function consulta($id,$campo)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT HM.ID,M.CODIGO_INTERNO,M.DESCRIPCION,HM.FECHA,HM.CANTIDAD_INICIAL,HM.CANTIDAD_FINAL
 FROM ".BD.".DBO.HOROMETRO_DIARIO_MAQUINA AS HM INNER JOIN 
".BD.".DBO.MAQUINA AS M  ON HM.ID_MAQUINA=M.ID
 WHERE HM.ID='".$id."'";
$result = mssql_query($query);
$dato   = mssql_fetch_array($result);
return  $dato[$campo];


}


function actualizar($id)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
UPDATE ".BD.".DBO.HOROMETRO_DIARIO_MAQUINA SET 
CANTIDAD_INICIAL='".$this->cant_inicial."',
CANTIDAD_FINAL='".$this->cant_final."'
 WHERE ID='".$id."'";
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



 ?>