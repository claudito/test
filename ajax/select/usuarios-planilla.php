<?php 

include('../../autoload.php');

$area =  $_POST['elegido'];

$usuarios = new Usuarios('?','?','?');

 ?>

 <div class="table-responsive">
 	<table  class="table table-bordered table-condensed">
 		<thead>
 			<tr class="active">
 				<th>NOMBRES</th>
 				<th>APELLIDOS</th>
 				<th>DNI</th>
 				<th>FECHA DE INGRESO</th>
 				<th>CARGO</th>
                <th>ÁREA</th>
 				<th>TRANSFERIR</th>
 			</tr>
 		</thead>
 		<tbody>
 		<?php 
        
        foreach ($usuarios->lista_usuarios_planillas($area,'1','0') as $key => $value) 
        {
         ?>
        <tr>
        <td><?php echo utf8_encode($value['NOMBRE']); ?></td>
        <td><?php echo utf8_encode($value['APEPAT']).' '.utf8_encode($value['APEMAT']); ?></td>
        <td><?php echo $value['DOCIDEN']; ?></td>
        <td><?php echo date_format(date_create($value['FECHAING']), 'd/m/Y'); ?></td>
        <td><?php echo utf8_encode($value['CARGO']); ?></td>
        <td><?php echo utf8_encode($value['AREA']); ?></td>
        <td>
        <?php if (empty($value['DNI'])): ?>
         <input type="checkbox"  name="dni[]" class="form-control" value="<?php echo $value['DOCIDEN']; ?>">   
        <?php else: ?>
         <input type="checkbox" name="" id="" checked="" class="form-control" disabled="">
        <?php endif ?>
        </td>

        </tr>
         <?php
        }

 		 ?>
 		</tbody>
 	</table>
 </div>


 <button class="btn btn-primary btn-lg btn-block">Transferir</button>
