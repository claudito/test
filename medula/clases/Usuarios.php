<?php 


class Usuarios
{

protected $dni;
protected $tipo;
protected $correo;
protected $pass;



function __construct($dni,$tipo,$correo,$pass)
{
   $this->dni                     = $dni;
   $this->tipo                    = $tipo;
   $this->correo                  = $correo;
   $this->pass                    = $pass;
}


function transferir()
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query = "SELECT  * FROM ".BD.".DBO.USUARIOS WHERE DNI='".trim($this->dni)."'";
$result  = mssql_query($query);
if (mssql_num_rows($result)) 
{
   return  "existe";
}
else
{
	 
   $query  =  "SELECT TIPOTRAB FROM ".BDPLANILLA.".dbo.TRABAJADORES WHERE DOCIDEN='".trim($this->dni)."'";
   $result = mssql_query($query);
   $dato   = mssql_fetch_array($result);
   if ($dato['TIPOTRAB']==20) 
   {
      $query = "INSERT INTO ".BD.".DBO.USUARIOS(NOMBRES,APELLIDOS,DNI,USUARIO,PASS,FECHAING,FECHANAC,CARGO,AREA,TIPO_TRAB,BASICO)
SELECT  T.NOMBRE,T.APEPAT+' '+T.APEMAT,T.DOCIDEN,T.DOCIDEN,'".md5($this->dni)."',T.FECHAING,T.FECHANAC,
T.CARGO,C.NOMBRE,UPPER(TT.DESCRIP),0
FROM ".BDPLANILLA.".DBO.TRABAJADORES AS T INNER JOIN ".BDPLANILLA.".DBO.TIPOSTRAB AS TT ON T.TIPOTRAB=TT.TIPTRAB
INNER JOIN ".BDPLANILLA.".DBO.CCOSTOS AS C ON T.CCOSTO=C.CODCCOSTO
  WHERE DOCIDEN='".trim($this->dni)."' 
";  #CREACIÓN DE  OBREROS
  $result  = mssql_query($query);
    if ($result) 
    {
      return "ok";
    } 
    else
     {
      return "error";
    }
   }
   else
   {
        $query = "INSERT INTO ".BD.".DBO.USUARIOS(NOMBRES,APELLIDOS,DNI,USUARIO,PASS,FECHAING,FECHANAC,CARGO,AREA,TIPO_TRAB,BASICO,SCTR_PENSION,SCTR_SALUD,SCTR_VIDA)
SELECT  T.NOMBRE,T.APEPAT+' '+T.APEMAT,T.DOCIDEN,T.DOCIDEN,'".md5($this->dni)."',T.FECHAING,T.FECHANAC,
T.CARGO,C.NOMBRE,UPPER(TT.DESCRIP),0,'0.50','0.50','0.32' 
FROM ".BDPLANILLA.".DBO.TRABAJADORES AS T INNER JOIN ".BDPLANILLA.".DBO.TIPOSTRAB AS TT ON T.TIPOTRAB=TT.TIPTRAB INNER JOIN ".BDPLANILLA.".DBO.CCOSTOS AS C ON T.CCOSTO=C.CODCCOSTO


  WHERE DOCIDEN='".trim($this->dni)."' 
";#CREACIÓN DE  EMPLEADOS
  $result  = mssql_query($query);
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

}



function actualizar()
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  = "UPDATE ".BD.".DBO.USUARIOS SET CORREO='".$this->correo."',TIPO='".$this->tipo."',PASS='".$this->pass."' WHERE DNI='".$this->dni."'";
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




function actualizar_usuarios_planillas()
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  = "UPDATE ".BD.".DBO.USUARIOS  SET ESTADO=T.SITUACIÓN,TIPO_TRAB=UPPER(TT.DESCRIP),CARGO=T.CARGO
FROM ".BDPLANILLA.".DBO.TRABAJADORES AS T 
INNER JOIN ".BD.".DBO.USUARIOS AS U ON T.DOCIDEN=U.DNI
INNER JOIN ".BDPLANILLA.".DBO.TIPOSTRAB AS TT ON T.TIPOTRAB=TT.TIPTRAB";
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


function eliminar($id,$dni)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query    = "SELECT * FROM ".BD.".DBO.REGISTRO_DIARIO_DET  WHERE ID_USUARIO='".$id."'";
$result   = mssql_query($query);
if (mssql_num_rows($result)>0) 
{
return "existe";
} 
else 
{
 
  $query_usuario      = "DELETE FROM ".BD.".DBO.USUARIOS WHERE ID='".$id."'";
  $query_usuario_det  = "DELETE FROM ".BD.".DBO.USUARIOS_DET WHERE DNI='".$this->dni."'";
  $query_permisos     = "DELETE FROM ".BD.".DBO.PERMISOS_MENU WHERE USUARIO='".$id."'";
  $result_usuario     = mssql_query($query_usuario);
  if ($result_usuario) 
  {
    $result_usuario_det  = mssql_query($query_usuario_det);
    $result_permisos     = mssql_query($query_permisos);
    return "ok";
  } 
  else 
  {
    return "error";
  }
  
}

}



function lista_usuarios_planillas($area,$activo,$inactivo)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "SELECT T.CODTRAB,T.NOMBRE,T.APEPAT,T.APEMAT,T.DOCIDEN,T.FECHAING,T.FECHANAC,
CC.NOMBRE AS AREA,T.CARGO,T.BASICO,T.SITUACIÓN as SITUACION,U.DNI  FROM ".BDPLANILLA.".DBO.TRABAJADORES AS T  INNER JOIN ".BDPLANILLA.".DBO.CCOSTOS AS CC ON T.CCOSTO=CC.CODCCOSTO   LEFT JOIN  ".BD.".DBO.USUARIOS AS U 
 ON T.DOCIDEN=U.DNI   WHERE T.CCOSTO='".$area."' 
AND T.SITUACIÓN IN ('".$activo."','".$inactivo."') ORDER BY T.NOMBRE";
$result = mssql_query(utf8_decode($query));
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
$query  =  "SELECT * FROM ".BD.".DBO.USUARIOS ORDER BY NOMBRES";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}


function consulta($usuario,$campo)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "SELECT * FROM ".BD.".DBO.USUARIOS WHERE ID='".$usuario."'";
$result = mssql_query($query);
$dato   = mssql_fetch_array($result);

return $dato[$campo];

}



}







 ?>