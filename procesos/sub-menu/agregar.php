<?php

include('../../autoload.php');  		

$nombre    = addslashes(trim($_POST['nombre']));
$menu      = addslashes(trim($_POST['menu']));
$url       = addslashes(trim($_POST['url']));
$item      = addslashes(trim($_POST['item']));
$submenu   = new Submenu($nombre,$menu,$url,$item); 
$valor     = $submenu -> agregar();

if ($valor == 'existe') 
{
echo '<script>
    swal({
    title: "Registro Dupiclado",
    text: "Verifique de nuevo",
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
    text: "Registro Exitoso",
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
    title: "Error de Registro ",
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
    title: "Error de Registro ",
    text: "Consulte al área de Soporte",
    type:"danger",
    timer: 2000,
    showConfirmButton: false
    });
     </script>';
}
    

?>