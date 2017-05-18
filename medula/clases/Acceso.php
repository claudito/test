<?php 


class  Acceso{


protected $user;
protected $pass;


function __construct($user,$pass)
{

	 $this->user  = $user;
	 $this->pass  = $pass;

}


function Login()
{
   
   $conexion =  new Conexion();
   $conexion ->sqlserver();

   $query = "SELECT  * FROM ".BD.".DBO.USUARIOS WHERE USUARIO='".$this->user."' AND 
     PASS='".$this->pass."'";
   $result = mssql_query($query);
   $dato   = mssql_fetch_array($result);
	if (mssql_num_rows($result)>0) 
	{
	session_start();
	$_SESSION[KEY.USUARIO]=$dato['ID'];
	$_SESSION[KEY.NOMBRES]=$dato['NOMBRES'];
	$_SESSION[KEY.APELLIDOS]=$dato['APELLIDOS'];
	$_SESSION[KEY.TIPO]=$dato['TIPO'];


	return "true";


	} 
	else
	{
	return "error";
	}

   
}


function Logout()
{

session_start();
if (!isset($_SESSION[KEY.USUARIO]))
{
 header('Location: '.PATH.'');
} 
else 
{
	unset($_SESSION[KEY.USUARIO]);
	unset($_SESSION[KEY.NOMBRES]);
	unset($_SESSION[KEY.APELLIDOS]);
	unset($_SESSION[KEY.TIPO]);
    header('Location: '.PATH.'');
    
}
 


	
}



}







 ?>