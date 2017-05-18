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
        WHERE O.OF_ESTADO='ACTIVO' ORDER BY CODIGOOT";
      $result = mssql_query($query);
      while ($fila = mssql_fetch_assoc($result))
       {
      	  $dato[] = $fila;
       }

       return $dato;

    }


     function lista_actualizar($ot)
    {
      
      $conexion =  new Conexion();
      $conexion -> sqlserver();
      $query  =  "SELECT CODIGOCENTROCOSTO,CODIGOOT,CODIGO,OF_ESTADO,O.OF_ARTCANT,O.OF_ARTNOM,M.ADESCRI  FROM ".BDRESERVA.".dbo.CENCOSOT AS CO 
        INNER JOIN ".BDCOMUN.".DBO.ORD_FAB AS O ON CO.CODIGOOT=O.OF_COD 
        LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
        WHERE O.OF_ESTADO='ACTIVO'  AND CODIGOOT <> '".$ot."'  ORDER BY CODIGOOT";
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
      $query  =  "SELECT CODIGOCENTROCOSTO,CODIGOOT,CODIGO,OF_ESTADO,O.OF_ARTCANT,O.OF_ARTNOM,M.ADESCRI 
FROM ".BDRESERVA.".dbo.CENCOSOT AS CO 
INNER JOIN ".BDCOMUN.".DBO.ORD_FAB AS O ON CO.CODIGOOT=O.OF_COD
LEFT JOIN ".BDCOMUN.".DBO.MAEART AS M ON CO.CODIGO=M.ACODIGO
WHERE O.OF_ESTADO='ACTIVO' AND CODIGOOT='".$ot."'";
      $result = mssql_query($query);
      $dato   = mssql_fetch_array($result);
      return $dato[$campo];

    }





}



 ?>