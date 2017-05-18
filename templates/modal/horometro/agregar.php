<form id="guardarDatos">
<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Agregar Horómetro</h4>
      </div>
      <div class="modal-body">
      <div id="datos_ajax_register"></div>

      <div class="form-group">
      <label>MES y AÑO</label>
      <input type="month" name="mes" class="form-control" required>
      </div>

      <div class="form-group">
      <label>HORAS HOMBRE</label>
      <input type="number" name="horas_hombre" id="" step="any" class="form-control" required>
      </div>

      <div class="form-group">
      <label>HORAS MÁQUINA</label>
      <input type="number" name="horas_maquina" id="" step="any" class="form-control" required>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar datos</button>
      </div>
    </div>
  </div>
</div>
</form>