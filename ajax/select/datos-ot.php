<?php 

include('../../autoload.php');

$id  = $_POST['elegido'];

$ot  = new Ot();


 ?>

<div class="col-md-2">

 <input type="number" step="any"  name="cantidad" class="form-control" min="0" required="" max="<?php echo round($ot->consulta($id,'OF_ARTCANT'),2); ?>" placeholder="Cant: <?php echo round($ot->consulta($id,'OF_ARTCANT'),2); ?>" required>
 
</div>



<div class="col-md-2">
 
<input type="text" class="form-control" value="<?php echo $ot->consulta($id,'OF_ESTADO'); ?>" readonly>

</div>
