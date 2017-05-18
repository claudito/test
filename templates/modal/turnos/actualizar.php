<?php

include('../../../autoload.php');


$id     = $_GET['id'];

$turnos = new Turnos('?','?','?','?','?');


?>

<?php if(count($turnos->lista()) > 0):?>

<form role="form" id="actualizar" >

<input type="hidden" name="id" value="<?php echo $id; ?>">

 <div class="form-group">
 <label>Código</label>
 <input type="text" name="codigo" class="form-control" onchange="Mayusculas(this)" readonly="" value="<?php echo $turnos->consulta($id,'CODIGO'); ?>">
 </div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>HORA INGRESO</label>
<input type="time" name="hora_ingreso" class="form-control" value="<?php echo date_format(date_create($turnos->consulta($id,'HORA_INGRESO')), 'H:i') ?>" required>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>SALIDA REFRIGERIO</label>
<input type="time" name="salida_refrigerio" class="form-control" value="<?php echo date_format(date_create($turnos->consulta($id,'SALIDA_REFRIGERIO')), 'H:i') ?>" required>
</div>
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>INGRESO REFRIGERIO</label>
<input type="time" name="ingreso_refrigerio" class="form-control" value="<?php echo date_format(date_create($turnos->consulta($id,'INGRESO_REFRIGERIO')), 'H:i') ?>" required>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>HORA SALIDA</label>
<input type="time" name="hora_salida" class="form-control" value="<?php echo date_format(date_create($turnos->consulta($id,'HORA_SALIDA')), 'H:i') ?>" required>
</div>
</div>
</div>



<button type="submit" class="btn btn-default">Actualizar</button>
</form>



<script>

    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/turnos/actualizar.php",
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

<?php else:?>
  <p class="alert alert-danger">No hay datos disponible</p>
<?php endif;?>