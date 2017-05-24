<?php 

include('../../../autoload.php');
$ot      = $_GET['ot'];
$subot   = $_GET['subot'];
$vua      = $_GET['vua'];

$cencosot    = new Cencosot();

$cantidadot  =  $cencosot->consulta($ot,'CANT');
$fechainicio =  date_format(date_create($cencosot->consulta($ot,'OF_FECHINI')), 'Y-m-d');

 ?>


 <?php if (count($cencosot->lista_ni($ot)) > 0): ?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">OT DE <?php echo $cencosot->tipo_ot(substr($ot, 0,1)) ?>: <?php echo $ot; ?></h4>
</div>

<form  role="form" id="agregar-ni" >

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



</form>


<?php if (count($cencosot->lista_subot($ot)) > 0): ?>
  <p></p> 
 <form role="form" method="post" id="agregar">
  <div class="table-responsive">
    <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th >SUB OT</th>
          <th >CÓDIGO</th>
          <th >DESCRIPCIÓN</th>
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
      <tr>
      <input type="hidden" name="id[]" value="<?php echo $value['ID']; ?>">
      <td><input type="text"  style="text-align: center;" name="subot[]" value="<?php echo $value['SUB_OT']; ?>"  min="0" required></td>
      <td><input type="text"  value="<?php echo $value['CODIGO']; ?>"  readonly></td>
      <td><input type="text"  value="<?php echo $value['ADESCRI']; ?>" readonly></td>
      <td><input type="number" min="0" style="text-align: center;" step="any" name="cantidad[]" value="<?php echo round($value['CANTIDAD'],2); ?>"  required></td>
      <td><input type="number" min="0" style="text-align: center;" step="any" name="entrega[]" value="<?php echo round($value['ENTREGA'],2); ?>"  required></td>
      <td><input type="number" min="0" style="text-align: center;" step="any" name="saldo[]" value="<?php echo round($value['SALDO'],2); ?>"  required></td>
      <td><input type="date" name="fechainicio[]" value="<?php echo date_format(date_create($value['FECHA_INICIO']), 'Y-m-d'); ?>"  ></td>
      <td><input type="date" name="fechafin[]" value="<?php echo date_format(date_create($value['FECHA_FIN']), 'Y-m-d'); ?>"  ></td>
      <td><input type="text" style="text-align: center;" name="notaingreso[]" value="<?php echo $value['NOTA_INGRESO']; ?>"  ></td>
      <td>
      <select name="tipo_entrega[]"  required="">
      <option value="<?php echo utf8_encode($value['TIPO_ENTREGA']); ?>"><?php echo utf8_encode($value['TIPO_ENTREGA']); ?></option>
      <option value="ENTREGA PARCIAL">ENTREGA PARCIAL</option>
      <option value="ENTREGA TOTAL">ENTREGA TOTAL</option>
      </select>
      </td>
      <td>
      <select name="status[]"  required="">
      <option value="<?php echo utf8_encode($value['STATUS']); ?>"><?php echo utf8_encode($value['STATUS']); ?></option>
      <option value="ANULADO">ANULADO</option>
      <option value="LIQUIDADO">LIQUIDADO</option>
      <option value="PROCESO">PROCESO</option>
      </select>
      </td>
      <td>
    <select name="tipo_ot[]"  required="">
    <option value="<?php echo utf8_encode($value['TIPO_OT']); ?>"><?php echo utf8_encode($value['TIPO_OT']); ?></option>
    <option value="SERVICIO">SERVICIO</option>
    <option value="ENSAMBLE">ENSAMBLE</option>
    <option value="FABRICACIÓN">FABRICACIÓN</option>
    <option value="GARANTIA">GARANTIA</option>
    <option value="TRABAJO INTERNO">TRABAJO INTERNO</option>
    </select>
      </td>
    <td>
    <select name="tipo_proceso[]"  required="">
    <option value="<?php echo utf8_encode($value['TIPO_PROCESO']); ?>"><?php echo utf8_encode($value['TIPO_PROCESO']); ?></option>
    <option value="FABRICACIÓN PARCIAL">FABRICACIÓN PARCIAL</option>
    <option value="MECANIZADO PARCIAL">MECANIZADO PARCIAL</option>
    <option value="MECANIZADO TOTAL">MECANIZADO TOTAL</option>
    </select>
    </td>
      </tr>
      <?php endforeach ?>
      </tbody>
    </table>
  </div>


  </form>

<p></p>

<div class="row">
<div class="col-md-12">
<form  id="costounitarioacumulado"  class="form-inline" autocomplete="Off">
  <input type="hidden" name="subot" value="<?php echo $subot; ?>">
  <input type="number" min="0"  step="any" name="cantidad" value="<?php echo $vua; ?>" class="form-control" required="" >
  <button type="submit" class="btn btn-primary">Agregar Costo Unitario Acumulado</button>
</form>
</div>
</div>


<?php else: ?>
  <p></p>
 <p class="alert alert-warning">No hay sub ot registradas.</p>
<?php endif ?>


<?php include('../../../templates/modal/gestion-ot/eliminar.php'); ?>

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
          loadTabla(1);
          }
      });
  });


</script>

 <?php else: ?>
 <p class="alert alert-warning">Aún no se ha registrado ingresos</p>
 <?php endif ?>