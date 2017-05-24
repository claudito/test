<?php

include '../../../autoload.php';
include '../../../session.php';
$cencosot = new Cencosot();

?>

<?php if (count($cencosot->lista_costeo($_SESSION['fechainiciocosteo'],$_SESSION['fechafincosteo']))>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Listas de Ordenes de Trabajo / Fabricación - Costeo </h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
      <th>OT</th>
      <th>SUB OT</th>
      <th>C. C.</th>
      <th>FECHA INICIO</th>
      <th>FECHA FIN</th>
      <th>CÓDIGO</th>
      <th>DESCRIPCIÓN</th>
      <th>UND</th>
      <th>CANT</th>
      <th>ENTREGA</th>
      <th>SALDO</th>
      <th>NOTA INGRESO</th>
      <th>TIPO ENTREGA</th>
      <th>STATUS</th>
      <th>TIPO OT</th>
      <th>TIPO PROCESO</th>
      <th>ESTADO</th>
      <th>COSTO UNITARIO ACUMULADO</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($cencosot->lista_costeo($_SESSION['fechainiciocosteo'],$_SESSION['fechafincosteo']) as $key => $value) 
  {
  ?>
  <tr>
  <td >
  <a data-ot="<?php echo $value['OF_COD'];?>" data-subot="<?php echo utf8_encode($value['SUB_OT']); ?>" data-vua="<?php echo round($value['COSTO_UNITARIO'],2); ?>" class="btn-edit">
  <?php echo utf8_encode($value['OF_COD']); ?>
  </a>
  </td>
  <td><?php echo utf8_encode($value['SUB_OT']); ?></td>
  <td><?php echo utf8_encode($value['CODIGOCENTROCOSTO']); ?></td>
  <td><?php echo date_format(date_create($value['OF_FECHINI']), 'd/m/Y');?></td>
  <td><?php echo date_format(date_create($value['FECHA_FIN']), 'd/m/Y');?></td>
  <td><?php echo utf8_encode($value['CODIGO']); ?></td>
  <td><?php echo utf8_encode($value['ADESCRI']); ?></td>
  <td><?php echo utf8_encode($value['AUNIDAD']); ?></td>
  <td><?php echo round($value['CANTIDAD'],2); ?></td>
  <td><?php echo round($value['ENTREGA'],2); ?></td>
  <td><?php echo round($value['SALDO'],2); ?></td>
  <td><?php echo utf8_encode($value['NOTA_INGRESO']); ?></td>
  <td><?php echo utf8_encode($value['TIPO_ENTREGA']); ?></td>
  <td><?php echo utf8_encode($value['STATUS']); ?></td>
  <td><?php echo utf8_encode($value['TIPO_OT']); ?></td>
  <td><?php echo utf8_encode($value['TIPO_PROCESO']); ?></td>
  <td><?php echo utf8_encode($value['OF_ESTADO']); ?></td>
  <td><?php echo round($value['COSTO_UNITARIO'],2); ?></td>
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
      ot    = $(this).data("ot");
      subot = $(this).data("subot");
      vua   = $(this).data("vua");
      $.get("../templates/modal/gestion-ot-costeo/agregar.php","ot="+ot+"&subot="+subot+"&vua="+vua,function(data){
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

