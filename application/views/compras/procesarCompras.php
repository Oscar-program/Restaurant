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
     /* window.addEventListener("unload", (event) => {
        console.log("I am the 3rd one.");
      });*/
    </script>
    <script>

  //   $('#listDetGastos').stacktable();
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

$('#detallecompra').stacktable();
    </script>
   
</head>
<?php  $compraProdID =   0;?>

<body>


<div class="row">
    <div class="col-12">
        <div class="card mt-3 tab-card">
            <div class="card-header tab-card-header ">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true" onclick="verificaTabCompras(this.id)">Ingreso de compras</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false" onclick="verificaTabCompras(this.id)">Compras procesadas</a> </li>
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
                                    <div class="row mt-2" style="width: 100%;">  
                                            <div class="col-lg-12">
                                                <form id = "FormCompras" class = "FormCompras"  method="post"  >
                                                    <input type="hidden"   id="compraProdID" name="compraProdID" value="<?php echo $compraProdID ;?>">
                                                    <!-- <input type="text"   id="clasfiscalID" name="clasfiscalID">--> <!-- gravado , excento  o tasa cerp -->
                                                    <!--<input type="text"   id="tipoContribID" name="tipoContribID">-->  <!-- pequeño , mediano  o gran contribuyente -->
                                                
                                                    <div class="mb-3">
                                                        <input type="date"   class="form-control"  id ="fechaCompra" name = "fechaCompra"   required>                                                    
                                                    
                                                    </div>                                                
                                                    <div class="mb-3"> 
                                                        <select name="tipocomprobante" id="tipocomprobante"  class="form-control chosen" required>  
                                                            <option value = "0">Select tipo comprobante</option>
                                                            <option value = "1">Consumidor final</option>
                                                            <option value = "2">Credito fiscal</option>
                                                            <option value = "3">Sin comprobante</option>
                                                        </select>     
                                                    </div>
                                                    <div class="mb-3">
                                                        <input class="form-control text-end" type="text"   class="form-control"  id ="numcomprobante" name = "numcomprobante"    placeholder="845755" >                                                    
                                                    
                                                    </div> 
                                                    <div class="mb-3"> 
                                                        <select name="proveedor" id="proveedor"  class="form-control chosen" required >  
                                                            <option value = "0">Select proveedor</option>
                                                            <?php foreach( $proveedores as  $row): ?>
                                                                <option  value="<?php echo $row->proveedorID; ?>"> <?php echo  $row->provDescripcion   ?> </option>
                                                            <?php endforeach; ?>           
                                                            
                                                        </select>     
                                                    </div>
                                                    <div class="mb-3">                                                   
                                                        <input type="number" class="form-control text-right" id="gravadas"  name="gravadas" step ="any" placeholder="Gravadas $100.00"  readonly style="text-align: right; width:100%;">            
                                                    </div>
                                                    <div class="mb-3">                                                   
                                                        <input type="number" class="form-control text-right" id="nosujetas"  name="nosujetas" step ="any" placeholder="No Sujetas $100.00"  readonly style="text-align: right; width:100%;" >            
                                                    </div>

                                                    <div class="mb-3">                                                   
                                                        <input type="number" class="form-control text-right" id="excentas"  name="excentas" step ="any" placeholder="Excentas $100.00"  readonly style="text-align: right; width:100%;">            
                                                    </div>

                                                    <div class="mb-3" style="text-align: right;">                                                   
                                                        <input type="number" class="form-control text-right" id="compProdIva" name="compProdIva" step ="any" placeholder="Iva $10.13" readonly   style="text-align: right; width:100%;" >  
                                                    </div>
                                                    <div class="mb-3">                                                   
                                                        <input type="number" class="form-control text-right" id="compProdTotal" name="compProdTotal" step ="any" placeholder="Total $110.13" readonly style="text-align: right; width:100%;">  
                                                    </div>
                                                <!--  <div>
                                                    <input type="checkbox" class="form-control" id="tipocompra"  name="tipocompra"  value="1">
                                                    <label for="tipocompra">Coding12</label>

                                                        <input type="checkbox" class="form-control"  id="tipocompra"  name="tipocompra"  value="2">
                                                        <label for="tipocompra">Coding</label>

                                                    </div> -->
                                                    
                                                    
                                                </form>  
                                                <div class="mb-3 text-right">
                                                    <button  id ="btnSaveCompra" name="btnSaveCompra"  class="btn btn-lg btn-primary"  style="background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px;"  title="Procesar compra" onclick="saveCompraproducto()">  <i class="fa fa-database" aria-hidden="true"></i> Guardar compra </button>
                                                    <!-- <button id ="btnSaveCompra" name="btnSaveCompra"  class="btn btn-lg btn-primary"  style="background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px;"  title="Procesar compra" onclick="saveCompraproducto()">  <i class="fa fa-database" aria-hidden="true"></i> Guardar compra </button> -->
                                                    <button id ="btnVerModalDetComp" name="btnVerModalDetComp"  class="btn btn-lg btn-primary" style="background-color: #5DADE2; border-color:aliceblue; border-width:1px;" title="Ingresar detalle de compra" onclick="addDetCompra()">  <i class="fa fa-plus" aria-hidden="true"></i></button>
                                                    
                                                </div>
                                                

                                                

                                            </div>
                                    </div>
                                    
                                </div>
                            <!-- DIV PARA MOSTRA DETALLE DE INGRESO AL MOMENTO DE  INGRESARLO -->
                            <div id= "detallecompra" class="col-lg-6">                              
                                 <table  class="table table-hover" style="border-width: 1px; border-color:#5DADE2 ;" >
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Cantidad</th>
                                                <th>Descripcion</th>
                                                <th>P. unit</th>
                                                <th>iva</th>
                                                <th>Total</th>
                                                <th>Accciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="detCompra" > 
                                        </tbody>  
                                    </table> 
                                    <div class="mb-3 text-right">
                                          
                                                 
                                    </div>

                                <!-- </div>    -->
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                    <div class="container-fluid m-top">
                          <div class="container-fluid m-top" style="text-align: center;">                          
                             <h4 style="text-align: center;">COMPRAS PROCESADAS</h4>
                               
                         </div>
                         <br>
                        <div class="row">
                            <div class="container-fluid m-top">
                                <div class="row">
                                    <div class="col-md" style="width: 50%;"> <h3>Buscar por Fechas:</h3> </div>

                                     <div class="col-md">
                                        <input type="date" class="form-control" name="fechaIni" id="fechaIni" style="border-radius: 15px;">
                                     </div>

                                      <div class="col-md"><input type="date"  class="form-control" name="fechaFin" id="fechaFin" style="border-radius: 15px;"></div>
                                       <div class="col-md"> <input type="button"  class="form-control"  id  ="btnguardar"  name  ="btnguardar" value="Buscar" style ="background-color: #5DADE2; width:30%;color:aliceblue; font-weight:bold;"></div>

                                </div>
                            </div>
                            <div id= "listaCompras" class="col-lg-12">
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
     </div>
