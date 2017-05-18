<?php 
include('../autoload.php');
include('../session.php');
$assets =  new Assets();
$html   = new Html();
$assets -> principal('Horómetro');
$assets -> datatables();
$assets -> sweetalert();
$html ->header();


include('../templates/modal/horometro/agregar.php');
include('../templates/modal/horometro/actualizar.php');
include('../templates/modal/horometro/eliminar.php');
 ?>

<div class="row">
<div class="col-md-12">
<?php include('../templates/nav.php'); ?>
</div>
</div>

<div class="row">
<div class="col-md-12">
 <div class="pull-right">
<div class="form-group">
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dataRegister"><i class='glyphicon glyphicon-plus'></i> Agregar Horómetro</button>
</div>
 </div>
</div>
</div>



<div class="row">
<div class="col-md-12">
<div id="loader" class="text-center"> <img src="../assets/img/loader.gif"></div>
<div class="datos_ajax"></div><!-- Datos ajax Final -->
<div class="outer_div"></div><!-- Datos ajax Final -->
</div>
</div>


<script src="../ajax/app/horometro.js"></script>
<script>
$(document).ready(function(){
load(1);
});
</script>


<?php 
$html ->footer();
 ?>