<?php
include '../../../autoload.php';
include '../../../session.php';

$id        = $_GET['id'];
$tiempos   = new Tiempos();
$ot        = $tiempos->consulta($id,'OT');
$subot     = $tiempos->consulta($id,'SUB_OT');


?>

<div class="row">
<div class="col-md-12">
<?php if (count($tiempos->agregar_subot($ot))>0): ?>
<h2>Actualizar SUB OT´s</h2><hr>
<form role="form" method="POST" id="actualizar">

<?php if (count($tiempos->lista_subot($id,$subot))>0): ?>
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<select name="subot" class="form-control" required="">
<option value="<?php echo $tiempos->consulta($id,'SUB_OT'); ?>">
<?php echo $tiempos->consulta($id,'SUB_OT'); ?></option>
<?php 
foreach ($tiempos->actualizar_subot($ot,$subot) as $key => $value) 
{
echo "<option value='".$value['SUB_OT']."'>".$value['SUB_OT']."</option>";
}
?>
<option value="">-</option>
</select>
</div> 
<?php else: ?>
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<select name="subot" class="form-control" required="">
<option value="">[Seleccionar]</option>
<?php 
foreach ($tiempos->agregar_subot($ot) as $key => $value) 
{
echo "<option value='".$value['SUB_OT']."'>".$value['SUB_OT']."</option>";
}
?>
</select>
</div> 
<?php endif ?>

<button class="btn btn-primary">Actualizar</button>

</form> 
<?php else: ?>
<p class="alert alert-warning">No hay SUB OT´s Registradas</p>
<?php endif ?>

<script>
    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../../procesos/tiempos/actualizar.php",
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
          //loadTabla(1);
          }
      });
  });
</script>



</div>
</div>