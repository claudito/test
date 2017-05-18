	function load(page){
		var parametros = {"action":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'../templates/modal/tipo-cambio/listar.php',
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
	
