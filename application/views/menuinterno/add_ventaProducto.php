<style>
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

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
<?php  
$detPedID           = null;
$ordenPedidoID      = null;
$productoID         = null;
$bodSaldID          = null;
$detcantidad        = 0;
$detprecioNormal    = 0;
$detprecioEspecial  = 0;
$dettotal           = 0;
 if(isset($DetOrdenpedido)){
  $detPedID           = $DetOrdenpedido->detPedID;
  $ordenPedidoID      = $DetOrdenpedido->ordenPedidoID;
  $productoID         = $DetOrdenpedido->productoID;
  $bodSaldID          = $DetOrdenpedido->bodSaldID;
  $detcantidad        = $DetOrdenpedido->detcantidad;
  $detprecioNormal    = $DetOrdenpedido->detprecioNormal;
  $detprecioEspecial  = $DetOrdenpedido->detprecioEspecial;
  $dettotal           = $DetOrdenpedido->dettotal;
 }
?>
<!-- <div class="modal-overlay" id="addVentaProducto">
    <div class="modal">
      <div class="modal-header">
            <span>Mi Modal Responsivehgfhvhjvfhjhhg</span>
            <span class="close-btn" onclick="cerrarModal()">&times;</span>
        </div>  -->
     <div class="modal fade" id="addVentaProducto" name   ="addVentaProducto"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        
          <div class="modal-header text-center">
            <h5 class="modal-title text-center" id="exampleModalLabel">    Registrar Venta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> 
          <div class="modal-body">
            <form>
            <input type="hidden" class="form-control text-right" id="productoID"    name="productoID"   value ="<?php echo  $productoID   ;?>" readonly>
            <input type="hidden" class="form-control text-right" id="detPedID"      name="detPedID" value ="<?php echo  $detPedID  ;?>" readonly>
            <input type="hidden" class="form-control text-right" id="ordenPedidoID" name="ordenPedidoID" value ="<?php echo $ordenPedidoID  ;?>" readonly>
            <input type="hidden" class="form-control text-right" id="precioregular" name="precioregular" value ="">
            <input type="hidden" class="form-control text-right" id="totalVenta" name="totalVenta" value ="">
            <input type="hidden" class="form-control text-right" id="prodctucocina" name="prodctucocina" value ="">

             

            <div class="form-group text-center">
              <p id="prodDescripcion" style = "color:darkblue; font-weight:bold; font-size:20px;"> </p>
            </div>

            
              <div class="form-group">
                <input type="number" class="form-control text-right" id="cantidadVenta"  name="cantidadVenta"  value ="<?php echo  $detcantidad   ;?>" step="any">
              </div> 
                <div class="form-group">
                      <button type="button" id ="btn0" value ="0" class="btn btn-danger btnActionVenta " data-title ="Procesar venta" onclick="escribeCantidad(this)" >0</button>
                      <button type="button" id ="btn1"  value ="1"  class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="escribeCantidad(this)" >1</i></button>
                      <button type="button" id ="btn2" value ="2"  class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="escribeCantidad(this)" >2</i></button>
                      <button type="button"  id ="btn3"  value ="3" class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="escribeCantidad(this)" >3</button>
                      <button type="button" id ="btn4"  value ="4" class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="escribeCantidad(this)" >4</button>
                      <button type="button" id ="btn4" value ="5" class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="escribeCantidad(this)" >5</button>
                      <button type="button" id ="btn6"  value ="6" class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="escribeCantidad(this)" >6</button>
                      <button type="button" id ="btn7" value ="7" class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="escribeCantidad(this)" >7</i></button>
                      <button type="button" id ="btn8" value ="8" class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="escribeCantidad(this)" >8</i></button>
                      <button type="button" id ="btn9"  value ="9" class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="escribeCantidad(this)" >9</button>
                      <button type="button" id ="btnce" class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="limpiaCantidad()" >CE</i></button>
                      <button type="button" class="btn btn-danger btnActionVenta1" data-title ="Procesar venta" onclick="saveVentaProducto()">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                </div> 
            </form>
          </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-danger btnActionVenta" data-title ="Procesar venta" onclick="saveVentaProducto()" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
          
        </div> -->
    </div>  
  </div>
</div>
<script>
  $(document).ready(function(){
    const txtCantidad = (document.getElementById("cantidadVenta"))  ?  document.getElementById("cantidadVenta").value :0;

/*txtCantidad.addEventListener("blur", function(){
      console.log("El control Esta cambiando ") ;
      calculartotalVenta();
    })*/

  });

</script>

<script>
  $(document).ready(function(){
    const btn0 = document.getElementById("btn0").value;
    const btn1 = document.getElementById("btn0").value;


    /*txtCantidad.addEventListener("blur", function(){
      console.log("El control Esta cambiando ") ;
      calculartotalVenta();

    })*/

  });

</script>



