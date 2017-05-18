<?php

include('../../../autoload.php');
$usuarios = new Usuarios('?','?','?','?');
?>


<?php if (count($usuarios->lista())>0): ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Lista de Usuarios</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
  <table id="consulta"  class="table table-bordered table-hover ">
  <thead>
    <tr class="active">
    <th>NOMBRES</th>
      <th>APELLIDOS</th>
      <th>DNI</th>
      <th>CARGO</th>
      <th>ÁREA</th>
      <th>TIPO</th>
      <th>FECHA DE INGRESO</th>
      <th>TIPO</th>
      <th>ESTADO</th>
      <th style="text-align: center;">ACCIONES</th>
    </tr>
  </thead>
  <tbody>
  <?php 
     
  foreach ($usuarios->lista() as $key => $value) 
  {
  ?>
  <tr>
  <td><a href="permisos?id=<?php echo $value['ID'] ?>"><?php echo utf8_encode($value['NOMBRES']); ?></a></td>
  <td><?php echo utf8_encode($value['APELLIDOS']); ?></td>
  <td><?php echo $value['DNI']; ?></td>
  <td><?php echo utf8_encode($value['CARGO']); ?></td>
  <td><?php echo utf8_encode($value['AREA']); ?></td>
  <td><?php echo utf8_encode($value['TIPO_TRAB']); ?></td>
  <td><?php echo date_format(date_create($value['FECHAING']), 'd/m/Y');?></td>
  <td><?php echo $retVal = ($value['TIPO']==1) ? "USUARIO" : "ADMINISTRADOR" ;  ?></td>
  <td><?php echo $retVal = ($value['ESTADO']==1) ? "ACTIVO" : "INACTIVO" ;  ?></td>
  <td  style="text-align: center;">
  <a data-dni="<?php echo $value['DNI'];?>" data-id="<?php echo $value['ID'];?>"  class="btn btn-edit btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i></a>
  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $value['ID']?>" data-dni="<?php echo $value['DNI']?>" ><i class="glyphicon glyphicon-trash"></i></button>

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
      dni = $(this).data("dni");
      id  = $(this).data("id");
      $.get("../templates/modal/horas-hombre/actualizar.php","dni="+dni+"&id="+id,function(data){
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

