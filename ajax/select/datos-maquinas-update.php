<?php 


include('../../autoload.php');

$id = $_POST['elegido'];

$procesos_maquina = new Procesos_maquina('?','?');

 ?>

<div class="col-md-4">
 <?php if (count($procesos_maquina->lista_proceso_maquina($id))>0): ?>
 <label>Máquina</label>
 <select name="maquina" class="form-control" required="">
 <option value="">[ Seleccionar ]</option>
 <?php 
 
 foreach ($procesos_maquina->lista_proceso_maquina($id) as $key => $value) 
 {
 echo "<option value='".$value['ID_MAQUINA']."'>".utf8_encode($value['CODIGO_INTERNO']).' - '.utf8_encode($value['DESCRIPCION'])."</option>";
 }

  ?>
 </select>
 <?php else: ?>
 <p class="alert alert-warning">No hay máquina asociadas</p>	
 <?php endif ?>
</div>