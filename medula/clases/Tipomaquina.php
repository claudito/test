<?php 

class Tipomaquina
{

  protected $descripcion;
	
	function __construct($descripcion)
	{
    $this->descripcion   = $descripcion;
	}


   
  function agregar()
  { 
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  = "SELECT * FROM ".BD.".DBO.TIPO_MAQUINA WHERE  DESCRIPCION='".trim($this->descripcion)."'";
    $result = mssql_query($query);
    if (mssql_num_rows($result) > 0) 
    {
      return "existe";
    }
    else 
    {
    $query  =  "INSERT INTO ".BD.".DBO.TIPO_MAQUINA(DESCRIPCION)VALUES('".trim($this->descripcion)."')";
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
    $query  =  "UPDATE ".BD.".DBO.TIPO_MAQUINA SET DESCRIPCION = '".trim($this->descripcion)."' WHERE ID='".$id."'";
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
    $query  = "SELECT * FROM ".BD.".DBO.MAQUINA  WHERE ID_TIPO_MAQUINA='".trim($id)."'";
    $result = mssql_query($query);
    if (mssql_num_rows($result) > 0) 
    {
      return "existe";
    }
    else 
    {
    $query  =  "DELETE FROM  ".BD.".DBO.TIPO_MAQUINA  WHERE ID='".trim($id)."'";
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


   

    function lista()
    {
      
      $conexion =  new Conexion();
      $conexion -> sqlserver();
      $query  =  "SELECT * FROM ".BD.".DBO.TIPO_MAQUINA ORDER BY DESCRIPCION";
      $result = mssql_query($query);
      while ($fila = mssql_fetch_assoc($result))
       {
      	  $dato[] = $fila;
       }

       return $dato;

    }

     function lista_actualizar($id)
    {
      
      $conexion =  new Conexion();
      $conexion -> sqlserver();
      $query  =  "SELECT * FROM ".BD.".DBO.TIPO_MAQUINA WHERE  ID <> '".$id."' ORDER BY DESCRIPCION";
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
    $query  =  "SELECT * FROM ".BD.".DBO.TIPO_MAQUINA WHERE ID='".trim($id)."'";
    $result = mssql_query($query);
    $dato   = mssql_fetch_array($result);
    return  $dato[$campo];

    }


}



 ?>