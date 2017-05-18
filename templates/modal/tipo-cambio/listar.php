<?php 

include('../../../autoload.php');
$conexion =  new Conexion();
$reporte     = new Reporte();
$conexion->sqlserver();
 ?>

 <div class="panel panel-default">
 <div class="panel-heading">
 Lista de Tipos de Cambio
 </div>
 <div class="panel-body">
 <div class="table-responsive">
 <table id="consulta" class="table table-bordered table-hover ">
 	<thead>
 		<tr class="active">
 			<th>AÑO</th>
 			<th>MES</th>
 			<th>FECHA</th>
 			<th>TC VENTA</th>
 		</tr>
 	</thead>
 	<tbody>
 	<?php 
     
	foreach ($reporte->tipo_de_cambio() as $key => $value) 
	{
	?>
	<tr>
	<td><?php echo date_format(date_create($value['TIPOCAMB_FECHA']), 'Y');?></td>
	<td><?php echo date_format(date_create($value['TIPOCAMB_FECHA']), 'm');?></td>
	<td><?php echo date_format(date_create($value['TIPOCAMB_FECHA']), 'd/m/Y');?></td>
	<td><?php echo $value['TIPOCAMB_VENTA'] ?></td>
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