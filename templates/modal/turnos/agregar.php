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
 <label>Código</label>
 <input type="text" name="codigo" class="form-control" onchange="Mayusculas(this)">
 </div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>HORA INGRESO</label>
<input type="time" name="hora_ingreso" class="form-control">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>SALIDA REFRIGERIO</label>
<input type="time" name="salida_refrigerio" class="form-control">
</div>
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>INGRESO REFRIGERIO</label>
<input type="time" name="ingreso_refrigerio" class="form-control">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>HORA SALIDA</label>
<input type="time" name="hora_salida" class="form-control">
</div>
</div>
</div>



  <button type="submit" class="btn btn-default">Agregar</button>
</form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->