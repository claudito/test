<?php 

class Procesos_maquina
{

  protected $procesos;
  protected $maquina;
	
	function __construct($procesos,$maquina)
	{

    $this->procesos      = $procesos;
    $this->maquina       = $maquina;
	}


   
  function agregar()
  { 
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  = "SELECT * FROM ".BD.".DBO.PROCESOS_MAQUINA WHERE ID_PROCESOS='".trim($this->procesos)."' AND ID_MAQUINA='".trim($this->maquina)."'";
    $result = mssql_query(utf8_decode($query));
    if (mssql_num_rows($result) > 0) 
    {
      return "existe";
    }
    else 
    {
    $query  =  "INSERT INTO ".BD.".DBO.PROCESOS_MAQUINA(ID_PROCESOS,ID_MAQUINA)VALUES('".trim($this->procesos)."','".trim($this->maquina)."')";
    $result = mssql_query(utf8_decode($query));
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
    $query  =  "UPDATE ".BD.".DBO.PROCESOS_MAQUINA SET ID_PROCESOS = '".trim($this->procesos)."',ID_MAQUINA = '".trim($this->maquina)."' WHERE ID='".$id."'";
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
    $query  =  "DELETE FROM  ".BD.".DBO.PROCESOS_MAQUINA WHERE ID='".trim($id)."'";
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
      $query  =  "SELECT PM.ID,PM.ID_PROCESOS,ID_MAQUINA,P.NOMBRE,M.CODIGO_INTERNO,M.DESCRIPCION FROM ".BD.".DBO.PROCESOS_MAQUINA AS PM  
  INNER JOIN ".BD.".DBO.PROCESOS AS P ON PM.ID_PROCESOS=P.ID
  INNER JOIN ".BD.".DBO.MAQUINA  AS M ON PM.ID_MAQUINA=M.ID ";
      $result = mssql_query($query);
      while ($fila = mssql_fetch_assoc($result))
       {
      	  $dato[] = $fila;
       }

       return $dato;

    }



  function lista_proceso_maquina($id)
  {

  $conexion =  new Conexion();
  $conexion -> sqlserver();
  $query  =  "SELECT PM.ID,PM.ID_PROCESOS,ID_MAQUINA,P.NOMBRE,M.CODIGO_INTERNO,M.DESCRIPCION FROM ".BD.".DBO.PROCESOS_MAQUINA AS PM  
  INNER JOIN ".BD.".DBO.PROCESOS AS P ON PM.ID_PROCESOS=P.ID
  INNER JOIN ".BD.".DBO.MAQUINA  AS M ON PM.ID_MAQUINA=M.ID
  WHERE PM.ID_PROCESOS='".$id."' ORDER BY M.CODIGO_INTERNO";
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
      $query    =  "SELECT PM.ID,PM.ID_PROCESOS,ID_MAQUINA,P.NOMBRE,M.CODIGO_INTERNO,M.DESCRIPCION FROM ".BD.".DBO.PROCESOS_MAQUINA AS PM  
  INNER JOIN ".BD.".DBO.PROCESOS AS P ON PM.ID_PROCESOS=P.ID
  INNER JOIN ".BD.".DBO.MAQUINA  AS M ON PM.ID_MAQUINA=M.ID
  WHERE PM.ID='".$id."'";
      $result   =  mssql_query($query);
      $dato     = mssql_fetch_array($result);
      return $dato[$campo];

    }



}



 ?>