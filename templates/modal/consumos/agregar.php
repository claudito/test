  <!-- Modal -->
  <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Actualizar Fecha</h4>
        </div>
        <div class="modal-body">
<form role="form" method="post" id="agregar">

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Fecha de Inicio</label>
<input type="date" name="fechainicio" required="" class="form-control" value="<?php echo $_SESSION['fechainicio'] ?>" required>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Fecha de Fin</label>
<input type="date" name="fechafin" required="" class="form-control" value="<?php echo $_SESSION['fechainicio'] ?>" required>
</div>
</div>
</div>


  <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->