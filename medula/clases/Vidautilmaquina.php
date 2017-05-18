<?php 

class Vidautilmaquina
{

  protected $anio;
  protected $mes;
  protected $tiempo_mes;
  protected $tiempo_anio;
  protected $tipo;
	
	function __construct($anio,$mes,$tiempo_mes,$tiempo_anio,$tipo)
	{
	  $this->anio        = $anio;
    $this->mes         = $mes;
    $this->tiempo_mes  = $tiempo_mes;
    $this->tiempo_anio = $tiempo_anio;
    $this->tipo        = $tipo;
 
	}


   
  function agregar()
  { 
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  = "SELECT * FROM ".BD.".DBO.VIDA_UTIL_MAQUINA WHERE  ANIO='".trim($this->anio)."' AND MES='".trim($this->mes)."' AND TIEMPO_MES='".trim($this->tiempo_mes)."' AND TIEMPO_ANIO='".trim($this->tiempo_anio)."'" ;
    $result = mssql_query($query);
    if (mssql_num_rows($result) > 0) 
    {
      return "existe";
    }
    else 
    {
    $query  =  "INSERT INTO ".BD.".DBO.VIDA_UTIL_MAQUINA(ANIO,MES,TIEMPO_MES,TIEMPO_ANIO,TIPO)VALUES('".trim($this->anio)."','".trim($this->mes)."','".trim($this->tiempo_mes)."','".trim($this->tiempo_anio)."','".trim($this->tipo)."')";
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


   
  function actualizar($id)
  { 
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  =  "UPDATE ".BD.".DBO.VIDA_UTIL_MAQUINA SET TIEMPO_MES = '".trim($this->tiempo_mes)."',TIEMPO_ANIO = '".trim($this->tiempo_anio)."',TIPO = '".trim($this->tipo)."' WHERE ID='".$id."'";
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
   

   function eliminar($id)
  { 
    
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  =  "DELETE FROM  ".BD.".DBO.VIDA_UTIL_MAQUINA WHERE ID='".trim($id)."'";
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


   

    function lista()
    {
      
      $conexion =  new Conexion();
      $conexion -> sqlserver();
      $query  =  "SELECT * FROM ".BD.".DBO.VIDA_UTIL_MAQUINA ORDER BY  ID";
      $result = mssql_query($query);
      while ($fila = mssql_fetch_assoc($result))
       {
      	  $dato[] = $fila;
       }

       return $dato;

    }

     function consulta($id,$campo)
    {
      
      $conexion =  new Conexion();
      $conexion -> sqlserver();
      $query  =  "SELECT * FROM ".BD.".DBO.VIDA_UTIL_MAQUINA WHERE ID='".$id."'";
      $result = mssql_query($query);
      $dato   = mssql_fetch_array($result);
      return $dato[$campo];

    }



}



 ?>