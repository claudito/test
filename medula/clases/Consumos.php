<?php 


class Consumos
{

function __construct()
{

}



function lista($fechainicio='',$fechafin='')
{
$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT CAALMA,CATD,CANUMDOC,CAFECDOC,CACODMOV,CAGLOSA,CARFTDOC FROM ".BDCOMUN.".DBO.MOVALMCAB
WHERE  CAALMA='01' AND CATD='NS' AND CASITGUI='V'
AND CANUMDOC IN (SELECT DENUMDOC
FROM ".BDCOMUN.".DBO.MOVALMDET WHERE  DEALMA='01' AND DETD='NS'
AND DEORDFAB !=''
GROUP BY DENUMDOC,DEORDFAB)
AND CONVERT(VARCHAR,CAFECDOC,23)  BETWEEN  '".$fechainicio."' AND '".$fechafin."'
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}


function consulta($ni,$campo)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT CAALMA,CATD,CANUMDOC,CAFECDOC,CACODMOV,CAGLOSA,CARFTDOC FROM ".BDCOMUN.".DBO.MOVALMCAB
WHERE  CAALMA='01' AND CATD='NS' AND CASITGUI='V' 
AND CANUMDOC='".$ni."'";
$result = mssql_query($query);
$dato   = mssql_fetch_array($result);
return $dato[$campo];

}



function detalle($ni)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT 
CASE SUB_OT
WHEN NULL THEN 'VACIO'
WHEN ''   THEN 'VACIO'
ELSE
SUB_OT
END AS SUB_OT
,DENUMDOC,DEITEM,DECODIGO,DEDESCRI,DECANTID,DEPRECIO,DECODMOV,DECODMON,DEUNIDAD,DEORDFAB
FROM ".BDCOMUN.".DBO.MOVALMDET  AS  D LEFT JOIN (SELECT NOTA_SALIDA,SUB_OT,ITEM FROM ".BD.".DBO.DETALLE_CONSUMOS)AS C 
ON D.DENUMDOC=C.NOTA_SALIDA AND D.DEITEM=C.ITEM
WHERE DENUMDOC='".$ni."' AND DEALMA='01' AND DETD='NS'  ORDER BY DEITEM";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}



function agregar($item,$ot,$subot,$ni)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query   = "SELECT * FROM ".BD.".DBO.DETALLE_CONSUMOS WHERE ITEM='".$item."' AND NOTA_SALIDA='".$ni."'";
$result  = mssql_query($query);
if (mssql_num_rows($result)>0) 
{
	$query  = "UPDATE ".BD.".DBO.DETALLE_CONSUMOS SET SUB_OT='".$subot."',OT='".$ot."' WHERE ITEM='".$item."'";
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
	$query  = "INSERT INTO ".BD.".DBO.DETALLE_CONSUMOS(ITEM,OT,SUB_OT,NOTA_SALIDA)
	VALUES('".$item."','".$ot."','".$subot."','".$ni."')";
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