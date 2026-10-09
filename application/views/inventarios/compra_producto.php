<div class="container-fluid m-top">
        <div class="row" style=" background: linear-gradient(LightSkyBlue 15%, DodgerBlue 60%, CornflowerBlue); color:white;">
            <div class="col-12 text-center">
                <H3>  Ingreso de compras de productos </H3>
            </div>
        </div>
       
</div> 

<div class="container-fluid m-top" style="background-color: white; border-style:outset;">
   
    <input type="hidden"  id="idCompra"  name="idCompra" >
    <!-- para   el  tipo de  comprobante  y el numero del comprobante -->
     
    <div class="row mt-20">
       
        <div class="col-12 mt-1 text-right">
        <button  data-title ="Guardar registro" class="btn btn-primary btn-lg rounded-circle" onclick="saveTransacCompraproducto()" style="font-weight: bold;"> <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        
       
        <button  data-title ="Cacelar " class="btn btn-primary btn-lg rounded-circle" onclick="addProducCompra()"> <i class="fa fa-times" aria-hidden="true"></i>  </button>
       
        </div>
       
       
    </div>
    <div class="row">
        <div class="col-sm mt-1">
            
        </div>
        <div class="col-sm mt-1">
         
        </div>
        <div class="col-sm mt-1">
        <label for="fechaing"> fecha de  ingreso</label>
        <input type="date" name="fechaing" id="fechaing" class ="form-control form-control-md" style="border-radius:10px; color:red;">
        </div>

       
        
       
       
    </div>


    <div class="row">
        <div class="col-sm mt-1">
            <label for="proveedor">Tipo de comprobante</label>
            <select name="tipocomprobante" id="tipocomprobante"  class="form-control form-control-md chosen">  
                    <option value="1"> Consumidor Final </option>
                    <option value="2"> Credito Fiscal </option>
                    <option value="3"> Nota de Remision </option>
                    <option value="4"> Factura de exportacion </option>
                
            </select>
        </div>
        <div class="col-sm mt-1">
            <label for="proveedor"># comprobante</label>
            <input type="text" id ="numComprobante"  name ="numComprobante"  class="form-control form-control-md">  
        </div>
        <div class="col-sm mt-1">
       
        </div>

       
        
       
       
    </div>
  
  <!-- select del proveedor -->
    <div class="row">
        <div class="col-sm mt-1">
            <label for="proveedor">Proveedor</label>

            <select name="proveedor" id="proveedor"  class="form-control chosen"> 
            <option value="0"> Selecccione un producto</option>              
                 <?php foreach ($proveedores as $row): ?>
                    <option value="<?php echo $row->proveedorID; ?>">
                    <?php echo $row->proveedorID . " - " .  $row->provDescripcion; ?>
                    </option>
                <?php endforeach ?>
            </select>

            
        </div>
        
        
       
       
    </div>
        <!-- telefono -->
        <div class="row mt-0">
        <div class="col-12">
        <a href="#" class="d-block"> <?php echo $_SESSION["usuario"] . "numero".  $_SESSION["idDetCompra"] ?></a>
            <label for="telefono">Direccion  <?php echo  $_SESSION["usuario"]?></label>
            <input type="text" id="telefono"  id="telefono" class ="form-control form-control-md"  readonly style="background-color:white;">
        </div>
    </div>
     <!-- mail -->
    <div class="row mt-0">
        <div class="col-12">
        <label for="emial">E-mail </label>
        <input type="email" name="emial" id="email" class="form-control form-control-md"  readonly style="background-color:white;">
        </div>
    </div>
   
        <!-- fecha de  ingreso -->
    <div class="row mt-1 ">
        <div class="col-sm mb-2" style ="padding-top: 25px;  padding-bottom: 0px;">
        <button  data-title ="Guardar registro" class="btn btn-danger" onclick="addProducCompra()"> <i class="fa fa-plus" aria-hidden="true"></i>  Agregar Producto </button> 
        <button  data-title ="Guardar registro" class="btn btn-danger" onclick="iniciaArr()"> <i class="fa fa-plus" aria-hidden="true"></i>  iniciar Proceso</button> 
        </div>
        <div class="col-sm mb-2" style ="padding-top: 25px;  padding-bottom: 0px;">
        
        </div>
        
        <div class="col-sm">
          
        </div>
    </div>
  
    <div class="row mt-1">
        
        <div class="col-12">
            <div class="table-responsive">
                <table id="tblListaProd" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cantidad </th>
                            <th>Descripcion </th>
                            
                            <th>P.Unit</th>
                            <th>Impuesto</th>
                            <th>Total</th>
                                                    
                            <th class="text-right">ACCIONES</th>                                
                        </tr>
                    </thead>
                    <tbody id = "detTmpCompra">
                        
                                            
                    </tbody>
                </table>

            </div>
        </div>
        
    </div>
    <!-- formando los  totales  -->
    <div class="row mt-1 ">
    <div class="col-sm mb-2">       
        </div>
        <div class="col-sm mb-2">       
        </div>
        <div class="col-sm mb-2">       
        </div>
        <div class="col-sm mb-2">       
        </div>
        <div class="col-sm">
            <label for="fechaing"> Sub Total $</label>            
        </div>
        <div class="col-sm">           
            <input type="text" name="sumas" id="sumas" class ="form-control  text-right" readonly style="border-color: DodgerBlue; background-color:white; color:red">
        </div>
    </div>
    <!-- iva-->
    <div class="row mt-1 ">
        <div class="col-sm mb-2">       
        </div>
        <div class="col-sm mb-2">       
        </div>
        <div class="col-sm mb-2">       
        </div>
        <div class="col-sm mb-2">       
        </div>
        <div class="col-sm">
            <label for="fechaing"> Impuestos $</label>            
        </div>
        <div class="col-sm">           
            <input type="text" name="impuesto" id="impuesto" class ="form-control  text-right" readonly style="border-color: DodgerBlue; background-color:white; color:red">
        </div>
    </div>
    <!-- total-->
    <div class="row mt-1 ">
    <div class="col-sm mb-2">       
        </div>
        <div class="col-sm mb-2">       
        </div>
        <div class="col-sm mb-2">       
        </div>
        <div class="col-sm mb-2">       
        </div>
        <div class="col-sm">
            <label for="fechaing"> Total $</label>            
        </div>
        <div class="col-sm">           
            <input type="text" name="total" id="total" class ="form-control  text-right" readonly style="border-color: DodgerBlue; background-color:white; color:red">
        </div>
    </div>
    <br>
    
</div>
<div id="addProductCompra">
        
</div>
