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
<label>PROCESOS</label>
<select name="procesos" id="" class="form-control" required="">
<option value="">[ Seleccionar ]</option>
<?php 
foreach ($procesos->lista() as $key => $value) 
{
  echo "<option value='".$value['ID']."'>".utf8_encode($value['NOMBRE']).' - '.utf8_encode($value['DETALLE'])."</option>";
}
 ?>
</select>
</div>


<div class="form-group">
<label>MÁQUINA</label>
<select name="maquina" id="" class="form-control" required="">
<option value="">[ Seleccionar ]</option>
<?php 
foreach ($maquina->lista() as $key => $value) 
{
  echo "<option value='".$value['ID']."'>".utf8_encode($value['CODIGO_INTERNO']).' - '.utf8_encode($value['DESCRIPCION'])."</option>";
}
 ?>
</select>
</div>



  



  <button type="submit" class="btn btn-primary">Agregar</button>
</form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->