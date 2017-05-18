<form id="guardarDatos" autocomplete="Off">
<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Agregar Sub Menú</h4>
      </div>
      <div class="modal-body">
          <div id="datos_ajax_register"></div>

          <div class="form-group">
          <label class="control-label">Sub Menú:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="100" autofocus="" onchange="Mayusculas(this)" >
          </div>

          <div class="form-group">
          <label class="control-label">Menú:</label>
           <select name="menu" id="menu" class="form-control" required="">
           <option value="">[ Seleccionar ]</option>
           <?php 
            $menu = new Menu('?','?','?','?');
            foreach ($menu->lista() as $key => $value) 
            {
              echo "<option value='".$value['ID']."'>".$value['NOMBRE']."</option>";
            }

            ?>
           </select>
          </div>

          

          <div class="form-group">
          <label class="control-label">Url:</label>
          <input type="text" class="form-control" id="url" name="url" required maxlength="100" autofocus="" >
          </div>

          <div class="form-group">
          <label for="">Item</label>
          <input type="number" name="item" id="" max="10" min="1" class="form-control">
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