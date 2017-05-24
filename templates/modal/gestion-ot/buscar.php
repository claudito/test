  <!-- Modal -->
  <div class="modal fade" id="buscarModal" tabindex="-1" role="dialog" aria-labelledby="buscarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Rango de Consulta</h4>
        </div>
        <div class="modal-body">
<form role="form" method="post" id="buscar">

<div class="row">
<div class="col-md-4">
 <div class="form-group">
<label>Fecha de Inicio</label>
<input type="date" name="fechainicio" id="" class="form-control" required="" value="<?php echo $_SESSION['fechainicionot']; ?>">
</div> 
</div>
<div class="col-md-4">
<div class="form-group">
<label>Fecha de Fin</label>
<input type="date" name="fechafin" id="" class="form-control" required="" value="<?php echo $_SESSION['fechafinot']; ?>">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Estado</label>
<select name="estado" class="form-control">
<option value="">[Seleccionar]</option>
<option value="'ACTIVO'">ACTIVO</option>
<option value="'LIQUIDADO'">LIQUIDADO</option>
<option value="'ACTIVO','LIQUIDADO'">AMBOS</option>
</select>
</div>
</div>
</div>

<button type="submit" class="btn btn-primary">Consultar</button>
</form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->