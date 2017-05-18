<?php
include '../../../autoload.php';
include '../../../session.php';

 $id        = $_GET['id'];

 $horometrodiario = new Horometrodiario();
 
?>

<h4>ACTUALIZAR: <?php echo utf8_encode($horometrodiario->consulta($id,'CODIGO_INTERNO')).' - '.utf8_encode($horometrodiario->consulta($id,'DESCRIPCION')); ?></h4>
<hr>

<form role="form" method="POST" id="actualizar">

<input type="hidden" name="id" value="<?php echo $id; ?>">

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>HORÓMETRO INICIAL</label>
<input type="number" min="0" name="cant_inicial"  step="any" required=""  class="form-control" value="<?php echo round($horometrodiario->consulta($id,'CANTIDAD_INICIAL'),2) ?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>HORÓMETRO FINAL</label>
<input type="number" min="0"  name="cant_final"  step="any" required=""  class="form-control" value="<?php echo round($horometrodiario->consulta($id,'CANTIDAD_FINAL'),2) ?>">
</div>  
</div>
</div>

<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>

</form>

<script>
    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/horometro-maquina/actualizar.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#mensaje").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#mensaje").html(datos);
         //$("#actualizar")[0].reset();  //resetear inputs
          $('#editModal').modal('hide'); //ocultar modal
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          loadTabla(1);
          }
      });
  });
</script>