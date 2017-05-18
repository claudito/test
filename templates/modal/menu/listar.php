<?php 

include('../../../autoload.php');
$conexion =  new Conexion();
$menu     = new Menu('?','?');
$conexion->sqlserver();
 ?>

 <div class="panel panel-default">
 <div class="panel-heading">
 Lista de Menús
 </div>
 <div class="panel-body">
 <div class="table-responsive">
 <table id="consulta" class="table table-bordered table-hover ">
 	<thead>
 		<tr class="active">
 			<th>ITEM</th>
 			<th>NOMBRE</th>
 			<th>Acciones</th>
 		</tr>
 	</thead>
 	<tbody>
 	<?php 
     
	foreach ($menu->lista() as $key => $value) 
	{
	?>
	<tr>
	<td><?php echo $value['ITEM']; ?></td>
	<td><?php echo $value['NOMBRE']; ?></td>
<td>
		<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $value['ID']?>" data-nombre="<?php echo $value['NOMBRE']?>" data-item="<?php echo $value['ITEM']?>"><i class='glyphicon glyphicon-edit'></i> Modificar</button>
		<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $value['ID']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button>
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