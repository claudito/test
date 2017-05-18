<?php 

include('../autoload.php');
include('../session.php');
$assets = new Assets();
$html   = new Html();
$assets ->principal('Vida Útil Máquina');
$assets -> datatables();
$assets -> sweetalert();
$html->header();

include('../templates/modal/vida-util-maquina/agregar.php');
include('../templates/modal/vida-util-maquina/eliminar.php');
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
<a data-toggle="modal" href="#newModal" class="btn btn-primary">Agregar Registro</a>
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

<script src="../ajax/app/vida-util-maquina.js"></script>
<script> loadTabla(1); </script>

<?php $html -> footer(); ?>