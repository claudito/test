<?php 
include('../autoload.php');
include('../session.php');
$assets =  new Assets();
$html   = new Html();
$assets -> principal('Servicios');
$assets -> datatables();
$assets -> sweetalert();
$html ->header();


include('../templates/modal/servicios/buscar.php');

 ?>

<style>
table{font-size: 12px}
</style>

<script>
swal({
  title: "Sólo se muestran los documentos,dónde el campo OT no se encuentra vacío.",
  timer: 5000,
  showConfirmButton: false
});
</script>

<div class="row">
<div class="col-md-12">
<?php include('../templates/nav.php'); ?>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="pull-right">
<div class="form-group">
 <a data-toggle="modal" href="#buscarModal" class="btn btn-primary">Rango de Consulta</a>
</div>
</div>
</div>
</div>



<div class="row">
<div class="col-md-12">
<div id="loader" class="text-center"> <img src="../assets/img/loader.gif"></div>
<div id="mensaje"></div><!-- Datos ajax Final -->
<div id="tabla"></div><!-- Datos ajax Final -->

</div>
</div>


<script src="../ajax/app/servicios.js"></script>
<script>
$(document).ready(function(){
loadTabla(1);
});
</script>


<?php 
$html ->footer();
 ?>