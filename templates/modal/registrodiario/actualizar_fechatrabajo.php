
<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Actualizar</h4>
			</div>
			<form action="../procesos/registrodiario/actualizar-cabecera" method="POST" autocomplete="Off">
			<div class="modal-body">

			<div class="row">
			<div class="col-md-6">
			<div class="form-group">
			<label>FECHA DE TRABAJO</label>
			<input type="date" name="fechatrabajo" class="form-control" value="<?php echo date_format(date_create($registrodiario_cab->consulta('FECHA_TRABAJO')), 'Y-m-d') ?>"  required>
			</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
			<label>FECHA DE PRODUCCIÓN</label>
			<input type="date" name="fechaproduccion" class="form-control" value="<?php echo date_format(date_create($registrodiario_cab->consulta('FECHA_PRODUCCION')), 'Y-m-d') ?>" required>
			</div>
			</div>
			</div>
				
             
            <div class="row">
			<div class="col-md-6">
			<div class="form-group">
			<label>TURNO</label>
			<select name="turno" class="form-control" required="">
			<option value="<?php echo $registrodiario_cab->consulta('IDTURNO'); ?>"><?php echo $registrodiario_cab->consulta('TURNO'); ?></option>
			<?php 
             
             $turnos = new Turnos('?','?','?','?','?');
             foreach ($turnos->lista_actualizar($registrodiario_cab->consulta('IDTURNO')) as $key => $value) 
             {
             	echo "<option value='".$value['ID']."'>".$value['CODIGO']."</option>";
             }


			 ?>
			</select>
			</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
			<label>MÁQUINA</label>
			<select name="maquina" class="form-control" required="">
			<option value="<?php echo $registrodiario_cab->consulta('IDMAQUINA'); ?>"><?php echo utf8_encode($registrodiario_cab->consulta('CODIGO_INTERNO')).' - '.utf8_encode($registrodiario_cab->consulta('DESCRIPCION')); ?></option>
			<?php 
            $maquina = new Maquina('?','?','?','?','?','?','?','?','?','?','?','?','?','?','?');
            foreach ($maquina->lista_actualizar($registrodiario_cab->consulta('IDMAQUINA')) as $key => $value) 
            {
            	echo "<option value='".$value['ID']."'>".utf8_encode($value['CODIGO_INTERNO']).' - '.utf8_encode($value['DESCRIPCION'])."</option>";
            }
			 ?>
			</select>
			</div>
			</div>
			</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
			</form>
		</div>
	</div>
</div>