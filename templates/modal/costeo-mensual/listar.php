<?php

include "../../../autoload.php";
include "../../../session.php";

$costeo  = new Costeo();
count($costeo->lista_costeo_mensual());
?>


<?php if (count($costeo->lista_costeo_mensual($_SESSION['fechainicio_costeomensual'],$_SESSION['fechafin_costeomensual']))>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Lista de costeo - Detalle Notas de Salida</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>OT</th>
      <th>SUB OT</th>
      <th>CÓDIGO</th>
      <th>DESCRIPCIÓN</th>
      <th>NOTA DE INGRESO</th>
      <th>STATUS</th>
      <th>TIPO OT</th>
      <th>TIPO PROCESO</th>
      <th>FECHA INICIO</th>
      <th>FECHA FIN</th>
      <th>CANTIDAD</th>
      <th>ENTREGA</th>
      <th>SALDO</th>
      <th>COSTO TOTAL CONSUMOS</th>
      <th>COSTO UNITARIO CONSUMOS</th>
      <th>COSTO TOTAL SERVICIOS</th>
      <th>COSTO UNITARIO SERVICIOS</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($costeo->lista_costeo_mensual($_SESSION['fechainicio_costeomensual'],$_SESSION['fechafin_costeomensual']) as $key => $value) 
  {
  ?>
  <tr>
  <td><?php echo $value['OT']; ?></td>
   <td><a data-subot="<?php echo $value['SUB_OT'];?>"  class="btn-edit">
  <?php echo utf8_encode($value['SUB_OT']); ?>
  </a></td>
  <td><?php echo $value['CODIGO']; ?></td>
  <td><?php echo utf8_encode($value['ADESCRI']); ?></td>
  <td><?php echo utf8_encode($value['NOTA_INGRESO']); ?></td>
  <td><?php echo utf8_encode($value['STATUS']); ?></td>
  <td><?php echo utf8_encode($value['TIPO_OT']); ?></td>
  <td><?php echo utf8_encode($value['TIPO_PROCESO']); ?></td>
  <td><?php echo date_format(date_create($value['FECHA_INICIO']), 'd/m/Y');?></td>
  <td><?php echo date_format(date_create($value['FECHA_FIN']), 'd/m/Y');?></td>
  <td><?php echo round($value['CANTIDAD'],2); ?></td>
  <td><?php echo round($value['ENTREGA'],2); ?></td>
  <td><?php echo round($value['SALDO'],2); ?></td>
  <td><?php echo round($value['COSTO_TOTAL_CONSUMOS'],2); ?></td>
  <td><?php echo round($value['COSTO_UNITARIO_CONSUMOS'],2); ?></td>
  <td><?php echo round($value['COSTO_TOTAL_SERVICIOS'],2); ?></td>
  <td><?php echo round($value['COSTO_UNITARIO_SERVICIOS'],2); ?></td>

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
      subot   = $(this).data("subot");
      $.get("../../templates/modal/costeo-mensual/actualizar.php","subot="+subot,function(data){
        $("#form-edit").html(data);
      });
      $('#editModal').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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

