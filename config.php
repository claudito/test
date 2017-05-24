<?php 
#error_reporting(0);
date_default_timezone_set('America/Lima');

//define("PATH", "http://".$_SERVER['SERVER_NAME'].substr(dirname(__FILE__).DIRECTORY_SEPARATOR,strlen($_SERVER['DOCUMENT_ROOT'])));
define("PATH","http://localhost/app-costos/");
define("FOLDER","/app-costos/");
define("RUTA", dirname(__FILE__).DIRECTORY_SEPARATOR);
define("SERVER","localhost");
define("USER", "SISTEMAS");
define("PASS", "SISTEMAS");
define("BD", "[BD_COSTOS]");
define("BDCOMUN", "[010BDCOMUN]");
define("BDCONTABILIDAD","[010BDCONTABILIDAD]");
define("BDPLANILLA","[CODRISE]");
define("BDRESERVA","[022BDCOMUN]");
define("FECHA",'d-m-Y');
define("ADMIN01", "45517818");
define("ADMIN02", "44050692");

$key  = date('Y-m-d').$_SERVER['SERVER_NAME'].FOLDER;
define("KEY",$key);

define("USUARIO", "usuario");
define("NOMBRES", "nombres");
define("APELLIDOS", "apellidos");
define("TIPO", "tipo");





 ?>
