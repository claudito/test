
function loadTabla(page){
    var parametros = {"action":"ajax","page":page};
    $("#loader").fadeIn('slow');
    $.ajax({
      url:'../templates/modal/gestion-ot-costeo/listar.php',
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


$( "#buscar" ).submit(function( event ) {
var parametros = $(this).serialize();
$.ajax({
  type: "POST",
  url: "../procesos/gestion-ot-costeo/buscar.php",
  data: parametros,
   beforeSend: function(objeto){
    $("#mensaje").html("Mensaje: Cargando...");
    },
  success: function(datos){
  $("#mensaje").html(datos);//mostrar mensaje 
  $('#agregar').modal('hide'); // ocultar  formulario
  //$("#agregar")[0].reset();  //resetear inputs
  $('#buscarModal').modal('hide');  // ocultar modal
  loadTabla(1);
  }
});
event.preventDefault();
});

