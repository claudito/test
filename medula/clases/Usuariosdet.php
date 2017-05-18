<?php 

class Usuariosdet
{

protected $dni;
protected $anio;
protected $mes;
protected $basico;
protected $vacaciones;
protected $gratificaciones;
protected $cts;
protected $essalud;
protected $sctr_pension;
protected $sctr_salud;
protected $sctr_vida;
protected $senati;
protected $descanso_medico;
protected $bonificacion_ordinaria;
protected $bonificacion_variable;
protected $bonificacion_nocturna;
protected $asignacion_familiar;


	
function __construct($dni,$anio,$mes,$basico,$vacaciones,$gratificaciones,$cts,$essalud,$sctr_salud,$sctr_pension,$sctr_vida,$senati,$descanso_medico,$bonificacion_ordinaria,$bonificacion_variable,$bonificacion_nocturna,$asignacion_familiar)
{

$this->dni                     = $dni;
$this->anio                    = $anio;
$this->mes                     = $mes;
$this->basico                  = $basico;
$this->vacaciones              = $vacaciones;
$this->gratificaciones         = $gratificaciones;
$this->cts                     = $cts;
$this->essalud                 = $essalud;
$this->sctr_pension            = $sctr_pension;
$this->sctr_salud              = $sctr_salud;
$this->sctr_vida               = $sctr_vida;
$this->senati                  = $senati;
$this->descanso_medico         = $descanso_medico;
$this->bonificacion_ordinaria  = $bonificacion_ordinaria;
$this->bonificacion_variable   = $bonificacion_variable;
$this->bonificacion_nocturna   = $bonificacion_nocturna;
$this->asignacion_familiar     = $asignacion_familiar;



}



function agregar()
{ 


}



function actualizar()
{ 

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "UPDATE  ".BD.".DBO.USUARIOS_DET SET 
BASICO='".$this->basico."',
BONIFICACION_ORDINARIA='".$this->bonificacion_ordinaria."',
BONIFICACION_VARIABLE='".$this->bonificacion_variable."',
BONIFICACION_NOCTURNA='".$this->bonificacion_nocturna."',
ASIGNACION_FAMILIAR='".$this->asignacion_familiar."',
VACACIONES='".$this->vacaciones."',
GRATIFICACIONES='".$this->gratificaciones."',
CTS='".$this->cts."',
ESSALUD='".$this->essalud."',
SCTR_PENSION='".$this->sctr_pension."',
SCTR_SALUD='".$this->sctr_salud."',
SCTR_VIDA='".$this->sctr_vida."',
SENATI='".$this->senati."',
DESCANSO_MEDICO='".$this->descanso_medico."'
WHERE DNI='".$this->dni."'
AND ANIO='".$this->anio."' AND MES='".$this->mes."'
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


function eliminar()
{ 





}


   

function lista_meses()
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "SELECT ANIO,MES FROM ".BD.".DBO.USUARIOS_DET  WHERE DNI='".$this->dni."'
GROUP BY ANIO,MES ORDER BY ANIO,MES
	";
$result = mssql_query($query);
while ($fila = mssql_fetch_assoc($result))
{
$dato[] = $fila;
}

return $dato;

}


function consulta($campo)
{

$conexion =  new Conexion();
$conexion -> sqlserver();
$query  =  "SELECT * FROM ".BD.".DBO.USUARIOS_DET  WHERE DNI='".$this->dni."' AND ANIO+MES='".$this->anio.$this->mes."'";
$result = mssql_query($query);
$dato   = mssql_fetch_array($result);
return $dato[$campo];

}






}



 ?>