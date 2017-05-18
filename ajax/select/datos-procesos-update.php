<?php 

include('../../autoload.php');

$id = $_POST['elegido'];

$clasificacion = new Clasificacion('?','?','?','?','?');

 ?>

 <?php if ($clasificacion->consulta($id,'RELACION_OT')==0): ?>
<div class="col-md-4">
 <p class="alert alert-warning">No hay procesos asociados.</p>
</div>

 <?php else: ?>

 <script type="text/javascript" charset="utf-8">
$(document).ready(function() {
// Parametros para el combo
$("#idprocesos-update").change(function () {
$("#idprocesos-update option:selected").each(function () {
elegido=$(this).val();
$.post("../ajax/select/datos-maquinas-update.php", { elegido: elegido }, function(data){
$("#datos-maquinas-update").html(data);
});     
});
});    
});
</script>

<div class="col-md-4">
 <label>Procesos</label>
 <select name="procesos" id="idprocesos-update" class="form-control" required="">
 <option value="">[ Seleccionar ]</option>
 <?php 

$procesos = new Procesos('?','?','?','?','?');
foreach ($procesos->lista() as $key => $value)
 {
	echo "<option value='".$value['ID']."'>".utf8_encode($value['NOMBRE']).' - '.utf8_encode($value['DETALLE'])."</option>";
 }


  ?>
 </select>
</div>


<!-- Lista de Máquinas -->
<div id="datos-maquinas-update"></div>



 <?php endif ?>