<style>
  loader-background {
    width: 100%;
    height: 100%;
    position: relative; /* Cambiamos de absolute a relative */
    background-color: #eaeaea4a;
    z-index: 9999;
}
.loader {
  width: 550px;
  height: 20px;
  left: 0;
  bottom: 0; 
  right: 0; 
  top: 0; 
  margin: auto;
  background:
   linear-gradient(#3498db 0 0) 0/0% no-repeat
   #ddd;
  animation: l1 2s infinite linear;
}
@keyframes l1 {
    100% {background-size:100%}
}


.loader2{
  border: 16px solid #d4d4d4;
  border-top: 16px solid #3498db;
  border-bottom: 16px solid #3498db;
  border-radius: 50%;
  width: 150px;
  height: 150px;
  animation: spin 1.5s linear infinite;
  position: absolute; /* cambiamos de fixed a absolute */
  /* Ponemos el valor de left, bottom, right y top en 0 */
  left: 0;
  bottom: 0; 
  right: 0; 
  top: 0; 
  margin: auto; /* Centramos vertical y horizontalmente */
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Positon the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
<?php 
  $productoID      = 0;
  $prodDescripcion = '';
  $prodClasfInvent = 0;
  $famProdID       = 0;
  $presProdID      = 0;
  $tipProdID       = 0;
  $marcProdID      = 0;
  $medProdID       = 0;
  $proveedorID     = 0;
  $idtmp           = '';
  $tipocomprobante = 0;
  $proveedorID     = 0;
  $unidadesPresenta= 0;

  
  if(isset($datoproducto)){

  }
  if(isset($datosProvedor)){
    //ECHO 'ELEMENTO  ENCONTRADO';
     // var_dump($datosProvedor);
    $tipocomprobante =$datosProvedor['tipocomprobante'];
    $proveedorID     =$datosProvedor['proveedorID'];
  }

  //echo   'DATOS CAPTURADOEN LA VIST PARA AGREGAR PRODUCTO '  . $tipocomprobante . 'PROVBEDOR'.  $proveedorID  .  '<BR>';  

  if(isset($compraResultID)){
    $compraProdID = $compraResultID; 
  }



  ?>

<!-- <div class="loader-background">
  <div class="loader"></div>
</div>-->

<div class="loader"></div>

<div class="modal fade" id="adddetProducCompra" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" id="exampleModalLabel">    Agrear producto a factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  metod="POST"  id ="formAddProducCompra" class="formAddProducCompra" action="javascript:saveDetCompra()">
        
        <input type="hidden"   id="unidadespresentacion"  name="unidadespresentacion"      value =  "<?php echo $unidadesPresenta; ?>"> 
        <input type="text"   id="compraProdID"  name="compraProdID"      value =  "<?php echo $compraProdID; ?>"> 
       
        

        <input type="hidden"  id="tipocomprobante"  name="tipocomprobante" value = "<?php  echo  $tipocomprobante?> "> <!-- si el producto es gravado o excento  -->
        <input type="hidden"  id="proveedorID"  name="proveedorID" value = "<?php echo $proveedorID?> "> <!-- si es un producto o  servicio como tal  -->

        <!-- <input type="text"  id="tipomovinvtId"  name="tipomovinvtId" > --><!-- si el producto es gravado o excento  -->
        <!-- <input type="text"  id="presentacion_invId"  name="presentacion_invId" > --> <!-- si es un producto o  servicio como tal  -->
        <!--<input type="text"  id="presentacion_invId"  name="presentacion_invId" > --><!-- si es un producto o  servicio como tal  -->

        <!-- <input type="text"  id="tipocomprobante_IMPUTC"  name="tipocomprobante_IMPUTC" >-->
            
       
        <div class="form-group col-sm">
            <label for="producto" class="col-form-label">Producto:</label>
            <select name="producto" id="producto"  class="form-control chosen"> 
            <option value="0"> Selecccione un producto</option>              
                 <?php foreach ($ListProducto as $row): ?>
                    <option value="<?php echo $row->productoID; ?>">
                    <?php echo $row->productoID . " - " .  $row->prodDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
        </div>
        <div class="col-sm" style="display: inline-block;">
              <label for="prodPresentacion">Presentacion</label>              

              <select name="prodPresentacion" id="prodPresentacion"  class="form-control chosen"  onchange="javaScript:getunidadPresentacion()">                                  
                <option value="0">Seleccione una presentacion</option>                                 
                    <?php foreach ($prodPresentacion as $row): ?>
                    <option value="<?php echo $row->presProdID; ?>">
                    <?php echo $row->presProdID . " - " .  $row->presentacionProd; ?>
                    </option>
                    <?php endforeach ?>
                                
                    </select>      
          </div> 

       

        <div class="form-group col-sm">
            <label for="familia" class="col-form-label">Cantidad:</label>
            <input type="number" class="form-control text-right" id="cantidad"  name="cantidad" step ="any">            
        </div>

        <div class="form-group col-sm">
            <label for="tipProducto" class="col-form-label">Precio costo por unidad:</label> 
            <input type="number" class="form-control text-right" id="preCosto" name="preCosto" step ="any" >  
        </div>
        <div class="mb-3 text-right">
           <!-- <input type="submit" value="Procesar">  <i class="fa fa-cog" aria-hidden="true"></i></button>-->
           <button  type="submit" id ="btnsavedet" name="btnsavedet"  class="btn btn-lg btn-danger"  style="background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px;" title="Procesar compra" onclick="">  <i class="fa fa-cog" aria-hidden="true"></i></button>
          
        </div>
          

        </form>
      </div>
      
    </div>
  </div>
</div>
<script> 
    function base_url(url){
          return window.location.origin + "/BartioFran/"+ url;
      }
 </script>
<script>
    $(document).ready(function() {
            $("#producto").on("change", function(event) {
                var url_destino = "index.php/CompraProducto_Controller/get_InfoProducto/"; 
                var combo       = document.getElementById("producto");
                var productoID  = this.value;
                var selected    = combo.options[combo.selectedIndex].text;
                console.log("cambiando  la dscripcion del producto" +  selected  + "El id del producto seleccionado es " + productoID );
                $("#nameproductotmp").val(selected);
                 
                $.ajax({
                          url: base_url(url_destino),
                          type: 'POST',
                          data: {'productoID': productoID},
                           dataType:'JSON',
                          beforeSend: function(){
                            console.log("Cargando busqueda en el servidor")                           
                           // data[0]['provDescripcion']
                          }, 
                          success: function(data){
                            $("#tipomovinvtId").val(data[0]['tipomovinvtId']);
                            $("#tipomovinvtId").change();
                            
                            $("#presentacion_invId").val(data[0]['presentacion_invId']);
                            $("#presentacion_invId").change();
                          }
                      });              
            }); 
        });

</script>

<script type="text/javascript">
$(document).ready(function() {

    $("#producto").select2({
        theme: 'bootstrap4',
        placeholder: "Select producto",
        allowClear: true,
        width: 'resolve',
    });
	
});
  </script>
