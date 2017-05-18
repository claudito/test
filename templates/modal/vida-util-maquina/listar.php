<?php

include('../../../autoload.php');
$vidautilmaquina = new Vidautilmaquina('?','?','?','?','?');
?>


<?php if (count($vidautilmaquina->lista())>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Vida Útil de la Máquina</h3>
  </div>
  <div class="panel-body">
  <div class="table-responsive">
    <table id="consulta"  class="table table-hover table-bordered table-condensed">
      <thead>
    <tr class="active">
      <th>AÑO</th>
      <th>MES</th>
      <th>TIEMPO MES</th>
      <th>TIEMPO AÑO</th>
      <th>TIPO</th>
      <th style="text-align: center;">ACCIONES</th>
    </tr>
  </thead>
      <tbody>
        <?php 
          
          foreach ($vidautilmaquina->lista() as $key => $value) 
          {
            ?>
            
  <tr>
  <td><?php echo $value['ANIO']; ?></td>
  <td><?php echo sprintf("%0"."2"."s", "".$value['MES']."") ?></td>
  <td><?php echo round($value['TIEMPO_MES']); ?></td>
  <td><?php echo round($value['TIEMPO_ANIO']); ?></td>
  <td><?php echo ($value['TIPO']==0) ? "COSTO COMERCIAL" : "COSTO REAL" ; ?></td>
  <td  style="text-align: center;">
  <a data-id="<?php echo $value['ID'];?>" data-id="<?php echo $value['ID'];?>"  class="btn btn-edit btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i></a>
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
      id  = $(this).data("id");
      $.get("../templates/modal/vida-util-maquina/actualizar.php","id="+id,function(data){
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
          <h4 class="modal-title">Actualización de Información</h4>
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

