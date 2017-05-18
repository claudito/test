<?php

include('../../autoload.php');          

$id                = addslashes(trim($_POST['id']));

$procesos_maquina   = new Procesos_maquina($procesos,$maquina); 

$valor              = $procesos_maquina -> eliminar($id);

 if ($valor == 'ok')  
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
    

?>