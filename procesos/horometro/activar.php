<?php 

include('../../autoload.php');


if (empty($_GET['id'])) 
{   echo "<meta charset='utf-8'>";
    echo '<script>
     alert("Algún registro esta vació");
     window.location="'.PATH.'pages/horometro";
     </script>';
}
else
{
     $id      = $_GET['id'];
     $valor   = $_GET['valor'];
 

     $horometro  =  new Horometro('?','?','?','?');
     $valor = $horometro -> activar($id,$valor);

  if ($valor == 'ok')  
{
echo "<meta charset='utf-8'>";
echo '<script>
     alert("Horómetro Seleccionado Activado");
     window.location="'.PATH.'pages/horometro";
     </script>';
}
else if ($valor == 'error')  
{
echo "<meta charset='utf-8'>";
echo '<script>
     alert("Error de Activación");
     window.location="'.PATH.'pages/horometro";
     </script>';
}
else
{
echo "<meta charset='utf-8'>";
echo '<script>
     alert("Error de Activación");
     window.location="'.PATH.'pages/horometro";
     </script>';
}




}





 ?>