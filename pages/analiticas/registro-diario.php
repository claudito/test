<?php 

include('../../autoload.php');
include('../../session.php');
$assets = new Assets();
$html   = new Html();
$assets ->principal('Registro Diario');
$assets ->datatables();
$html->header();
?>

<style>
table{font-size: 13px;}
</style>

<div class="row">
<div class="col-md-12">
<?php include('../../templates/nav.php'); ?>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
	<div class="panel-heading">
	<h3 class="panel-title">Reporte Diario</h3>
	</div>
	<div class="panel-body">
	<form action="" class="form-inline">
	 <label>Fecha Inicio:</label>
	 <input type="date" name="fechainicio"  class="form-control" required="" value="<?php echo $_GET['fechainicio']; ?>">
	 <label>Fecha Fin:</label>
	 <input type="date" name="fechafin"     class="form-control" required="" value="<?php echo $_GET['fechafin']; ?>">
	 <label>Tipo:</label>
	 <select name="tipo" class="form-control">
	 <?php if (!isset($_GET['tipo'])): ?>
	 
	 <option value="">[Seleccionar el Tipo]</option>
	 <option value="1">Usuario</option>
	 <option value="2">Máquina</option>	
	 <?php else: ?>
	 <?php if ($_GET['tipo']=='1'): ?>
	 <option value="1">Usuario</option>
	 <option value="2">Máquina</option>		
	 <?php else: ?>
	 <option value="2">Máquina</option>
	 <option value="1">Usuario</option>	
	 <?php endif ?>
	 	
	 <?php endif ?>
	 </select>
	 <button class="btn btn-primary">Consultar</button>
	</form>
	</div>
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
	
	<div class="panel-body">
	   <?php 
       $reporte = new Reporte();
	   if (count($reporte->registro_diario($_GET['fechainicio'],$_GET['fechafin'],$_GET['tipo']))> 0): ?>
	   <div class="table-responsive">
	   	<table id="consulta"  class="table table-bordered table-condensed">
	   		<thead>
	   			<tr>
	   			    <th>Fecha Trabajo</th>
	   			    <th>Fecha Producción</th>
	   			    <th>Hora Inicio</th>
	   				<th>Hora Fin</th>
	   			    <th>ID</th>
	   				<th><?php echo ($_GET['tipo']=='1') ? "USUARIO" : "MÁQUINA" ; ?></th>
	   				<th>Horas Trabajo</th>
	   				<th>Horas Hombre</th>
	   				<th>Detalle</th>
	   				<th>Observación</th>
	   				<th>Ot</th>
	   				<th>Cant. Ot</th>
	   				<th>Clasificación</th>
	   				<th>Proceso</th>
	   				<th>Máquina</th>
	   				<th>Turno</th>
	   			</tr>
	   		</thead>
	   		<tbody>
	   		<?php 

            foreach ($reporte->registro_diario($_GET['fechainicio'],$_GET['fechafin'],$_GET['tipo']) as $key => $value) 
            {
            ?>
            <tr>
            <td><?php echo date_format(date_create($value['FECHA_TRABAJO']), 'd/m/Y') ?></td>
            <td><?php echo date_format(date_create($value['FECHA_PRODUCCION']), 'd/m/Y') ?></td>
            <td><?php echo date_format(date_create($value['HORA_INICIO']), 'H:i') ?></td>
            <td><?php echo date_format(date_create($value['HORA_FIN']), 'H:i') ?></td>
            <td><?php echo $value['ID']; ?></td>
            <td><?php echo  ($value['TIPO']=='1') ? utf8_encode($value['USUARIO']) : utf8_encode($value['MAQUINA']) ;  ?></td>
            
            <td><?php echo $value['HORAS_TRABAJO']; ?></td>
            <td><?php echo round($value['HORAS_HOMBRE'],2); ?></td>
            <td><?php echo utf8_encode($value['DETALLE']); ?></td>
            <td><?php echo utf8_encode($value['OBSERVACION']); ?></td>
            <td><?php echo $value['OT']; ?></td>
            <td><?php echo round($value['CANTIDAD_OT'],2); ?></td>
            <td><?php echo utf8_encode($value['CLASIFICACION']); ?></td>
            <td><?php echo utf8_encode($value['PROCESOS']); ?></td>
            <td><?php echo utf8_encode($value['MAQUINA']); ?></td>
            <td><?php echo utf8_encode($value['TURNO']); ?></td>
            </tr>
            <?php
            }

             echo $suma;
	   		 ?>
	   		</tbody>
	   	</table>
	   	<script>
		$(document).ready(function(){
		$('#consulta').DataTable();
		});
	   	</script>
	   </div>
	   <?php else: ?>
	   	<p class="alert alert-warning">No hay registros.</p>
	   <?php endif ?>
	</div>
</div>
</div>
</div>


<?php $html -> footer(); ?>