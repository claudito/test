<?php 

include('../autoload.php');
include('../session.php');
$assets =  new Assets();
$html   = new Html();
$assets -> principal('Registro Diario');
$assets -> datatables();
$assets -> sweetalert();
$assets -> selectize();

$registrodiario_cab = new Registrodiario_cab('?','?','?','?','?');
$registrodiario_det  = new Registrodiario_det('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');

?>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<style>table{font-size: 12px;}</style>
<?php
$html ->header();
//include('../templates/modal/registrodiario/agregar.php');
include('../templates/modal/registrodiario/eliminar.php');
 ?>

<div class="row">
<div class="col-md-12">
<?php include('../templates/nav.php'); ?>
</div>
</div>

<div class="row">
<div class="col-md-10">

<?php if (count($registrodiario_cab->lista())>0): ?>
<div class="panel panel-default">
<div class="table-responsive">
<table class="table  table-condensed">
<thead>
<tr class="active">
<th><i class="glyphicon glyphicon-user"></i> <a data-toggle="modal" href='#modal-id'><span data-toggle="tooltip" data-placement="bottom" title="Usuario"><?php echo utf8_encode($registrodiario_cab->consulta('NOMBRES')).' '.utf8_encode($registrodiario_cab->consulta('APELLIDOS')); ?></span></a></th>
<th><i class="glyphicon glyphicon-calendar"></i> <span data-toggle="tooltip" data-placement="bottom" title="Fecha de Trabajo"><?php echo date_format(date_create($registrodiario_cab->consulta('FECHA_TRABAJO')), 'd/m/Y');?></span></th>
<th><i class="glyphicon glyphicon-calendar"></i> <span data-toggle="tooltip" data-placement="bottom" title="Fecha de Producción"><?php echo date_format(date_create($registrodiario_cab->consulta('FECHA_PRODUCCION')), 'd/m/Y');?></span></th>
<th><i class="glyphicon glyphicon-dashboard"></i> <span data-toggle="tooltip" data-placement="bottom" title="Turno"><?php echo $registrodiario_cab->consulta('TURNO'); ?></span></th>
<th><i class="glyphicon glyphicon-wrench"></i> <span data-toggle="tooltip" data-placement="bottom" title="Máquina"><?php echo $registrodiario_cab->consulta('CODIGO_INTERNO').' '.utf8_encode($registrodiario_cab->consulta('DESCRIPCION')); ?></span></th>
</tr>

</thead>
</table>
</div>
</div>	
<?php include('../templates/modal/registrodiario/actualizar_fechatrabajo.php'); ?>
<?php else: ?>
<center><a class="btn btn-primary btn-lg" data-toggle="modal" href='#modal-id'>Registrar Configuración Inicial</a></center>
<?php include('../templates/modal/registrodiario/agregar_fechatrabajo.php'); ?>
<?php endif ?>

</div>
<div class="col-md-2">

<div class="pull-right">
<div class="form-group">
<?php if (count($registrodiario_cab->lista())>0): ?>
 <a data-toggle="modal" href="#newModal" class="btn btn-primary btn-sm btn-block">Agregar Registro Diario</a>	
<?php else: ?>
 <!-- no hay se puede registrar -->
<?php endif ?>
</div>
</div>

</div>
</div>


<!-- A que deberia carga el modal registrar -->
<div class="row">
<div class="col-md-12">
<div id="mensaje-modal-agregar"></div><!-- Datos ajax Final -->
<div id="tabla-modal-agregar"></div><!-- Datos ajax Final -->

</div>
</div>






<div class="row">
<div class="col-md-12">
<div id="loader" class="text-center"> <img src="../assets/img/loader.gif"></div>
<div id="mensaje"></div><!-- Datos ajax Final -->
<div id="tabla"></div><!-- Datos ajax Final -->

</div>
</div>


<script src="../ajax/app/registro-diario.js"></script>
<script>
$(document).ready(function(){
loadTabla(1);
});
$(document).ready(function(){
CargarModalAgregar(1);
});
</script>

<?php 
$html ->footer();
 ?>