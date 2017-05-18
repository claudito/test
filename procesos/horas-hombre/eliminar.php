<?php 


include '../../autoload.php';
include '../../session.php';

$id        = $_POST['id'];
$dni       = $_POST['dni'];

if ($dni==ADMIN01 || $dni==ADMIN02)
{
echo '<script>
    swal({
    title: "El Usuario no puede ser eliminado",
    type:"warning",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
} 
else
{

$usuarios  = new Usuarios($dni,'?','?','?');

$valor     = $usuarios->eliminar($id,$dni);

if ($valor == 'existe') 
{
echo '<script>
    swal({
    title: "No se puede Eliminar",
    text: "El Usuario tiene registros diarios asociados",
    type:"warning",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
} 
else if ($valor == 'ok')  
{
echo '<script>
    swal({
    title: "Buen Trabajo",
    text: "Registro Eliminado",
    type:"success",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}
else if ($valor == 'error')  
{
echo '<script>
    swal({
    title: "Error de Eliminacion",
    text: "Consulte al área de Soporte",
    type:"danger",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}
else
{
echo '<script>
    swal({
    title: "Error de Eliminación",
    text: "Consulte al área de Soporte",
    type:"danger",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}


}


 ?>