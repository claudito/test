<?php 
include('../autoload.php');
include('../session.php');
$assets =  new Assets();
$html   = new Html();
$assets -> principal('Lista de Tipos de Cambio');
$assets -> datatables();
$assets -> sweetalert();
$html ->header();

 ?>

<div class="row">
<div class="col-md-12">
<?php include('../templates/nav.php'); ?>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div id="loader" class="text-center"> <img src="../assets/img/loader.gif"></div>
<div class="datos_ajax"></div><!-- Datos ajax Final -->
<div class="outer_div"></div><!-- Datos ajax Final -->
</div>
</div>


<script src="../ajax/app/tipo-cambio.js"></script>
<script>
$(document).ready(function(){
load(1);
});
</script>


<?php 
$html ->footer();
 ?>