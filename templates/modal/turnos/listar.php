<?php

include "../../../autoload.php";

$turnos  = new Turnos('?','?','?','?','?');
count($turnos->lista());
?>


<?php if (count($turnos->lista())>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Lista de turnos</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>CÓDIGO</th>
      <th>HORA DE INGRESO</th>
      <th>SALIDA REFRIGERIO</th>
      <th>INGRESO REFRIGERIO</th>
      <th>HORA DE SALIDA</th>
      <th>ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($turnos->lista() as $key => $value) 
  {
  ?>
  <tr>
  <td><?php echo utf8_encode($value['CODIGO']); ?></td>
  <td><?php echo date_format(date_create($value['HORA_INGRESO']), 'H:i');?></td>
  <td><?php echo date_format(date_create($value['SALIDA_REFRIGERIO']), 'H:i');?></td>
  <td><?php echo date_format(date_create($value['INGRESO_REFRIGERIO']), 'H:i');?></td>
  <td><?php echo date_format(date_create($value['HORA_SALIDA']), 'H:i');?></td>
 
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
  </div>
</div>
<?php else: ?>
  <p class="alert alert-warning">No hay resultados</p>
<?php endif ?>

<!-- Modal -->
  <script>
    $(".btn-edit").click(function(){
      id = $(this).data("id");
      $.get("../templates/modal/turnos/actualizar.php","id="+id,function(data){
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

