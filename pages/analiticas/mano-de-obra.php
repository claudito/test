<?php 

include('../../autoload.php');
include('../../session.php');
$assets = new Assets();
$html   = new Html();
$assets ->principal('Mano de Obra');
$assets -> datatables();
$reporte = new Reporte();
?>
<style>
table{font-size: 12px;}
</style>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<?php
$html->header();
?>


<div class="row">
<div class="col-md-12">
<?php include('../../templates/nav.php'); ?>
</div>
</div>


<div class="row">
<div class="col-md-12">
<h3>Reporte de Mano de Obra
<div class="pull-right">
<a href="../../uploads/odbc-mano-de-obra-v1.xlsx" class="btn btn-success btn-sm">Descargar ODBC</a>
</div>
</h3><hr>

<div class="table-responsive">
	<table id="consulta" class="table table-bordered table-condensed">
		<thead>
		    <tr class="active">
		    <th colspan="11"> </th>
		    <th colspan="3" class="success" style="text-align: center;">BENEFICIOS</th>
		    <th colspan="6" class="info" style="text-align: center;">APORTES</th>
		    <th colspan="3"></th>
		    <th class="info" style="text-align: center;">REGULAR</th>
		    <th class="active" style="text-align: center;">25%</th>
		    <th class="info" style="text-align: center;">35%</th>
		    <th class="active" style="text-align: center;">100%</th>
		    </tr>
			<tr class="active">
				<th>PERIODO</th>
				<th>N°</th>
				<th>EMPLEADO / OBRERO</th>
				<th>NOMBRE</th>
				<th>CARGO</th>
				<th>ÁREA</th>
				<th>BÁSICO (S/.)</th>
				<th>BONIFICACIÓN ORDINARIA (S/.)</th>
				<th>BONIFICACIÓN VARIABLE (S/.)</th>
				<th>BONIFICACIÓN NOCTURNA (S/.)</th>
				<th>TOTAL INGRESOS</th>
				<th><span data-toggle="tooltip" data-placement="top" title="8.33% / 8.33%"
				>VACACIONES</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="16.67% / 16.67%"
				>GRATIFICACIONES</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="9.72% / 9.72%"
				>CTS</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="9.00% /9.00%"
				>ESSALUD</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="0.50% / 0.90%"
				>SCTR PENSIÓN</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="0.50% / 0.90%"
				>SCTR SALUD</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="0.32% / 0.50%"
				>VIDA LEY</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="0.75% / 0.75%"
				>SENATI</span></th>
				<th><span data-toggle="tooltip" data-placement="top" title="5.56% / 5.56%"
				>DESCANSO MÉDICO</span></th>
				<th>ASIGNACIÓN FAMILIAR (S/.)</th>
				<th>COSTO TOTAL MENSUAL (S/.)</th>
				<th>HH / MES</th>
				<th>COSTO HH REAL (S/.)</th>
				<th>COSTO HE 25% (S/.)</th>
				<th>COSTO HE 35% (S/.)</th>
				<th>COSTO HE 100% (S/.)</th>
		</thead>
		<tbody>
		<?php 


		foreach ($reporte->mano_de_obra() as $key => $value) 
		{
		?>
        <tr>
        <td><?php echo $value['PERIODO']; ?></td>
        <td><?php echo $value['ITEM']; ?></td>
        <td><?php echo $value['TIPO_TRAB']; ?></td>
        <td><?php echo utf8_encode($value['NOMBRE']); ?></td>
        <td><?php echo $value['CARGO']; ?></td>
        <td><?php echo $value['AREA']; ?></td>
        <td><?php echo round($value['BASICO'],2); ?></td>
        <td><?php echo round($value['BONIFICACION_ORDINARIA'],2); ?></td>
        <td><?php echo round($value['BONIFICACION_VARIABLE'],2); ?></td>
        <td><?php echo round($value['BONIFICACION_NOCTURNA'],2); ?></td>
        <td><?php echo round($value['TOTAL_INGRESOS'],2); ?></td>
        <td><?php echo round($value['VACACIONES'],2); ?></td>
        <td><?php echo round($value['GRATIFICACION'],2); ?></td>
        <td><?php echo round($value['CTS'],2); ?></td>
        <td><?php echo round($value['ESSALUD'],2); ?></td>
        <td><?php echo round($value['SCTR_PENSION'],2); ?></td>
        <td><?php echo round($value['SCTR_SALUD'],2); ?></td>
        <td><?php echo round($value['SCTR_VIDA'],2); ?></td>
        <td><?php echo round($value['SENATI'],2); ?></td>
        <td><?php echo round($value['DESCANSO_MEDICO'],2); ?></td>
        <td><?php echo round($value['ASIGNACION_FAMILIAR'],2); ?></td>
        <td><?php echo round($value['COSTO_TOTAL_MENSUAL'],2); ?></td>
        <td><?php echo round($value['HH_MES'],2); ?></td>
        <td><?php echo round($value['COSTO_HH_REAL'],2); ?></td>
        <td><?php echo round($value['COSTO_HE_25'],2); ?></td>
        <td><?php echo round($value['COSTO_HE_35'],2); ?></td>
        <td><?php echo round($value['COSTO_HE_100'],2); ?></td>
        </tr>
		<?php
		}



		?>
		</tbody>
	</table>
	<script>
	$(document).ready(function(){
    $('#consulta').DataTable();
});
	</script>
</div>
</div>
</div>


<?php $html -> footer(); ?>