<?php 

include('../../../autoload.php');
$id               = $_GET['id'];
$tipomaquina  = new Tipomaquina('?');

 ?>

<?php if(count($tipomaquina->lista()) > 0):?>

<form role="form" id="actualizar" >
 

<input type="hidden" name="id"  value="<?php echo $id; ?>">
  

  <div class="form-group">
    <label>Descripción</label>
    <input type="text" name="descripcion" required="" class="form-control" value="<?php echo utf8_encode($tipomaquina->consulta($id,'DESCRIPCION')); ?>" onchange="Mayusculas(this)">
  </div>
 

 <button class="btn btn-primary">Actualizar</button>


</form>



<script>

    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/tipo-maquina/actualizar.php",
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