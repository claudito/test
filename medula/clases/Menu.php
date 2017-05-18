<?php 

class Menu
{

  protected $nombre;
  protected $item;
	
	function __construct($nombre,$item)
	{
	  $this->nombre = $nombre;
    $this->item   = $item;
	}


   
  function agregar()
  { 
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  = "SELECT * FROM ".BD.".DBO.MENU WHERE  NOMBRE='".trim($this->nombre)."'";
    $result = mssql_query($query);
    if (mssql_num_rows($result) > 0) 
    {
      return "existe";
    }
    else 
    {
    $query  =  "INSERT INTO ".BD.".DBO.MENU(NOMBRE,ITEM)VALUES('".trim($this->nombre)."','".trim($this->item)."')";
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
    $query  =  "UPDATE ".BD.".DBO.MENU SET NOMBRE = '".trim($this->nombre)."',ITEM = '".trim($this->item)."' WHERE ID='".$id."'";
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
    $query  = "SELECT * FROM ".BD.".DBO.SUB_MENU  WHERE ID_MENU='".trim($id)."'";
    $result = mssql_query($query);
    if (mssql_num_rows($result) > 0) 
    {
      return "existe";
    }
    else 
    {
    $query  =  "DELETE FROM  ".BD.".DBO.MENU WHERE ID='".trim($id)."'";
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
      $query  =  "SELECT * FROM ".BD.".DBO.MENU ORDER BY ITEM";
      $result = mssql_query($query);
      while ($fila = mssql_fetch_assoc($result))
       {
      	  $dato[] = $fila;
       }

       return $dato;

    }



}



 ?>