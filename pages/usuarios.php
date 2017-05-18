<?php 

include('../autoload.php');
include('../session.php');
$assets = new Assets();
$html   = new Html();
$assets ->principal('Usuarios');
$assets -> selectize();
$centrocosto  = new Centrocosto();
?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
// Parametros para el combo
$("#idcentrocosto").change(function () {
$("#idcentrocosto option:selected").each(function () {
elegido=$(this).val();
$.post("../ajax/select/usuarios-planilla.php", { elegido: elegido }, function(data){
$("#idusuarios-planilla").html(data);
});     
});
});    
});
</script>
<?php $html->header(); ?>


<div class="row">
<div class="col-md-12">
<?php include('../templates/nav.php'); ?>
</div>
</div>


<div class="row">
<div class="col-md-12">
<h3>Transferir Usuarios desde el Módulo de Planillas:</h3><hr>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<select name="centrocosto" id="idcentrocosto" class="demo-default">
<option value="">[ Seleccionar el área ]</option>
<?php 

foreach ($centrocosto->lista() as $key => $value) 
{
  echo "<option value='".$value['CODCCOSTO']."'>".$value['NOMBRE']."</option>";
}


 ?>
</select>
 <script >
$('#idcentrocosto').selectize({
maxItems: 1
});
</script>
</div>

</div>
</div>


<form action="../procesos/usuarios/transferir" method="POST">
	
<div class="row">
<div class="col-md-12">
<div id="idusuarios-planilla"></div>
</div>
</div>

</form>






<?php $html -> footer(); ?>