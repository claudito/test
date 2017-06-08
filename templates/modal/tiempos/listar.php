<?php

include "../../../autoload.php";
include "../../../session.php";

$tiempos     = new Tiempos();
$funciones   = new Funciones();

$fechainicio =  $_SESSION['fechainicio_tiempos'];
$fechafin    =  $_SESSION['fechafin_tiempos'];
$anio        =  $_SESSION['anio_tiempos']; 
$mes         =  $_SESSION['mes_tiempos'];

?>

<?php if (count($tiempos->lista($fechainicio,$fechafin,$anio,$mes))>0): ?>
 <div class="panel panel-default">
   <div class="panel-heading">
     <h3 class="panel-title">TIEMPOS</h3>
   </div>
   <div class="panel-body">
  <div class="table-responsive">
    <table id="consulta"  class="table table-bordered table-hover">
      <thead>
        <tr class="active"> 
          <th>FECHA DE TRABAJO</th>
          <th>FECHA DE PRODUCCIÓN</th>
          <th>USUARIO</th>
          <th>MÁQUINA</th>
          <th>HORA INICIO</th>
          <th>HORA FIN</th>
          <th>HORAS HOMBRE</th>
          <th>OT</th>
          <th>CANTIDAD</th>
          <th>TURNO</th>
          <th>CLASIFICACIÓN</th>
          <th>PROCESOS</th>
          <th>MÁQUINA</th>
          <th>FACTURABLE</th>
          <th>PRODUCTIVO</th>
          <th>COSTO HH</th>
          <th>COSTO MO</th>
          <th>COSTO HMQ REAL</th>
          <th>COSTO MO REAL</th>
          <th>COSTO HMQ COMERCIAL</th>
          <th>COSTO MO COMERCIAL</th>
        </tr>
      </thead>
      <tbody>
       <?php foreach ($tiempos->lista($fechainicio,$fechafin,$anio,$mes) as $key => $value): ?>
         <tr>
           <td>
          <a data-id="<?php echo $value['ID'];?>"  class="btn-edit">
          <?php echo date_format(date_create($value['FECHA_DE_TRABAJO']), 'd/m/Y');?>
          </a>
          </td>
          <td><?php echo date_format(date_create($value['FECHA_DE_PRODUCCION']), 'd/m/Y');?></td>
          <td><?php echo utf8_encode($value['USUARIO_MAQUINA']); ?></td>
          <td><?php echo utf8_encode($value['MAQUINA']); ?></td>
          <td><?php echo date_format(date_create($value['HORA_DE_INICIO']), 'H:i');?></td>
          <td><?php echo date_format(date_create($value['HORA_DE_FIN']), 'H:i');?></td>
          <td><?php echo round($value['HORAS_HOMBRE'],2); ?></td>
          <td><?php echo utf8_encode($value['OT']); ?></td>
          <td><?php echo round($value['CANTIDAD_OT'],2); ?></td>
          <td><?php echo utf8_encode($value['TURNO']); ?></td>
          <td><?php echo utf8_encode($value['CLASIFICACION']); ?></td>
          <td><?php echo utf8_encode($value['PROCESO']); ?></td>
          <td><?php echo utf8_encode($value['MAQUINA']); ?></td>
          <td>
          <?php 
          switch ($value['PROCESO_FACTURABLE']) {
          case 'SI':
          echo 'FACTURABLE';
          break;
          case 'NO':
          echo 'NO FACTURABLE';
          break;
          default:
          echo '';
          break;
           } 
           ?>  
          </td>
          <td>
          <?php 
          switch ($value['PROCESO_PRODUCTIVO']) {
          case 'SI':
          echo 'PRODUCTIVO';
          break;
          case 'NO':
          echo 'NO PRODUCTIVO';
          break;
          default:
          echo '';
          break;
           } 
           ?>  
          </td>
          <td><?php echo round($value['COSTO_HH'],2); ?></td>
          <td><?php echo round($value['COSTO_MO'],2); ?></td>
          <td><?php echo round($value['COSTO_HMQ_REAL'],2); ?></td>
          <td><?php echo round($value['COSTO_MQ_REAL'],2); ?></td>
          <td><?php echo round($value['COSTO_HMQ_COMERCIAL'],2); ?></td>
          <td><?php echo round($value['COSTO_MQ_COMERCIAL'],2); ?></td>
        </tr>
       <?php endforeach ?>
      </tbody>
    </table>
  </div>
   </div>
 </div>
<?php else: ?>
   <p class="alert alert-warning">No hay resultados</p>
<?php endif ?>


<!-- Modal -->
  <script>
    $(".btn-edit").click(function(){
      id   = $(this).data("id");
      $.get("../../templates/modal/tiempos/actualizar.php","id="+id,function(data){
        $("#form-edit").html(data);
      });
      $('#editModal').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
    
        <div class="modal-body">
        <div id="form-edit"></div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->




   <script>
 $(document).ready(function(){
    $('#consulta').DataTable();
});
 </script>
