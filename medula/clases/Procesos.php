<?php 

class Procesos
{

  protected $nombre;
  protected $detalle;
  protected $facturable;
  protected $productivo;
  protected $tipo_stand_by;
	
	function __construct($nombre,$detalle,$facturable,$productivo,$tipo_stand_by)
	{
    $this->nombre        = $nombre;
    $this->detalle       = $detalle;
    $this->facturable    = $facturable;
    $this->productivo    = $productivo;
    $this->tipo_stand_by = $tipo_stand_by;
   
	}


   
  function agregar()
  { 
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  = "SELECT * FROM ".BD.".DBO.PROCESOS WHERE  NOMBRE='".trim($this->nombre)."'";
    $result = mssql_query(utf8_decode($query));
    if (mssql_num_rows($result) > 0) 
    {
      return "existe";
    }
    else 
    {
    $query  =  "INSERT INTO ".BD.".DBO.PROCESOS(NOMBRE,DETALLE,FACTURABLE,PRODUCTIVO,TIPO_STAND_BY)VALUES('".trim($this->nombre)."','".trim($this->detalle)."','".trim($this->facturable)."','".trim($this->productivo)."','".trim($this->tipo_stand_by)."')";
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
    $query  =  "UPDATE ".BD.".DBO.PROCESOS SET 
    DETALLE = '".trim($this->detalle)."',
    FACTURABLE = '".trim($this->facturable)."',
    PRODUCTIVO = '".trim($this->productivo)."',
    TIPO_STAND_BY = '".trim($this->tipo_stand_by)."'
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
  }
   

   function eliminar($id)
  { 
    
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  =  "DELETE FROM  ".BD.".DBO.PROCESOS WHERE ID='".trim($id)."'";
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
      $query  =  "SELECT * FROM ".BD.".DBO.PROCESOS ORDER BY ID";
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
      $query    =  "SELECT * FROM ".BD.".DBO.PROCESOS WHERE ID='".$id."'";
      $result   =  mssql_query($query);
      $dato     = mssql_fetch_array($result);
      return $dato[$campo];

    }



}



 ?>