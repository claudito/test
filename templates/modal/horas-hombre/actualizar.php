<?php 

include('../../../autoload.php');
$dni         = $_GET['dni'];
$id          = $_GET['id'];
$usuariosdet  = new Usuariosdet($dni,'?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');


 ?>

 <script type="text/javascript" charset="utf-8">
$(document).ready(function() {
// Parametros para el combo
$("#idsueldo").change(function () {
$("#idsueldo option:selected").each(function () {
elegido=$(this).val();
$.post("../ajax/select/sueldos.php", { elegido: elegido }, function(data){
$("#lista-sueldos").html(data);
});     
});
});    
});
</script>

 <?php if (count($usuariosdet->lista_meses($dni)) > 0): ?>
 
 <form role="form" id="actualizar" >
  
  <label >Lista de Sueldos por Año y Mes</label>
  <select name="" id="idsueldo" class="form-control">
  <option value="">[ Seleccionar ]</option>
	<?php 

	foreach ($usuariosdet->lista_meses() as $key => $value) 
	{
      echo "<option value='".$value['ANIO'].$value['MES'].$dni.$id."'>".$value['ANIO'].' - '.$value['MES']."</option>";
	}

	?>
  </select>

  <div id="lista-sueldos"></div>

</form>

 <?php else: ?>
 <p class="alert alert-warning">No tiene ningún mes registrado</p>
 <?php endif ?>