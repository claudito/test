<?php
include '../../../autoload.php';
include '../../../session.php';

$ni        = $_GET['ni'];
$item      = $_GET['item'];

$consumos  = new Consumos();
$cencosot  = new Cencosot();

?>

<h4>Nota de Salida: <?php echo $ni ?> - <?php echo date_format(date_create($consumos->consulta($ni,'CAFECDOC')), 'd/m/Y'); ?></h4>

<form role="form" method="POST" id="actualizar">
<div class="table-responsive">
  <table class="table table-bordered table-condensed">
    <thead>
      <tr class="active">
        <th>SUB OT</th>
        <th>ITEM</th>
        <th>CÓDIGO</th>
        <th>DESCRIPCIÓN</th>
        <th>UND</th>
        <th>CANT</th>
        <th>PRECIO</th>
        <th>TIPO MOV</th>
        <th>MONEDA</th>
        <th>OT</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($consumos->detalle($ni,$item) as $key => $value): ?>
    <tr>
    <input type="hidden" name="ni" value="<?php echo $ni ?>">
    <input type="hidden" name="item[]" value="<?php echo $value['DEITEM']; ?>">
    <input type="hidden" name="ot[]" value="<?php echo $value['DEORDFAB']; ?>">
    <td>
     <select name="subot[]" required="">
      <?php if ($value['SUB_OT']=='VACIO'): ?>
      <option value="">...</option>
      <?php 

      foreach ($cencosot->lista_subot($value['DEORDFAB']) as $key_ot => $value_ot) 
      {
      echo "<option value='".$value_ot['OT'].'-'.$value_ot['SUB_OT']."'>".$value_ot['OT'].'-'.$value_ot['SUB_OT']."</option>";
      }

       ?>
      <?php else: ?>
      <option value="<?php echo $value['SUB_OT']; ?>"><?php echo ($value['SUB_OT']=='0') ? "-" :  $value['SUB_OT']; ?></option>
      <?php 
      foreach ($cencosot->lista_subot($value['DEORDFAB']) as $key_ot => $value_ot) 
      {
      echo "<option value='".$value_ot['OT'].'-'.$value_ot['SUB_OT']."'>".$value_ot['OT'].'-'.$value_ot['SUB_OT']."</option>";
      }

       ?>
      <option value="0">-</option>
      <?php endif ?>
      </select>
    </td>
    <td><?php echo utf8_encode($value['DEITEM']); ?></td>
    <td><?php echo utf8_encode($value['DECODIGO']); ?></td>
    <td><?php echo utf8_encode($value['DEDESCRI']); ?></td>
    <td><?php echo utf8_encode($value['DEUNIDAD']); ?></td>
    <td><?php echo round($value['DECANTID'],2); ?></td>
    <td><?php echo round($value['DEPRECIO'],2); ?></td>
    <td><?php echo utf8_encode($value['DECODMOV']); ?></td>
    <td><?php echo utf8_encode($value['DECODMON']); ?></td>
    <td><?php echo utf8_encode($value['DEORDFAB']); ?></td>
    </tr>
    <?php endforeach ?>
    </tbody>
  </table>
</div>

<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> Actualizar SUB OT</button>

</form>

<script>
    $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/consumos/actualizar.php",
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