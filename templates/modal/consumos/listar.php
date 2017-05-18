<?php

include "../../../autoload.php";
include "../../../session.php";

$consumos  = new Consumos();
count($consumos->lista());
?>


<?php if (count($consumos->lista($_SESSION['fechainicio_consumo'],$_SESSION['fechafin_consumo']))>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Lista de Consumos - Notas de Salida</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>NOTA DE SALIDA</th>
      <th>FECHA</th>
      <th>TIPO DE MOVIMIENTO</th>
      <th>DOC. DE REFERENCIA</th>
      <th>GLOSA</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($consumos->lista($_SESSION['fechainicio_consumo'],$_SESSION['fechafin_consumo']) as $key => $value) 
  {
  ?>
  <tr>
  <td><a data-ni="<?php echo $value['CANUMDOC'];?>" class="btn-edit">
  <?php echo utf8_encode($value['CANUMDOC']); ?>
  </a></td>
  <td><?php echo date_format(date_create($value['CAFECDOC']), 'd/m/Y');?></td>
  <td><?php echo utf8_encode($value['CACODMOV']); ?></td>
  <td><?php echo utf8_encode($value['CARFTDOC']); ?></td>
  <td><?php echo utf8_encode($value['CAGLOSA']); ?></td>
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
      ni= $(this).data("ni");
      $.get("../templates/modal/consumos/actualizar.php","ni="+ni,function(data){
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

