<?php 

include('../../../autoload.php');
$id               = $_GET['id'];
$vidautilmaquina  = new Vidautilmaquina('?','?','?','?','?');

 ?>

<?php if(count($vidautilmaquina->lista()) > 0):?>

<form role="form" id="actualizar" >
 

<input type="hidden" name="id" id="" value="<?php echo $id; ?>">
  
 <div class="form-group">
    <label>Mes y Año</label>
    <input type="month" name="mes" id="" class="form-control" required="" 
     value="<?php echo $vidautilmaquina->consulta($id,'ANIO').'-'.sprintf("%0"."2"."s", "".$vidautilmaquina->consulta($id,'MES').""); ?>" readonly>
  </div>

   <div class="form-group">
    <label>Tiempo Depreciación Meses</label>
    <input type="number" min="0" name="tiempo_mes" id="" step="any" required="" class="form-control" value="<?php echo round($vidautilmaquina->consulta($id,'TIEMPO_MES'),2); ?>">
  </div>

  <div class="form-group">
    <label>Tiempo Depreciación Años</label>
    <input type="number" min="0" name="tiempo_anio" id="" step="any" required="" class="form-control" value="<?php echo round($vidautilmaquina->consulta($id,'TIEMPO_ANIO'),2); ?>">
  </div>

 <div class="form-group">
  <label>TIPO</label>
  <select name="tipo" class="form-control" required="">
  <option value="<?php echo $vidautilmaquina->consulta($id,'TIPO'); ?>"><?php echo  ($vidautilmaquina->consulta($id,'TIPO')==0) ? "COSTO COMERCIAL" : "COSTO REAL" ; ?></option>
  <?php if ($vidautilmaquina->consulta($id,'TIPO')==0): ?>
    <option value="1">COSTO REAL</option>
  <?php else: ?>
    <option value="0">COSTO COMERCIAL</option>
  <?php endif ?>
  </select>
 </div>

 <button class="btn btn-primary">Actualizar</button>


</form>



<script>

    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/vida-util-maquina/actualizar.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#mensaje").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#mensaje").html(datos);
         //$("#actualizar")[0].reset();  //resetear inputs
          $('#editModal').modal('hide'); //ocultar modal
          $('body').removeClass('modal-open');
          $("body").removeAttr("style");
          $('.modal-backdrop').remove();
          loadTabla(1);
          }
      });
  });


</script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>