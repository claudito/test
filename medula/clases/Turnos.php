<?php 

class Turnos
{

  protected $codigo;
  protected $hora_ingreso;
  protected $salida_refrigerio;
  protected $ingreso_refrigerio;
  protected $hora_salida;


	
	function __construct($codigo,$hora_ingreso,$salida_refrigerio,$ingreso_refrigerio,$hora_salida)
	{
	  $this->codigo             = $codigo;
    $this->hora_ingreso       = $hora_ingreso;
    $this->salida_refrigerio  = $salida_refrigerio;
    $this->ingreso_refrigerio = $ingreso_refrigerio;
    $this->hora_salida        = $hora_salida;

	}


   
  function agregar()
  { 
    $conexion =  new Conexion();
    $conexion->sqlserver();
    $query  = "SELECT * FROM ".BD.".DBO.TURNO WHERE CODIGO='".$this->codigo."'";
    $result = mssql_query($query);
    if (mssql_num_rows($result)>0) 
    {
      return "existe";
    } 
    else 
    {
       $query  =  "INSERT INTO ".BD.".DBO.TURNO(CODIGO,HORA_INGRESO,SALIDA_REFRIGERIO,INGRESO_REFRIGERIO,HORA_SALIDA)VALUES('".trim($this->codigo)."','".trim($this->hora_ingreso)."','".trim($this->salida_refrigerio)."','".trim($this->ingreso_refrigerio)."','".trim($this->hora_salida)."')";
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
    $query  =  "UPDATE ".BD.".DBO.TURNO SET 
    HORA_INGRESO = '".trim($this->hora_ingreso)."',
    SALIDA_REFRIGERIO = '".trim($this->salida_refrigerio)."',
    INGRESO_REFRIGERIO = '".trim($this->ingreso_refrigerio)."',
    HORA_SALIDA = '".trim($this->hora_salida)."'

    WHERE ID='".$id."'";
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
    $query  =  "DELETE FROM  ".BD.".DBO.TURNO WHERE ID='".trim($id)."'";
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
$query  =  "SELECT * FROM ".BD.".DBO.TURNO ORDER BY CODIGO";
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
$query  =  "SELECT * FROM ".BD.".DBO.TURNO  WHERE ID <> '".$id."' ORDER BY CODIGO";
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
$query  =  "SELECT * FROM ".BD.".DBO.TURNO WHERE ID='".$id."'";
$result = mssql_query($query);
$dato   = mssql_fetch_array($result);
return  $dato[$campo];

}


}



 ?>