<?php

include "../../../autoload.php";
include "../../../session.php";

$servicios  = new Servicios();
count($servicios->lista());
?>


<?php if (count($servicios->lista($_SESSION['fechainicio_servicio'],$_SESSION['fechafin_servicio']))>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Detalle Notas de Ingreso por Ordenes de Servicio </h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>NOTA DE INGRESO</th>
      <th>SUB OT</th>
      <th>ITEM</th>
      <th>CÓDIGO</th>
      <th>DESCRIPCIÓN</th>
      <th>CANT</th>
      <th>PRECIO</th>
      <th>MONEDA</th>
      <th>TIPO DOC</th>
      <th>DOC</th>
      <th>OT</th>
      <th>ORDEN DE SERVICIO</th>
      <th>FECHA</th>  
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($servicios->lista($_SESSION['fechainicio_servicio'],$_SESSION['fechafin_servicio']) as $key => $value) 
  {
  ?>
  <tr>
  <td><a data-oc="<?php echo $value['CANUMORD'];?>" data-ni="<?php echo $value['CANUMDOC'];?>" class="btn-edit">
  <?php echo utf8_encode($value['CANUMDOC']); ?>
  </a></td>
  <td><?php echo utf8_encode($value['SUB_OT']); ?></td>
  <td><?php echo round($value['DEITEM'],2); ?></td>
  <td><?php echo utf8_encode($value['DECODIGO']); ?></td>
  <td><?php echo utf8_encode($value['DEDESCRI']); ?></td>
  <td><?php echo round($value['DECANTID'],2); ?></td>
  <td><?php echo round($value['DEPRECIO'],2); ?></td>
  <td><?php echo utf8_encode($value['CACODMON']); ?></td>
  <td><?php echo utf8_encode($value['CARFTDOC']); ?></td>
  <td><?php echo utf8_encode($value['CARFNDOC']); ?></td>
  <td><?php echo utf8_encode($value['CACODLIQ']); ?></td>
  <td><?php echo utf8_encode($value['CANUMORD']); ?></td>
    <td><?php echo date_format(date_create($value['CAFECDOC']), 'd/m/Y');?></td>

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
      ni = $(this).data("ni");
      $.get("../templates/modal/servicios/actualizar.php","oc="+oc+"&ni="+ni,function(data){
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

