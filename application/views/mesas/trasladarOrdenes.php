

<div class="card text-center">
  <div class="card-header" style="background-color:#243458; color:white; font-weight:bold; text-align: center;">
    <h5 class="card-title"  style=" color:white; font-weight:bold; text-align: center;">TRASLADO DE ORDENES</h5>
  </div>
    <div class="card-body">
     <div class="row">   
        <div class="col-6">
             <h5 class="card-title" style="font-weight:bold; ">Mesas con ordenes:</h5>
              <br>
             <select class="form-control" name="MesasConOrdenes" id="MesasConOrdenes" style ="text-align: left;">
               
            <option value="0">Seleccione mesa origen</option>
            <?php  foreach( $MesasUtilizadas as  $row): ?>
                <option value="<?php  echo  $row->mesaID ?>"> <?php echo  $row->mesNombre;  ?></option>
        <?php endforeach; ?>
             </select> 
        </div>     
        <div class="col-6">
             <h5 class="card-title" style="font-weight:bold; ">Mesas Disponibles:</h5> 
             <br>
              <select  class="form-control" name="MesasDisponibles" id="MesasDisponibles" style ="text-align: left;">
             <option value="0">Seleccione mesa destino</option>
             <?php  foreach( $MesasDisponibles as  $row): ?>
                <option value="<?php  echo  $row->mesaID ?>"> <?php echo  $row->mesNombre;  ?></option>
        <?php endforeach; ?>
             </select> 
        </div>
    </div>
  </div>
  <div class="card-footer text-muted">
  <button type="button" class="form-control"  style=" color:#243458; font-weight:bold; "  onclick="ProcesarTraslado();">Traladar ordenes <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $("#MesasConOrdenes").select2({
        theme: 'bootstrap4',
        placeholder: "Select mesa Origen",
        allowClear: true,
        width: 'resolve',
    });

     $("#MesasDisponibles").select2({
        theme: 'bootstrap4',
        placeholder: "Select mesa destino",
        allowClear: true,
        width: 'resolve',
    });
	
	
});
  </script>



 

  
