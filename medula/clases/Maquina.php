<?php 

class Maquina
{


	protected $codigo_interno;
	protected $fecha_adquisicion;
	protected $fecha_inicio;
	protected $cantidad;
	protected $fecha_termino;
	protected $meses_deprec;
	protected $meses_faltan;
	protected $contrato_factura;
	protected $descripcion;
	protected $tipo;
	protected $descripcion_abrv;
	protected $modelo;
	protected $serie;
	protected $marca;
	protected $valor_contable;


	function __construct($codigo_interno,$fecha_adquisicion,$fecha_inicio,$cantidad,$fecha_termino,$meses_deprec,$meses_faltan,$contrato_factura,$descripcion,$tipo,$descripcion_abrv,$modelo,$serie,$marca,$valorcontable)
	{

	$this->codigo_interno     = $codigo_interno;
	$this->fecha_adquisicion  = $fecha_adquisicion;
	$this->fecha_inicio       = $fecha_inicio;
	$this->cantidad           = $cantidad;
	$this->fecha_termino      = $fecha_termino;
	$this->meses_deprec       = $meses_deprec;
	$this->meses_faltan       = $meses_faltan;
	$this->contrato_factura   = $contrato_factura;
	$this->descripcion        = $descripcion;
	$this->tipo               = $tipo;
	$this->descripcion_abrv   = $descripcion_abrv;
	$this->modelo             = $modelo;
	$this->serie              = $serie;
	$this->marca              = $marca;
	$this->valorcontable      = $valorcontable;


	}


	function agregar()
	{
	$conexion = new Conexion();
	$conexion -> sqlserver();
	$query  = "SELECT * FROM ".BD.".DBO.MAQUINA WHERE CODIGO_INTERNO='".trim($this->codigo_interno)."'";
	$result = mssql_query($query);
	if (mssql_num_rows($result) > 0) 
	{

	return "existe";

	}
	else
	{
	$query  = "INSERT INTO ".BD.".DBO.MAQUINA(CODIGO_INTERNO,FECHA_ADQUISICION,FECHA_INICIO,CANTIDAD,FECHA_TERMINO,CONTRATO_FACTURA,DESCRIPCION,ID_TIPO_MAQUINA,DESCRIPCION_ABRV,MODELO,SERIE,MARCA,VALOR_CONTABLE
	) VALUES('".trim($this->codigo_interno)."','".trim($this->fecha_adquisicion)."','".trim($this->fecha_inicio)."','".trim($this->cantidad)."','".trim($this->fecha_termino)."','".trim($this->contrato_factura)."','".trim($this->descripcion)."','".trim($this->tipo)."','".trim($this->descripcion_abrv)."','".trim($this->modelo)."','".trim($this->serie)."','".trim($this->marca)."','".trim($this->valorcontable)."')";
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


	function actualizar($id,$estado)
	{

	$conexion =  new Conexion();
	$conexion -> sqlserver();
	$query  =  "UPDATE ".BD.".DBO.MAQUINA SET FECHA_ADQUISICION='".trim($this->fecha_adquisicion)."' ,FECHA_INICIO='".trim($this->fecha_inicio)."',CANTIDAD='".trim($this->cantidad)."',FECHA_TERMINO='".trim($this->fecha_termino)."',CONTRATO_FACTURA='".trim($this->contrato_factura)."',DESCRIPCION='".trim($this->descripcion)."',ID_TIPO_MAQUINA='".trim($this->tipo)."',DESCRIPCION_ABRV='".trim($this->descripcion_abrv)."',MODELO='".trim($this->modelo)."',SERIE='".trim($this->serie)."',MARCA='".trim($this->marca)."',VALOR_CONTABLE='".trim($this->valorcontable)."',ESTADO='".trim($estado)."'  WHERE ID='".trim($id)."'";
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
	$query  =  "DELETE FROM  ".BD.".DBO.MAQUINA  WHERE ID='".trim($id)."'";
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
	$query  =  "SELECT M.ID,M.CODIGO_INTERNO,M.FECHA_ADQUISICION,M.FECHA_INICIO,M.CANTIDAD,M.FECHA_TERMINO,M.CONTRATO_FACTURA,M.DESCRIPCION,M.ID_TIPO_MAQUINA AS IDTIPO,TM.DESCRIPCION AS TIPO,M.DESCRIPCION_ABRV,M.MODELO,M.SERIE,M.MARCA,M.VALOR_CONTABLE,M.ESTADO FROM ".BD.".DBO.MAQUINA AS M  INNER JOIN ".BD.".DBO.TIPO_MAQUINA  AS TM 
         ON M.ID_TIPO_MAQUINA=TM.ID";
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
	$query  =  "SELECT M.ID,M.CODIGO_INTERNO,M.FECHA_ADQUISICION,M.FECHA_INICIO,M.CANTIDAD,M.FECHA_TERMINO,M.CONTRATO_FACTURA,M.DESCRIPCION,M.ID_TIPO_MAQUINA AS IDTIPO,TM.DESCRIPCION AS TIPO,M.DESCRIPCION_ABRV,M.MODELO,M.SERIE,M.MARCA,M.VALOR_CONTABLE,M.ESTADO FROM ".BD.".DBO.MAQUINA AS M  INNER JOIN ".BD.".DBO.TIPO_MAQUINA  AS TM 
         ON M.ID_TIPO_MAQUINA=TM.ID WHERE M.ID <> '".$id."'";
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
	$query  =  "
SELECT M.ID,M.CODIGO_INTERNO,M.FECHA_ADQUISICION,M.FECHA_INICIO,M.CANTIDAD,M.FECHA_TERMINO,M.CONTRATO_FACTURA,
M.DESCRIPCION,M.ID_TIPO_MAQUINA AS IDTIPO,TM.DESCRIPCION AS TIPO,M.DESCRIPCION_ABRV,M.MODELO,M.SERIE,M.MARCA,
M.VALOR_CONTABLE,M.ESTADO FROM ".BD.".DBO.MAQUINA AS M  INNER JOIN ".BD.".DBO.TIPO_MAQUINA  AS TM 
ON M.ID_TIPO_MAQUINA=TM.ID WHERE M.ID='".$id."'";
	$result = mssql_query($query);
	$dato   = mssql_fetch_array($result);

	return $dato[$campo];

	}


}

 ?>