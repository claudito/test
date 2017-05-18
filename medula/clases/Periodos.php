<?php 


class Periodos
{


function __construct()
{

}


function registrar_sueldo_mensual($dni,$anio,$mes)
{

$conexion = new Conexion();
$conexion -> sqlserver();
$query   = "INSERT INTO ".BD.".DBO.USUARIOS_DET(DNI,ANIO,MES,BASICO,BONIFICACION_ORDINARIA,
BONIFICACION_VARIABLE,BONIFICACION_NOCTURNA,
ASIGNACION_FAMILIAR,VACACIONES,GRATIFICACIONES,CTS,ESSALUD,SCTR_PENSION,
SCTR_SALUD,SCTR_VIDA,SENATI,DESCANSO_MEDICO)
SELECT DNI,'".$anio."','".$mes."',BASICO,BONIFICACION_ORDINARIA,BONIFICACION_VARIABLE,BONIFICACION_NOCTURNA,
ASIGNACION_FAMILIAR,VACACIONES,GRATIFICACIONES,CTS,ESSALUD,SCTR_PENSION,
SCTR_SALUD,SCTR_VIDA,SENATI,DESCANSO_MEDICO FROM ".BD.".DBO.USUARIOS WHERE DNI='".$dni."' ";
$result  = mssql_query($query);
if ($result) 
{
 return "";
} 
else
{
 return "error";
}

}


function validar_existencia_sueldo($dni,$anio,$mes)
{

$conexion = new Conexion();
$conexion -> sqlserver();
$query   = "SELECT * FROM ".BD.".DBO.USUARIOS_DET  
WHERE DNI='".$dni."'  AND ANIO='".$anio."' AND MES='".$mes."'";
$result  = mssql_query($query);
if (mssql_num_rows($result) > 0) 
{
 return "1";
} 
else
{
 return "0";
}


}



function registrar_maquinadet($id,$anio,$mes)
{

$conexion = new Conexion();
$conexion -> sqlserver();
$query   = "INSERT INTO ".BD.".DBO.MAQUINA_DET(ID_MAQUINA,ANIO,MES,MES_DEPRECIADO,MES_FALTANTE)
SELECT '".$id."','".$anio."','".$mes."',0,0 FROM  ".BD.".DBO.MAQUINA WHERE ID='".$id."'";
$result  = mssql_query($query);
if ($result) 
{
 return "";
} 
else
{
 return "error";
}

}


function validar_existencia_maquinadet($id,$anio,$mes)
{

$conexion = new Conexion();
$conexion -> sqlserver();
$query   = "SELECT * FROM ".BD.".DBO.MAQUINA_DET  
WHERE ID_MAQUINA='".$id."'  AND ANIO='".$anio."' AND MES='".$mes."'";
$result  = mssql_query($query);
if (mssql_num_rows($result) > 0) 
{
 return "1";
} 
else
{
 return "0";
}


}



}

 ?>