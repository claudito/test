<?php

include "../../../autoload.php";
include "../../../session.php";

$registrodiario_det  = new Registrodiario_det('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');

?>


<?php if (count($registrodiario_det->lista()) > 0): ?>
<div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover table-condensed">
  <thead>
    <tr class="active">
   
      <th>FECHA TRABAJO</th> <!--  
      <th>FECHA PRODUCCIÓN</th>-->
      <th>HORA INICIO</th>
      <th>HORA FIN</th>
      <th>HORAS TRABAJO</th>
      <th>HORAS HOMBRE</th>
      <th>DETALLE</th>
      <th>OBSERVACIÓN</th>
      <th>OT</th>
      <th>CANT. OT</th>
      <!-- <th>TURNO</th> -->
      <th>CLASIFICACIÓN</th>
      <th>PROCESO</th>
      <th>MÁQUINA</th>
      <th style="text-align: center;">ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($registrodiario_det->lista() as $key => $value) 
  {
  ?>
<tr>
<td><?php echo date_format(date_create($value['FECHA_TRABAJO']), 'd/m/Y') ?></td>
<!-- 
<td><?php //echo date_format(date_create($value['FECHA_PRODUCCION']), 'd/m/Y') ?></td>-->
<td><?php echo date_format(date_create($value['HORA_INICIO']), 'H:i') ?></td>
<td><?php echo date_format(date_create($value['HORA_FIN']), 'H:i') ?></td>
<td><?php echo $value['HORAS_TRABAJO']; ?></td>
<td><?php echo round($value['HORAS_HOMBRE'],2); ?></td>
<td><?php echo utf8_encode($value['DETALLE']); ?></td>
<td><?php echo utf8_encode($value['OBSERVACION']); ?></td>
<td><?php echo $value['OT']; ?></td>
<td><?php echo round($value['CANTIDAD_OT'],2); ?></td>
<!--  <td><?php //echo utf8_encode($value['TURNO']); ?></td>-->
<td><?php echo utf8_encode($value['CLASIFICACION']); ?></td>
<td><?php echo utf8_encode($value['PROCESOS']); ?></td>
<td><?php echo utf8_encode($value['MAQUINA']); ?></td>
<td style="text-align: center;">
<a data-id="<?php echo $value['ID'];?>" class="btn btn-edit btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i></a>
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $value['ID']?>" ><i class="glyphicon glyphicon-trash"></i></button>
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
      $.get("../templates/modal/registrodiario/actualizar.php","id="+id,function(data){
        $("#form-edit").html(data);
      });
      $('#editModal').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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

