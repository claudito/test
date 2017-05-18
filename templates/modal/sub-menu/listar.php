<?php 

include('../../../autoload.php');
$conexion =  new Conexion();
$conexion->sqlserver();
$submenu  = new Submenu('?','?','?','?');
 ?>

 <div class="panel panel-default">
 <div class="panel-heading">
 Lista de Sub Menús
 </div>
 <div class="panel-body">
 <div class="table-responsive">
 <table id="consulta"  class="table table-bordered table-hover ">
 	<thead>
 		<tr class="active">
 		    <th>MENÚ</th>
 			<th>ITEM</th>
 			<th>SUB MENÚ</th>
 			<th>URL</th>
 			<th>Acciones</th>
 		</tr>
 	</thead>
 	<tbody>
 	<?php 
     
	foreach ($submenu->lista() as $key => $value) 
	{
	?>
	<tr>
	<td><?php echo $value['MENU']; ?></td>
	<td><?php echo $value['ITEM']; ?></td>
	<td><?php echo $value['NOMBRE']; ?></td>
	<td><?php echo $value['URL']; ?></td>
<td>
		<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dataUpdate" data-id="<?php echo $value['ID']?>" data-menu="<?php echo $value['MENU']?>" data-idmenu="<?php echo $value['IDMENU']?>" data-submenu="<?php echo $value['NOMBRE']?>" data-url="<?php echo $value['URL']?>"  data-item="<?php echo $value['ITEM']?>"><i class='glyphicon glyphicon-edit'></i> Modificar</button>
		<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $value['ID']?>"  ><i class='glyphicon glyphicon-trash'></i> Eliminar</button>
		</td>
</tr>
	<?php

	}

	?>
 	</tbody>
 </table>
 </div>
 </div>
  </div>
<script>
$(document).ready(function(){
$('#consulta').DataTable();
});
</script>