<?php

include "../../../autoload.php";
include "../../../session.php";

$servicios  = new Servicios();
count($servicios->lista());
?>


<?php if (count($servicios->lista($_SESSION['fechainicio_servicio'],$_SESSION['fechafin_servicio']))>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Lista de Ordenes de Servicio</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>O/S</th>
      <th>R/S</th>
      <th>OT</th>
      <th>RUC</th>
      <th>FECHA</th>
      <th>RAZÓN SOCIAL</th>
      <th>COTIZACIÓN</th>
      <th>MONEDA</th>
      <th>FORMA DE PAGO</th>
      <th>R. DE COMPRAS</th>
      <th>SOLIICITANTE</th>
      <th>T/C</th>
      <th>IMPORTE</th>
      <th>IGV</th>
      <th>VENTA</th>
      <th>ESTADO</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($servicios->lista($_SESSION['fechainicio_servicio'],$_SESSION['fechafin_servicio']) as $key => $value) 
  {
  ?>
  <tr>
  <td><a data-oc="<?php echo $value['OC_CNUMORD'];?>" class="btn-edit">
  <?php echo utf8_encode($value['OC_CNUMORD']); ?>
  </a></td>
  <td><?php echo utf8_encode($value['OC_CNRODOCREF']); ?></td>
  <td><?php echo utf8_encode($value['OC_ORDFAB']); ?></td>
  <td><?php echo utf8_encode($value['OC_CCODPRO']); ?></td>
  <td><?php echo date_format(date_create($value['OC_DFECDOC']), 'd/m/Y');?></td>
  <td><?php echo utf8_encode($value['OC_CRAZSOC']); ?></td>
  <td><?php echo utf8_encode($value['OC_CCOTIZA']); ?></td>
  <td><?php echo utf8_encode($value['OC_CCODMON']); ?></td>
  <td><?php echo utf8_encode($value['OC_CFORPAG']); ?></td>
  <td><?php echo utf8_encode($value['RESPONSABLE_NOMBRE']); ?></td>
  <td><?php echo utf8_encode($value['TDESCRI']); ?></td>
  <td><?php echo round($value['OC_NTIPCAM'],2); ?></td>
  <td><?php echo round($value['OC_NIMPORT'],2); ?></td>
  <td><?php echo round($value['OC_NIGV'],2); ?></td>
  <td><?php echo round($value['OC_NVENTA'],2); ?></td>
  <td><?php echo utf8_encode($value['EST_COMPRA']); ?></td>

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
      oc = $(this).data("oc");
      $.get("../templates/modal/servicios/actualizar.php","oc="+oc,function(data){
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

