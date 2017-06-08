<?php 


class Cencosot 

{


function __construct()
{

}


function lista($fechainicio,$fechafin,$estado)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT O.OF_COD,CO.CODIGOCENTROCOSTO,CO.CODIGO,M.ADESCRI,M.AUNIDAD,ISNULL(O.OF_ARTCANT,0.00)AS CANT,
ISNULL(NI.CANT,0.00) AS CANT_NI,
ISNULL(O.OF_ARTCANT,0.00) - ISNULL(NI.CANT,0.00) as CANT_P
,
O.OF_FECHINI,O.OF_FECHFIN,CO.FECHAINICIO_REPRO,CO.FECHAFIN_REPRO,
ISNULL(NI.CAFECDOC,O.OF_FECHINI) AS FECHA_NI,O.OF_ESTADO
FROM ".BDCOMUN.".dbo.ORD_FAB AS O
LEFT JOIN ".BDRESERVA.".DBO.CENCOSOT AS CO ON O.OF_COD=CO.CODIGOOT
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
LEFT JOIN (SELECT C.CARFNDOC,SUM(D.DECANTID)AS CANT,MAX(CAFECDOC) AS CAFECDOC
FROM ".BDCOMUN.".dbo.MOVALMCAB AS C INNER JOIN ".BDCOMUN.".dbo.MOVALMDET AS D ON C.CANUMDOC=D.DENUMDOC 
WHERE C.CAALMA=D.DEALMA AND C.CAALMA='01' AND C.CACODMOV IN ('IP','IE') AND C.CATD=D.DETD and C.CARFTDOC IN ('OF','OT')
GROUP BY C.CARFNDOC) AS NI ON O.OF_COD=NI.CARFNDOC
WHERE O.OF_ESTADO IN (".$estado.") AND  CONVERT(VARCHAR,ISNULL(NI.CAFECDOC,O.OF_FECHINI),23)  BETWEEN '".$fechainicio."' AND '".$fechafin."'";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
  $dato[] = $fila;
}

return $dato;

}


function lista_costeo($fechainicio,$fechafin)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT O.OF_COD,ISNULL(SO.OT+'-'+CONVERT(VARCHAR,SO.SUB_OT),'')AS SUB_OT,CO.CODIGOCENTROCOSTO,O.OF_FECHINI,
ISNULL(SO.FECHA_FIN,O.OF_FECHINI)AS FECHA_FIN,CO.CODIGO,M.ADESCRI,AUNIDAD,ISNULL(SO.CANTIDAD,O.OF_ARTCANT)AS CANTIDAD,
ISNULL(SO.ENTREGA,0)AS ENTREGA,ISNULL(SO.SALDO,0)AS SALDO,SO.NOTA_INGRESO,SO.TIPO_ENTREGA,SO.STATUS,SO.TIPO_OT,SO.TIPO_PROCESO,O.OF_ESTADO,COSTO_UNITARIO
 FROM ".BDCOMUN.".DBO.ORD_FAB AS O 
LEFT JOIN ".BDRESERVA.".DBO.CENCOSOT AS CO ON O.OF_COD=CO.CODIGOOT 
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
LEFT JOIN (SELECT ID,OT,CENTRO_COSTO,SUB_OT,CODIGO,CANTIDAD,ENTREGA,SALDO,FECHA_INICIO,FECHA_FIN,
NOTA_INGRESO,TIPO_ENTREGA,STATUS,TIPO_OT,TIPO_PROCESO,COSTO_UNITARIO FROM ".BD.".DBO.DETALLE_OT)AS SO ON O.OF_COD=SO.OT
WHERE CONVERT(VARCHAR,ISNULL(SO.FECHA_FIN,O.OF_FECHFIN),23) BETWEEN '".$fechainicio."' AND '".$fechafin."'
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
  $dato[] = $fila;
}

return $dato;

}





function lista_ni($ot)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT (ROW_NUMBER() OVER(ORDER BY D.DENUMDOC))AS ITEM,C.CARFNDOC,D.DENUMDOC,D.DEUNIDAD,C.CAFECDOC,D.DECODIGO,D.DEDESCRI,D.DECANTID,C.CAGLOSA
FROM ".BDCOMUN.".dbo.MOVALMCAB AS C INNER JOIN ".BDCOMUN.".dbo.MOVALMDET AS D ON C.CANUMDOC=D.DENUMDOC 
WHERE C.CAALMA=D.DEALMA AND C.CAALMA='01' AND C.CACODMOV IN ('IP','IE') AND C.CATD=D.DETD AND C.CARFTDOC IN ('OF','OT')
AND CARFNDOC='".$ot."'
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
  $dato[] = $fila;
}

return $dato;

}


function lista_subot($ot)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT ID,OT,CENTRO_COSTO,SUB_OT,CODIGO,M.ADESCRI,CANTIDAD,ENTREGA,SALDO,FECHA_INICIO,FECHA_FIN,NOTA_INGRESO,TIPO_ENTREGA,STATUS,TIPO_OT,
TIPO_PROCESO,COSTO_UNITARIO FROM ".BD.".dbo.DETALLE_OT AS D LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON D.CODIGO=M.ACODIGO
WHERE D.OT='".$ot."'
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
  $dato[] = $fila;
}

