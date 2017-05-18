<?php 

include('../autoload.php');
include('../session.php');

$assets   = new Assets();
$html     = new Html();
$permisos = new Permisos();
$permisos -> agregar($_GET['id']);
$usuarios = new Usuarios('?','?','?','?');
$assets   -> principal('Permisos');
$assets   -> datatables();
$html     -> header();

?>


<div class="row">
<div class="col-md-12">
<?php include('../templates/nav.php'); ?>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
	<div class="panel-heading">
    Permisos de Usuario: <?php echo $usuarios->consulta($_GET['id'],'NOMBRES').' '.$usuarios->consulta($_GET['id'],'APELLIDOS'); ?>

	</div>
	<div class="panel-body">
    <div class="table-responsive">
    	<table id="consulta"  class="table table-bordered table-condensed">
    		<thead>
			<tr>
			<th>MENÚ</th>
			<th>SUB MENÚ</th>
			
			<th style="text-align: center;">PERMISO</th>
			</tr>
    		</thead>
    		<tbody>
    		<?php 
            foreach ($permisos->lista($_GET['id']) as $key => $value) 
            {
            ?>
            <tr>
		   <td><?php echo $value['MENU']; ?></td>
			<td><?php echo $value['SUBMENU']; ?></td>
			
			<td style="text-align: center;">
			<a href=""></a>
			<?php
			if ($value['ESTADO']==0)
			{

			echo '<a href="../procesos/permisos/actualizar?id='.$value['ID'].'&usuario='.$_GET['id'].'&estado=1"><i class="fa fa-square-o fa-2x"></i></a>';
			} 
			else
			{
			echo '<a href="../procesos/permisos/actualizar?id='.$value['ID'].'&usuario='.$_GET['id'].'&estado=0"><i class="fa fa-check-square fa-2x"></i></a>';
			}

			 ?>
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
</div>
</div>






<?php $html -> footer(); ?>