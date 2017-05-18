<?php 

include('../../autoload.php');
include('../../session.php');
$assets = new Assets();
$html   = new Html();
$assets ->principal('Costo de Máquina');
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
<h3>Reporte de Máquina
<div class="pull-right">
<a href="#" class="btn btn-success btn-sm">Descargar ODBC</a>
</div>
</h3><hr>

<div class="table-responsive">

<?php if (count($reporte->costo_maquina())>0): ?>
<table id="consulta" class="table table-bordered table-condensed">
        <thead>
            <tr class="active">
            <td>PERIODO</td>
            <td>COD. INTERNO</td>
            <td>FECHA DE ADQUISICIÓN</td>
            <td>FECHA DE INICIO OPERACIONES</td>
            <td>CANT</td>
            <td>FECHA TERMINO DEPREACIACIÓN</td>
            <td>MESES DEPREC</td>
            <td>MESES FALTANTES</td>
            <td>CONTRATO Y/O FACTURA</td>
            <td>DESCRIPCIÓN</td>
            <td>TIPO</td>
            <td>DESCRIPCIÓN ABRV</td>
            <td>MODELO</td>
            <td>SERIE</td>
            <td>MARCA</td>
            <td>VALOR CONTABLE</td>
            <td>DEPRECIACIÓN MENSUAL</td>
            <td>VALOR DEPRECIADO ACUM</td>
            <td>VALOR ACTUAL</td>
            <td>HM / MES </td>
            <td>COSTO HM REAL (S/.)</td>
            <td>COSTO HM COMERCIAL (S/.)</td>
            
            </tr>  
        </thead>
        <tbody>
        <?php 


        foreach ($reporte->costo_maquina() as $key => $value) 
        {
        ?>
        <tr>
        <td><?php echo $value['PERIODO']; ?></td>
        <td><?php echo utf8_encode($value['CODIGO_INTERNO']); ?></td>
        <td><?php echo date_format(date_create($value['FECHA_ADQUISICION']), 'd/m/Y');?></td>
        <td><?php echo date_format(date_create($value['FECHA_INICIO']), 'd/m/Y');?></td>
        <td><?php echo $value['CANTIDAD']; ?></td>
        <td><?php echo date_format(date_create($value['FECHA_TERMINO']), 'd/m/Y');?></td>
        <td><?php echo round($value['MES_DEPRECIADO'],2); ?></td>
        <td><?php echo round($value['MES_FALTANTE'],2); ?></td>
        <td><?php echo utf8_encode($value['CONTRATO_FACTURA']); ?></td>
        <td><?php echo utf8_encode($value['DESCRIPCION']); ?></td>
        <td><?php echo utf8_encode($value['TIPO']); ?></td>
        <td><?php echo utf8_encode($value['DESCRIPCION_ABRV']); ?></td>
        <td><?php echo utf8_encode($value['MODELO']); ?></td>
        <td><?php echo utf8_encode($value['SERIE']); ?></td>
        <td><?php echo utf8_encode($value['MARCA']); ?></td>
        <td><?php echo round($value['VALOR_CONTABLE'],2); ?></td>
        <td><?php echo round($value['DEPRECIACION_MENSUAL'],2); ?></td>
        <td><?php echo round($value['VALOR_DEPRECIADO_ACUMULADO'],2); ?></td>
        <td><?php echo round($value['VALOR_ACTUAL'],2); ?></td>
        <td><?php echo round($value['HORAS_MAQUINA'],2); ?></td>
        <td><?php echo round($value['COSTO_HM_REAL'],2); ?></td>
        <td><?php echo round($value['COSTO_HM_COMERCIAL'],2); ?></td>
        </tr>
        <?php
        }

        ?>
        </tbody>
    </table>    
<?php else: ?>
  <p class="alert alert-warning">No hay registros.</p>  
<?php endif ?>



	<script>
	$(document).ready(function(){
    $('#consulta').DataTable();
});
	</script>
</div>
</div>
</div>


<?php $html -> footer(); ?>