<?php 

include'../../../autoload.php';
include'../../../session.php';

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
<div class="col-md-9">

<div class="form-group">
<select name="ot" id="idot" class="demo-default" required="">
<option value="">[ Seleccionar ]</option>
<?php 
$ot = new Ot();
foreach ($ot->lista() as $key => $value) 
{
echo "<option value='".$value['CODIGOOT']."'>".$value['CODIGOOT'].' - '.utf8_encode($value['CODIGO']).' - '.utf8_encode($value['ADESCRI'])."</option>";
}

?>
</select>
<script >
$('#idot').selectize({
maxItems: 1
});
</script>
</div>


</div>


<div class="col-md-3">
<div id="datos-ot"></div>
</div>


</div>

<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>Clasificación</label>
<select name="clasificacion" id="idclasificacion" class="form-control" required="">
<option value="">[ Seleccionar ]</option>
<?php 

$clasificacion = new Clasificacion('?','?','?','?','?');
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
$registrodiario_det  = new Registrodiario_det('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');
$registrodiario_cab = new Registrodiario_cab('?','?','?','?','?'); 
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
<div class="col-md-4">
<div class="form-group">
<label>Hora Inicio</label>
<input type="time" name="horainicio"  class="form-control" required>
</div>
</div>
<div class="col-md-4">
<label>Hora Fin</label>
<div class="form-group">
<input type="time" name="horafin"     class="form-control" required>
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