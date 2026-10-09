<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class = "container-fluid">
    <div class="row">
                <div class="col- col-md-12 text-center pt-5 pb-2">
                    <h4 style="font-weight: bold;">
                        CONFIGURACIONES GENERALES 
                    </h4>
                </div>
    </div>

  <div class="row"> 
      <div class =  "col-12">
            <div class="card mt-3 tab-card" style="background-color:AliceBlue;">
            <div class="card-header tab-card-header ">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true" onclick="verificarstadotab(this.id)">Marcas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false" onclick="verificarstadotab(this.id)" >Presentacion</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false" onclick="verificarstadotab(this.id)">Medida</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab" aria-controls="Four" aria-selected="false" onclick="verificarstadotab(this.id)">Familia</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="five-tab" data-toggle="tab" href="#five" role="tab" aria-controls="Five" aria-selected="false" onclick="verificarstadotab(this.id)">Bodegas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="six-tab" data-toggle="tab" href="#six" role="tab" aria-controls="Six" aria-selected="false" onclick="verificarstadotab(this.id)">Lista de precios especiales</a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link" id="seven-tab" data-toggle="tab" href="#seven" role="tab" aria-controls="seven" aria-selected="false" onclick="verificarstadotab(this.id)">Equialente de productos</a>
                    </li>
                 


                    
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <!-- panel de las marcas -->
                    <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab" >
                            <div class="row">
                            <div class ="col-md 6"> 
                                <h4>Registro de marcas </h4>
                                <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                    <form metod="POST" id ="FormOnetab" class="FormOnetab" action="javascript:saveMarca()" >
                                    <input type="hidden"  name="marcProdID" id="marcProdID" class="form-control text-left" value ="">
                                        <div class="form-group">
                                            <label for="txtmarca" class="col-form-label">Marca </label>
                                            <input type="text"  name="txtmarca" id="txtmarca" class="form-control text-left" placeholder="Ingrese marca del producto" required >
                                        </div>
                                        <div class="form-group">
                                        <button  type="submit" data-title="Almacena un registro de base de datos" class="btn btn-danger btnAction"> Guardar </button>
                                        </div>

                                    </form>
                                </div>      
                            </div> 
                            <div class ="col-md 6">
                                <div class="contenedor-tabla">
                                    <div class="tabla-responsive">
                                    <table id="tblFamiliaProd" class="tabla-estilo">
                                        <thead>
                                            <tr  style="border-color: white; color:honeydew;">
                                                <th >#</th>
                                                <th>Marca</th>                                      
                                                <th class="text-right" >ACCIONES</th>                                
                                            </tr>
                                        </thead>
                                        <tbody  id ="detMArcas">                                   
                                                                            
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>             
                            </div>
                    </div>
                <!-- panel de las presentaciones  -->
                    <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                        <div class="row">
                                <div class ="col-md 6"> 
                                    <h4>Registro de presentacion </h4>
                                    <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                        <form  id  ="FormTwotab" class = "FormTwotab"  method="POST" action="javascript:savePresentacionProduc()">
                                        <input type="hidden" class="form-control text-left" id="presProdID" name ="presProdID">     
                                        <div class="form-group">
                                                <label for="txtpresentacion" class="col-form-label">Presentacion </label>
                                                <input type="text" class="form-control text-left" id="txtpresentacion"   name ="txtpresentacion" placeholder="Ingrese la  presentacion del producto" required>
                                            </div>
                                            <div class="form-group">
                                            <button  type="submit" class="btn btn-danger btnAction" data-title="Almacenar Registro" > Guardar </button>
                                            </div>

                                        </form>
                                    </div>      
                                </div> 
                                <div class ="col-md 6">
                                    <div class="contenedor-tabla">
                                    <div class="tabla-responsive">
                                        <table id="tblFamiliaProd" class="tabla-estilo">
                                            <thead>
                                                <tr>
                                                    <th >#</th>
                                                    <th>Presentacion</th>                                      
                                                    <th class="text-right">ACCIONES</th>                                
                                                </tr>
                                            </thead>
                                            <tbody id ="detPresentacion">                                   
                                                                                    
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>             
                        </div>
                    </div>
                <!-- panel de las medidas -->    
                    <div class="tab-pane fade  p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
                        <div class="row">
                                <div class ="col-md 6"> 
                                    <h4>Registro de Medidas de bebidas </h4>
                                    <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                        <form  id  ="FormThreetab" class ="FormThreetab" method="post" action="javascript:saveMedidaProducto()">
                                        <input type="hidden" class="form-control text-left" id="txtmedProdID" name="txtmedProdID">    
                                        <div class="form-group">
                                                <label for="txtmedida" class="col-form-label">Medida </label>
                                                <input type="text" class="form-control text-left" id="txtmedida" name="txtmedida" placeholer ="Ingrese la medida del  producto" required  >
                                        </div>
                                            <div class="form-group">
                                            <button  type="submit" data-title="Almacenar registro" class="btn btn-danger btnAction"> Guardar </button>
                                            </div>

                                        </form>
                                    </div>      
                                </div> 
                                <div class ="col-md 6">
                                     <div class="contenedor-tabla">
                                        <div class="tabla-responsive">
                                            <table id="tblFamiliaProd" class="tabla-estilo" >
                                                <thead class="headertable">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Medida</th>                                      
                                                        <th class="text-right">ACCIONES</th>                                
                                                    </tr>
                                                </thead>
                                                <tbody id ="detMedidad">                                   
                                                                                        
                                                </tbody>
                                            </table>
                                        </div>
                                     </div>    
                                </div>             
                        </div>
                    </div>
                <!-- panel de la familia de productos -->
                    <div class="tab-pane fade  p-3" id="four" role="tabpanel" aria-labelledby="four-tab">
                        <div class="row">
                                    <div class ="col-md 6"> 
                                        <h4>Registro de familia de producto </h4>
                                        <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                            <form  id  = "FormFourtab" class  = "FormFourtab" method="POST" action="javascript:saveFamiliaProducto()">
                                            <input type="hidden" class="form-control text-left" id="txtfamProdID" name="txtfamProdID">    
                                            <div class="form-group">
                                                    <label for="txtfamilia" class="col-form-label">Familia </label>
                                                    <input type="text" class="form-control text-left" id="txtfamilia" name="txtfamilia" placeholder="Ingrese la familia del producto" required>
                                                </div>
                                                <div class="form-group">
                                                <button  type="submit" data-title="Almacenar registro" class="btn btn-danger btnAction"> Guardar </button>
                                                </div>

                                            </form>
                                        </div>      
                                    </div> 
                                    <div class ="col-md 6">
                                        <div class="contenedor-tabla">
                                            <div class="tabla-responsive">
                                                <table id="tblFamiliaProd" class="tabla-estilo">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Proveedor</th>                                      
                                                            <th class="text-right">ACCIONES</th>                                
                                                        </tr>
                                                    </thead>
                                                    <tbody id ="detFamilia">                                   
                                                                                            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>             
                                    </div> 
                        </div>
                    </div>
                <!-- panel de las bodegas -->
                    <div class="tab-pane fade  p-3" id="five" role="tabpanel" aria-labelledby="five-tab">
                        <div class="row">
                                    <div class ="col-md 6"> 
                                        <h4>Registro de bodegas de producto </h4>
                                        <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                            <form action="javascript:addBodegaProducto()" id  = "FormFivetab" class  = "FormFivetab" method="POST">
                                            <input type="hidden" class="form-control text-left" id="txtbodegaProductoID" name="txtbodegaProductoID">

                                                <div class="form-group">
                                                    <label for="txtbodega" class="col-form-label">Bodega </label>
                                                    <input type="text" class="form-control text-left" id="txtbodega" name="txtbodega" placeholder="Ingrese nombre de bodega"   required>
                                                </div>
                                                <div class="form-group">
                                                <button  type="submit"    data-title ="Guardar registro" class="btn btn-danger btnAction"> Guardar </button>
                                                </div>

                                            </form>
                                        </div>      
                                    </div> 
                                    <div class ="col-md 6">
                                         <div class="contenedor-tabla">
                                            <div class="tabla-responsive">
                                                <table id="tblFamiliaProd" class="tabla-estilo">
                                                    <thead>
                                                        <tr >
                                                            <th>#</th>
                                                            <th>Bodega</th> 
                                                            <th>Establecimiento</th>                                      
                                                            <th class="text-right">ACCIONES</th>                                
                                                        </tr>
                                                    </thead>
                                                    <tbody id  =  "detBodegas">                                   
                                                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                         </div> 
                                    </div>             
                        </div>
                    </div>
                <!-- panel de  precios especiales  -->
                    <div class="tab-pane fade  p-3" id="six" role="tabpanel" aria-labelledby="six-tab">
                        <div class="row">
                                    <div class ="col-md 6"> 
                                        <h4>Configuracion de precios especiales </h4>
                                        <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                            <form enctype="multipart/form-data" action="javascript:addPreciosEspProducto()" method="POST" id  = "FormSixtab" class = "FormSixtab" >
                                            <input type="hidden" class="form-control text-left" id="precioEspecialProdID" name="precioEspecialProdID">
                                            <input type="hidden" class="form-control text-left" id="turnOperaID" name="turnOperaID">
                                            <input type="hidden" class="form-control text-left" id="famProdID" name="famProdID">
                                
                                            <div class="form-group">
                                                <label for="turno" class="col-form-label">Turno:</label>
                                                <select name="turno" id="turno"  class="form-control chosen">                
                                                    <?php foreach ($turnos as $row): ?>
                                                        <option value="<?php echo $row->turnOperaID; ?>">
                                                        <?php echo $row->turnOperaID . " - " .  $row->turnOperaDescripcion; ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                                
                                            </div>

                                            <div class="form-group">
                                                <label for="familiaprod" class="col-form-label">Familia de producto:</label>
                                                <select name="familiaprod" id="familiaprod"  class="form-control chosen">                
                                                    <?php foreach ($familiaProducto as $row): ?>
                                                        <option value="<?php echo $row->famProdID; ?>">
                                                        <?php echo $row->famProdID . " - " .  $row->famProdDescripcion; ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                                
                                            </div>

                                            <div class="form-group">
                                                    <label for="txtdescPrecioEspecial" class="col-form-label">Descripcion </label>
                                                    <input type="text" class="form-control text-left" id="txtdescPrecioEspecial" name="txtdescPrecioEspecial" placeholder ="ingrese la  descripcion del precio especial" required>
                                            </div>       
                                            <div class="form-group">
                                                    <label for="txtprecio" class="col-form-label">Precio </label>
                                                    <input type="number" class="form-control text-right" id="txtprecioespecial" name="txtprecioespecial" step ="any" required >
                                                </div>
                                                <div class="form-group">
                                                <button  type="submit" data-title="Guardar registro" class="btn btn-danger btnAction"> Guardar </button>
                                                </div>

                                            </form>
                                        </div>      
                                    </div> 
                                    <div class ="col-md 6">
                                        <div class="contenedor-tabla">
                                            <div class="tabla-responsive">
                                                <table id="tblFamiliaProd" class="tabla-estilo">
                                                    <thead>
                                                        <tr>
                                                            <th style="font-size: 11px;">#</th>
                                                            <th style="font-size: 11px;">Turno</th> 
                                                            <th style="font-size: 11px;" >Familia Prod</th>  
                                                            <th style="font-size: 11px;">Descripcion</th>  
                                                            <th style="font-size: 11px;" >Precio</th>                                       
                                                            <th style="font-size: 11px;"  class="text-right">ACCIONES</th>                                
                                                        </tr>
                                                    </thead>
                                                    <tbody id ="detPreciosEsp">         
                                                    </tbody>
                                                </table>                                            
                                            </div>
                                       </div>             
                                   </div>
                                </div>
                    </div>
                <!-- panel los euivalentes -->
                    <div class="tab-pane fade  p-3" id="seven" role="tabpanel" aria-labelledby="seven-tab">
                        <div class="row">
                                    <div class ="col-md 6"> 
                                        <h4>Configuracion de equivalente de productos </h4>
                                        <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                            <form enctype="multipart/form-data" action="javascript:saveEquivalenteProducto()" method="POST" id  = "FormSeventab" class = "FormSeventab" >
                                            <input type="hidden" class="form-control text-left" id="productoID"    name="productoID">
                                            <input type="hidden" class="form-control text-left" id="presProdID"    name="presProdID">
                                            <input type="hidden" class="form-control text-left" id="prodPresentID" name="prodPresentID">
                                        
                                        
                                
                                            <div class="form-group">
                                                <label for="prouctoEquivalente" class="col-form-label">Producto:</label>
                                                <select name="prouctoEquivalente" id="prouctoEquivalente"  class="form-control chosen"> 
                                                    <option value ="0"> Seleccione un producto</option>               
                                                    <?php foreach ($listaProductos as $row): 
                                                         if(   $row->presentacion_invId == 1){
                                                         ?>
                                                        
                                                        <option value="<?php echo $row->productoID; ?>">
                                                        <?php echo $row->productoID . " - " .  $row->prodDescripcion; ?>
                                                        </option>
                                                    <?php }
                                                     endforeach ?>
                                                </select>
                                                
                                            </div>

                                            <div class="form-group">
                                                <label for="equivalente" class="col-form-label">Equivalente:</label>
                                                <select name="equivalente" id="equivalente"  class="form-control chosen">
                                                <option value ="0"> Seleccione un equivalente</option>                  
                                                    <?php foreach ($equivalentes as $row): ?>
                                                        <option value="<?php echo $row->presProdID; ?>">
                                                        <?php echo $row->presProdID . " - " .  $row->presentacionProd; ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                                
                                            </div>

                                                
                                            <div class="form-group">
                                                    <label for="unidadequivalente" class="col-form-label">unidaddes de equivalente </label>
                                                    <input type="number" class="form-control text-right" id="unidadequivalente" name="unidadequivalente" step ="any" required >
                                                </div>
                                                <div class="form-group">
                                                <button  type="submit" data-title="Guardar registro" class="btn btn-danger btnAction"> Guardar </button>
                                                </div>

                                            </form>
                                        </div>      
                                    </div> 
                                    <div class ="col-md 6">
                                        <div class="contenedor-tabla">
                                             <div class="tabla-responsive">
                                            <table id="tblFamiliaProd" class="tabla-estilo">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Producto</th> 
                                                        <th>Presentacion</th>  
                                                        <th>Unidades</th>  
                                                                                        
                                                        <th>ACCIONES</th>                                
                                                    </tr>
                                                </thead>
                                                <tbody id ="detEquivalentes">                                   
                                                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>             
                        </div>
                    </div> 
                <!-- establecimiento -->
                     
                <!-- sucursales -->    
                  
                  <!-- Areas -->    
                 
                  <!-- Mesas Areas -->    
                 

            </div>               
            </div>
      </div>
    
  </div>
</div>
<style>
        
          
          #txtmarca::placeholder {
            color: white;
          }
          
          #Fullname::placeholder{
            color: white;
          }

          #password::placeholder{
            color: white;
          }

          #Rpassword::placeholder{
            color: white;
          }

      </style>
