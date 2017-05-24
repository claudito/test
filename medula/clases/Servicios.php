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
SELECT CANUMDOC,S.SUB_OT,DEITEM,DECODIGO,DEDESCRI,DECANTID,DECANREF,DEPRECIO,CARFTDOC,CARFNDOC,CAFECDOC,CACODMON,CACODLIQ,C.CANUMORD
 FROM ".BDCOMUN.".DBO.MOVINGCAB_S AS C  
INNER JOIN ".BDCOMUN.".DBO.MOVINGDET_S AS D  ON C.CANUMDOC=D.DENUMDOC  AND  C.CATD=D.DETD 
LEFT JOIN (SELECT  SUB_OT,NOTA_INGRESO,ITEM FROM ".BD.".DBO.DETALLE_SERVICIOS) AS S
ON C.CANUMDOC=S.NOTA_INGRESO AND D.DEITEM=S.ITEM
WHERE C.CATD='NI'   AND C.CASITGUI='V' AND DEESTADO='V'   AND C.CACODLIQ !='' AND
CONVERT(VARCHAR,CAFECDOC,23)  BETWEEN  '".$fechainicio."' AND '".$fechafin."'
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}



function orden_servicio_cab($oc)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT  OC_CNUMORD,OC_DFECDOC,OC_CCODPRO,OC_CRAZSOC,OC_CCODMON,OC_CFORPAG,OC_NIMPORT,OC_NIGV,OC_NVENTA,
CASE OC_CSITORD
WHEN '00' THEN 'EMITIDA'
WHEN '01' THEN 'APROBADA'
WHEN '03' THEN 'REQ PARCIAL'
WHEN '04' THEN 'REQ TOTAL'
WHEN '06' THEN 'ANULADA'
END OC_CSITORD,OC_CDOCREF,OC_CNRODOCREF FROM ".BDCOMUN.".DBO.COMOVC_S WHERE OC_CNUMORD='".$oc."'
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}


function orden_servicio_det($oc)
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
END OC_CESTADO  FROM ".BDCOMUN.".DBO.COMOVD_S AS D WHERE OC_CNUMORD='".$oc."'
ORDER BY D.OC_CITEM
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}



function ni($ni)
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
WHERE C.CANUMDOC='".$ni."' AND C.CATD='NI' AND C.CASITGUI='V' AND DETD='NI' AND DEESTADO='V'
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}



function agregar($item,$ot,$subot,$ni,$os)
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
   $query  =  "INSERT INTO ".BD.".DBO.DETALLE_SERVICIOS(ITEM,OT,SUB_OT,NOTA_INGRESO,ORDEN_SERVICIO)
   VALUES('".$item."','".$ot."','".$subot."','".$ni."','".$os."')";
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