<?php 
include('../autoload.php');
include('../session.php');
$assets =  new Assets();
$html   = new Html();
$assets -> principal('Horas Hombre');
$assets -> datatables();
$assets -> sweetalert();
$html ->header();
$usuarios = new Usuarios('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');
$usuarios -> actualizar_usuarios_planillas();

if(isset($_GET['actualizado']))
{
	echo "<script>
	alert('Registros Actualizados desde la Planilla.');
	window.location='".PATH."pages/horas-hombre';
	</script>";
}

include('../templates/modal/horas-hombre/agregar.php');
include('../templates/modal/horas-hombre/eliminar.php');
 ?>

<div class="row">
<div class="col-md-12">
<?php include('../templates/nav.php'); ?>
</div>
</div>

<div class="row">
<div class="col-md-12">

<!-- Single button -->
<div class="form-group">
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Opciones <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="?actualizado">Actualizar información desde la Planilla</a></li>
    <li><a href="<?php echo PATH; ?>procesos/horas-hombre/actualizar-lista-de-sueldos">Actualizar Registro de Sueldos Mensuales</a></li>
  </ul>
</div>
</div>

</div>
</div>


<div class="row">
<div class="col-md-12">

<div id="loader" class="text-center"> <img src="../assets/img/loader.gif""></div>
<div id="mensaje"></div><!-- Datos ajax Final -->
<div id="tabla"></div><!-- Datos ajax Final -->


</div>
</div>


<script src="../ajax/app/horas-hombre.js"></script>
<script>
$(document).ready(function(){
loadTabla(1);
});
</script>


<?php 
$html ->footer();
 ?>