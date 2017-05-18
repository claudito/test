$(document).ready(function(){
	$("#add_err").css('display', 'none', 'important');
	 $("#login").click(function(){	
		  username=$("#name").val();
		  password=$("#word").val();
		  path    =$("#path").val();
		  $.ajax({
		   type: "POST",
		   url: "procesos/login.php",
			data: "name="+username+"&pwd="+password,
		   success: function(html){    
			if(html=='true')    
			{

			 window.location=""+path+"?login=ok";		
			}
			else if (html =='emptyname')
			{

		    $("#add_err").css('display', 'inline', 'important');
			$("#add_err").html("<script>swal({type:'warning',title:'Ingrese el Usuario',timer:2000,showConfirmButton: false})</script>");
			$('#name').val("");
			$('#name').focus();
			$('#word').val("");

			}
			else if (html =='emptypwd')
			{

		    $("#add_err").css('display', 'inline', 'important');
			$("#add_err").html("<script>swal({type:'warning',title:'Ingrese la Contraseña',timer:2000,showConfirmButton: false})</script>");
			$('#word').val("");
			$('#word').focus();

			}
			else if (html =='emptynamepwd')
			{

		    $("#add_err").css('display', 'inline', 'important');
			$("#add_err").html("<script>swal({type:'warning',title:'Ingrese la Contraseña',timer:2000,showConfirmButton: false})</script>");
			$('#word').val("");
			$('#word').focus();

			}
			else   
			 {
			$("#add_err").css('display', 'inline', 'important');
			$("#add_err").html("<script>swal({type:'error',title:'Usuario o Contraseña Incorrectos',timer:2000,showConfirmButton: false})</script>");
			$('#name').val("");
			$('#name').focus();
			$('#word').val("");

			}
		   },
		   beforeSend:function()
		   {
			$("#add_err").css('display', 'inline', 'important');
			$("#add_err").html("Cargando...")
		   }
		  });
		return false;
	});
});