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

/*para checknox  */
.switch-container{
    display:inline-flex;
    align-items:center;
    cursor:pointer;
    user-select:none;
    font-family:Arial, Helvetica, sans-serif;
    font-size:22px;
    color:#444;
}

.switch-container input{
    display:none;
}

/* Fondo del switch */
.slider{
    position:relative;
    width:42px;
    height:22px;
    background:#d8d8d8;
    border-radius:30px;
    transition:.3s;
    margin-right:10px;
}

/* Botón */
.slider::before{
    content:"";
    position:absolute;
    width:16px;
    height:16px;
    left:3px;
    top:3px;
    background:#ffffff;
    border-radius:50%;
    box-shadow:0 1px 3px rgba(0,0,0,.35);
    transition:.3s;
}

/* Cuando está activado */
.switch-container input:checked + .slider{
    background:#0d6efd;
}

.switch-container input:checked + .slider::before{
    transform:translateX(20px);
}

.texto{
    margin-left:2px;
} 


</style>
<?php 
  $productoID      = NULL;
  $prodDescripcion = '';
  $prodClasfInvent = 0;
  $famProdID       = 0;
  $presProdID      = 0;
  $tipProdID       = 0;
  $marcProdID      = 0;
  $medProdID       = 0;
  $proveedorID     = 0;
  $presentacion_invId = 0;
  $tipomovinvtId      = 0;
  $productcocinadb   = 0; 

  if(isset($datoproducto)){ 
    if(!empty($datoproducto)){
      echo 'setiendo datos del  producto';
      $productoID         = $datoproducto->productoID;
      $prodDescripcion    = $datoproducto->prodDescripcion;
      $prodClasfInvent    = $datoproducto->prodClasfInvent;
      $famProdID          = $datoproducto->famProdID;
      $presProdID         = $datoproducto->presProdID;
      $tipProdID          = $datoproducto->tipProdID;
      $marcProdID         = $datoproducto->marcProdID;
      $medProdID          = $datoproducto->medProdID;
      $proveedorID        = $datoproducto->proveedorID;
      $presentacion_invId = $datoproducto->presentacion_invId;
      $tipomovinvtId      = $datoproducto->tipomovinvtId;
      $productcocinadb    = $datoproducto->prodctucocina;
    }

  }
  
  

  ?>
