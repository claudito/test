<?php

include('../../autoload.php');          

$procesos          = addslashes(trim($_POST['procesos']));
$maquina           = addslashes(trim($_POST['maquina']));

$procesos_maquina   = new Procesos_maquina($procesos,$maquina); 

$valor              = $procesos_maquina -> agregar();

 if ($valor == 'existe')  
{
echo '<script>
    swal({
    title: "Código Duplicado",
    text: "Verifique porfavor",
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
    

?>