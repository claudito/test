<?php 	


class Ot

{


  function lista()
    {
      $conexion =  new Conexion();
      $conexion -> sqlserver();
      $query  =  "SELECT CODIGOCENTROCOSTO,CODIGOOT,CODIGO,OF_ESTADO,O.OF_ARTCANT,O.OF_ARTNOM,M.ADESCRI  FROM ".BDRESERVA.".dbo.CENCOSOT AS CO 
        INNER JOIN ".BDCOMUN.".DBO.ORD_FAB AS O ON CO.CODIGOOT=O.OF_COD 
        LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
        WHERE O.OF_ESTADO='ACTIVO' ORDER BY CODIGO";
      $result = mssql_query($query);
      while ($fila = mssql_fetch_assoc($result))
       {
      	  $dato[] = $fila;
       }

       return $dato;

    }


   function lista_registro_diario()
    {
      $funciones   = new Funciones();
      $conexion =  new Conexion();
      $conexion -> sqlserver();
      $query  =  "  
      SELECT CODIGOCENTROCOSTO,OF_COD,CODIGO,OF_ESTADO,O.OF_ARTCANT,O.OF_ARTNOM,M.ADESCRI  FROM ".BDRESERVA.".dbo.CENCOSOT AS CO 
      INNER JOIN ".BDCOMUN.".DBO.ORD_FAB AS O ON CO.CODIGOOT=O.OF_COD 
      LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
      WHERE OF_COD!=''  AND  O.OF_ESTADO='ACTIVO'
      UNION
      SELECT CODIGOCENTROCOSTO,CODIGOOT,CODIGO,OF_ESTADO,O.OF_ARTCANT,O.OF_ARTNOM,M.ADESCRI 
      FROM ".BDCOMUN.".dbo.ORD_FAB AS O
      LEFT JOIN ".BDRESERVA.".DBO.CENCOSOT AS CO ON O.OF_COD=CO.CODIGOOT
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
LEFT JOIN (SELECT C.CARFNDOC,SUM(D.DECANTID)AS CANT,MAX(CAFECDOC) AS CAFECDOC
FROM ".BDCOMUN.".dbo.MOVALMCAB AS C INNER JOIN ".BDCOMUN.".dbo.MOVALMDET AS D ON C.CANUMDOC=D.DENUMDOC 
WHERE C.CAALMA=D.DEALMA AND C.CAALMA='01' AND C.CACODMOV IN ('IP','IE') AND C.CATD=D.DETD and C.CARFTDOC IN ('OF','OT')
GROUP BY C.CARFNDOC) AS NI ON O.OF_COD=NI.CARFNDOC
WHERE  OF_COD!=''  AND O.OF_ESTADO IN ('LIQUIDADO') AND  CONVERT(VARCHAR,ISNULL(NI.CAFECDOC,O.OF_FECHFIN),23)  BETWEEN '".$funciones->first_day_mes(date('Y-m-d'))."' AND '".$funciones->last_day_mes(date('Y-m-d'))."'

      ";
      $result = mssql_query($query);
      while ($fila = mssql_fetch_assoc($result))
       {
          $dato[] = $fila;
       }

       return $dato;

    }


     function lista_actualizar($ot)
    {
      
      $conexion  =  new Conexion();
      $funciones =  new Funciones();
      $conexion -> sqlserver();
      $query  =  "SELECT CODIGOCENTROCOSTO,OF_COD,CODIGO,OF_ESTADO,O.OF_ARTCANT,O.OF_ARTNOM,M.ADESCRI  FROM ".BDRESERVA.".dbo.CENCOSOT AS CO 
INNER JOIN ".BDCOMUN.".DBO.ORD_FAB AS O ON CO.CODIGOOT=O.OF_COD 
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
WHERE OF_COD!=''  AND  O.OF_ESTADO='ACTIVO' AND O.OF_COD<>'".$ot."'
UNION
SELECT CODIGOCENTROCOSTO,CODIGOOT,CODIGO,OF_ESTADO,O.OF_ARTCANT,O.OF_ARTNOM,M.ADESCRI 
FROM ".BDCOMUN.".dbo.ORD_FAB AS O
LEFT JOIN ".BDRESERVA.".DBO.CENCOSOT AS CO ON O.OF_COD=CO.CODIGOOT
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
LEFT JOIN (SELECT C.CARFNDOC,SUM(D.DECANTID)AS CANT,MAX(CAFECDOC) AS CAFECDOC
FROM ".BDCOMUN.".dbo.MOVALMCAB AS C INNER JOIN ".BDCOMUN.".dbo.MOVALMDET AS D ON C.CANUMDOC=D.DENUMDOC 
WHERE C.CAALMA=D.DEALMA AND C.CAALMA='01' AND C.CACODMOV IN ('IP','IE') AND C.CATD=D.DETD and C.CARFTDOC IN ('OF','OT')
GROUP BY C.CARFNDOC) AS NI ON O.OF_COD=NI.CARFNDOC
WHERE  OF_COD!=''  AND O.OF_ESTADO IN ('LIQUIDADO') AND  CONVERT(VARCHAR,ISNULL(NI.CAFECDOC,O.OF_FECHFIN),23)  BETWEEN '".$funciones->first_day_mes(date('Y-m-d'))."' AND '".$funciones->last_day_mes(date('Y-m-d'))."'
AND O.OF_COD <>'".$ot."'";
      $result = mssql_query($query);
      while ($fila = mssql_fetch_assoc($result))
       {
          $dato[] = $fila;
       }

       return $dato;

    }


