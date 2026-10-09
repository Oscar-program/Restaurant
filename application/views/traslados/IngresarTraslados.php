<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
    <script>
      window.addEventListener("beforeunload", (event) => {
        console.log("a punto de avandonar la pagina.");
      });    
    </script>
    <script>

     $('#listDetGastos').stacktable();
</script>



<style>       
          
        #cantidadgasto::placeholder {
            text-align: start;
        }
        
        #preciogasto::placeholder{
           text-align: start;
        }

        /*#password::placeholder{
          color: white;
        }

        #Rpassword::placeholder{
          color: white;
        }*/
       
    </style>
    <script>

$('#DeGastos').stacktable();
    </script>
   
</head>

<body>


<div class="row">
    <div class="col-12">
        <div class="card mt-3 tab-card">
            <div class="card-header tab-card-header ">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true" onclick="verificatabgasto(this.id)">Ingresar Traslados</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false" onclick="verificatabgasto(this.id)">Traslados procesados</a> </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">                   
                    <div class="container-fluid m-top">
                        <div class="row">
                            <!-- DIV PARA INGRESO DE  GASTOS -->
                            <div class="col-lg-6" >
                                <div>
                               <!-- <button id ="btnSalir" name="btnSalir" class="btn btn-lg btn-danger" title="Abandonar toma de gastos">Abandonar  <i class="fa fa-sign-out" aria-hidden="true"></i></button> -->
                                </div>
                                <dIv class="row mt-2">  
                                        <div class="col-lg-8">
                                            <form id = "FormTraslados" name ='FormTraslados' class = "FormTraslados" action="javaScript:saveTraslado()" method="post">
                                                <input type="hidden"   id="trasProdID" name="trasProdID">
                                                <input type="hidden"   id="cerrado" name="cerrado">
                                                <div class="mb-3">
                                                <input type="date"   class="form-control"  id ="fechatraslado" name = "fechatraslado"   required> 
                                                </div>                                                
                                                <div class="mb-3">                                              
                                                    <select name="bodOrigen" id="bodOrigen"  class="form-control chosen" required >  
                                                        <option value ="0">Seleccione la bodega de origen</option>                                
                                                        <?php foreach ($listBodegaProducto as $row): ?>
                                                            <option value="<?php echo $row->bodegaProductoID; ?>">
                                                            <?php echo $row->bodegaProductoID . " - " .  $row->bodProdDescripcion; ?>
                                                            </option>
                                                        <?php endforeach ?>
                                                                
                                                    </select> 
                                                </div>
                                                <div class="mb-3">                                              
                                                    <select name="bodDestino" id="bodDestino"  class="form-control chosen" required>  
                                                        <option value ="0">Seleccione la bodega de destino</option>                                
                                                        <?php foreach ($listBodegaProducto as $row): ?>
                                                            <option value="<?php echo $row->bodegaProductoID; ?>">
                                                            <?php echo $row->bodegaProductoID . " - " .  $row->bodProdDescripcion; ?>
                                                            </option>
                                                        <?php endforeach ?>
                                                                
                                                    </select> 
                                                </div>
                                                
                                                    <div class="mb-3">
                                                            <select name="producto" id="producto"  class="form-control chosen" required>  
                                                                <option>Seleccione un producto</option>                                
                                                            <?php foreach ($listaProductos as $row): ?>
                                                                <option value="<?php echo $row->productoID; ?>">
                                                                <?php echo $row->productoID . " - " .  $row->prodDescripcion; ?>
                                                                </option>
                                                            <?php endforeach ?>
                                                                        
                                                            </select>      
                                                    </div>                                                                                             
               
                                               
                                                    <div class="mb-3">                                                                                                               
                                                            <select name="prodPresentacion" id="prodPresentacion"  class="form-control chosen"  onchange="javaScript:getunidadPresentacion()" required>                                  
                                                            <option value="0">Seleccione una presentacion</option>                                 
                                                                <?php foreach ($prodPresentacion as $row): ?>
                                                                    <option value="<?php echo $row->presProdID; ?>">
                                                                    <?php echo $row->presProdID . " - " .  $row->presentacionProd; ?>
                                                                    </option>
                                                                    <?php endforeach ?>
                                                                                
                                                                    </select>      
                                                    </div>           

                                               
                                               
                                                    <div class="mb-3">
                                                        <input type="hidden"   class="form-control "  id ="existenciaprod" name = "existenciaprod" step="any" placeholder="Ingrese la cantidad a trasladar">                           
                                                    </div>

                                                    <div class="mb-3">
                                                       <input type="number"   class="form-control "  id ="cantidadTrasl" name = "cantidadTrasl" onchange="javaScript:activaBoton();" step="any" placeholder="Ingrese la cantidad a trasladar" required>                           
                                                    </div>

                                                    <div class="mb-3">
                                                   
                                                   <input type="number"   class="form-control "  id ="cantidadProd" name = "cantidadProd" step="any" placeholder="Ingrese la cantidad a trasladar" required>                           
                                                   </div>
                                                   <div class="mb-3 text-right">
                                                      <button id ="btnsavetraslado" name="btnsavetraslado" type="submit" class="btn btn-lg btn-danger" title="Iniciar toma">  <i class="fa fa-plus" aria-hidden="true"></i></button>
                                                    
                                                  </div>
                                                             

                                                                    
                                                    

                                             


                                               <!-- <div class="mb-3">                                                  
                                                    <button id="btnguardar" name="btnguardar" type="submit"  class="form-control btn-primary "><i class="fa fa-save" aria-hidden="true"></i>  Guardar</button>
                                                   
                                                </div>
                                                <div class="mb-3"> 
                                                  
                                                   
                                                    <button id="btncerrargasto" name="btncerrargasto" class="form-control btn-danger" onclick="cerrarGastos()"><i class="fa fa-close" aria-hidden="true"></i>  Cerrar gastos</button>
                                                </div> -->
                                                
                                            </form>    
                                        </div>

                                        <div class="col-lg-4"> 
                                        <button id="btnsearch" name="btnsearch"  class="btn btn-md  btn-primary "  onclick="searGastos();"><i class="fa fa-search" aria-hidden="true"></i></button>
                                           
                                         </div>
                                     
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <form  action="javaScript:guardarDetGastos()" method="POST" id  = "FormDetGastos" class = "FormDetGastos">  
                                        <input type="hidden"   id="gastosIDdet" name="gastosIDdet">
                                        <input type="hidden"  id ="detgastosID" name ="detgastosID">
                                        <!-- <input type="hidden"  id ="IdGasto" name ="IdGasto"> -->

                                        <input type="hidden"   id="cerrado"  name="cerrado"> 
                                            
                                            <div class="mb-3 text-right">
                                              <!--  <button id ="btnsavedet" name="btnsavedet" type="submit" class="btn btn-lg btn-danger" title="Iniciar toma">  <i class="fa fa-plus" aria-hidden="true"></i></button>-->
                                                  <!--   <input type="submit"   class="form-control" value="Guardar"> -->
                                                </div>

                                        </form>     
                                    </div> 
                                </div>
                                
                            </div>
                            <!-- DIV PARA MOSTRA DETALLE DE INGRESO AL MOMENTO DE  INGRESARLO -->
                            <div id= "mostrarTabla" class="col-lg-6">
                               <!--  <div class="row mt-2"> -->
                             

                                 <table  class="table table-hover" style="border-width: 0px;" >
                                        <thead>
                                            <tr>
                                                <th>#</th> 
                                                <th>Descripcion</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Total</th>
                                                <th>Accciones</th>
                                            </tr>
                                        </thead>
                                        <tbody > 
                                        </tbody>  
                                    </table> 
                                    <div class="mb-3">                                
                                       <button id="btnguardartras" name="btnguardartras" type="submit"  class="form-control btn-primary "><i class="fa fa-save" aria-hidden="true"></i>  Guardar</button>
                                     
                                                
                                    </div>

                                <!-- </div>    -->
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                    <div class="container-fluid m-top">
                        <div class="row">
                            <h1>Lista General de gastos</h1>
                        </div>
                        <div class="row">
                        <div id= "listaGastos" class="col-lg-12">
                                 <table  class="table table-hover" style="border-width: 0px;" >
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Fecha</th>
                                                <th>Establecimiento</th>
                                                <th>unidades</th>
                                                <th>Total</th>                                                                                                
                                                <th style="text-align: right;">Accciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id ="cuerpolistagastos"> 

                                        </tbody>  
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
     </div>
</div>
</body>
 
 </html> 
 <script>
    $(document).ready(function(){
        $("#sucursalGasto").on('change', function(){
            //console.log(this.value);
            $("#btnguardar").css("display", "block");
        });
    });    
 </script> 

<script>
    $(document).ready(function()
    {
        $("#descripcionDetGast").on('change', function(){
                //console.log(this.value);
                if($(this).val().length > 0) {
                    document.getElementById('btnsavedet').disabled = false;
                }else{
                    document.getElementById('btnsavedet').disabled = true;
                }
            });
    });
</script>

<script> 

    window.addEventListener("unload", function(event) { 
        console.log("El usuario a avandonado la pagina")

    });
</script>
