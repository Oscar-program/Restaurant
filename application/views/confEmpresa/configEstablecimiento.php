<?php
defined('BASEPATH') or exit('No direct script access allowed');
$listaEmpresa = '';
?>
<div class = "container-fluid">
    <div class="row">
                <div class="col- col-md-12 text-center pt-5 pb-2">
                    <h4 style="font-weight: bold;">
                        CONFIGURACIONES ESTABLECIMIENTO
                    </h4>
                </div>
    </div>

  <div class="row"> 
      <div class =  "col-12">
            <div class="card mt-3 tab-card" style="background-color:AliceBlue;">
            <div class="card-header tab-card-header ">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true" onclick="verificarstadotabconf(this.id)">Empresa</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false" onclick="verificarstadotabconf(this.id)">Establecimiento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false" onclick="verificarstadotabconf(this.id)" >Areas</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab" aria-controls="Four" aria-selected="false" onclick="verificarstadotabconf(this.id)">Mesas</a>
                    </li>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" id="five-tab" data-toggle="tab" href="#five" role="tab" aria-controls="Five" aria-selected="false" onclick="verificarstadotabconf(this.id)">Nivel usuario</a>
                    </li>
                   
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <!-- para para registro de la empresa-->
                  <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab" >
                            <div class="row">
                                <div class ="col-md 6"> 
                                    <h4>Registro Empresa</h4>
                                    <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                        <form metod="POST" id ="FormEmpresa" class="FormEmpresa" action="javascript:saveEmpresa()" >
                                        <input type="hidden"  name="empresaID" id="empresaID" class="form-control text-left" value ="">
                                            <div class="form-group">

                                                <label for="empNombre" class="col-form-label">Nombre:</label>
                                                <input type="text"  name="empNombre" id="empNombre" class="form-control text-left" placeholder="Ingrese nombre" required >

                                                <label for="empGiro" class="col-form-label">Giro:</label>
                                                <input type="text"  name="empGiro" id="empGiro" class="form-control text-left" placeholder="Ingrese giro" required >

                                                <label for="empNit" class="col-form-label">nit:</label>
                                                <input type="text"  name="empNit" id="empNit" class="form-control text-left" placeholder="Ingrese nit" required >

                                                <label for="empTelefono" class="col-form-label">telefono:</label>
                                                <input type="text"  name="empTelefono" id="empTelefono" class="form-control text-left" placeholder="Ingrese tlefono" required >

                                                <!--<label for="txtmarca" class="col-form-label">email:</label>
                                                <input type="text"  name="txtmarca" id="txtmarca" class="form-control text-left" placeholder="Ingrese marca del producto" required > -->

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
                                        <table id="tblEmpresa" class="tabla-estilo">
                                            <thead>
                                                <tr  style="border-color: white; color:honeydew;">
                                                    <th >#</th>
                                                    <th>Nombre</th>  
                                                    <th>Giro</th> 
                                                    <th>Nit</th>     
                                                    <th>Telefono</th>                                       
                                                    <th class="text-right" >ACCIONES</th>                                
                                                </tr>
                                            </thead>
                                            <tbody  id ="detEmpresa">                                   
                                                                                
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>             
                            </div>
                    </div>

                <!-- panel de establecimiento -->
                    <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab" >
                            <div class="row">
                                <div class ="col-md 6"> 
                                    <h4>Registro establecimimiento</h4>
                                    <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                        <form metod="POST" id ="FormEstablecimiento" class="FormEstablecimiento" action="javascript:saveEstablecimiento()" >
                                        <input type="hidden"  name="establecimientoID" id="establecimientoID" class="form-control text-left" value ="">

                                                <div class="form-group">
                                                            <label for="SelectEmpresaOrigen" class="col-form-label">Empresa origen:</label>
                                                            <select name="SelectEmpresaOrigen" id="SelectEmpresaOrigen"  class="form-control chosen"> 
                                                                <option value ="0"> Seleccione empresa</option>               
                                                                 <?php foreach ($datosEmpresa as $row): ?>
                                                                    <option value="<?php  echo $row->empresaID; ?>">
                                                                    <?php  echo $row->empresaID . " - " .  $row->empNombre; ?>
                                                                    </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                    
                                                </div>

                                            <div class="form-group">
                                            


                                                <label for="estNombre" class="col-form-label">Establecimiento:</label>
                                                <input type="text"  name="estNombre" id="estNombre" class="form-control text-left" placeholder="Ingrese nombre" required >

                                                <label for="estDireccion" class="col-form-label">Dirección:</label>
                                                <input type="text"  name="estDireccion" id="estDireccion" class="form-control text-left" placeholder="Ingrese direccion" required >

                                                <label for="estTelefono" class="col-form-label">Telefono:</label>
                                                <input type="text"  name="estTelefono" id="estTelefono" class="form-control text-left" placeholder="Ingrese telefono" required >

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
                                        <table id="tblEstablecimiento" class="tabla-estilo">
                                            <thead>
                                                <tr  style="border-color: white; color:honeydew;">
                                                    <th >#</th>
                                                    <th>Emp.  Origen</th> 
                                                    <th>Establecimiento</th>  
                                                    <th>Dirección</th> 
                                                    <th>Telefono</th>                                         
                                                    <th class="text-right" >ACCIONES</th>                                
                                                </tr>
                                            </thead>
                                            <tbody  id ="detEstablecimiento">                                   
                                                                                
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>             
                            </div>
                    </div>
                <!-- Areas de  sucursal  -->
                    <div class="tab-pane fade  p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
                        <div class="row">
                                <div class ="col-md 6"> 
                                    <h4>Areas de establecimiento </h4>
                                    <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                        <form  id  ="FormAreaEstb" class = "FormAreaEstb"  method="POST" action="javascript:saveAreaEstab()">
                                        <input type="hidden"  id="areasEstablecimientoID" name ="areasEstablecimientoID"> 
                                        <input type="hidden"  id="establecimientoID" name ="establecimientoID"> 

                                        <div class="form-group">
                                                            <label for="SEstab" class="col-form-label">Establecimiento:</label>
                                                            <select name="SEstab" id="SEstab"  class="form-control chosen"> 
                                                                <option value ="0"> Seleccione establecimiento</option>               
                                                                 <?php foreach ($datosEstablecimientos as $row): ?>
                                                                    <option value="<?php  echo $row->establecimientoID; ?>">
                                                                    <?php  echo $row->establecimientoID . " - " .  $row->estNombre; ?>
                                                                    </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                    
                                                </div>

                                        <div class="form-group">
                                               
                                                <label for="txtArea" class="col-form-label">Area: </label>
                                                <input type="text" class="form-control text-left" id="Area"   name ="Area" placeholder="Ingrese el area" required>

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
                                        <table id="tblAreasEstablecimiento" class="tabla-estilo">
                                            <thead>
                                                <tr>
                                                    <th >#</th>
                                                    <th>Establecimiento</th>   
                                                     <th>Area</th>                                     
                                                    <th class="text-right">ACCIONES</th>                                
                                                </tr>
                                            </thead>
                                            <tbody id ="detAreas">                                   
                                                                                    
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>             
                        </div>
                    </div>
                <!-- Mesas  por area -->    
                    <div class="tab-pane fade  p-3" id="four" role="tabpanel" aria-labelledby="four-tab">
                        <div class="row">
                                <div class ="col-md 6"> 
                                    <h4>Registro de Mesas por area </h4>
                                    <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                        <form  id  ="FormRegMesa" class ="FormRegMesa" method="post" action="javascript:saveMesa()">
                                        <input type="hidden"  id="mesaID" name="mesaID"> 
                                        <input type="hidden"  id="establecimientoID" name="establecimientoID">  
                                        <input type="hidden"  id="areasEstablecimientoID" name="areasEstablecimientoID"> 
                                        
                                         <div class="form-group">
                                                            <label for="SEstablecimiento" class="col-form-label">Establecimiento:</label>
                                                            <select name="SEstablecimiento" id="SEstablecimiento"  class="form-control chosen"> 
                                                                <option value ="0"> Seleccione establecimiento</option>               
                                                                 <?php foreach ($datosEstablecimientos as $row): ?>
                                                                    <option value="<?php  echo $row->establecimientoID; ?>">
                                                                    <?php  echo $row->establecimientoID . " - " .  $row->estNombre; ?>
                                                                    </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                    
                                                </div>

                                         
                                               <div class="form-group">
                                                            <label for="SArea" class="col-form-label">Area establecimiento:</label>
                                                            <select name="SArea" id="SArea"  class="form-control chosen"> 
                                                                <option value ="0"> Seleccione establecimiento</option>               
                                                                 <?php foreach ($datosAreas as $row): ?>
                                                                    <option value="<?php  echo $row->areaEstablecimientoID; ?>">
                                                                    <?php  echo $row->areaEstablecimientoID . " - " .  $row->area; ?>
                                                                    </option>
                                                                <?php endforeach ?>
                                                            </select>
                                                    
                                                </div>

                                        <div class="form-group">
                                                
                                                 <label for="txtmesa" class="col-form-label">Mesa: </label>
                                                <input type="text" class="form-control text-left" id="txtmesa" name="txtmesa" placeholer ="Ingrese la medida del  producto" required  >
                                                 <label for="txtcapacidad" class="col-form-label">Capacidad: </label>
                                                <input type="text" class="form-control text-left" id="txtcapacidad" name="txtcapacidad" placeholer ="Ingrese la medida del  producto" required  >
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
                                            <table id="tblMesas" class="tabla-estilo" >
                                                <thead class="headertable">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Area</th>
                                                        <th>Mesa</th>   
                                                        <th>Capacidad</th>   

                                                        <th class="text-right">ACCIONES</th>                                
                                                    </tr>
                                                </thead>
                                                <tbody id ="detMesas">                                   
                                                                                        
                                                </tbody>
                                            </table>
                                        </div>
                                     </div>    
                                </div>             
                        </div>
                    </div>
                <!-- Nivel usuario Sistema -->
                   <div class="tab-pane fade  p-3" id="five" role="tabpanel" aria-labelledby="four-tab">
                        <div class="row">
                                <div class ="col-md 6"> 
                                    <h4>Nivel usuario sistema</h4>
                                    <div class ="shadow-sm p-3 mb-5 bg-white rounded">
                                        <form  id  ="FormNivelUser" class ="FormNivelUser" method="post" action="javascript:saveNivelUsuario()">
                                        <input type="hidden"  id="nivelUsuarioID" name="nivelUsuarioID"> 
                                        
                                        
                                         
                                         
                                              

                                        <div class="form-group">
                                                
                                                 <label for="txtmesa" class="col-form-label">Nivel: </label>
                                                <input type="text" class="form-control text-left" id="nivel" name="nivel" placeholer ="Ingrese nivel usuario sistema" required  >
                                                
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
                                            <table id="tblMesas" class="tabla-estilo" >
                                                <thead class="headertable">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nivel</th>
                                                        <th class="text-right">ACCIONES</th>                                
                                                    </tr>
                                                </thead>
                                                <tbody id ="detNivelUsuario">                                   
                                                                                        
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
