<?php 

include '../../../autoload.php';
include '../../../session.php';

$oc        = $_GET['oc'];
$ni        = $_GET['ni'];

$servicios = new Servicios();
$cencosot  = new Cencosot();

 ?>

 <h3>Orden de Servicio</h3>

 <div class="table-responsive">
   <table class="table table-bordered table-condensed">
     <thead>
       <tr class="active">
         <th>O. SERVICIO</th>
         <th>R. SERVICIO</th>
         <th>PROVEEDOR</th>
         <th>MONEDA</th>
         <th>FORMA DE PAGO</th>
         <th>FECHA</th>
         <th>ESTADO</th>
       </tr>
     </thead>
     <tbody>
      <?php foreach ($servicios->orden_servicio_cab($oc) as $key => $value): ?>
        <tr>
         <td><?php echo utf8_encode($value['OC_CNUMORD']) ?></td>
         <td><?php echo utf8_encode($value['OC_CNRODOCREF']) ?></td>
         <td><?php echo utf8_encode($value['OC_CRAZSOC']) ?></td>
         <td><?php echo utf8_encode($value['OC_CCODMON']) ?></td>
         <td><?php echo utf8_encode($value['OC_CFORPAG']) ?></td>
         <td><?php echo date_format(date_create($value['OC_DFECDOC']), 'd/m/Y');?></td>
         <td><?php echo utf8_encode($value['OC_CSITORD']) ?></td>
       </tr> 
      <?php endforeach ?>
     </tbody>
   </table>
 </div>

  <div class="table-responsive">
   <table class="table table-bordered table-condensed">
     <thead>
       <tr class="active">
         <th>ITEM</th>
         <th>CÓDIGO</th>
         <th>DESCRIPCIÓN</th>
         <th>CANT</th>
         <th>PRECIO</th>
         <th>GLOSA</th>
         <th>C. COSTO </th>
         <th>OT</th>
         <th>ESTADO</th>
       </tr>
     </thead>
     <tbody>
      <?php foreach ($servicios->orden_servicio_det($oc) as $key => $value): ?>
        <tr>
         <td><?php echo round($value['OC_CITEM'],2) ?></td>
         <td><?php echo utf8_encode($value['OC_CODSERVICIO']) ?></td>
         <td><?php echo utf8_encode($value['OC_CDESREF']) ?></td>
         <td><?php echo round($value['OC_CANT'],2) ?></td>
         <td><?php echo round($value['OC_NPREUNI'],2) ?></td>
         <td><?php echo utf8_encode($value['OC_GLOSA']) ?></td>
         <td><?php echo utf8_encode($value['CENTCOST']) ?></td>
         <td><?php echo utf8_encode($value['OC_DORDFAB']) ?></td>
         <td><?php echo utf8_encode($value['OC_CESTADO']) ?></td>
       </tr> 
      <?php endforeach ?>
     </tbody>
   </table>
 </div>

 <h3>Nota de Ingreso</h3>

  <form role="form" method="POST" id="actualizar">
 <div class="table-responsive">
   <table class="table table-bordered table-condensed">
     <thead>
       <tr class="active">
        <th>SUB OT</th>
        <th>NOTA DE INGRESO</th>
        <th>ITEM</th>
        <th>CÓDIGO</th>
        <th>DESCRIPCIÓN</th>
        <th>CANT</th>
        <th>PRECIO</th>
        <th>OT</th>
        <th>FECHA</th>
       </tr>
     </thead>
     <tbody>
      <?php foreach ($servicios->ni($ni) as $key => $value): ?>
      <tr>
      <input type="hidden" name="ot" value="<?php echo $value['CACODLIQ']; ?>">
      <input type="hidden" name="ni[]" value="<?php echo $value['CANUMDOC']; ?>">
      <input type="hidden" name="item[]" value="<?php echo round($value['DEITEM'],2); ?>">
      <input type="hidden" name="os" value="<?php echo $oc ?>">
      <td>
      <select name="subot[]" required="">
      <?php if ($value['SUB_OT']=='VACIO'): ?>
       <option value="">...</option>
       <?php 
        foreach ($cencosot->lista_subot($value['CACODLIQ']) as $key_ot => $value_ot) 
        {
        echo "<option value='".$value_ot['OT'].'-'.$value_ot['SUB_OT']."'>".$value_ot['OT'].'-'.$value_ot['SUB_OT']."</option>";
        }
        ?>
      <?php else: ?>
      <option value="<?php echo $value['SUB_OT']; ?>"><?php echo ($value['SUB_OT']=='0') ? "-" : $value['SUB_OT'] ; ?></option>
       <?php 
        foreach ($cencosot->lista_subot($value['CACODLIQ']) as $key_ot => $value_ot) 
        {
        echo "<option value='".$value_ot['OT'].'-'.$value_ot['SUB_OT']."'>".$value_ot['OT'].'-'.$value_ot['SUB_OT']."</option>";
        }
        ?>
       <option value="0">-</option>
      <?php endif ?>
     
      </select>
      </td>
      <td><?php echo $value['CANUMDOC']; ?></td>
      <td><?php echo round($value['DEITEM'],2); ?></td>
      <td><?php echo utf8_encode($value['DECODIGO']); ?></td>
      <td><?php echo utf8_encode($value['DEDESCRI']); ?></td>
      <td><?php echo round($value['DECANTID'],2); ?></td>
      <td><?php echo round($value['DEPRECIO'],2); ?></td>
      <td><?php echo $value['CACODLIQ']; ?></td>
      <td><?php echo date_format(date_create($value['CAFECDOC']), 'd/m/Y'); ?></td>
       </tr>
      <?php endforeach ?>
     </tbody>
   </table>
 </div>
 <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i>  Agregar SUB OT´S</button>
</form>

<script>
    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/servicios/actualizar.php",
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
          loadTabla(1);
          }
      });
  });
</script>