 function consulta($ot,$campo)
    {
      $funciones   = new Funciones();
      $conexion =  new Conexion();
      $conexion -> sqlserver();
      $query  =  " 
      SELECT CODIGOCENTROCOSTO,OF_COD,CODIGO,OF_ESTADO,O.OF_ARTCANT,O.OF_ARTNOM,M.ADESCRI  FROM ".BDRESERVA.".dbo.CENCOSOT AS CO 
INNER JOIN ".BDCOMUN.".DBO.ORD_FAB AS O ON CO.CODIGOOT=O.OF_COD 
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
WHERE OF_COD!=''  AND  O.OF_ESTADO='ACTIVO' AND O.OF_COD='".$ot."'
UNION
SELECT CODIGOCENTROCOSTO,CODIGOOT,CODIGO,OF_ESTADO,O.OF_ARTCANT,O.OF_ARTNOM,M.ADESCRI 
FROM ".BDCOMUN.".dbo.ORD_FAB AS O
LEFT JOIN ".BDRESERVA.".DBO.CENCOSOT AS CO ON O.OF_COD=CO.CODIGOOT
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
LEFT JOIN (SELECT C.CARFNDOC,SUM(D.DECANTID)AS CANT,MAX(CAFECDOC) AS CAFECDOC
FROM ".BDCOMUN.".dbo.MOVALMCAB AS C INNER JOIN ".BDCOMUN.".dbo.MOVALMDET AS D ON C.CANUMDOC=D.DENUMDOC 
WHERE C.CAALMA=D.DEALMA AND C.CAALMA='01' AND C.CACODMOV IN ('IP','IE') AND C.CATD=D.DETD and C.CARFTDOC IN ('OF','OT')
GROUP BY C.CARFNDOC) AS NI ON O.OF_COD=NI.CARFNDOC
WHERE  OF_COD!=''  AND O.OF_ESTADO IN ('LIQUIDADO') AND  CONVERT(VARCHAR,ISNULL(NI.CAFECDOC,O.OF_FECHFIN),23)  BETWEEN '".$funciones->first_day_mes(date('Y-m-d'))."' AND '".$funciones->last_day_mes(date('Y-m-d'))."'
AND O.OF_COD='".$ot."'
       ";
      $result = mssql_query($query);
      $dato   = mssql_fetch_array($result);
      return $dato[$campo];

    }





  function ultimo_registro($campo)
    {
      $conexion =  new Conexion();
      $conexion -> sqlserver();
      $query  =  "
      SELECT D.OT,O.CODIGO,O.ADESCRI,O.OF_ARTCANT,O.OF_ESTADO
      FROM ".BD.".DBO.REGISTRO_DIARIO_DET AS D
      INNER JOIN ".BD.".DBO.REGISTRO_DIARIO_CAB AS CA  ON  
      D.FECHA_PRODUCCION=CA.FECHA_PRODUCCION
      AND D.ID_TURNO=CA.ID_TURNO AND D.ID_USUARIO=CA.ID_USUARIO
      INNER JOIN (SELECT O.OF_COD,CO.CODIGO,M.ADESCRI,O.OF_ARTCANT,O.OF_ESTADO FROM ".BDCOMUN.".DBO.ORD_FAB AS O  INNER JOIN 
      ".BDRESERVA.".DBO.CENCOSOT AS CO ON O.OF_COD=CO.CODIGOOT
      LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO) AS O
      ON D.OT=O.OF_COD
      WHERE D.ID_USUARIO='".$_SESSION[KEY.USUARIO]."' AND D.TIPO=1 
      ORDER BY HORA_INICIO DESC    
      ";
      $result = mssql_query($query);
      $dato   = mssql_fetch_array($result);
      return $dato[$campo];
      
    }






}



 ?>