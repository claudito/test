<?php 

include'../../autoload.php';
include'../../session.php';


$nombre      = $_POST['nombre'];
$version     = $_POST['version'];

$documentos  = new Documentos();

if ($documentos->existe($nombre,$version)=='noexiste') 
{

$detalle            = $nombre.'-'.'V'.$version.'-';
$nombre_archivo     = utf8_decode($detalle.$_FILES['archivo']['name']);
$archivo_temporal   = $_FILES['archivo']['tmp_name'];
$destino            = "../../uploads/".$nombre_archivo;
move_uploaded_file($archivo_temporal,$destino);
$valor = $documentos->agregar(utf8_decode($nombre),$version,$nombre_archivo);

if ($valor=='ok')
{
 echo '<script>
	swal({
	title: "Buen Trabajo",
	text: "Archivo Subido",
	type:"success",
	timer: 2000,
	showConfirmButton: false
	});
	</script>';
}
else
{
  echo '<script>
	swal({
	title: "Error de Registro",
	text: "Consulte al área de Soporte",
	type:"danger",
	timer: 2000,
	showConfirmButton: false
	});
	</script>';
}


}
else
{
  echo '<script>
	swal({
	title: "El archvivo ya esta registrado",
	text: "Intento de Nuevo",
	type:"warning",
	timer: 2000,
	showConfirmButton: false
	});
	</script>';
}






 ?>