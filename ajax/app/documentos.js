
function loadTabla(page){
    var parametros = {"action":"ajax","page":page};
    $("#loader").fadeIn('slow');
    $.ajax({
      url:'../templates/modal/documentos/listar.php',
      data: parametros,
       beforeSend: function(objeto){
      $("#loader").html("<img src='../assets/img/loader.gif'>");
      },
      success:function(data){
        $("#tabla").html(data).fadeIn('slow');
        $("#loader").html("");
      }
    })
  }


$(function(){
$("#agregar").on("submit", function(e){
e.preventDefault();
var f = $(this);
var formData = new FormData(document.getElementById("agregar"));
formData.append("dato", "valor");

$.ajax({
url: "../procesos/documentos/agregar.php",
type: "post",
dataType: "html",
data: formData,
cache: false,
contentType: false,
processData: false
})
.done(function(res){
    $("#mensaje").html(res);
    $('#newModal').modal('hide');  // ocultar modal
    loadTabla(1);
});
});
});


$('#dataDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id = button.data('id')
      var dni = button.data('dni')
      var modal = $(this)
      modal.find('#id').val(id)
      modal.find('#dni').val(dni)
    })



$( "#eliminarDatos" ).submit(function( event ) {
    var parametros = $(this).serialize();
       $.ajax({
          type: "POST",
          url: "../procesos/documentos/eliminar.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#mensaje").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#mensaje").html(datos);
          $('#dataDelete').modal('hide');
          loadTabla(1);
          }
      });
      event.preventDefault();
    });