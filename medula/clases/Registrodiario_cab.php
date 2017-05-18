<?php 

class Registrodiario_cab
{


protected $fechatrabajo;
protected $fechaproduccion;
protected $maquina;
protected $turno;
protected $usuario;


function __construct($fechatrabajo,$fechaproduccion,$maquina,$turno,$usuario)
{

   $this->fechatrabajo      = $fechatrabajo;
   $this->fechaproduccion   = $fechaproduccion;
   $this->maquina           = $maquina;
   $this->turno             = $turno;
   $this->usuario           = $usuario;

}


function agregar()
{

$conexion =  new Conexion();
$conexion ->sqlserver();
$query    = "SELECT * FROM ".BD.".DBO.REGISTRO_DIARIO_CAB WHERE ID_USUARIO='".$this->usuario."'";
$result   = mssql_query($query);
if (mssql_num_rows($result)>0) 
{
  $query   =  "UPDATE ".BD.".DBO.REGISTRO_DIARIO_CAB SET FECHA_TRABAJO='".$this->fechatrabajo."',FECHA_PRODUCCION='".$this->fechaproduccion."',ID_MAQUINA='".$this->maquina."',ID_TURNO='".$this->turno."' WHERE ID_USUARIO='".$this->usuario."'";
  $result  = mssql_query($query);
  if ($result) 
  {
    return "ok";
  } 
  else
  {
     return "error";
  }
  
} 
else 
{
  $query   =  "INSERT INTO ".BD.".DBO.REGISTRO_DIARIO_CAB(FECHA_TRABAJO,FECHA_PRODUCCION,ID_MAQUINA,ID_TURNO,ID_USUARIO)VALUES('".$this->fechatrabajo."','".$this->fechaproduccion."','".$this->maquina."','".$this->turno."','".$this->usuario."')";
  $result  = mssql_query($query);
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
$conexion ->sqlserver();
$query    = "
    SELECT RC.FECHA_TRABAJO,RC.FECHA_PRODUCCION,M.CODIGO_INTERNO,M.DESCRIPCION,T.CODIGO AS TURNO,U.NOMBRES,U.APELLIDOS
      FROM ".BD.".DBO.REGISTRO_DIARIO_CAB AS RC 
    INNER JOIN ".BD.".DBO.MAQUINA AS M ON  RC.ID_MAQUINA=M.ID
    INNER JOIN ".BD.".DBO.TURNO  AS T ON RC.ID_TURNO=T.ID
    INNER JOIN ".BD.".DBO.USUARIOS AS U ON RC.ID_USUARIO=U.ID 
    WHERE U.ID='".$_SESSION[KEY.USUARIO]."'";
$result   = mssql_query(utf8_decode($query));
while ($fila = mssql_fetch_assoc($result))
 {
    $dato[] = $fila;
 }

   return $dato;

}


function consulta($campo)
{

$conexion =  new Conexion();
$conexion ->sqlserver();
$query    = "
    SELECT RC.FECHA_TRABAJO,RC.FECHA_PRODUCCION,M.ID AS IDMAQUINA,M.CODIGO_INTERNO,M.DESCRIPCION,T.ID AS IDTURNO,T.CODIGO AS TURNO,U.NOMBRES,U.APELLIDOS
      FROM ".BD.".DBO.REGISTRO_DIARIO_CAB AS RC 
    INNER JOIN ".BD.".DBO.MAQUINA AS M ON  RC.ID_MAQUINA=M.ID
    INNER JOIN ".BD.".DBO.TURNO  AS T ON RC.ID_TURNO=T.ID
    INNER JOIN ".BD.".DBO.USUARIOS AS U ON RC.ID_USUARIO=U.ID 
    WHERE U.ID='".$_SESSION[KEY.USUARIO]."'";
$result   = mssql_query(utf8_decode($query));
$dato     = mssql_fetch_array($result);
return $dato[$campo];

}



}


 ?>