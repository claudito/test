<?php

include "../../../autoload.php";

$clasificacion  = new Clasificacion('?','?','?','?','?');
count($clasificacion->lista());
?>


<?php if (count($clasificacion->lista())>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Lista de Clasificaciones</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>NOMBRE</th>
      <th>DETALLE</th>
      <th>ABRV</th>
      <th>ASISTENCIA</th>
      <th>TIPO STAND BY</th>
      <th style="text-align: center;">RELACION OT</th>
      <th>ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($clasificacion->lista() as $key => $value) 
  {
  ?>
  <tr>
  <td><?php echo utf8_encode($value['NOMBRE']); ?></td>
  <td><?php echo utf8_encode($value['DETALLE']); ?></td>
  <td><?php echo utf8_encode($value['ABRV']); ?></td>
  <td><?php echo ($value['ASISTENCIA']==0) ? "NO ASISTE" : "ASISTE" ; ?></td>
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
  <td style="text-align: center;"><?php if ($value['RELACION_OT']==0): ?>
    <a href="<?php echo PATH; ?>procesos/clasificacion/actualizar_relacion_ot?id=<?php echo $value['ID']; ?>&valor=1"><i class="fa fa-square-o fa-2x"></i></a>
  <?php else: ?>
    <a href="<?php echo PATH; ?>procesos/clasificacion/actualizar_relacion_ot?id=<?php echo $value['ID']; ?>&valor=0"><i class="fa fa-check-square fa-2x"></i></a>
  <?php endif ?></td>
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
      $.get("../templates/modal/clasificacion/actualizar.php","id="+id,function(data){
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

