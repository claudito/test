  <!-- Modal -->
  <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Subir Archivo</h4>
        </div>
<div class="modal-body">

<form enctype="multipart/form-data" id="agregar" method="post">

<div class="row">
<div class="col-md-5">
<div class="form-group">
<label>NOMBRE</label>
<input type="text" name="nombre"  required="" class="form-control" onchange="Mayusculas(this)">
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>VERSIÓN</label>
<input type="number" name="version" min="1" required="" class="form-control">
</div>
</div>
<div class="col-md-5">
<div class="form-group">
<label>ARCHIVO</label>
<input  type="file" id="archivo" name="archivo" required="" class="form-control" />
</div>
</div>
</div>

<input type="submit" value="Cargar archivo" class="btn btn-primary" />
</form>

</div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->