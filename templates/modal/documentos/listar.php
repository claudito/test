<?php

include '../../../autoload.php';
include '../../../session.php';
$documentos = new Documentos();

?>

<?php if (count($documentos->lista())>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Listas de Documentos</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>ARCHIVO</th>
      <th style="text-align: center;">ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($documentos->lista() as $key => $value) 
  {
  ?>
  <tr>
  <td><a href="<?php echo PATH; ?>uploads/<?php echo utf8_encode($value['RUTA']); ?>"><?php echo utf8_encode($value['NOMBRE']).' '.'V'.' '.$value['VERSION']; ?></a></td>
  <td  style="text-align: center;">
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
<?php else: ?>
  <p class="alert alert-warning">No hay resultados</p>
<?php endif ?>





   <script>
 $(document).ready(function(){
    $('#consulta').DataTable();
});
 </script>

