<?php

include "../../../autoload.php";

$procesos_maquina  = new Procesos_maquina('?','?');
count($procesos_maquina->lista());
?>


<?php if (count($procesos_maquina->lista())>0): ?>
<div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>ID</th>
      <th>MÁQUINA</th>
      <th>PROCESO</th>
      <th>ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($procesos_maquina->lista() as $key => $value) 
  {
  ?>
  <tr>
  <td><?php echo $value['ID']; ?></td>
  <td><?php echo utf8_encode($value['CODIGO_INTERNO']).' - '.utf8_encode($value['DESCRIPCION']); ?></td>
  <td><?php echo utf8_encode($value['NOMBRE']); ?></td>
  <td style="width:150px;">
    <a data-id="<?php echo $value['ID'];?>" class="btn btn-edit btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i></a>
    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $value['ID']?>"><i class="glyphicon glyphicon-trash"></i></button>
    </td>
</tr>
  <?php

  }

  ?>
  </tbody>
 </table>
</div>
<?php else: ?>
  <p class="alert alert-warning">No hay resultados</p>
<?php endif ?>

<!-- Modal -->
  <script>
    $(".btn-edit").click(function(){
      id = $(this).data("id");
      $.get("../templates/modal/asociar-procesos-maquina/actualizar.php","id="+id,function(data){
        $("#form-edit").html(data);
      });
      $('#editModal').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Actualizar</h4>
        </div>
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->




   <script>
 $(document).ready(function(){
    $('#consulta').DataTable();
});
 </script>

