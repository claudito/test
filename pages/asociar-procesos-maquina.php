<?php 
include('../autoload.php');
include('../session.php');
$assets =  new Assets();
$html   = new Html();
$assets -> principal('Asociación  Procesos & Máquinas');
$assets -> datatables();
$assets -> sweetalert();
$html ->header();

$procesos      = new Procesos('?','?','?','?','?');
$maquina = new Maquina('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');

include('../templates/modal/asociar-procesos-maquina/agregar.php');
include('../templates/modal/asociar-procesos-maquina/eliminar.php');
 ?>

<div class="row">
<div class="col-md-12">
<?php include('../templates/nav.php'); ?>
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3>Lista  Procesos & Máquinas
<div class="pull-right">
<div class="form-group">
 <a data-toggle="modal" href="#newModal" class="btn btn-primary">Agregar Registro</a>
</div>
</div>
</h3><hr>
</div>
</div>



<div class="row">
<div class="col-md-12">
<div id="loader" class="text-center"> <img src="../assets/img/loader.gif"></div>
<div id="mensaje"></div><!-- Datos ajax Final -->
<div id="tabla"></div><!-- Datos ajax Final -->

</div>
</div>


<script src="../ajax/app/asociar-procesos-maquina.js"></script>
<script>
$(document).ready(function(){
loadTabla(1);
});
</script>


<?php 
$html ->footer();
 ?>