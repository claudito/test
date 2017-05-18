	function load(page){
		var parametros = {"action":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'../templates/modal/sub-menu/listar.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='../assets/img/loader.gif'>");
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}
	
		$('#dataUpdate').on('show.bs.modal', function (event) {
  var button      = $(event.relatedTarget) // Botón que activó el modal
  var id          = button.data('id') // Extraer la información de atributos de datos
  var item        = button.data('item') // Extraer la información de atributos de datos
  var menu        = button.data('menu') // Extraer la información de atributos de datos
  var idmenu      = button.data('idmenu') // Extraer la información de atributos de datos
  var submenu     = button.data('submenu') // Extraer la información de atributos de datos
  var url         = button.data('url') // Extraer la información de atributos de datos
 
		  var modal = $(this)
		  modal.find('.modal-title').text('Modificar Sub Menú: '+submenu)
		  modal.find('.modal-body #id').val(id)
		  modal.find('.modal-body #item').val(item)
		  modal.find('.modal-body #submenu').val(submenu)
		  modal.find('.modal-body #url').val(url)
 modal.find('.modal-body #menuupdate').append("<option selected value='"+idmenu+"'>"+menu+"</option>");

		
		  $('.alert').hide();//Oculto alert
		

		})
		
		

		$('#dataDelete').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var id = button.data('id') // Extraer la información de atributos de datos
		  var modal = $(this)
		  modal.find('#id').val(id)
		})

	$( "#actualidarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "../procesos/sub-menu/actualizar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$(".datos_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$(".datos_ajax").html(datos);
					$('#dataUpdate').modal('hide');
					load(1);
				  }
			});
		  event.preventDefault();
		});
		
		$( "#guardarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "../procesos/sub-menu/agregar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$(".datos_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$(".datos_ajax").html(datos);
					$('#dataRegister').modal('hide');
					load(1);
					$(":text").each(function(){	   /*Limpiar input:text*/
					$($(this)).val('');
					});
					$(":password").each(function(){	/*Limpiar input:password*/
					$($(this)).val('');
					});	
					$("#idtipo option:first-child").attr("selected",true); /*Limpiar select*/
				
					
				  }
			});
		  event.preventDefault();
		});
		
		$( "#eliminarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "../procesos/sub-menu/eliminar.php",
					data: parametros,
					 beforeSend: function(objeto){
						$(".datos_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$(".datos_ajax").html(datos);
					$('#dataDelete').modal('hide');
					load(1);
				  }
			});
		  event.preventDefault();
		});

     	
	