<?php

include "../../../autoload.php";
include "../../../session.php";

$fecha  =  $_SESSION['fecha_horometro'];

$horometrodiario  = new Horometrodiario($fecha,'?','?','?');
count($horometrodiario->lista());
?>


<?php if (count($horometrodiario->lista())>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Horómetro Diario de Máquinas</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>MÁQUINA</th>
      <th>FECHA</th>
      <th>CANTIDAD INICIAL</th>
      <th>CANTIDAD FINAL</th>
      <th style="text-align: center;">ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($horometrodiario->lista() as $key => $value) 
  {
  ?>
  <tr>
  <td><?php echo utf8_encode($value['CODIGO_INTERNO']).' - '.utf8_encode($value['DESCRIPCION']); ?></td>
  <td><?php echo date_format(date_create($value['FECHA']), 'd/m/Y');?></td>
  <td><?php echo round($value['CANTIDAD_INICIAL'],2); ?></td>
  <td><?php echo round($value['CANTIDAD_FINAL'],2); ?></td>
  <td style="text-align: center;"><a data-id="<?php echo $value['ID'];?>" class="btn btn-primary btn-edit">
  <i class="fa fa-pencil-square-o"></i>
  </a></td>
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
      id= $(this).data("id");
      $.get("../templates/modal/horometro-maquina/actualizar.php","id="+id,function(data){
        $("#form-edit").html(data);
      });
      $('#editModal').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
    
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

