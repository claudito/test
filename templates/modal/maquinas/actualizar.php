<?php 

include('../../../autoload.php');
 $id             = $_GET['id'];
$maquinadet     = new Maquinadet($id,'?','?','?','?');


 ?>

 <script type="text/javascript" charset="utf-8">
$(document).ready(function() {
// Parametros para el combo
$("#idlista").change(function () {
$("#idlista option:selected").each(function () {
elegido=$(this).val();
$.post("../ajax/select/detalle-maquina.php", { elegido: elegido }, function(data){
$("#detalle-maquina").html(data);
});     
});
});    
});
</script>

 <?php if (count($maquinadet->lista_meses()) > 0): ?>
 
 <form role="form" id="actualizar" >
  
  <label >Lista de Años y meses</label>
  <select name="" id="idlista" class="form-control">
  <option value="">[ Seleccionar ]</option>
  <?php 

  foreach ($maquinadet->lista_meses() as $key => $value) 
  {
      echo "<option value='".$value['ANIO'].$value['MES'].$id."'>".$value['ANIO'].' - '.$value['MES']."</option>";
  }

  ?>
  </select>

  <div id="detalle-maquina"></div>

</form>

 <?php else: ?>
 <p class="alert alert-warning">No tiene ningún mes registrado</p>
 <?php endif ?>