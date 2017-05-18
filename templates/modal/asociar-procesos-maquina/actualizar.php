<?php
include('../../../autoload.php');
$id = $_GET['id'];
$procesos_maquina  = new Procesos_maquina('?','?');

?>

<?php if(count($procesos_maquina->lista())>0):?>

<form role="form" id="actualizar" >


<p class="alert alert-warning">No hay información por actualizar.</p>

 

  
<input type="hidden" name="id" value="<?php echo $id; ?>">
<!--  
<button type="submit" class="btn btn-default btn-primary">Actualizar</button>
-->
</form>



<script>

    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/asociar-procesos-maquina/actualizar.php",
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
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>