<?php

include('../../../autoload.php');
$maquina = new Maquina('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');
?>


<?php if (count($maquina->lista())>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Lista de Máquinas</h3>
  </div>
  <div class="panel-body">
  <div class="table-responsive">
    <table id="consulta"  class="table table-hover table-bordered table-condensed">
      <thead>
    <tr class="active">
      <th>CÓDIGO INTERNO</th>
      <th>FECHA DE AQUISICIÓN</th>
      <th>FECHA DE INICIO DE OPERACIONES</th>
      <th>CANTIDAD</th>
      <th>FECHA DE TÉRMINO DEPRECIACIÓN</th>
      <th>CONTRATO Y/O FACTURA</th>
      <th>DESCRIPCIÓN</th>
      <th>TIPO</th>
      <th>DESCRP ABRV</th>
      <th>MODELO</th>
      <th>SERIE</th>
      <th>MARCA</th>
      <th>VALOR CONTABLE</th>
      <th>ESTADO</th>
      <th style="text-align: center;">ACCIONES</th>
    </tr>
  </thead>
      <tbody>
        <?php 
          
          foreach ($maquina->lista() as $key => $value) 
          {
            ?>
            
  <tr>
  <td><?php echo utf8_encode($value['CODIGO_INTERNO']); ?></td>
  <td><?php echo date_format(date_create($value['FECHA_ADQUISICION']), 'd/m/Y');?></td>
  <td><?php echo date_format(date_create($value['FECHA_INICIO']), 'd/m/Y');?></td>
  <td><?php echo $value['CANTIDAD']; ?></td>
  <td><?php echo date_format(date_create($value['FECHA_TERMINO']), 'd/m/Y');?></td>
  <td><?php echo utf8_encode($value['CONTRATO_FACTURA']); ?></td>
  <td><?php echo utf8_encode($value['DESCRIPCION']); ?></td>
  <td><?php echo utf8_encode($value['TIPO']); ?></td>
  <td><?php echo utf8_encode($value['DESCRIPCION_ABRV']); ?></td>
  <td><?php echo utf8_encode($value['MODELO']); ?></td>
  <td><?php echo utf8_encode($value['SERIE']); ?></td>
  <td><?php echo utf8_encode($value['MARCA']); ?></td>
  <td><?php echo round($value['VALOR_CONTABLE'],2); ?></td>
  <td><?php echo ($value['ESTADO']=='1') ? "ACTIVO" : "INACTIVO" ; ?></td>
  <td style="text-align: center;">
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
      $.get("../templates/modal/maquinas/actualizar.php","id="+id,function(data){
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

