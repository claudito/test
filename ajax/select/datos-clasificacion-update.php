<?php 
include '../../autoload.php';
include '../../session.php';


$id         = substr($_POST['elegido'], 0,1);
$idregistro  = substr($_POST['elegido'], 1,2);

$clasificacion = new Clasificacion('?','?','?','?','?');

$registrodiario_det  = new Registrodiario_det('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');

 ?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
// Parametros para el combo
$("#idclasificacion-update").change(function () {
$("#idclasificacion-update option:selected").each(function () {
elegido=$(this).val();
$.post("../ajax/select/datos-procesos-update", { elegido: elegido }, function(data){
$("#datos-procesos-update").html(data);
});     
});
});    
});
</script>

<?php if ($id == 1): ?>
<input type="hidden" name="update" id="" value="<?php echo $id; ?>">

<div class="col-md-4">
 <div class="form-group">
 <label>Clasificación</label>
 <select name="clasificacion" id="idclasificacion-update" class="form-control" required="">
 <option value="">[Seleccionar]</option>
 <?php 

foreach ($clasificacion->lista() as $key => $value) 
{
	echo "<option value='".$value['ID']."'>".utf8_encode($value['NOMBRE']).' - '.utf8_encode($value['DETALLE'])."</option>";
}


  ?>
 </select>
 </div>
</div>

<!-- Lista de Procesos -->

<div id="datos-procesos-update"></div>

<?php else: ?>

<div class="col-md-4">
<div class="form-group">
<label>Clasificación</label>
<input type="text" name="" class="form-control" readonly="" value="<?php echo utf8_encode($registrodiario_det->consulta($idregistro,'CLASIFICACION'))?>">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Procesos</label>
<input type="text" name="" class="form-control" readonly="" value="<?php echo utf8_encode($registrodiario_det->consulta($idregistro,'PROCESOS'))?>">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Máquina</label>
<input type="text" name="" class="form-control" readonly="" value="<?php echo utf8_encode($registrodiario_det->consulta($idregistro,'MAQUINA'))?>">
</div>
</div>
<?php endif ?>