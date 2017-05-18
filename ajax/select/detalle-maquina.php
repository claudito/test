<?php 

include('../../autoload.php');

$elegido    = $_POST['elegido'];
$anio       = substr($elegido,0,4);
$mes        = substr($elegido,4,2);
$id         = substr($elegido,6);
$maquina    = new Maquina('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');
$maquinadet = new Maquinadet($id,$anio,$mes,'?','?');

 ?>

<br>
<input type="hidden" name="id" value="<?php echo  $id; ?>">
<input type="hidden" name="anio" value="<?php echo $anio; ?>">
<input type="hidden" name="mes" value="<?php echo  $mes; ?>">


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingCabecera">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseCabecera" aria-expanded="false" aria-controls="collapseCabecera">
          Datos Cabecera
        </a>
      </h4>
    </div>
    <div id="collapseCabecera" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingCabecera">
      <div class="panel-body">
       
        <div class="form-group">
    <label>CÓDIGO INTERNO</label>
    <input type="text" class="form-control input-sm" name="codigo_interno" required="" onchange="Mayusculas(this)" value="<?php echo utf8_encode($maquina->consulta($id,'CODIGO_INTERNO')); ?>" readonly>
  </div>

  <div class="row">
  <div class="col-md-6">
  <div class="form-group">
    <label>FECHA DE ADQUISICIÓN</label>
    <input type="date" class="form-control input-sm" name="fecha_adquisicion" required="" value="<?php echo date_format(date_create($maquina->consulta($id,'FECHA_ADQUISICION')), 'Y-m-d'); ?>">
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group">
    <label>FECHA DE INICIO DE OPERACIONES</label>
    <input type="date" class="form-control input-sm" name="fecha_inicio" required="" value="<?php echo date_format(date_create($maquina->consulta($id,'FECHA_INICIO')), 'Y-m-d'); ?>">
  </div>
  </div>
  </div>

<div class="row">
<div class="col-md-6">
 <div class="form-group">
    <label>CANTIDAD</label>
    <input type="number" step="any" min="0"   class="form-control input-sm" name="cantidad" required="" value="<?php echo $maquina->consulta($id,'CANTIDAD'); ?>">
  </div> 
</div>
<div class="col-md-6">
<div class="form-group">
<label>FECHA TÉRMINO DE DEPRECIACIÓN</label>
<input type="date" class="form-control input-sm" name="fecha_termino" required="" value="<?php echo date_format(date_create($maquina->consulta($id,'FECHA_TERMINO')), 'Y-m-d'); ?>">
</div>
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>CONTRATO Y/O FACTURA</label>
<input type="text" class="form-control input-sm" name="contrato_factura" required="" onchange="Mayusculas(this)" value="<?php echo  utf8_encode($maquina->consulta($id,'CONTRATO_FACTURA')); ?>">
</div> 
</div>
<div class="col-md-6">
<div class="form-group">
<label>DESCRIPCIÓN</label>
<input type="text" class="form-control input-sm" name="descripcion" required="" onchange="Mayusculas(this)" value="<?php echo utf8_encode($maquina->consulta($id,'DESCRIPCION')); ?>">
</div> 
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>TIPO DE MÁQUINA</label>
<select name="tipo"  class="form-control" required="">
<option value="<?php echo $maquina->consulta($id,'IDTIPO'); ?>"><?php echo utf8_encode($maquina->consulta($id,'TIPO')); ?></option>
<?php 

$tipomaquina = new Tipomaquina('?');
foreach ($tipomaquina->lista_actualizar($maquina->consulta($id,'IDTIPO')) as $key => $value) 
{
   echo "<option value='".$value['ID']."'>".utf8_encode($value['DESCRIPCION'])."</option>";
}

 ?>
</select>
</div>  
</div>
<div class="col-md-6">
<div class="form-group">
<label>DESCRIPCIÓN ABREVIADA</label>
<input type="text" name="descripcion_abrv" class="form-control" required="" value="<?php echo utf8_encode($maquina->consulta($id,'DESCRIPCION_ABRV')); ?>">
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group">
  <label>MODELO</label>
  <input type="text" name="modelo"  required="" class="form-control" value="<?php echo utf8_encode($maquina->consulta($id,'MODELO')); ?>">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
  <label>SERIE</label>
  <input type="text" name="serie"  required="" class="form-control" value="<?php echo utf8_encode($maquina->consulta($id,'SERIE')); ?>"> 
  </div>
</div>
</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group">
  <label>MARCA</label>
  <input type="text" name="marca"  required="" class="form-control" value="<?php echo utf8_encode($maquina->consulta($id,'MARCA')); ?>">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
  <label>VALOR CONTABLE</label>
  <input type="number" min="0"  step="any"  name="valorcontable"  required="" class="form-control" value="<?php echo round($maquina->consulta($id,'VALOR_CONTABLE'),2); ?>">
  </div>
</div>
</div>


<div class="form-group">
<label>ESTADO</label>
<select name="estado" class="form-control" required="">
<option value="<?php echo $maquina->consulta($id,'ESTADO'); ?>"><?php echo  ($maquina->consulta($id,'ESTADO')==1) ? "ACTIVO" : "INACTIVO" ; ?></option>
<?php if ($maquina->consulta($id,'ESTADO')==1): ?>
  <option value="3">INACTIVO</option>
<?php else: ?>
  <option value="1">ACTIVO</option>
<?php endif ?>
</select>
</div>



      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingDetalle">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseDetalle" aria-expanded="false" aria-controls="collapseDetalle">
          Datos Detalle
        </a>
      </h4>
    </div>
    <div id="collapseDetalle" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingDetalle">
      <div class="panel-body">
        <div class="row">
        <div class="col-md-6">
        	<div class="form-group">
        	<label>MES DEPRECIADO</label>
        	 <input type="number" name="mes_depreciado" class="form-control" value="<?php echo round($maquinadet->consulta('MES_DEPRECIADO'),2); ?>">
        	</div>
        </div>
        <div class="col-md-6">
        	<div class="form-group">
        	<label>MES FALTANTE</label>
        	 <input type="number" name="mes_faltante" class="form-control" value="<?php echo round($maquinadet->consulta('MES_FALTANTE'),2); ?>">
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
          url: "../procesos/maquinas/actualizar.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#mensaje").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#mensaje").html(datos);
         //$("#actualizar")[0].reset();  //resetear inputs
          $('#editModal').modal('hide'); //ocultar modal
          $('body').removeClass('modal-open');
          $("body").removeAttr("style"); // remover todos los estilos
          $('.modal-backdrop').remove();
          loadTabla(1);
          }
      });
  });


</script>