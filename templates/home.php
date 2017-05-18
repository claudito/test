<?php 

include('autoload.php');

$assets = new Assets();
$html   = new Html();
$assets ->principal('Bienvenidos');
$assets ->sweetalert();
$html->header();
?>


<div class="row">
<div class="col-md-12">
<?php include('templates/nav.php'); ?>
</div>
</div>


<div class="row">
<div class="col-md-12">
<?php echo $retVal = ($_GET['login']=='ok') ?  "<script>swal({type:'success',title:'Bienvenido(a) ".$_SESSION[KEY.NOMBRES]."',timer:3000,showConfirmButton: false})</script>" : ""; ?>

<center><img src="assets/img/logo-acceso.png" alt="" ></center>

</div>
</div>


<div class="row">
<div class="col-md-12">
<h1 class="text-center">Aplicación de Costos</h1>
</div>
</div>


<?php $html -> footer(); ?>