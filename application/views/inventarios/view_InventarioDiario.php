<div class="row">
    <div class="col-12">
        <div class="card mt-3 tab-card">
            <div class="card-header tab-card-header ">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true" onclick="verificarstadotab(this.id)">Ingreso Inventario</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false" onclick="verificarstadotab(this.id)">Busqueda Inventario</a> </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                    <form metod="POST" id="FormInvdiario" class="FormOnetab">
                        <div class="container-fluid m-top">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <H2> INGRESO INVENTARIO DIARIO</H2>
                                </div>
                                <!-- <div class="col-3">
                              <input type="date"  name="fechab" id="fechab" class ="form-control" value="<?php echo date('Y-m-d'); ?>"> 
                                      </div>
                              -->
                                <!-- <a href='#' class="btn btn-success btn-sm" style="margin:0px;  color:white;"
                              data-title="Procesar Traslado"
                              onclick="BuscarInvDiario()">
                              <i class="fa  fa-search" aria-hidden="true">
                              </i> </a> -->
                                <!-- <div class="col-3" style="margin-left:30px">
                              <input type="date"   class="form-control"  name="fechaing" id="fechaing" value="<?php  date_default_timezone_set("America/El_Salvador"); echo $date = date("Y-m-d"); ?>"> 
                           </div> -->
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <input type="date" name="fechaingb" id="fechaingb" class="form-control" value="<?php  date_default_timezone_set("America/El_Salvador"); echo $date = date("Y-m-d"); ?>"> </div>
                                    <div class="mb-3">
                                        <select class="form-control  custom-margin" name="TipoMov" id="TipoMov" selected="this.selectedText">
                                            <option value="Apertura" selected>Turno Mañana</option>
                                            <option value="Cierre">Turno tarde</option>
                                             <option value="Cierre">Turno noche</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control  custom-margin" name="Bodega" id="Bodega" selected="this.selectedText">
                                            <option value="Apertura" selected>Bodega1 </option>
                                            <option value="Cierre">Bodega 2</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <select class="form-control custom-margin" name="nProducto" id="nProducto" selected="this.selectedValue">
                                            <?php foreach ($listaProductos as $row){?>
                                                <option value="<?=$row->productoID?>" <?php if($row->productoID == 1) echo " selected" ?>>
                                                    <?=$row->prodDescripcion?>
                                                </option>
                                                <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:20px">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control   custom-margin" id="invinicial" value="" placeholder="Total cierre">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control custom-margin"  id="exitenciafisica" placeholder="Existencia física">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control  custom-margin"  id="invfinal" placeholder="Aberías">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control custom-margin"  id="vnormal" placeholder="Refíl">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control   custom-margin"  id="pnormal" placeholder="Existencia Real">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control custom-margin"  id="pespecial" placeholder="Monto Precio Especial">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control  custom-margin"  id="vespecial" placeholder="Qty Vendidos Precio Especial">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control  custom-margin"  id="totalv" placeholder="Qty Total Venta (Global)">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control custom-margin"  id="totalamt" placeholder="Monto Total venta (Global)">
                                </div>

                                <a href='#' class="btn btn-danger btn-sm"  data-title="Guardar" onclick="SaveInvDiario()">
									Guardar
                                </a>

                            </div>
                        </div>
                    </form>
                </div>


                <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                    <div class="container-fluid m-top">
                        <div class="row">
                            <div class="col-12 text-center">
                                <H2> BUSQUEDA INVENTARIO DIARIO</H2> </div>
                         
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <input type="date" name="fechab" id="fechab" class="form-control" value="<?php  date_default_timezone_set("America/El_Salvador"); echo $date = date("Y-m-d");?>"> </div>
                                    <div class="mb-3">
                                        <select class="form-control  custom-margin" name="TipoMovb" id="TipoMovb" selected="this.selectedText">
                                            <option value="Apertura" selected>Apertura</option>
                                            <option value="Cierre">Cierre</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control custom-margin" name="Productob" id="Productob" selected="this.selectedValue">
                                            <?php foreach ($listaProductos as $row){?>
                                                <option value="<?=$row->productoID?>">
                                                    <?=$row->prodDescripcion?>
                                                </option>
                                                <?php }?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                     
                                <a href='#' class="btn btn-danger btn-sm" style="float:right" data-title="Buscar" onclick="BuscarInvDiario()">
                                   Buscar
                                </a> 
                                    </div>

                                </div>
                            </div>
                        </div>
								
						<div class="row" style="margin-top:20px" id="detalle">
                            <div class="col-lg-6">
									<div class="mb-3">
									<label for="invinicialb" class="col-form-label">Qty Inv Inicial:</label>
                                    <input type="text" class="form-control   custom-margin" id="invinicialb" value="" >
                                </div>
                                <div class="mb-3">
								<label for="conteob" class="col-form-label">Conteo:</label>
                                    <input type="text" class="form-control custom-margin"  id="conteob">
                                </div>
                                <div class="mb-3">
								<label for="invfinalb" class="col-form-label">Qty Inv Final:</label>
                                    <input type="text" class="form-control  custom-margin"  id="invfinalb">
                                </div>
                                <div class="mb-3">
								<label for="vnormalb" class="col-form-label">Qty Vendidos Precio Normal:</label>
                                    <input type="text" class="form-control custom-margin"  id="vnormalb">
                                </div>
                                <div class="mb-3">
								<label for="pnormalb" class="col-form-label">Monto Precio Normal:</label>
                                    <input type="text" class="form-control   custom-margin">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
								<label for="pespecialb" class="col-form-label">Monto Precio Especial:</label>
                                    <input type="text" class="form-control custom-margin"  id="pespecialb">
                                </div>
                                <div class="mb-3">
								<label for="vespecialb" class="col-form-label">Qty Vendidos Precio Especial:</label>
                                    <input type="text" class="form-control  custom-margin"  id="vespecialb">
                                </div>
                                <div class="mb-3">
								<label for="totalvb" class="col-form-label">Qty Total  Venta (Global):</label>
                                    <input type="text" class="form-control  custom-margin"  id="totalvb">
                                </div>
                                <div class="mb-3">
								<label for="totalamtb" class="col-form-label">Monto Total Venta (Global):</label>
                                    <input type="text" class="form-control custom-margin"  id="totalamtb">
                                </div>
                                <!-- 
                                <a href='#' class="btn btn-success btn-sm" style="float:right" data-title="Procesar Traslado" onclick="SaveInvDiario()">
                                    <i class="fa fa-save" aria-hidden="true">
												</i>
                                </a> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function()
{

//$("#nProducto").prop("selectedIndex", 0); // here 0 means select first option
//$('#nProducto').removeAttr('selected').find('option:first').attr('selected', 'selected');

});
</script>