<div class="modal fade" id="addProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-center" id="exampleModalLabel">    Registrar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  metod="POST"  id ="formAddProducto" class="formAddProducto" action="javascript:saveProducto()">
        <input type="hidden"  id="productoID"      name="productoID"      value =  "<?php echo $productoID; ?>">
        <input type="hidden"  id="prodDescripcion" name="prodDescripcion" value =  "<?php echo $prodDescripcion; ?>">
        <input type="hidden"  id="prodClasfInvent" name="prodClasfInvent" value =  " <?php echo $prodClasfInvent;?>">
        <input type="hidden"  id="famProdID"       name="famProdID"       value =  "<?php echo $famProdID; ?>">
        <input type="hidden"  id="presProdID"      name="presProdID"      value =  "<?php echo $presProdID; ?>">
        <input type="hidden"  id="tipProdID"       name="tipProdID"       value =  "<?php echo $tipProdID; ?>">
        <input type="hidden"  id="medProdID"       name="medProdID"       value =  "<?php echo $medProdID;  ?>">
        <input type="hidden"  id="marcProdID"      name="medProdID"       value =  "<?php echo $marcProdID;  ?>">
        <!-- <input type="hidden"  id="productcocinadb"      name="productcocinadb"       value =  "<?php //echo $productcocinadb;  ?>">-->

       


        <input type="hidden"  id="proveedorID"     name="proveedorID"     value =  "<?php echo $proveedorID; ?>">
        <input type="hidden"  id="presentacion_invId" name="presentacion_invId" value =  "<?php echo $presentacion_invId;  ?>">
        <input type="hidden"  id="tipomovinvtId"      name="tipomovinvtId"      value =  "<?php echo $tipomovinvtId; ?>">

        <div class="form-group">           
            <select name="proveedor" id="proveedor"  class="form-control chosen"> 
                 <option value="0"> Seleccione proveedor </option>                  
                 <?php foreach ($proveedorProducto as $row): ?>
                    <option value="<?php echo $row->proveedorID; ?>">
                    <?php echo $row->proveedorID . " - " .  $row->provDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
        </div>

        <div class="form-group">
            <select name="familia" id="familia"  class="form-control chosen"> 
              <option value="0"> Seleccione familia de producto </option>               
                 <?php foreach ($familiaProducto as $row): ?>
                    <option value="<?php echo $row->famProdID; ?>">
                    <?php echo $row->famProdID . " - " .  $row->famProdDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
        </div>

          <div class="form-group">          
           
            <select name="tipProducto" id="tipProducto"  class="form-control chosen">  
               <option value="0"> Seleccione tipo de producto</option>              
                 <?php foreach ($tipoProducto as $row): ?>
                    <option value="<?php echo $row->tipProdID; ?>">
                    <?php echo $row->tipProdID . " - " .  $row->tipProdNombre; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
          </div>

          <div class="form-group">            
            <select name="marca" id="marca"  class="form-control chosen">  
               <option value="0"> Seleccione Marca</option>                 
                 <?php foreach ($MarcaProducto as $row): ?>
                    <option value="<?php echo $row->marcProdID; ?>">
                    <?php echo $row->marcProdID . " - " .  $row->marcProdDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>
            
          </div>
          <div class="form-group">          
            <select name="presentacion" id="presentacion"  class="form-control chosen">                
                       <option value="0"> Seleccione Presentacion</option>  
               <?php foreach ($prsentacionProducto as $row): ?>
                    <option value="<?php echo $row->presProdID; ?>">
                    <?php echo $row->presProdID . " - " .  $row->presProdDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>            
          </div>
          <div class="form-group">           
            <select name="medida" id="medida"  class="form-control chosen">    
              <option value="0"> Seleccione Medida</option>              
                 <?php foreach ($medidaProducto as $row): ?>
                    <option value="<?php echo $row->medProdID; ?>">
                    <?php echo $row->medProdID . " - " .  $row->medProdDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>            
          </div>

          <div class="form-group">           
            <select name="tipomovinvent" id="tipomovinvent"  class="form-control chosen">   
              <option value="0"> Seleccione movimiento de intentario</option>               
                 <?php foreach ($TipoMovInvnt as $row): ?>
                    <option value="<?php echo $row->tipomovinvtId; ?>">
                    <?php echo $row->tipomovinvtId . " - " .  $row->tipomovimientoinvt; ?>
                    </option>
                <?php endforeach ?>
            </select>            
          </div>
          <div class="form-group">
            <select name="presentacioninvent" id="presentacioninvent"  class="form-control chosen">               
            
            <option value="0"> Seleccione Producto/servicio</option>  
            <?php foreach ($Presentacion_inv as $row): ?>
                    <option value="<?php echo $row->presentacion_invId; ?>">
                    <?php echo $row->presentacion_invId . " - " .  $row->presentacion_inv; ?>
                    </option>
                <?php endforeach ?>
            </select>            
          </div>
          



          <div class="form-group">
            <label for="message-text" class="col-form-label">Descripcion </label>
            <input type="text" class="form-control text-left" id="descripcion" name="descripcion" value ="<?php echo $prodDescripcion ?>  ">
          </div>

           <?php  
           
          if($productcocinadb ==  '1'){ ?>
          <label class="switch-container">
              <input type="checkbox" id="prodctucocina"  name  ="prodctucocina" checked>
              <span class="slider"></span>
              <span class="texto">Producto de cocina</span>
          </label>


          
            <?php   }else { ?>
            <label class="switch-container">
                <input type="checkbox" id="prodctucocina" name  ="prodctucocina" >
                <span class="slider"></span>
                <span class="texto">Producto de cocina</span>
            </label>
            <?php  } ?>

      <div class="modal-footer">
        <button  type="submit" class="btn btn-danger"> Enviar </button>
      </div>
          

        </form>
      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $("#marca").select2({
        theme: 'bootstrap4',
        placeholder: "Select marca",
        allowClear: true,
        width: 'resolve',
    });
	
});
  </script>
