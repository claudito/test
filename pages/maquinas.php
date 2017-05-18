<?php 

include('../autoload.php');
include('../session.php');
$assets = new Assets();
$html   = new Html();
$assets ->principal('Horas Máquina');
$assets -> datatables();
$assets -> sweetalert();?>
<style>table{font-size: 12px;}</style>
<?php
$html->header();
include('../templates/modal/maquinas/agregar.php');
include('../templates/modal/maquinas/eliminar.php');

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
<div class="pull-left">
<!-- Single button -->
<div class="form-group">
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Opciones <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="<?php echo PATH; ?>procesos/maquinas/actualizar-lista">Actualizar detalle desde el Horómetro</a></li>
  </ul>
</div>
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

<script src="../ajax/app/maquinas.js"></script>
<script> loadTabla(1); </script>

<?php $html -> footer(); ?>