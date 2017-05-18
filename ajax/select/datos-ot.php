<?php 

include('../../autoload.php');

$id  = $_POST['elegido'];

$ot  = new Ot();

 ?>



  <input type="number" step="any"  name="cantidad" class="form-control" required="" max="<?php echo round($ot->consulta($id,'OF_ARTCANT'),2); ?>" placeholder="Cantidad: <?php echo round($ot->consulta($id,'OF_ARTCANT'),2); ?>" required>


