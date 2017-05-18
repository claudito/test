<?php 

include('../../../autoload.php');
$horomentro   = new Horometro('?','?','?','?');

 ?>

 <div class="panel panel-default">
 <div class="panel-heading">
 Lista de Horómetros
 </div>
 <div class="panel-body">
 <div class="table-responsive">
 <table id="consulta" class="table table-bordered table-hover ">
 	<thead>
 		<tr class="active">
 			<th>AÑO</th>
 			<th>MES</th>
 			<th>HORAS HOMBRE</th>
 			<th>HORAS MÁQUINA</th>
 			<th>Acciones</th>
 		</tr>
 	</thead>
 	<tbody>
 	<?php 
     
	foreach ($horomentro->lista() as $key => $value) 
	{
	?>
	<tr>
	<td><?php echo $value['ANIO']; ?></td>
	<td><?php echo sprintf("%0"."2"."s", "".$value['MES']."") ?></td>
	<td><?php echo round($value['HORAS_HOMBRE'],2); ?></td>
	<td><?php echo round($value['HORAS_MAQUINA'],2); ?></td>
	<td>
	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $value['ID']?>" data-horas_hombre="<?php echo round($value['HORAS_HOMBRE'],2)?>" data-horas_maquina="<?php echo round($value['HORAS_MAQUINA'],2)?>" data-mes="<?php echo $value['ANIO'].'-'.sprintf("%0"."2"."s", "".$value['MES'].""); ?>"><i class='glyphicon glyphicon-edit'></i> Modificar</button>
	<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $value['ID']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button>
     
     <?php if ($value['ACTIVAR']==0): ?>
     <a href="../procesos/horometro/activar?id=<?php echo $value['ID'] ?>&valor=1" class="btn btn-default btn-sm">Activar</a>	
     <?php else: ?>
     <a href="../procesos/horometro/activar?id=<?php echo $value['ID'] ?>&valor=0" class="btn btn-success btn-sm">Activo</a>	
     <?php endif ?>


	</td>
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