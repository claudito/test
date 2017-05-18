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
    <label>Mes y Año</label>
    <input type="month" name="mes" id="" class="form-control" required="">
  </div>

   <div class="form-group">
    <label>Tiempo Depreciación Meses</label>
    <input type="number" min="0" name="tiempo_mes" id="" step="any" required="" class="form-control">
  </div>

  <div class="form-group">
    <label>Tiempo Depreciación Años</label>
    <input type="number" min="0" name="tiempo_anio" id="" step="any" required="" class="form-control">
  </div>

  <div class="form-group">
  <label>Tipo</label>
  <select name="tipo" class="form-control" required="">
  <option value="">[ Seleccionar ]</option>
  <option value="0">COSTO COMERCIAL</option>
  <option value="1">COSTO REAL</option>
  </select>
  </div>
 



  <button type="submit" class="btn btn-default">Agregar</button>
</form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->