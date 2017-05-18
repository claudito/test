<form id="actualidarDatos" name="actualizarDatos" autocomplete="Off">
<div class="modal fade" id="dataUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Actualizar Menú</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax"></div>

<input type="hidden" class="form-control" id="id" name="id">

<div class="form-group">
<label  class="control-label">Nombre</label>
<input type="text" class="form-control" id="nombre" name="nombre" required maxlength="100"onchange="Mayusculas(this)">
</div>

<div class="form-group">
<label for="">Item</label>
<input type="number" name="item" id="item" max="10" min="1" class="form-control">
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar datos</button>
      </div>
    </div>
  </div>
</div>
</form>