<?php 



class Documentos
{
	
function __construct()
{
# code...
}


function lista()
{
	
$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT * FROM ".BD.".DBO.DOCUMENTOS
";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}


function existe($nombre,$version)
{
	
$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT * FROM ".BD.".DBO.DOCUMENTOS WHERE NOMBRE='".$nombre."' AND VERSION='".$version."'
";
$result = mssql_query($query);
if (mssql_num_rows($result)>0) 
{
  return "existe";
} 
else
{
  return "noexiste";
  
}

}


function agregar($nombre,$version,$ruta)
{
	
$conexion =  new Conexion();
$conexion -> sqlserver();

$query  =  "
INSERT INTO ".BD.".DBO.DOCUMENTOS(NOMBRE,RUTA,VERSION)VALUES('".$nombre."','".$ruta."','".$version."')
";
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
$conexion -> sqlserver();
$query  =  "
DELETE FROM ".BD.".DBO.DOCUMENTOS WHERE ID='".$id."'
";
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



function consulta($id,$campo)
{
	
$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT * FROM ".BD.".DBO.DOCUMENTOS WHERE ID='".$id."'
";
$result = mssql_query($query);
$dato   = mssql_fetch_array($result);
return $dato[$campo];

}




}



 ?>