<?php
include('../../../autoload.php');
$id = $_GET['id'];
$registrodiario_det  = new Registrodiario_det('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');

$ot  = new Ot();



?>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
// Parametros para el combo
$("#idot_u").change(function () {
$("#idot_u option:selected").each(function () {
elegido=$(this).val();
$.post("../ajax/select/datos-ot.php", { elegido: elegido }, function(data){
$("#datos-ot_u").html(data);
});     
});
});    
});
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
// Parametros para el combo
$("#iddatos-update").change(function () {
$("#iddatos-update option:selected").each(function () {
elegido=$(this).val();
$.post("../ajax/select/datos-clasificacion-update.php", { elegido: elegido }, function(data){
$("#datos-update").html(data);
});     
});
});    
});
</script>



<?php if(count($registrodiario_det->lista_actualizar($id))>0):?>

<form role="form" id="actualizar" >
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="clasificacion-actual" value="<?php echo $registrodiario_det->consulta($id,'ID_CLASIFICACION'); ?>">
<input type="hidden" name="procesos-actual" value="<?php echo $registrodiario_det->consulta($id,'ID_PROCESOS'); ?>">
<input type="hidden" name="maquina-actual" value="<?php echo $registrodiario_det->consulta($id,'ID_MAQUINA'); ?>">

<label>Orden de Trabajo</label>
<div class="row">

<div class="col-md-8">
<div class="form-group">
<select name="ot" id="idot_u" class="demo-default" required="">
<option value="<?php echo $registrodiario_det->consulta($id,'OT'); ?>"><?php echo $registrodiario_det->consulta($id,'OT'); ?></option>
<?php 
$ot = new Ot();
foreach ($ot->lista_actualizar($registrodiario_det->consulta($id,'OT')) as $key => $value) 
{
echo "<option value='".$value['OF_COD']."'>".$value['OF_COD'].' - '.utf8_encode($value['CODIGO']).' - '.utf8_encode($value['ADESCRI'])."</option>";
}

?>
</select>
<script >
$('#idot_u').selectize({
maxItems: 1
});
</script>
</div>

</div>


<div id="datos-ot_u">
<div class="col-md-2">
<input type="number" name="cantidad"  class="form-control"  value="<?php echo round($registrodiario_det -> consulta($id,'CANTIDAD_OT'),2); ?>" max="<?php echo round($ot->consulta($registrodiario_det->consulta($id,'OT'),'OF_ARTCANT'),2); ?>"  required=""  placeholder="Cantidad: <?php echo round($ot->consulta($registrodiario_det->consulta($id,'OT'),'OF_ARTCANT'),2); ?>">
</div>
<div class="col-md-2">
 
<input type="text" class="form-control" 
 value="<?php echo $ot->consulta($registrodiario_det->consulta($id,'OT'),'OF_ESTADO'); ?>" readonly>

</div>
</div>



</div>

<div class="row">
<div class="col-md-12">

<div class="form-group">
<select name="" id="iddatos-update" class="form-control">
<option value="0<?php echo $id; ?>">....</option>
<option value="1<?php echo $id; ?>">Actualizar Clasificación - Proceso - Máquina</option>

</select>
</div>

</div>
</div>


<div class="row">
<div id="datos-update">

<div class="col-md-4">
<div class="form-group">
<label>Clasificación</label>
<input type="text" name="" class="form-control" readonly="" value="<?php echo utf8_encode($registrodiario_det->consulta($id,'CLASIFICACION'))?>">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Procesos</label>
<input type="text" name="" class="form-control" readonly="" value="<?php echo utf8_encode($registrodiario_det->consulta($id,'PROCESOS'))?>">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Máquina</label>
<input type="text" name="" class="form-control" readonly="" value="<?php echo utf8_encode($registrodiario_det->consulta($id,'MAQUINA'))?>">
</div>
</div>

</div>
</div>


<div class="row">
<div class="col-md-4">
<div class="form-group">
<label>Hora de Inicio</label>
<input type="time" name="horainicio" class="form-control" value="<?php echo date_format(date_create($registrodiario_det -> consulta($id,'HORA_INICIO')), 'H:i'); ?>" required>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Hora de Fin</label>
<input type="time" name="horafin" class="form-control" value="<?php echo date_format(date_create($registrodiario_det -> consulta($id,'HORA_FIN')), 'H:i'); ?>" required>
</div>
</div>
</div>


<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Detalle de Actividad</label>
<textarea name="detalle"  rows="6" class="form-control" placeholder="Escriba detalladamente la actividad realizada" required="" onchange="Mayusculas(this)"><?php echo utf8_encode($registrodiario_det->consulta($id,'DETALLE')); ?></textarea>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Observaciones</label>
<textarea name="observacion"  rows="6" class="form-control" placeholder="Escriba se presenta alguna observación" required="" onchange="Mayusculas(this)"><?php echo utf8_encode($registrodiario_det->consulta($id,'OBSERVACION')); ?></textarea>
</div>
</div>

</div>



<button class="btn btn-primary">Actualizar</button>

</form>



<script>

    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/registrodiario/actualizar-detalle.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#mensaje").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#mensaje").html(datos);
         //$("#actualizar")[0].reset();  //resetear inputs
          $('#editModal').modal('hide'); //ocultar modal
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          loadTabla(1);
          }
      });
  });


</script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>