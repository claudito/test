<?php 


class Conexion
{

function __construct()
{

}


function sqlserver()
{

if(!($link = mssql_connect(SERVER,USER,PASS)))
{
echo  "Servidor Conectado:ERROR";
exit();
}
else
{
#echo  "Servidor Conectado:OK";

}

#echo "</br>";

if (!mssql_select_db(BD,$link))
{
echo  "BD Conectada:ERROR";
exit();
}
else
{
#echo  "BD Conectada:OK";

}

return $link;

}


function Mysql()
{

}


}

 ?>