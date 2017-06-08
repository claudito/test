<?php 

include'../../../autoload.php';
include'../../../session.php';


$registrodiario_det  = new Registrodiario_det('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');

$registrodiario_cab = new Registrodiario_cab('?','?','?','?','?'); 

$ot                 = new Ot();

$clasificacion      = new Clasificacion('?','?','?','?','?');

 ?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
// Parametros para el combo
$("#idot").change(function () {
$("#idot option:selected").each(function () {
elegido=$(this).val();
$.post("../ajax/select/datos-ot.php", { elegido: elegido }, function(data){
$("#datos-ot").html(data);
});     
});
});    
});
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
// Parametros para el combo
$("#idclasificacion").change(function () {
$("#idclasificacion option:selected").each(function () {
elegido=$(this).val();
$.post("../ajax/select/datos-procesos.php", { elegido: elegido }, function(data){
$("#datos-procesos").html(data);
});     
});
});    
});
</script>

<!-- Modal -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Agregar Registro Diario</h4>
</div>
<div class="modal-body">
<form role="form" method="post" id="agregar" autocomplete="Off">

<label>Orden de trabajo</label>
<div class="row">

<?php if ($registrodiario_det->lista()>0): ?>
<div class="col-md-8">
<select name="ot" id="idot" class="demo-default" required="">
<option value="<?php echo $ot->ultimo_registro('OT'); ?>"><?php echo $ot->ultimo_registro('OT').' - '.utf8_encode($ot->ultimo_registro('CODIGO')).' - '.utf8_encode($ot->ultimo_registro('ADESCRI')); ?></option>
<?php 

foreach ($ot->lista_registro_diario() as $key => $value) 
{
echo "<option value='".$value['OF_COD']."'>".$value['OF_COD'].' - '.utf8_encode($value['CODIGO']).' - '.utf8_encode($value['ADESCRI'])."</option>";
}

?>
</select>
<script >
$('#idot').selectize({
maxItems: 1
});
</script>
</div>
<div id="datos-ot">
<div class="col-md-2">

 <input type="number" step="any"  name="cantidad" class="form-control" min="0" required="" max="<?php echo round($ot->consulta($ot->ultimo_registro('OT'),'OF_ARTCANT'),2); ?>" placeholder="Cant: <?php echo round($ot->consulta($ot->ultimo_registro('OT'),'OF_ARTCANT'),2); ?>" required>
 
</div>



<div class="col-md-2">
 
<input type="text" class="form-control" value="<?php echo $ot->consulta($ot->ultimo_registro('OT'),'OF_ESTADO'); ?>" readonly>

</div>

</div>
<?php else: ?>
<div class="col-md-8">
<select name="ot" id="idot" class="demo-default" required="">
<option value="">[ Seleccionar ]</option>
<?php 

foreach ($ot->lista_registro_diario() as $key => $value) 
{
echo "<option value='".$value['OF_COD']."'>".$value['OF_COD'].' - '.utf8_encode($value['CODIGO']).' - '.utf8_encode($value['ADESCRI'])."</option>";
}

?>
</select>
<script >
$('#idot').selectize({
maxItems: 1
});
</script>
</div>
<div id="datos-ot">
</div>
<?php endif ?>



</div>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>Clasificación</label>
<select name="clasificacion" id="idclasificacion" class="form-control" required="">
<option value="">[ Seleccionar ]</option>
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
<div id="datos-procesos"></div>

</div>


<div class="row">

<?php 

$turnos  = new Turnos('?','?','?','?','?');
$funciones = new Funciones();
$horainicio =  date_format(date_create($turnos->consulta($registrodiario_cab->consulta('IDTURNO'),'HORA_INGRESO')), 'H:i');

$horafin    = $funciones->sumarmin($horainicio,15);
if (count($registrodiario_det->lista())==0): ?>
<div class="col-md-4">
<div class="form-group">
<label>Hora Inicio</label>
<input type="time" name="horainicio" value="<?php echo $horainicio; ?>" class="form-control" required>
</div>
</div>
<div class="col-md-4">
<label>Hora Fin</label>
<div class="form-group">
<input type="time" name="horafin"    value="<?php echo $horafin; ?>" class="form-control" required>
</div>
</div>
<?php else: ?>
<?php 
$horainicio =  date_format(date_create($registrodiario_det->ultimo_registro('HORA_FIN')), 'H:i');
$horafin    = $funciones->sumarmin($horainicio,30);
?>
<div class="col-md-4">
<div class="form-group">
<label>Hora Inicio</label>
<input type="time" name="horainicio" value="<?php echo $horainicio; ?>"  class="form-control" required>
</div>
</div>
<div class="col-md-4">
<label>Hora Fin</label>
<div class="form-group">
<input type="time" name="horafin"   value="<?php echo $horafin; ?>"   class="form-control" required>
</div>
</div>	
<?php endif ?>


</div>





<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Detalle de Actividad</label>
<textarea name="detalle"  rows="6" class="form-control" placeholder="Escriba detalladamente la actividad realizada" required="" onchange="Mayusculas(this)"></textarea>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Observaciones</label>
<textarea name="observacion"  rows="6" class="form-control" placeholder="Escriba se presenta alguna observación" required="" onchange="Mayusculas(this)"></textarea>
</div>
</div>

</div>





<button type="submit" class="btn btn-primary">Agregar</button>
</form>
<script>
$( "#agregar" ).submit(function( event ) {
var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "../procesos/registrodiario/agregar.php",
data: parametros,
beforeSend: function(objeto){
$("#mensaje").html("Mensaje: Cargando...");
},
success: function(datos){
$("#mensaje").html(datos);
//$("#actualizar")[0].reset();  //resetear inputs
$('#agregar').modal('hide'); //ocultar modal
$('body').removeClass('modal-open');
$('.modal-backdrop').remove();
loadTabla(1);
CargarModalAgregar(1);
}
});
event.preventDefault();
});
</script>
</div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->