</div>
<div id = "conteModalDetCompra"></div>
</body>
 
 </html> 
 <script> 
    function base_url(url){
    return window.location.origin + "/BartioFran/"+ url;
}
 </script>
 <!-- segmento para  encontrar los datos del proveedor-->
 <script>
    $(document).ready(function(){
       $("#proveedor").on( 'change', function(){
          var proveedorId = (parseInt(this.value) !=0) ? this.value: 0  ;

          console.log("buscando la informacion del proveedor ");
          var url_destino = "index.php/CompraProducto_Controller/getInfoProveedor/";           
         $.ajax({
            url  : base_url(url_destino), 
            type : 'POST', 
            data : {'proveedorID':proveedorId},           
            dataType: 'JSON',
            beforeSend: function(){
      
            },
            success: function(response){
                       console.log(response);
                       if(response != null){
                       // length
                         $("#clasfiscalID").val(response[0]['clasfiscalID']);
                        $("#clasfiscalID").change();
                        $("#tipoContribID").val(response[0]['tipoContribID']);
                        $("#tipoContribID").change();
                       }else{
                          console.log("no se encontraron datos de retorno");
                       }
                    
            },complete: function(){

            }
         }
         );
          console.log("Solicitando la informacion general del proveedor"+ proveedorId  + " infor" );

       })
    });
   
 </script> 
 <!-- -->
  <script>
   // Esperar a que el DOM esté cargado
   $('input[name=tipocompra]').change(function() {
        if ($(this).is(':checked')) {
            var  valor = this.value;    
        } 
        if(valor== 2){
            console.log("el valor del  chexbox es  " + valor );
        }
    
    });
  </script>
<!-- SEGMENTO PARA  RETORNAR LA INFORMACION DEL PRODUCTO -->
<script>
    $(document).ready(function()
    {
        // CREAMOS EL ELVENTO CHANGE DEL SELECT DEL PRODUCTO  
        ("#")
    });
</script>

<script> 

    /*window.addEventListener("unload", function(event) { 
        console.log("El usuario a avandonado la pagina")

    });*/
</script>

<!-- Funcion que escucha el evento click del  mouse  -->
<script>
const button  =  document.querySelector("#btnguardar");
button.addEventListener("click", () =>{  
   if( $("#fechaIni").val().length >0 && $("#fechaFin").val().length >0  ){
    get_ListCompras();
   } else{
     swal("Tiene que ingresar fechas como parametros de búsqueda.",{
          icon: "warning",
        });
   }
    
    
});
</script>

