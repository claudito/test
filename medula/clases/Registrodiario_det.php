<?php 

class Registrodiario_det
{


protected $fechatrabajo;
protected $fechaproduccion;
protected $horainicio;
protected $horafin;
protected $horastrabajo;
protected $horashombre;
protected $detalle;
protected $observacion;
protected $ot;
protected $cantidad_ot;
protected $turno;
protected $usuario;
protected $clasificacion;
protected $procesos;
protected $maquina;
protected $tipo;


function __construct($fechatrabajo,$fechaproduccion,$horainicio,$horafin,$horastrabajo,$horashombre,$detalle,$observacion,$ot,$cantidad_ot,$turno,$usuario,$clasificacion,$procesos,$maquina,$tipo)
{

 $this->fechatrabajo     =  $fechatrabajo;
 $this->fechaproduccion  =  $fechaproduccion;
 $this->horainicio       =  $horainicio;
 $this->horafin          =  $horafin;
 $this->horastrabajo     =  $horastrabajo;
 $this->horashombre      =  $horashombre;
 $this->detalle          =  $detalle;
 $this->observacion      =  $observacion;
 $this->ot               =  $ot;
 $this->cantidad_ot      =  $cantidad_ot;
 $this->turno            =  $turno;
 $this->usuario          =  $usuario;
 $this->clasificacion    =  $clasificacion;
 $this->procesos         =  $procesos;
 $this->maquina          =  $maquina;
 $this->tipo             =  $tipo;

}


function agregar()
{

$conexion = new Conexion();
$conexion->sqlserver();
$query   =  "SELECT * FROM ".BD.".DBO.REGISTRO_DIARIO_DET WHERE  FECHA_TRABAJO='".$this->fechatrabajo."' AND 
    FECHA_PRODUCCION='".$this->fechaproduccion."' AND HORA_INICIO='".$this->horainicio."' AND  HORA_FIN='".$this->horafin."' AND ID_USUARIO='".$this->usuario."' AND TIPO='".$this->tipo."'";
$result  = mssql_query(utf8_decode($query));
if (mssql_num_rows($result)>0) 
{
   return "existe";
} 
else 
{

$query   =  "INSERT INTO ".BD.".DBO.REGISTRO_DIARIO_DET(FECHA_TRABAJO,FECHA_PRODUCCION,HORA_INICIO,HORA_FIN,HORAS_TRABAJO,HORAS_HOMBRE,DETALLE,OBSERVACION,OT,CANTIDAD_OT,ID_TURNO,ID_USUARIO,ID_CLASIFICACION,ID_PROCESOS,ID_MAQUINA,TIPO,FECHA_CREACION)
VALUES('".$this->fechatrabajo."','".$this->fechaproduccion."','".$this->horainicio."','".$this->horafin."','".$this->horastrabajo."','".$this->horashombre."','".$this->detalle."','".$this->observacion."','".$this->ot."','".$this->cantidad_ot."','".$this->turno."','".$this->usuario."','".$this->clasificacion."','".$this->procesos."','".$this->maquina."','".$this->tipo."','".date('d-m-Y H:i:s')."')";
$result  = mssql_query(utf8_decode($query));
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
$query   =  "UPDATE  ".BD.".DBO.REGISTRO_DIARIO_DET SET 
OT='".$this->ot."',
CANTIDAD_OT='".$this->cantidad_ot."',
HORA_INICIO='".$this->horainicio."',
HORA_FIN='".$this->horafin."',
HORAS_TRABAJO='".$this->horastrabajo."',
HORAS_HOMBRE='".$this->horashombre."',
DETALLE='".$this->detalle."',
OBSERVACION='".$this->observacion."',
ID_CLASIFICACION='".$this->clasificacion."',
ID_PROCESOS='".$this->procesos."',
ID_MAQUINA='".$this->maquina."'
 WHERE  ID='".$id."'";
$result  = mssql_query(utf8_decode($query));
if ($result) 
{
  return "ok";
} 
else 
{
  return "error";
}



}


function eliminar($id,$idtipo)
{

$tipo = ($idtipo==1) ? "1,2" : "2" ;
$conexion = new Conexion();
$conexion -> sqlserver();
$query   =  "DELETE  FROM ".BD.".DBO.REGISTRO_DIARIO_DET  WHERE ID IN (
SELECT T2.ID FROM ".BD.".DBO.REGISTRO_DIARIO_DET AS T1 
INNER JOIN ".BD.".DBO.REGISTRO_DIARIO_DET AS T2  
ON T1.HORA_INICIO=T2.HORA_INICIO AND T1.HORA_FIN=T2.HORA_FIN 
AND T1.FECHA_PRODUCCION=T2.FECHA_PRODUCCION AND T1.ID_USUARIO=T2.ID_USUARIO
WHERE T1.ID='".$id."' AND T2.TIPO IN (".$tipo."))";
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

function lista()
{
  
$conexion = new Conexion();
$conexion->sqlserver();
$query   =  "SELECT D.ID,D.FECHA_TRABAJO,D.FECHA_PRODUCCION,D.HORA_INICIO,D.HORA_FIN,HORAS_TRABAJO,D.HORAS_HOMBRE,
D.DETALLE,D.OBSERVACION,D.OT,D.CANTIDAD_OT,D.ID_TURNO,D.ID_USUARIO,D.ID_CLASIFICACION,D.ID_PROCESOS,D.ID_MAQUINA,T.CODIGO AS TURNO,
C.NOMBRE AS CLASIFICACION,P.NOMBRE AS PROCESOS,M.CODIGO_INTERNO+' '+M.DESCRIPCION AS MAQUINA,D.TIPO,D.FECHA_CREACION
FROM ".BD.".DBO.REGISTRO_DIARIO_DET AS D
LEFT JOIN ".BD.".DBO.TURNO AS T ON D.ID_TURNO=T.ID
LEFT JOIN ".BD.".DBO.CLASIFICACION AS C ON D.ID_CLASIFICACION=C.ID
LEFT JOIN ".BD.".DBO.PROCESOS AS P ON D.ID_PROCESOS=P.ID
LEFT JOIN ".BD.".DBO.MAQUINA AS M ON D.ID_MAQUINA=M.ID
INNER JOIN ".BD.".DBO.REGISTRO_DIARIO_CAB AS CA  ON  
/*D.FECHA_TRABAJO=CA.FECHA_TRABAJO AND*/ D.FECHA_PRODUCCION=CA.FECHA_PRODUCCION
AND D.ID_TURNO=CA.ID_TURNO AND D.ID_USUARIO=CA.ID_USUARIO
WHERE D.ID_USUARIO='".$_SESSION[KEY.USUARIO]."' AND D.TIPO=1";
$result  = mssql_query($query);
while ($fila= mssql_fetch_assoc($result))
 {
   $dato[] = $fila;
 }
  return $dato;

}



function ultimo_registro($campo)
{
  
$conexion = new Conexion();
$conexion->sqlserver();
$query   =  "
SELECT TOP 1 D.HORA_INICIO,D.HORA_FIN
FROM ".BD.".DBO.REGISTRO_DIARIO_DET AS D
LEFT JOIN ".BD.".DBO.TURNO AS T ON D.ID_TURNO=T.ID
LEFT JOIN ".BD.".DBO.CLASIFICACION AS C ON D.ID_CLASIFICACION=C.ID
LEFT JOIN ".BD.".DBO.PROCESOS AS P ON D.ID_PROCESOS=P.ID
LEFT JOIN ".BD.".DBO.MAQUINA AS M ON D.ID_MAQUINA=M.ID
INNER JOIN ".BD.".DBO.REGISTRO_DIARIO_CAB AS CA  ON  
 D.FECHA_PRODUCCION=CA.FECHA_PRODUCCION
AND D.ID_TURNO=CA.ID_TURNO AND D.ID_USUARIO=CA.ID_USUARIO
WHERE D.ID_USUARIO='".$_SESSION[KEY.USUARIO]."' AND D.TIPO=1 
ORDER BY HORA_INICIO DESC
 ";
$result  = mssql_query($query);
$dato    = mssql_fetch_array($result);
return $dato[$campo];

}




function lista_actualizar($id)
{
  
$conexion = new Conexion();
$conexion->sqlserver();
$query   =  "SELECT D.ID,D.FECHA_TRABAJO,D.FECHA_PRODUCCION,D.HORA_INICIO,D.HORA_FIN,HORAS_TRABAJO,D.HORAS_HOMBRE,
D.DETALLE,D.OBSERVACION,D.OT,D.CANTIDAD_OT,D.ID_TURNO,D.ID_USUARIO,D.ID_CLASIFICACION,D.ID_PROCESOS,D.ID_MAQUINA,T.CODIGO AS TURNO,
C.NOMBRE AS CLASIFICACION,P.NOMBRE AS PROCESOS,M.CODIGO_INTERNO+' '+M.DESCRIPCION AS MAQUINA,D.TIPO
FROM ".BD.".DBO.REGISTRO_DIARIO_DET AS D
LEFT JOIN ".BD.".DBO.TURNO AS T ON D.ID_TURNO=T.ID
LEFT JOIN ".BD.".DBO.CLASIFICACION AS C ON D.ID_CLASIFICACION=C.ID
LEFT JOIN ".BD.".DBO.PROCESOS AS P ON D.ID_PROCESOS=P.ID
LEFT JOIN ".BD.".DBO.MAQUINA AS M ON D.ID_MAQUINA=M.ID
INNER JOIN ".BD.".DBO.REGISTRO_DIARIO_CAB AS CA  ON /* 
D.FECHA_TRABAJO=CA.FECHA_TRABAJO AND */ D.FECHA_PRODUCCION=CA.FECHA_PRODUCCION
AND D.ID_TURNO=CA.ID_TURNO AND D.ID_USUARIO=CA.ID_USUARIO
WHERE D.ID='".$id."'";
$result  = mssql_query($query);
while ($fila= mssql_fetch_assoc($result))
 {
   $dato[] = $fila;
 }
  return $dato;

}


function consulta($id,$campo)
{
  
$conexion = new Conexion();
$conexion->sqlserver();
$query   =  "SELECT D.ID,D.FECHA_TRABAJO,D.FECHA_PRODUCCION,D.HORA_INICIO,D.HORA_FIN,HORAS_TRABAJO,D.HORAS_HOMBRE,
D.DETALLE,D.OBSERVACION,D.OT,D.CANTIDAD_OT,D.ID_TURNO,D.ID_USUARIO,D.ID_CLASIFICACION,D.ID_PROCESOS,D.ID_MAQUINA,T.CODIGO AS TURNO,
C.NOMBRE AS CLASIFICACION,P.NOMBRE AS PROCESOS,M.CODIGO_INTERNO+' '+M.DESCRIPCION AS MAQUINA,D.TIPO,D.FECHA_CREACION
FROM ".BD.".DBO.REGISTRO_DIARIO_DET AS D
LEFT JOIN ".BD.".DBO.TURNO AS T ON D.ID_TURNO=T.ID
LEFT JOIN ".BD.".DBO.CLASIFICACION AS C ON D.ID_CLASIFICACION=C.ID
LEFT JOIN ".BD.".DBO.PROCESOS AS P ON D.ID_PROCESOS=P.ID
LEFT JOIN ".BD.".DBO.MAQUINA AS M ON D.ID_MAQUINA=M.ID
INNER JOIN ".BD.".DBO.REGISTRO_DIARIO_CAB AS CA  ON /* 
D.FECHA_TRABAJO=CA.FECHA_TRABAJO AND*/ D.FECHA_PRODUCCION=CA.FECHA_PRODUCCION
AND D.ID_TURNO=CA.ID_TURNO AND D.ID_USUARIO=CA.ID_USUARIO
WHERE D.ID='".$id."'";
$result  = mssql_query($query);
$dato    = mssql_fetch_array($result);
return $dato[$campo];

}







}


 ?>