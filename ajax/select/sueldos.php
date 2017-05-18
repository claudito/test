<?php 

include('../../autoload.php');

$elegido  = $_POST['elegido'];
$dni      =  substr($elegido,6,8);
$anio     = substr($elegido,0,4);
$mes      = substr($elegido,4,2);
$id       = substr($elegido,14);

$usuariosdet  = new Usuariosdet($dni,$anio,$mes,'?','?','?','?','?','?','?','?','?','?','?','?','?','?');

$usuarios = new Usuarios('?','?','?','?');

 ?>

<br>
<input type="hidden" name="dni" value="<?php echo  $dni; ?>">
<input type="hidden" name="anio" value="<?php echo $anio; ?>">
<input type="hidden" name="mes" value="<?php echo  $mes; ?>">


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Básico,Bonificaciones y Asignación Familiar
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
       <div class="row">

		<div class="col-md-2">
		<div class="form-group">
		<label>Básico</label>
		<input type="number" min="0"  step="any" name="basico" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('BASICO'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>B. Ordinaria</label>
		<input type="number" min="0"  step="any" name="bonificacion_ordinaria" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('BONIFICACION_ORDINARIA'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>B. Variable</label>
		<input type="number" min="0"  step="any" name="bonificacion_variable" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('BONIFICACION_VARIABLE'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>B. Nocturna</label>
		<input type="number" min="0"  step="any" name="bonificacion_nocturna" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('BONIFICACION_NOCTURNA'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>A. Familiar</label>
		<input type="number" min="0"  step="any" name="asignacion_familiar" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('ASIGNACION_FAMILIAR'),2); ?>">
		</div>
		</div>


       </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Beneficios
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
       <div class="row">
       	
		<div class="col-md-2">
		<div class="form-group">
		<label>Vacaciones</label>
		<input type="number" min="0"  step="any" name="vacaciones" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('VACACIONES'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>Gratificaciónes</label>
		<input type="number" min="0"  step="any" name="gratificaciones" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('GRATIFICACIONES'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>CTS</label>
		<input type="number" min="0"  step="any" name="cts" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('CTS'),2); ?>">
		</div>
		</div>


       </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Aportes
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <div class="row">
        
		<div class="col-md-2">
		<div class="form-group">
		<label>EsSalud</label>
		<input type="number" min="0"  step="any" name="essalud" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('ESSALUD'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>Sctr Pensión</label>
		<input type="number" min="0"  step="any" name="sctr_pension" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('SCTR_PENSION'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>Sctr Salud</label>
		<input type="number" min="0"  step="any" name="sctr_salud" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('SCTR_SALUD'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>Sctre Vida</label>
		<input type="number" min="0"  step="any" name="sctr_vida" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('SCTR_VIDA'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>Senati</label>
		<input type="number" min="0"  step="any" name="senati" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('SENATI'),2); ?>">
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<label>D. Médico</label>
		<input type="number" min="0"  step="any"  name="descanso_medico" id="" class="form-control" value="<?php echo round($usuariosdet->consulta('DESCANSO_MEDICO'),2); ?>">
		</div>
		</div>



        </div>
      </div>
    </div>
  </div>

 
 <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Perfil
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
       <div class="row">
       	
	   <div class="col-md-3">
	   	<div class="form-group">
	   	 <label>Tipo</label>
	   	 <select name="tipo" id="" class="form-control">
	   	 <option value="<?php echo $usuarios->consulta($id,'TIPO'); ?>"><?php echo ($usuarios->consulta($id,'TIPO')=='1') ? "USUARIO" : "ADMINISTRADOR" ; ?></option>
	   	 <?php if ($usuarios->consulta($id,'TIPO')=='1'): ?>
	   	 <option value="2">ADMINISTRADOR</option>
	   	 <?php else: ?>
	   	 <option value="1">USUARIO</option>
	   	 <?php endif ?>

	   	 </select>
	   	</div>
	   </div>

	   <div class="col-md-5">
	   	<div class="form-group">
	   	 <label>Correo</label>
	   	 <input type="email" name="correo" id="" class="form-control" value="<?php echo $usuarios->consulta($id,'CORREO'); ?>">
	   	 </select>
	   	</div>
	   </div>


	   <div class="col-md-4">
	   	<div class="form-group">
	   	 <label>Contraseña</label>
	   	 <input type="password" name="passnuevo" id="" class="form-control">
	   	 <input type="hidden" name="passactual" value="<?php echo $usuarios->consulta($id,'PASS'); ?>">
	   	</div>
	   </div>

	
	


       </div>
      </div>
    </div>
  </div>



</div>



<button class="btn btn-primary">Actualizar</button>

<script>

    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/horas-hombre/actualizar.php",
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
          //loadTabla(1);
          }
      });
  });


</script>