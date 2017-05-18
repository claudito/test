<?php
include '../../../autoload.php';
include '../../../session.php';

$oc        = $_GET['oc'];
$servicios = new Servicios();
$cencosot  = new Cencosot();
$ot        = $servicios->consulta($oc,'OC_DORDFAB');
?>

<h4>ORDEN DE SERVICIO: <?php echo $oc; ?> - <?php echo date_format(date_create($servicios->consulta($oc,'OC_DFECDOC')), 'd/m/Y'); ?> </h4>

<div class="table-responsive">
  <table class="table table-bordered table-condensed">
    <thead>
      <tr class="active">
        <th>IT</th>
        <th>CÓDIGO</th>
        <th>DESCRIPCIÓN</th>
        <th>CANT</th>
        <th>GLOSA</th>
        <th>P. U.</th>
        <th>CENCOST</th>
        <th>OT</th>
        <th>ESTADO</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($servicios->detalle($oc) as $key => $value): ?>
    <tr>
    <td><?php echo round($value['OC_CITEM'],2); ?></td>
    <td><?php echo utf8_encode($value['OC_CODSERVICIO']); ?></td>
    <td><?php echo utf8_encode($value['OC_CDESREF']); ?></td>
    <td><?php echo round($value['OC_CANT'],2); ?></td>
    <td><?php echo utf8_encode($value['OC_GLOSA']); ?></td>
    <td><?php echo round($value['OC_NPREUNI'],2); ?></td>
    <td><?php echo utf8_encode($value['CENTCOST']); ?></td>
    <td><?php echo utf8_encode($value['OC_DORDFAB']); ?></td>
    <td><?php echo utf8_encode($value['EST_COMPRA']); ?></td>
    </tr>
    <?php endforeach ?>
    </tbody>
  </table>
</div>

<?php if (count($servicios->ni($oc))>0): ?>
 <h4>Nota de Ingresos</h4>
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
      <?php foreach ($servicios->ni($oc) as $key => $value): ?>
      <tr>
      <input type="hidden" name="ot" value="<?php echo $ot; ?>">
      <input type="hidden" name="ni[]" value="<?php echo $value['CANUMDOC']; ?>">
      <input type="hidden" name="os" value="<?php echo $oc ?>">
      <td>
      <select name="subot[]" required="">
      <?php if ($value['SUB_OT']=='VACIO'): ?>
       <option value="">...</option>
       <option value="0">-</option>
       <?php 
        foreach ($cencosot->lista_subot($ot) as $key_ot => $value_ot) 
        {
        echo "<option value='".$value_ot['OT'].'-'.$value_ot['SUB_OT']."'>".$value_ot['OT'].'-'.$value_ot['SUB_OT']."</option>";
        }
        ?>
      <?php else: ?>
      <option value="<?php echo $value['SUB_OT']; ?>"><?php echo ($value['SUB_OT']=='0') ? "-" : $value['SUB_OT'] ; ?></option>
       <?php 
        foreach ($cencosot->lista_subot($ot) as $key_ot => $value_ot) 
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
          //loadTabla(1);
          }
      });
  });
</script>

<?php else: ?>
 <p class="alert alert-warning">No se ha registrado ingresos</p>
<?php endif ?>