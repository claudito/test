<?php 

include('../../../autoload.php');
$ot   = $_GET['ot'];

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

 <input type="hidden" name="codigo" value="<?php echo $cencosot->consulta($ot,'CODIGO') ?>">
 <input type="hidden" name="ot" value="<?php echo $cencosot->consulta($ot,'CODIGOOT') ?>">
 <input type="hidden" name="centro_costo" value="<?php echo $cencosot->consulta($ot,'CODIGOCENTROCOSTO') ?>">
  <input type="hidden" name="fechainicio" value="<?php echo $cencosot->consulta($ot,'OF_FECHINI') ?>">

<button type="submit" class="btn btn-primary btn-xs btn-block">CREAR SUB OT</button>

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
          <th>Acciones</th>
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
    <td style="text-align: center;">
    <a data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $value['ID']?>"><i class="glyphicon glyphicon-trash text-danger"></i></a>
    </td>
      </tr>
      <?php endforeach ?>
      </tbody>
    </table>
  </div>


  <button type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-refresh"></i>  Actualizar lista&nbsp;</button>
  </form>

<p></p>

 <form role="form" id="actualizar" >

 <input type="hidden" name="codigo" value="<?php echo $cencosot->consulta($ot,'CODIGO') ?>">
 <input type="hidden" name="ot" value="<?php echo $cencosot->consulta($ot,'CODIGOOT') ?>">
 <input type="hidden" name="centro_costo" value="<?php echo $cencosot->consulta($ot,'CODIGOCENTROCOSTO') ?>">

  
<div class="form-group">
<a class="btn btn-success btn-sm" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
<i class="glyphicon glyphicon-floppy-saved"></i> Agregar Sub OT
</a>
</div>


<div class="collapse" id="collapseExample">
  <div class="well">
   
  <div class="row">

  <div class="col-md-2">
  <div class="form-group">
  <label>SUB OT</label>
  <input type="number" name="subot"  required="" class="form-control input-sm" min="1"  max="20" >
  </div>
  </div>

  <div class="col-md-2">
  <div class="form-group">
  <label>CANTIDAD</label>
  <input type="number" name="cantidad"  required="" step="any"  class="form-control input-sm" min="0">
  </div>
  </div>


  <div class="col-md-2">
  <div class="form-group">
  <label>ENTREGA</label>
  <input type="number" name="entrega"  required="" step="any"  class="form-control input-sm" min="0">
  </div>
  </div>

  <div class="col-md-2">
  <div class="form-group">
  <label>SALDO</label>
  <input type="number" name="saldo"  required="" step="any"  class="form-control input-sm" min="0">
  </div>
  </div>

  <div class="col-md-4">
  <div class="form-group">
  <label>FECHA INICIO</label>
  <input type="date" name="fechainicio"  required="" class="form-control input-sm" value="<?php echo $fechainicio; ?>">
  </div>
  </div>



   </div>

  <div class="row">

  <div class="col-md-3">
  <div class="form-group">
  <label>FECHA FIN</label>
  <input type="date" name="fechafin"  required="" class="form-control input-sm" >
  </div>
  </div>

  
  <div class="col-md-3">
  <div class="form-group">
  <label>NOTA DE INGRESO</label>
  <input type="text" name="nota_ingreso" class="form-control input-sm" required="" >
  </div>
  </div>

  <div class="col-md-3">
  <div class="form-group">
  <label>TIPO DE ENTREGA</label>
  <select name="tipo_entrega" class="form-control input-sm" required="">
  <option value="">[ Seleccionar ]</option>
  <option value="ENTREGA PARCIAL">ENTREGA PARCIAL</option>
  <option value="ENTREGA TOTAL">ENTREGA TOTAL</option>
  </select>
  </div>
  </div>

  <div class="col-md-3">
  <div class="form-group">
  <label>STATUS</label>
  <select name="status" class="form-control input-sm" required="">
  <option value="">[ Seleccionar ]</option>
  <option value="ANULADO">ANULADO</option>
  <option value="LIQUIDADO">LIQUIDADO</option>
  <option value="PROCESO">PROCESO</option>
  </select>
  </div>
  </div>

  

  </div>

  <div class="row">
  
  <div class="col-md-3">
  <div class="form-group">
  <label>TIPO DE OT</label>
  <select name="tipo_ot" class="form-control input-sm" required="">
  <option value="">[ Seleccionar ]</option>
  <option value="SERVICIO">SERVICIO</option>
  <option value="ENSAMBLE">ENSAMBLE</option>
  <option value="FABRICACIÓN">FABRICACIÓN</option>
  <option value="GARANTIA">GARANTIA</option>
  <option value="TRABAJO INTERNO">TRABAJO INTERNO</option>
  </select>
  </div>
  </div>

  <div class="col-md-3">
  <div class="form-group">
  <label>TIPO DE PROCESO</label>
  <select name="tipo_proceso" class="form-control input-sm" required="">
  <option value="">[ Seleccionar ]</option>
  <option value="FABRICACIÓN PARCIAL">FABRICACIÓN PARCIAL</option>
  <option value="MECANIZADO PARCIAL">MECANIZADO PARCIAL</option>
  <option value="MECANIZADO TOTAL">MECANIZADO TOTAL</option>
  </select>
  </div>
  </div>
  </div>

  <div class="row">
  <div class="col-md-12">
  <button class="btn btn-primary">Registrar Sub OT</button>
  </div>
  </div>


  </div>
</div>
  

 </form>


<?php else: ?>
  <p></p>
 <p class="alert alert-warning">No hay sub ot registradas.</p>
<?php endif ?>


<?php include('../../../templates/modal/gestion-ot/eliminar.php'); ?>

 <script>

 $( "#agregar" ).submit(function( event ) {
var parametros = $(this).serialize();
$.ajax({
  type: "POST",
  url: "../procesos/gestion-ot/actualizar.php",
  data: parametros,
   beforeSend: function(objeto){
    $("#mensaje").html("Mensaje: Cargando...");
    },
  success: function(datos){
  $("#mensaje").html(datos);//mostrar mensaje 
  $('#agregar').modal('hide'); // ocultar  formulario
  //$("#agregar")[0].reset();  //resetear inputs
  $('#editModal').modal('hide');  // ocultar modal
  //loadTabla(1);
  }
});
event.preventDefault();
});

$("#agregar-ni").submit(function(e){
e.preventDefault();
var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "../procesos/gestion-ot/agregar-por-ni.php",
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


 $("#actualizar").submit(function(e){
    e.preventDefault();
    var parametros = $(this).serialize();
     $.ajax({
          type: "POST",
          url: "../procesos/gestion-ot/agregar.php",
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




$('#dataDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id = button.data('id') // Extraer la información de atributos de datos
      var modal = $(this)
      modal.find('#id').val(id)
      $("body").removeAttr("style"); // remover todos los estilos
    })


$( "#eliminarDatos" ).submit(function( event ) {
    var parametros = $(this).serialize();
       $.ajax({
          type: "POST",
          url: "../procesos/gestion-ot/eliminar.php",
          data: parametros,
           beforeSend: function(objeto){
            $("#mensaje").html("Mensaje: Cargando...");
            },
          success: function(datos){
           $("#mensaje").html(datos);
         //$("#actualizar")[0].reset();  //resetear inputs
          $('#dataDelete').modal('hide'); //ocultar modal
          $('#editModal').modal('hide'); //ocultar modal
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          //loadTabla(1);
          }
      });
      event.preventDefault();
    });
</script>

 <?php else: ?>
 <p class="alert alert-warning">Aún no se ha registrado ingresos</p>
 <?php endif ?>