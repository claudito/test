<!-- Modal -->
<div class="modal fade" id="buscarModal" tabindex="-1" role="dialog" aria-labelledby="buscarModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Rango de Consulta</h4>
</div>
<div class="modal-body">
<form role="form" method="post" id="buscar" autocomplete="Off">

<div class="row">
<div class="col-md-12">
<div class="form-group">
<input type="month" name="fecha"  class="form-control" required="" value="<?php echo $_SESSION['fecha_tiempos']; ?>">
</div>
</div>
</div>


<button type="submit" class="btn btn-primary">Consultar</button>
</form>
</div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->