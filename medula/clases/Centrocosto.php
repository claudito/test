<?php 


class Centrocosto

{


function __construct()
{

}

function lista()
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "
SELECT  * FROM ".BDPLANILLA.".DBO.CCOSTOS ORDER BY NOMBRE";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
  $dato[] = $fila;
}

return $dato;

}



}






 ?>