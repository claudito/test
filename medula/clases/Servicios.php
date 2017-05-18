<?php 


class Servicios
{

function __construct()
{

}



function lista($fechainicio='',$fechafin='')
{
$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT 
C.OC_CNUMORD,OC_DFECDOC,OC_CCODPRO,UPPER(OC_CRAZSOC)AS OC_CRAZSOC,OC_CCOTIZA,
OC_CCODMON,OC_CFORPAG,OC_CSOLICT,OC_SOLICITA,CASE OC_Csitord
WHEN '00' THEN 'EMITIDA'
WHEN '01' THEN 'APROBADA'
WHEN '03' THEN 'REQ PARCIAL'
WHEN '04' THEN 'REQ TOTAL'
WHEN '06' THEN 'ANULADA'
END EST_COMPRA,
OC_NIMPORT,OC_NTIPCAM,OC_NIGV,OC_NVENTA,OC_CDOCREF,OC_CNRODOCREF,OC_ORDFAB,RC.RESPONSABLE_NOMBRE,T.TDESCRI
FROM ".BDCOMUN.".dbo.COMOVC_S AS C  
INNER JOIN ".BDCOMUN.".DBO.Responsablecmp  AS RC ON C.OC_CSOLICT=RC.RESPONSABLE_CODIGO
INNER JOIN ".BDCOMUN.".dbo.TABAYU  AS T  ON C.OC_SOLICITA=T.TCLAVE AND TCOD=12
WHERE C.OC_ORDFAB !='' AND CONVERT(VARCHAR,OC_DFECDOC,23)  BETWEEN  '".$fechainicio."' AND '".$fechafin."'
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}



function detalle($oc)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT D.OC_CNUMORD,D.OC_CCODPRO,D.OC_CITEM,D.OC_CODSERVICIO,D.OC_CDESREF,D.OC_CANT,D.OC_GLOSA,
D.OC_NPREUNI,D.OC_NIGV,D.OC_NIGVPOR,D.OC_NPRENET,D.OC_NTOTVEN,D.OC_CESTADO,D.CENTCOST,D.OC_DORDFAB,
CASE D.OC_CESTADO
WHEN '00' THEN 'EMITIDA'
WHEN '01' THEN 'APROBADA'
WHEN '03' THEN 'REQ PARCIAL'
WHEN '04' THEN 'REQ TOTAL'
WHEN '06' THEN 'ANULADA'
END EST_COMPRA,C.OC_DFECDOC FROM ".BDCOMUN.".DBO.COMOVD_S AS D  INNER JOIN 
(SELECT OC_CNUMORD,OC_DFECDOC FROM ".BDCOMUN.".DBO.COMOVC_S)AS C 
ON D.OC_CNUMORD=C.OC_CNUMORD
 WHERE D.OC_CNUMORD='".$oc."'
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}


function consulta($oc,$campo)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT D.OC_CNUMORD,D.OC_CCODPRO,D.OC_CITEM,D.OC_CODSERVICIO,D.OC_CDESREF,D.OC_CANT,D.OC_GLOSA,
D.OC_NPREUNI,D.OC_NIGV,D.OC_NIGVPOR,D.OC_NPRENET,D.OC_NTOTVEN,D.OC_CESTADO,D.CENTCOST,D.OC_DORDFAB,
CASE D.OC_CESTADO
WHEN '00' THEN 'EMITIDA'
WHEN '01' THEN 'APROBADA'
WHEN '03' THEN 'REQ PARCIAL'
WHEN '04' THEN 'REQ TOTAL'
WHEN '06' THEN 'ANULADA'
END EST_COMPRA,C.OC_DFECDOC FROM ".BDCOMUN.".DBO.COMOVD_S AS D  INNER JOIN 
(SELECT OC_CNUMORD,OC_DFECDOC FROM ".BDCOMUN.".DBO.COMOVC_S)AS C 
ON D.OC_CNUMORD=C.OC_CNUMORD
 WHERE D.OC_CNUMORD='".$oc."'
";
$result = mssql_query($query);
$dato   = mssql_fetch_array($result);
return $dato[$campo];


}



function ni($oc)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT  
CASE S.SUB_OT
WHEN NULL THEN 'VACIO'
WHEN ''  THEN 'VACIO'
ELSE
S.SUB_OT
END AS SUB_OT
,CANUMDOC,DEITEM,DECODIGO,DEDESCRI,DECANTID,DECANREF,DEPRECIO,CACODLIQ,CARFNDOC,CAFECDOC,CACODMON,CACODLIQ FROM ".BDCOMUN.".DBO.MOVINGCAB_S AS C  
INNER JOIN ".BDCOMUN.".DBO.MOVINGDET_S AS D  ON C.CANUMDOC=D.DENUMDOC
LEFT JOIN (SELECT NOTA_INGRESO,SUB_OT FROM ".BD.".DBO.DETALLE_SERVICIOS) AS S 
ON C.CANUMDOC=S.NOTA_INGRESO
WHERE C.CANUMORD='".$oc."' AND C.CATD='NI' AND C.CASITGUI='V' AND DETD='NI' AND DEESTADO='V'
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}



function agregar($ot,$subot,$ni,$os)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query   = "SELECT * FROM ".BD.".DBO.DETALLE_SERVICIOS WHERE NOTA_INGRESO='".$ni."'";
$result  = mssql_query($query);
if (mssql_num_rows($result)>0)
{
  $query  =  "UPDATE ".BD.".DBO.DETALLE_SERVICIOS SET SUB_OT='".$subot."' WHERE 
              NOTA_INGRESO='".$ni."'";
   $result = mssql_query($query);
	if ($result)
	{
	return "actualizado";
	} 
	else
	{
	return "error";
	}
}
else
{
   $query  =  "INSERT INTO ".BD.".DBO.DETALLE_SERVICIOS(OT,SUB_OT,NOTA_INGRESO,ORDEN_SERVICIO)
   VALUES('".$ot."','".$subot."','".$ni."','".$os."')";
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




}



 ?>