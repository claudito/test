<?php 


class Cencosot 

{


function __construct()
{

}




function lista()
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT 

CO.CODIGOOT,CO.CODIGOCENTROCOSTO,CO.CODIGO,M.ADESCRI,M.AUNIDAD,ISNULL(O.OF_ARTCANT,0.00)AS CANT,
ISNULL(NI.CANT,0.00) AS CANT_NI,
ISNULL(O.OF_ARTCANT,0.00) - ISNULL(NI.CANT,0.00) as CANT_P
,
O.OF_FECHINI,O.OF_FECHFIN,CO.FECHAINICIO_REPRO,CO.FECHAFIN_REPRO

FROM ".BDRESERVA.".DBO.CENCOSOT AS CO INNER JOIN ".BDCOMUN.".DBO.ORD_FAB AS O ON CO.CODIGOOT=O.OF_COD
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
LEFT JOIN ".BDCOMUN.".DBO.STKART AS S ON CO.CODIGO=S.STCODIGO AND STALMA='01'
	LEFT JOIN (SELECT c.CARFNDOC,CANT= SUM(D.DECANTID) 
	FROM ".BDCOMUN.".dbo.MOVALMCAB AS C INNER JOIN ".BDCOMUN.".dbo.MOVALMDET AS D ON C.CANUMDOC=D.DENUMDOC 
	WHERE C.CAALMA=D.DEALMA AND C.CAALMA='01' AND C.CACODMOV IN ('IP','IE') AND C.CATD=D.DETD and C.CARFTDOC IN ('OF','OT')
	GROUP BY C.CARFNDOC) AS NI ON CO.CODIGOOT=NI.CARFNDOC
WHERE O.OF_ESTADO='ACTIVO'";
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
WHERE C.CAALMA=D.DEALMA AND C.CAALMA='01' AND C.CACODMOV IN ('IP','IE') AND C.CATD=D.DETD and C.CARFTDOC IN ('OF','OT')
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
TIPO_PROCESO FROM ".BD.".dbo.DETALLE_OT AS D LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON D.CODIGO=M.ACODIGO
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
SELECT 

CO.CODIGOOT,CO.CODIGOCENTROCOSTO,CO.CODIGO,M.ADESCRI,M.AUNIDAD,ISNULL(O.OF_ARTCANT,0.00)AS CANT,
ISNULL(NI.CANT,0.00) AS CANT_NI,
ISNULL(O.OF_ARTCANT,0.00) - ISNULL(NI.CANT,0.00) as CANT_P
,
O.OF_FECHINI,O.OF_FECHFIN,CO.FECHAINICIO_REPRO,CO.FECHAFIN_REPRO

FROM ".BDRESERVA.".DBO.CENCOSOT AS CO INNER JOIN ".BDCOMUN.".DBO.ORD_FAB AS O ON CO.CODIGOOT=O.OF_COD
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
LEFT JOIN ".BDCOMUN.".DBO.STKART AS S ON CO.CODIGO=S.STCODIGO AND STALMA='01'
	LEFT JOIN (SELECT c.CARFNDOC,CANT= SUM(D.DECANTID) 
	FROM ".BDCOMUN.".dbo.MOVALMCAB AS C INNER JOIN ".BDCOMUN.".dbo.MOVALMDET AS D ON C.CANUMDOC=D.DENUMDOC 
	WHERE C.CAALMA=D.DEALMA AND C.CAALMA='01' AND C.CACODMOV IN ('IP','IE') AND C.CATD=D.DETD and C.CARFTDOC IN ('OF','OT')
	GROUP BY C.CARFNDOC) AS NI ON CO.CODIGOOT=NI.CARFNDOC
WHERE O.OF_ESTADO='ACTIVO' AND CODIGOOT='".$ot."'";
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


}






 ?>