<?php
include('../../../autoload.php');
$id = $_GET['id'];
$clasificacion  = new Clasificacion('?','?','?','?','?');

?>

<?php if(count($clasificacion->lista())>0):?>

<form role="form" id="actualizar" >


<input type="hidden" name="id"  value="<?php echo $id; ?>">
 
<div class="form-group">
<label for="name">NOMBRE</label>
<input type="text" class="form-control"  name="nombre" required onchange="Mayusculas(this)" value="<?php echo utf8_encode($clasificacion->consulta($id,'NOMBRE')); ?>" readonly>
</div>

<div class="form-group">
<label for="lastname">DETALLE</label>
<input type="text" class="form-control"  name="detalle" required onchange="Mayusculas(this)" value="<?php echo utf8_encode($clasificacion->consulta($id,'DETALLE')); ?>">
</div>

<div class="form-group">
<label for="lastname">ABREVIATURA</label>
<input type="text" class="form-control"  name="abrv" required onchange="Mayusculas(this)" value="<?php echo utf8_encode($clasificacion->consulta($id,'ABRV')); ?>">
</div>


   <div class="row">
  <div class="col-md-6">
   <div class="form-group">
  <label>ASISTENCIA</label>
  <select name="asistencia" id="" class="form-control" required="">
  <option value="<?php echo $clasificacion->consulta($id,'ASISTENCIA'); ?>"><?php echo ($clasificacion->consulta($id,'ASISTENCIA')==0) ? "NO" : "SI" ; ?></option>
  <?php if ($clasificacion->consulta($id,'ASISTENCIA')==0): ?>
    <option value="1">SI</option>
  <?php else: ?>
    <option value="0">NO</option>
  <?php endif ?>
  </select>
  </div>
 
  </div>
  <div class="col-md-6">
  <div class="form-group">
  <label>TIPO DE STAND BY</label>
  <select name="tipo_stand_by" id="" class="form-control" required="">
 <option value="<?php echo $clasificacion->consulta($id,'TIPO_STAND_BY'); ?>">
 <?php 
switch ($clasificacion->consulta($id,'TIPO_STAND_BY')) {
case '1':
  echo "NINGUNO";
  break;
  case '2':
  echo "STAND BY NORMAL";
  break;
  case '3':
  echo "STAND BY OPERATIVO";
  break;
  
  default:
  echo "NINGUNO";
    break;
}

  ?>
   
 </option>
  <?php 
switch ($clasificacion->consulta($id,'TIPO_STAND_BY')) {
case '1':
  echo "
  <option value='2'>STAND BY NORMAL</option>
  <option value='3'>STAND BY OPERATIVO</option>
  ";
  break;
  case '2':
  echo "<option value='1'>NINGUNO</option>
  <option value='3'>STAND BY OPERATIVO</option>";
  break;
  case '3':
  echo "
  <option value='1'>NINGUNO</option>
  <option value='2'>STAND BY NORMAL</option>";
  break;
  
  default:
  echo "NINGUNO";
    break;
}

  ?>
  </select>
  </div>
  </div>
  </div>




<button type="submit" class="btn btn-default btn-primary">Actualizar</button>
</form>



<script>

    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/clasificacion/actualizar.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#mensaje").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#mensaje").html(datos);
         //$("#actualizar")[0].reset();  //resetear inputs
          $('#editModal').modal('hide'); //ocultar modal
          $("body").removeAttr("style"); // remover todos los estilos
          $('.modal-backdrop').remove();
          loadTabla(1);
          }
      });
  });


</script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>