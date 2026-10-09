<div class="container-fluid m-top">
        <div class="row">
            <div class="col-12 text-center">
                <H2>  ingreso de venta de productos </H2>
            </div>
        </div>
</div> 

<div class="container-fluid m-top">


<div class="row">
    <div class="col-12">
        <label for="comanda"> Comanda</label>
        <select name="comanda" id="comanda"  class="form-control chosen">  
                <option value="1"> Comanda 1 </option>
                <option value="2"> Comanda 2 </option>
                <option value="3"> Comanda 3 </option>
            
        </select>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <label for="producfam">Familia de producto</label>
        <select name="producfam" id="producfam"  class="form-control chosen">  
                <option value="1"> Familia1 </option>
                <option value="2"> familia 2 </option>
                <option value="3"> familia 3 </option>
            
        </select>
    </div>
</div>
<br>    
    <div class="row">
        
        <div class="col-12">
            <div class="table-responsive">


                <table id="tblListaProd" class="table table-hover">
                    <thead>
                        <tr class="thead-dark">
                            <th>#</th>
                            <th>NOMBRE DEL  PRODUCTO</th>
                            <th>BODEGA SALIDA</th>
                            
                            <th>CANTIDAD</th>
                                                    
                            <th class="text-right">ACCIONES</th>                                
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                          <td>1</b></td>
                            <td>NOMBRE DEL  PRODUCTO</b></td>
                            <td>
                                <select name="medida" id="medida"  class="form-control chosen">  
                                        <option value="1"> Bodega 1 </option>
                                        <option value="2"> Bodega 2 </option>
                                        <option value="3"> Bodega 3 </option>
                                
                                </select>  
                            </td>
                            
                            <td><input type="text"   class="form-control"  id ="salidas" value = "3"></td>
                           
                           
                                                        
                            <td class="text-right">

                                <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:blue;"
                                    title="Consultar venta"
                                    onclick="mostrar_venta();">
                                    <i class="fa fa-search" aria-hidden="true"></i> </a>
                                    
                            </td>
                        </tr>
                        
                       
                        <tr>
                          <td>1</b></td>
                            <td>NOMBRE DEL  PRODUCTO</b></td>
                            <td>
                                <select name="medida" id="medida"  class="form-control chosen">  
                                        <option value="1"> Bodega 1 </option>
                                        <option value="2"> Bodega 2 </option>
                                        <option value="3"> Bodega 3 </option>
                                
                                </select>  
                            </td>
                            
                            <td><input type="text"   class="form-control"  id ="salidas" value = "3"></td>
                           
                           
                                                        
                            <td class="text-right">

                                <a href='#' class="btn btn-default btn-sm" style="margin:0px;  color:blue;"
                                    title="Consultar venta"
                                    onclick="mostrar_venta();">
                                    <i class="fa fa-search" aria-hidden="true"></i> </a>
                                    
                            </td>
                        </tr>                     
                    </tbody>
                </table>

            </div>
        </div>
        
    </div>
</div>