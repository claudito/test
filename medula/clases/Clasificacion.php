<?php 

class Clasificacion
{

  protected $nombre;
  protected $detalle;
  protected $abrv;
  protected $asistencia;
  protected $tipo_stand_by;

	
	function __construct($nombre,$detalle,$abrv,$asistencia,$tipo_stand_by)
	{
	  $this->nombre        = $nombre;
    $this->detalle       = $detalle;
    $this->abrv          = $abrv;
    $this->asistencia    = $asistencia;
    $this->tipo_stand_by = $tipo_stand_by;

	}


   
  function agregar()
  { 
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  = "SELECT * FROM ".BD.".DBO.CLASIFICACION WHERE  NOMBRE='".trim($this->nombre)."'";
    $result = mssql_query(utf8_decode($query));
    if (mssql_num_rows($result) > 0) 
    {
      return "existe";
    }
    else 
    {
    $query  =  "INSERT INTO ".BD.".DBO.CLASIFICACION(NOMBRE,DETALLE,ABRV,ASISTENCIA,TIPO_STAND_BY)VALUES('".trim($this->nombre)."','".trim($this->detalle)."','".trim($this->abrv)."','".trim($this->asistencia)."','".trim($this->tipo_stand_by)."')";
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
    $query  =  "UPDATE ".BD.".DBO.CLASIFICACION SET DETALLE = '".trim($this->detalle)."',
    ABRV = '".trim($this->abrv)."',
    ASISTENCIA = '".trim($this->asistencia)."',
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


    function actualizar_relacion_ot($id,$valor)
  { 
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  =  "UPDATE ".BD.".DBO.CLASIFICACION SET RELACION_OT = '".trim($valor)."' WHERE ID='".$id."'";
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
    $query  =  "DELETE FROM  ".BD.".DBO.CLASIFICACION WHERE ID='".trim($id)."'";
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
      $query  =  "SELECT * FROM ".BD.".DBO.CLASIFICACION ORDER BY ID";
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
      $query  =  "SELECT * FROM ".BD.".DBO.CLASIFICACION WHERE ID <> '".$id."' ORDER BY NOMBRE";
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
      $query    =  "SELECT * FROM ".BD.".DBO.CLASIFICACION WHERE ID='".$id."'";
      $result   =  mssql_query($query);
      $dato     = mssql_fetch_array($result);
      return $dato[$campo];

    }



}



 ?>