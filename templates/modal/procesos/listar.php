<?php

include "../../../autoload.php";

$procesos  = new Procesos('?','?','?','?','?');

?>


<?php if (count($procesos->lista())>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Lista de Procesos</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>NOMBRE</th>
      <th>DETALLE</th>
      <th>FACTURABLE / NO FACTURABLE</th>
      <th>PRODUCTIVO / NO PRODUCTIVO</th>
      <th>TIPO STAND BY</th>
      <th>ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($procesos->lista() as $key => $value) 
  {
  ?>
  <tr>
  <td><?php echo utf8_encode($value['NOMBRE']); ?></td>
  <td><?php echo utf8_encode($value['DETALLE']); ?></td>
  <td><?php echo ($value['FACTURABLE']==0) ? "NO FACTURABLE" : "FACTURABLE" ; ?></td>
  <td><?php echo ($value['PRODUCTIVO']==0) ? "NO PRODUCTIVO" : "PRODUCTIVO" ; ?></td>
  <td><?php switch ($value['TIPO_STAND_BY']) {
    case '1':
    echo "NINGUNO";
      break;
    case '2':
    echo "STAND BY NORMAL";
      break;
    case '3':
    echo "STAND BY OPERATIVO";
    break;
    default:
     echo "NINGUNO";
      break;
  } ?>
  </td>
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
      $.get("../templates/modal/procesos/actualizar.php","id="+id,function(data){
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

