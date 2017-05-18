  <!-- Modal -->
  <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Agregar</h4>
        </div>
        <div class="modal-body">
<form role="form" method="post" id="agregar">

  <div class="form-group">
    <label>CÓDIGO INTERNO</label>
    <input type="text" class="form-control input-sm" name="codigo_interno" required="" onchange="Mayusculas(this)">
  </div>

  <div class="row">
  <div class="col-md-6">
  <div class="form-group">
    <label>FECHA DE ADQUISICIÓN</label>
    <input type="date" class="form-control input-sm" name="fecha_adquisicion" required="" >
  </div>
  </div>
  <div class="col-md-6">
  <div class="form-group">
    <label>FECHA DE INICIO DE OPERACIONES</label>
    <input type="date" class="form-control input-sm" name="fecha_inicio" required="">
  </div>
  </div>
  </div>

<div class="row">
<div class="col-md-6">
 <div class="form-group">
    <label>CANTIDAD</label>
    <input type="number" step="any" min="0"   class="form-control input-sm" name="cantidad" required="">
  </div> 
</div>
<div class="col-md-6">
<div class="form-group">
<label>FECHA TÉRMINO DE DEPRECIACIÓN</label>
<input type="date" class="form-control input-sm" name="fecha_termino" required="" onchange="Mayusculas(this)">
</div>
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>CONTRATO Y/O FACTURA</label>
<input type="text" class="form-control input-sm" name="contrato_factura" required="" onchange="Mayusculas(this)">
</div> 
</div>
<div class="col-md-6">
<div class="form-group">
<label>DESCRIPCIÓN</label>
<input type="text" class="form-control input-sm" name="descripcion" required="" onchange="Mayusculas(this)">
</div> 
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>TIPO DE MÁQUINA</label>
<select name="tipo"  class="form-control" required="">
<option value="">[ Seleccionar ]</option>
<?php 

$tipomaquina = new Tipomaquina('?');
foreach ($tipomaquina->lista() as $key => $value) 
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
<input type="text" name="descripcion_abrv" class="form-control" required="" onchange="Mayusculas(this)">
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group">
  <label>MODELO</label>
  <input type="text" name="modelo"  required="" class="form-control" onchange="Mayusculas(this)">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
  <label>SERIE</label>
  <input type="text" name="serie"  required="" class="form-control" onchange="Mayusculas(this)">
  </div>
</div>
</div>

<div class="row">
<div class="col-md-6">
  <div class="form-group">
  <label>MARCA</label>
  <input type="text" name="marca"  required="" class="form-control" onchange="Mayusculas(this)">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
  <label>VALOR CONTABLE</label>
  <input type="number" min="0"  step="any"  name="valorcontable"  required="" class="form-control" onchange="Mayusculas(this)">
  </div>
</div>
</div>



  


  <button type="submit" class="btn btn-default">Agregar</button>
</form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->