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
<label for="name">NOMBRE</label>
<input type="text" class="form-control"  name="nombre" required onchange="Mayusculas(this)">
</div>

<div class="form-group">
<label for="lastname">DETALLE</label>
<input type="text" class="form-control"  name="detalle" required onchange="Mayusculas(this)">
</div>

<div class="form-group">
<label for="lastname">ABREVIATURA</label>
<input type="text" class="form-control"  name="abrv" required onchange="Mayusculas(this)">
</div>


   <div class="row">
  <div class="col-md-6">
   <div class="form-group">
  <label>ASISTENCIA</label>
  <select name="asistencia" id="" class="form-control" required="">
  <option value="">[ Seleccionar ]</option>
  <option value="0">NO</option>
  <option value="1">SI</option>
  </select>
  </div>
 
  </div>
  <div class="col-md-6">
  <div class="form-group">
  <label>TIPO DE STAND BY</label>
  <select name="tipo_stand_by" id="" class="form-control" required="">
  <option value="">[ Seleccionar ]</option>
  <option value="1">NINGUNO</option>
  <option value="2">STAND BY NORMAL</option>
  <option value="3">STAND BY OPERATIVO</option>
  </select>
  </div>
  </div>
  </div>

 


  <button type="submit" class="btn btn-primary">Agregar</button>
</form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->