<?php

include '../../../autoload.php';
include '../../../session.php';
$cencosot = new Cencosot();

$estado   = (!isset($_SESSION['estadoot'])) ? "'',''" : $_SESSION['estadoot'];


?>

<?php if (count($cencosot->lista($_SESSION['fechainicionot'],$_SESSION['fechafinot'],$estado))>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Listas de Ordenes de Trabajo / Fabricación </h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>OT</th>
      <th>CENTRO COSTO</th>
      <th>CÓDIGO</th>
      <th>DESCRIPCIÓN</th>
      <th>UND</th>
      <th>CANT</th>
      <th>CANT NI</th>
      <th>CANT P</th>
      <th>FECHA DE INICIO</th>
      <th>FECHA DE FIN</th>
      <th>FECHA INGRESO</th>
      <th>ESTADO</th>
      <th style="text-align: center;">ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($cencosot->lista($_SESSION['fechainicionot'],$_SESSION['fechafinot'],$estado) as $key => $value) 
  {
  ?>
  <tr>
  <td><?php echo utf8_encode($value['OF_COD']); ?></td>
  <td><?php echo utf8_encode($value['CODIGOCENTROCOSTO']); ?></td>
  <td><?php echo utf8_encode($value['CODIGO']); ?></td>
  <td><?php echo utf8_encode($value['ADESCRI']); ?></td>
  <td><?php echo utf8_encode($value['AUNIDAD']); ?></td>
  <td><?php echo round($value['CANT'],2); ?></td>
  <td><?php echo round($value['CANT_NI'],2); ?></td>
  <td><?php echo round($value['CANT_P'],2); ?></td>
  <td><?php echo date_format(date_create($value['OF_FECHINI']), 'd/m/Y');?></td>
  <td><?php echo date_format(date_create($value['OF_FECHFIN']), 'd/m/Y');?></td>
  <td><?php echo date_format(date_create($value['FECHA_NI']), 'd/m/Y');?></td>
  <td><?php echo utf8_encode($value['OF_ESTADO']); ?></td>
  <td  style="text-align: center;">
  <a data-ot="<?php echo $value['OF_COD'];?>" class="btn btn-edit btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i></a>

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
      ot = $(this).data("ot");
      $.get("../templates/modal/gestion-ot/agregar.php","ot="+ot,function(data){
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

