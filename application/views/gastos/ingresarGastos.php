<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class ="padre">
    <div class ="allDevice">
        <div class="card">
            <div class="card-header bg-danger">
              INGRESAR GASTOS 
            </div>
            <div>
                
            </div>
            <div  class="card-body">
                <form  method="POST" id  = "FormGastos" class = "FormGastos">
                    <input type="hidden"   id="gastosID" name="gastosID">
                    <input type="hidden"   id="cerrado" name="cerrado">
                    <div class="row">
                        <div class="col-sm" style="display: inline-block;">
                          <label for="producto"> Fecha deingreso de gastos</label>
                          <input type="date"   class="form-control"  id ="fechaGasto" name = "fechaGasto"  style="border-radius: 20px;">                           
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-sm" style="display: inline-block;">
                            <label for="sucursalGasto">Sucursal</label>

                            <select name="sucursalGasto" id="sucursalGasto"  class="form-control chosen" style="border-radius: 20px;">  
                             <option value = "0"> Seleccione una sucrusal</option>
                             <?php foreach( $listaSucursales as  $row): ?>
                                <option  value="<?php echo $row->establecimientoID; ?>"> <?php echo  $row->estNombre   ?> </option>
                             
                                   
                              <?php endforeach ?>      
                               
                            </select>      
                        </div>           

                    </div>
                    <br>
                    <br>                    

               
                    </form>     
            </div>
            <div class="card-footer text-muted text-right">
            <!-- <button type="submit" class="btn btn-lg btn-outline-danger" title="Cancelar"> <i class="fa fa-chevron-left" aria-hidden="true"></i> </button> -->
            <button type="submit" class="btn btn-lg btn-outline-danger" title="Ingresear detalle de gastos" onclick="javaScript:guardarGastos()"> <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
              
            </div>
            
           
        </div>
    </div>
    </div>
    
</body>
</html>
<script>
$("#document").ready(function(){
    $("#sucursalGasto").select2({       
            theme: 'bootstrap4',
            placeholder: "Select sucursal",
            width: 'resolve',
            "searching"    : true,
    });
});

</script>