
function loadTabla(page){
    var parametros = {"action":"ajax","page":page};
    $("#loader").fadeIn('slow');
    $.ajax({
      url:'../templates/modal/registrodiario/listar.php',
      data: parametros,
       beforeSend: function(objeto){
      //$("#loader").html("<img src='../assets/img/loader.gif'>");
      },
      success:function(data){
        $("#tabla").html(data).fadeIn('slow');
        $("#loader").html("");
      }
    })
  }



function CargarModalAgregar(page){
    var parametros = {"action":"ajax","page":page};
    $("#loader-modal-agregar").fadeIn('slow');
    $.ajax({
      url:'../templates/modal/registrodiario/agregar.php',
      data: parametros,
       beforeSend: function(objeto){
      $("#loader-modal-agregar").html("<img src='../assets/img/loader.gif'>");
      },
      success:function(data){
        $("#tabla-modal-agregar").html(data).fadeIn('slow');
        $("#loader-modal-agregar").html("");
      }
    })
  }


/*
$( "#agregar" ).submit(function( event ) {
var parametros = $(this).serialize();
$.ajax({
  type: "POST",
  url: "../procesos/registrodiario/agregar.php",
  data: parametros,
   beforeSend: function(objeto){
    $("#mensaje").html("Mensaje: Cargando...");
    },
  success: function(datos){
  $("#mensaje").html(datos);//mostrar mensaje 
  $('#agregar').modal('hide'); // ocultar  formulario
  //$("#agregar")[0].reset();  //resetear inputs
  $("#agregar").trigger('reset'); //jquery
  $('#newModal').modal('hide');  // ocultar modal
  loadTabla(1);
  }
});
event.preventDefault();
});*/



$('#dataDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id     = button.data('id') // Extraer la información de atributos de datos
      var modal  = $(this)
      modal.find('#id').val(id)
    })


$( "#eliminarDatos" ).submit(function( event ) {
    var parametros = $(this).serialize();
       $.ajax({
          type: "POST",
          url: "../procesos/registrodiario/eliminar.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#mensaje").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#mensaje").html(datos);
          $('#dataDelete').modal('hide');
          loadTabla(1);
          CargarModalAgregar(1);
          }
      });
      event.preventDefault();
    });