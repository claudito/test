<?php 

class Submenu
{

	protected $nombre;
	protected $idmenu;
	protected $url;
	protected $item;
	
	function __construct($nombre,$idmenu,$url,$item)
	{ 

	   $this->nombre = $nombre;
	   $this->idmenu = $idmenu;
	   $this->url    = $url;
	   $this->item   = $item;
	
	}

 function agregar()
  { 
    $conexion =  new Conexion();
    $conexion ->sqlserver();
    $query  = "SELECT * FROM ".BD.".DBO.SUB_MENU WHERE  URL='".trim($this->url)."'";
    $result = mssql_query($query);
    if (mssql_num_rows($result) > 0) 
    {
      return "existe";
    }
    else 
    {
    $query  =  "INSERT INTO ".BD.".DBO.SUB_MENU(NOMBRE,ID_MENU,URL,ITEM)VALUES('".trim($this->nombre)."','".trim($this->idmenu)."','".trim($this->url)."','".trim($this->item)."')";
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
    $query  =  "UPDATE ".BD.".DBO.SUB_MENU SET NOMBRE = '".trim($this->nombre)."',ITEM = '".trim($this->item)."',URL = '".trim($this->url)."',ID_MENU = '".trim($this->idmenu)."' WHERE ID='".$id."'";
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
    $query  =  "DELETE FROM  ".BD.".DBO.SUB_MENU WHERE ID='".trim($id)."'";
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

    function lista_menu($menu,$usuario)
    {
	$conexion =  new Conexion();
	$conexion -> sqlserver();
    $query  =  "SELECT SM.ID,SM.NOMBRE,SM.ID_MENU,SM.URL,PM.USUARIO,PM.ESTADO 
    FROM  ".BD.".DBO.SUB_MENU AS SM  INNER  JOIN 
    ".BD.".DBO.PERMISOS_MENU  AS PM ON SM.ID=PM.ID_SUB_MENU
    WHERE ID_MENU='".$menu."' AND USUARIO='".$usuario."'
    ";
		$result = mssql_query($query);
		while ($fila = mssql_fetch_assoc($result))
		{
		  $dato[] = $fila;
		}

		return $dato;
    }


    function lista()
    {

    $conexion =  new Conexion();
	$conexion -> sqlserver();
    $query  =  "SELECT M.ID AS IDMENU,SM.ID,SM.NOMBRE,SM.URL,SM.ITEM,M.NOMBRE AS MENU FROM ".BD.".DBO.SUB_MENU  AS SM INNER JOIN ".BD.".DBO.MENU AS M ON SM.ID_MENU=M.ID ";
		$result = mssql_query($query);
		while ($fila = mssql_fetch_assoc($result))
		{
		  $dato[] = $fila;
		}

		return $dato;

    }

}



 ?>