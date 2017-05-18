<?php 

include('../autoload.php');
include('../session.php');

$assets = new Assets();
$html   = new Html();
$assets ->principal('Ayuda');
$html->header();
?>


<div class="row">
<div class="col-md-12">
<?php include('../templates/nav.php'); ?>
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3>Ayuda: Documentos y Contacto</h3><hr>
</div>
</div>


<div class="row">
<div class="col-md-12">



			<div class="panel-group" id="panel-ayuda">

				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-ayuda" href="#panel-manual-pdf">Manuales en PDF</a>
					</div>
					<div id="panel-manual-pdf" class="panel-collapse collapse">
						<div class="panel-body">
						
					

						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-ayuda" href="#panel-manual-video">Manuales en Vídeo</a>
					</div>
					<div id="panel-manual-video" class="panel-collapse collapse">
						<div class="panel-body">

					

						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-ayuda" href="#panel-contacto">Contacto de Ayuda</a>
					</div>
					<div id="panel-contacto" class="panel-collapse collapse">
						<div class="panel-body">
							
						 <ul>
						 <li>Correo de Soporte: <a href="">soluciones@perutec.com.pe</a></li>
						 <li>Celular de Soporte : 997 935 085 </li>
						 </ul>

						</div>
					</div>
				</div>

			</div>




</div>
</div>



<?php $html -> footer(); ?>