return $dato;

}




function consulta($ot,$campo)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT O.OF_COD,CO.CODIGOCENTROCOSTO,CO.CODIGO,M.ADESCRI,M.AUNIDAD,ISNULL(O.OF_ARTCANT,0.00)AS CANT,
ISNULL(NI.CANT,0.00) AS CANT_NI,
ISNULL(O.OF_ARTCANT,0.00) - ISNULL(NI.CANT,0.00) as CANT_P
,
O.OF_FECHINI,O.OF_FECHFIN,CO.FECHAINICIO_REPRO,CO.FECHAFIN_REPRO,
ISNULL(NI.CAFECDOC,O.OF_FECHINI) AS FECHA_NI,O.OF_ESTADO
FROM ".BDCOMUN.".dbo.ORD_FAB AS O
LEFT JOIN ".BDRESERVA.".DBO.CENCOSOT AS CO ON O.OF_COD=CO.CODIGOOT
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
LEFT JOIN (SELECT C.CARFNDOC,SUM(D.DECANTID)AS CANT,MAX(CAFECDOC) AS CAFECDOC
FROM ".BDCOMUN.".dbo.MOVALMCAB AS C INNER JOIN ".BDCOMUN.".dbo.MOVALMDET AS D ON C.CANUMDOC=D.DENUMDOC 
WHERE C.CAALMA=D.DEALMA AND C.CAALMA='01' AND C.CACODMOV IN ('IP','IE') AND C.CATD=D.DETD and C.CARFTDOC IN ('OF','OT')
GROUP BY C.CARFNDOC) AS NI ON O.OF_COD=NI.CARFNDOC
WHERE O.OF_COD='".$ot."'
";
$result = mssql_query($query);
$dato   = mssql_fetch_array($result);
return $dato[$campo];

}



function registrar_subot($ot,$centro_costo,$sub_ot,$codigo,$cantidad,$entrega,$saldo,$fechainicio,$fechafin,$nota_ingreso,$tipo_entrega,$status,$tipo_ot,$tipo_proceso)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "SELECT * FROM ".BD.".DBO.DETALLE_OT WHERE OT='".$ot."' AND SUB_OT='".$sub_ot."'";
$result = mssql_query($query);
if (mssql_num_rows($result)>0) 
{
 return "existe";
} 
else
{
 $query    =  "INSERT INTO ".BD.".DBO.DETALLE_OT(OT,CENTRO_COSTO,SUB_OT,CODIGO,CANTIDAD,ENTREGA,SALDO,FECHA_INICIO,FECHA_FIN,NOTA_INGRESO,TIPO_ENTREGA,STATUS,TIPO_OT,TIPO_PROCESO)VALUES('".$ot."','".$centro_costo."','".$sub_ot."','".$codigo."','".$cantidad."','".$entrega."','".$saldo."','".$fechainicio."','".$fechafin."','".$nota_ingreso."','".$tipo_entrega."','".$status."','".$tipo_ot."','".$tipo_proceso."')";
$result   = mssql_query(utf8_decode($query));
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



function eliminar_subot($id)
{

try {
	

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
DELETE FROM ".BD.".DBO.DETALLE_OT WHERE ID='".$id."'
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



} catch (Exception $e) {

	return "error:".$e->getMessage();
	
}

}


function actualizar_subot($id,$subot,$cantidad,$entrega,$saldo,$fechainicio,$fechafin,$notaingreso,$tipo_entrega,$status,$tipo_ot,$tipo_proceso)
{

try {
	

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
UPDATE  ".BD.".DBO.DETALLE_OT SET SUB_OT='".$subot."',CANTIDAD='".$cantidad."',
SALDO='".$saldo."',ENTREGA='".$entrega."',FECHA_INICIO='".$fechainicio."',FECHA_FIN='".$fechafin."',
NOTA_INGRESO='".$notaingreso."',TIPO_ENTREGA='".$tipo_entrega."',STATUS='".$status."',
TIPO_OT='".$tipo_ot."',TIPO_PROCESO='".$tipo_proceso."'
 WHERE ID='".$id."'";
$result = mssql_query(utf8_decode($query));
if ($result) 
{
   return "ok";
}
else
{

   return "error";
}



} catch (Exception $e) {

	return "error:".$e->getMessage();
	
}

}



function tipo_ot($tipo)
{

  
  switch ($tipo) {
    case 'S':
    return "SERVICIO";
    break;
    case 'E':
    return "ENSAMBLE";
    break;
    case 'F':
    return "FABRICACIÓN";
    break;
    case 'G':
    return "GARANTIA";
    break;
    case 'C':
    return "TRABAJO INTERNO";
    break;
  	
  	default:
  		return "VACIO";
  		break;
  }


}



function actualizar_vua($vua,$subot)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query = "UPDATE  ".BD.".DBO.DETALLE_OT SET COSTO_UNITARIO='".$vua."'  
 WHERE OT+'-'+CONVERT(VARCHAR,SUB_OT)='".$subot."'";
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