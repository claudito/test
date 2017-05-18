<?php 


class Permisos
{

	function __construct()
	{
		
	}

   
function agregar($usuario)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "INSERT INTO ".BD.".DBO.PERMISOS_MENU(ID_SUB_MENU,USUARIO,ESTADO)
SELECT ID,'".trim($usuario)."',0 FROM ".BD.".DBO.SUB_MENU  WHERE  ID NOT IN (
SELECT  ID_SUB_MENU FROM ".BD.".DBO.PERMISOS_MENU WHERE  USUARIO='".trim($usuario)."')";
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



function actualizar($id,$usuario,$estado)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query = "UPDATE PERMISOS_MENU SET  ESTADO='".$estado."'  
WHERE  USUARIO='".$usuario."' AND ID_SUB_MENU='".$id."'";
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



function lista($usuario)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "SELECT SM.ID,SM.NOMBRE AS SUBMENU,M.NOMBRE AS MENU,PM.ESTADO,ISNULL(PM.USUARIO,0) AS USUARIO from ".BD.".DBO.MENU AS M INNER JOIN ".BD.".DBO.SUB_MENU AS SM
ON M.ID=SM.ID_MENU LEFT JOIN 
(SELECT * FROM ".BD.".DBO.PERMISOS_MENU  WHERE  USUARIO=".$usuario.") AS PM ON
SM.ID=PM.ID_SUB_MENU ORDER BY M.NOMBRE";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$this->lista[] = $fila;
}

return $this->lista;

}


}

 ?>