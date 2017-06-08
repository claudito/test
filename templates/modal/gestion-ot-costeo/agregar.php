<?php 

include('../../../autoload.php');
$ot      = $_GET['ot'];
$subot   = $_GET['subot'];
$cencosot    = new Cencosot();

$cantidadot  =  $cencosot->consulta($ot,'CANT');
$fechainicio =  date_format(date_create($cencosot->consulta($ot,'OF_FECHINI')), FECHA);

 ?>

<?php if (count($cencosot->lista_ni($ot))): ?>
 <div class="table-responsive">
  <table class="table table-bordered table-condensed">
    <thead>
      <tr class="active">
        <th>Nota de Ingreso</th>
        <th>Código</th>
        <th>Descripción</th>
        <th>Unidad</th>
        <th>Cantidad</th>
        <th>Entrega</th>
        <th>Saldo</th>
        <th>Fecha de Registro</th>
      </tr>
    </thead>
    <tbody>
    <?php 

     $a = 0;
     
     foreach ($cencosot->lista_ni($ot) as $key => $value) 
     {
    ?>
    <tr>
    <input type="hidden" name="subot[]" value="<?php echo $value['ITEM']; ?>">
    <input type="hidden" name="ni[]" value="<?php echo $value['DENUMDOC']; ?>">
    <input type="hidden" name="cantidad[]" value="<?php echo $cantidadot-$a; ?>">
    <input type="hidden" name="entrega[]" value="<?php echo round($value['DECANTID'],2); ?>">
    <input type="hidden" name="saldo[]" value="<?php echo ($cantidadot-$a)-($value['DECANTID']); ?>">
    <input type="hidden" name="fechafin[]" value="<?php echo date_format(date_create($value['CAFECDOC']), FECHA); ?>">
    <td><?php echo utf8_encode($value['DENUMDOC']) ?></td>
    <td><?php echo utf8_encode($value['DECODIGO']) ?></td>
    <td><?php echo utf8_encode($value['DEDESCRI']) ?></td>
    <td><?php echo utf8_encode($value['DEUNIDAD']) ?></td>
    <td><?php echo $cantidadot-$a; ;?></td>
    <td><?php echo round($value['DECANTID'],2) ?></td>
    <td><?php echo ($cantidadot-$a)-($value['DECANTID']); ?></td>
    <td><?php echo date_format(date_create($value['CAFECDOC']), 'd/m/Y');?></td>
    </tr>
    
     <?php 
       
       $a = $a+$value['DECANTID'];

      ?>
    <?php
     }


     ?>
     <tr>
      <td colspan="5"></td>
      <td><?php echo $a; ?></td>
      <td colspan="2">
      <?php 
       $cantidad = round($cencosot->consulta($ot,'CANT'),2); 
       $saldo    = $cantidad - $a;
       ?>
       <ul>
        <li>Cantidad : <?php echo $cantidad; ?></li>
        <li>Ingresos :&nbsp;&nbsp;   <?php echo $a; ?></li>
        <li>Saldo :&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $saldo; ?></li>
       </ul>
      </td>
      
     </tr>
    </tbody>
  </table>

</div> 
<?php else: ?>
<p class="alert alert-warning">No se ha registrado Ingresos.</p>
<?php endif ?>

<?php if (count($cencosot->lista_subot($ot)) > 0): ?>
  <form  id="costounitarioacumulado"  class="form-inline" autocomplete="Off">
  <div class="table-responsive">
    <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th >SUB OT</th>
          <th>COSTO UNITARIO ACUMULADO</th>
          <th >CÓDIGO</th>
          <th >CANTIDAD</th>
          <th>ENTREGA</th>
          <th >SALDO</th>
          <th >FECHA INICIO</th>
          <th >FECHA FIN</th>
          <th >NOTA DE INGRESO</th>
          <th >TIPO ENTREGA</th>
          <th >STATUS</th>
          <th >TIPO OT</th>
          <th >TIPO PROCESO</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($cencosot->lista_subot($ot) as $key => $value): ?>
      <?php if (($value['OT'].'-'.$value['SUB_OT'])==$subot): ?>
      <tr>
      <td><input type="text"  style="text-align: center;" name="subot" value="<?php echo $value['OT'].'-'.$value['SUB_OT']; ?>"  min="0" readonly></td>
      <td><input type="number" min="0" style="text-align: center;" step="any" name="cantidad" value="<?php echo round($value['COSTO_UNITARIO'],2); ?>"  required></td>
      <td><input type="text"  value="<?php echo $value['CODIGO']; ?>"  readonly></td>
      <td><input type="number" min="0" style="text-align: center;"   value="<?php echo round($value['CANTIDAD'],2); ?>"  readonly></td>
      <td><input type="number" min="0" style="text-align: center;"  value="<?php echo round($value['ENTREGA'],2); ?>"  readonly></td>
      <td><input type="number" min="0" style="text-align: center;"  value="<?php echo round($value['SALDO'],2); ?>"  readonly></td>
      <td><input type="date"  value="<?php echo date_format(date_create($value['FECHA_INICIO']), 'Y-m-d'); ?>"  readonly></td>
      <td><input type="date"  value="<?php echo date_format(date_create($value['FECHA_FIN']), 'Y-m-d'); ?>"  readonly></td>
      <td><input type="text" style="text-align: center;" value="<?php echo $value['NOTA_INGRESO']; ?>"  readonly></td>
      <td>
      <input type="text" value="<?php echo utf8_encode($value['TIPO_ENTREGA']); ?>" readonly>
      </td>
      <td>
      <input type="text" value="<?php echo utf8_encode($value['STATUS']); ?>" readonly>
      </td>
      <td>
      <input type="text" value="<?php echo utf8_encode($value['TIPO_OT']); ?>" readonly>
      </td>
    <td>
    <input type="text" value="<?php echo utf8_encode($value['TIPO_PROCESO']); ?>" readonly>
    </td>
      </tr>
      <?php else: ?>
       <!-- No coincide con la sub ot -->
      <?php endif ?>
      <?php endforeach ?>
      </tbody>
    </table>
  </div>

<div class="form-group">
<button type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-refresh"></i>  Actualizar</button>
</div>
  </form>
<?php else: ?>
 <p class="alert alert-warning">No se ha registrado SUBOTs.</p> 
<?php endif ?>

 <script>


 $("#costounitarioacumulado").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/gestion-ot-costeo/costounitarioacumulado.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#mensaje").html("Mensaje: Cargando...");
            },
          success: function(datos){
          $("#mensaje").html(datos);
         //$("#actualizar")[0].reset();  //resetear inputs
          $('#editModal').modal('hide'); //ocultar modal
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          //loadTabla(1);
          }
      });
  });


</script>