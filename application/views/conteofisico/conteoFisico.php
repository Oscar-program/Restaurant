<div class="row">
    <div class="col-12">
        <div class="card mt-3 tab-card">
            <div class="card-header tab-card-header ">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Ingreso Conteo</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">Búsqueda de Conteos</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false" onclick="getResumenInventario()">Inventario Actual</a> </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
               <!-- Registra los conteos fisicos   -->
                <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                        <div class="container-fluid m-top">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <H4 style="color:#5DADE2; font-weight:bold;"> CONTEO FÍSICO</H4>
                                </div>
                                <br>
                                <br>

                                <div class="col-lg-5">
                                    <form id="FormConteoFisico" name="FormConteoFisico"  method="post" >
                                        <input type="hidden" name="conteoID" id="conteoID"  value ="0" >
                                        <input type="hidden" name="detConteoID" id="detConteoID" value ="0">

                                        <div class="mb-3">
                                            <label class="small text-muted mb-0">Fecha</label>
                                            <input type="date"  class="form-control"  name="fechaC" id="fechaC"  value="<?php  date_default_timezone_set("America/El_Salvador"); echo $date = date("Y-m-d"); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="small text-muted mb-0">Turno</label>
                                            <select class="form-control  custom-margin" name="turno" id="turno">
                                                <option value="0" selected>Seleccione un turno</option>
                                                <?php  foreach( $turnos as  $row): ?>
                                                        <option value="<?php  echo  $row->turnOperaID ?>"> <?php echo  $row->turnOperaDescripcion;  ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small text-muted mb-0">Bodega</label>
                                            <select class="form-control  custom-margin" name="bodega" id="bodega">
                                                <option value="0" selected>Seleccione una bodega</option>
                                                <?php  foreach( $bodegas as  $row): ?>
                                                        <option value="<?php  echo  $row->bodegaProductoID ?>"> <?php echo  $row->bodProdDescripcion;  ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="small text-muted mb-0">Producto</label>
                                            <select class="form-control custom-margin chosen" name="producto" id="producto">
                                                <option value="0" selected>Seleccione un producto</option>
                                                <?php foreach ($listaProductos as $row){?>
                                                    <option value="<?=$row->productoID?>">
                                                        <?=$row->prodDescripcion?>
                                                    </option>
                                                    <?php }?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="small text-muted mb-0">Conteo inicial (cierre anterior)</label>
                                            <input type="number" min="0" class="form-control   custom-margin" id="tcierreant" name ="tcierreant" value="" placeholder="Conteo inicial">
                                        </div>
                                        <div class="mb-3">
                                            <label class="small text-muted mb-0">Reabastecimiento (refil)</label>
                                            <input type="number" min="0" class="form-control custom-margin"  id="refil" name="refil"  placeholder="Refil" value="0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="small text-muted mb-0">Conteo físico final (existencia actual)</label>
                                            <input type="number" min="0" class="form-control custom-margin"  id="existenciaF"  name="existenciaF"   placeholder="Existencia física final">
                                        </div>
                                        <div class="mb-3">
                                            <label class="small text-muted mb-0">Averías / mermas</label>
                                            <input type="number" min="0" class="form-control  custom-margin"  id="aberia"   name="aberia" placeholder="Averías" value="0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="small text-muted mb-0">Consumo del día (calculado)</label>
                                            <input type="number" class="form-control   custom-margin"  id="stockf"  name="stockf"  placeholder="Consumo = (inicial + refil) - final - averías" readonly>
                                        </div>
                                    </form>

                                    <div class="mb-3 text-right">
                                                <button  id ="btnNuevoConteo" name="btnNuevoConteo"  class="btn btn-lg btn-secondary" title="Iniciar un nuevo conteo" onclick="nuevoConteo()">  <i class="fa fa-file" aria-hidden="true"></i> Nuevo </button>
                                                <button  id ="btnSaveConteo" name="btnSaveConteo"  class="btn btn-lg btn-primary"  style="background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px;"  title="Agregar producto al conteo" onclick="procesarConteoFisico()">  <i class="fa fa-database" aria-hidden="true"></i> Agregar / Guardar </button>
                                     </div>
                                </div>

                                <div class="col-lg-7">
                                    <table  class="table table-hover" id="detalleConteo" style="border-width: 1px; border-color:#5DADE2 ;" >
                                            <thead>
                                                <tr style="font-size: 9px;">
                                                    <th style="font-size: 10px;">#</th>
                                                    <th style="font-size: 10px;">Producto</th>
                                                    <th style="font-size: 10px;">Inicial</th>
                                                    <th style="font-size: 10px;">Refil</th>
                                                    <th style="font-size: 10px;">Final</th>
                                                    <th style="font-size: 10px;">Averías</th>
                                                    <th style="font-size: 10px;">Consumo</th>
                                                    <th style="font-size: 10px;">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detConteo" >
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- lista los conteos fisicos  -->
                <div class="tab-pane fade  p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                    <div class="container-fluid m-top">
                        <div class="row">
                            <div class="col-12 text-center">
                                <H5> BÚSQUEDA DE CONTEOS FÍSICOS</H5> </div>
                                <br>
                                 <br>

                                <div class="container-fluid mt-0">
                                    <div class="row">
                                        <div class="col-md"><label class="small text-muted mb-0">Desde</label><input type="date"  class="form-control" name="FechIncio" id="FechIncio"></div>
                                        <div class="col-md"><label class="small text-muted mb-0">Hasta</label><input type="date" class="form-control" name="FechFin" id="FechFin"></div>
                                        <div class="col-md align-self-end"><input type="button" id="btnBuscaConteo"  class="form-control" value="Buscar" onclick="getlistaConteo()"  style ="background-color: #5DADE2; width:50%;color:aliceblue; font-weight:bold;"></div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <table id="tblConteo" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>FECHA</th>
                                                    <th>TURNO</th>
                                                    <th>INICIAL</th>
                                                    <th>REFIL</th>
                                                    <th>FINAL</th>
                                                    <th>AVERÍAS</th>
                                                    <th>CONSUMO</th>
                                                    <th class="text-right">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detListaConteo">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- resumen inventario actual  -->
                <div class="tab-pane fade  p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
                    <div class="container-fluid m-top">
                        <div class="row">
                            <div class="col-12 text-center">
                                <H5> INVENTARIO ACTUAL POR PRODUCTO</H5> </div>
                                <br>
                                <div class="container-fluid mt-0">
                                    <div class="row">
                                        <div class="col-md"><label class="small text-muted mb-0">Desde</label><input type="date"  class="form-control" name="FechIncioR" id="FechIncioR"></div>
                                        <div class="col-md"><label class="small text-muted mb-0">Hasta</label><input type="date" class="form-control" name="FechFinR" id="FechFinR"></div>
                                        <div class="col-md align-self-end"><input type="button" id="btnResumen"  class="form-control" value="Generar" onclick="getResumenInventario()"  style ="background-color: #5DADE2; width:50%;color:aliceblue; font-weight:bold;"></div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <table id="tblResumen" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>PRODUCTO</th>
                                                    <th>INICIAL</th>
                                                    <th>REFIL</th>
                                                    <th>FINAL</th>
                                                    <th>AVERÍAS</th>
                                                    <th>CONSUMO</th>
                                                    <th>EXISTENCIA ACTUAL</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detResumen">
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

<!-- recalcula el consumo cada vez que cambia un valor -->
<script>
    $(document).ready( function(){
      $("#tcierreant, #existenciaF, #aberia, #refil").on("change keyup", function(){
         calcularexistenciaReal();
      });
      // al cambiar producto o bodega arrastramos el cierre anterior como conteo inicial
      $("#producto, #bodega").on("change", function(){
         cargarCierreAnterior();
      });
    });

    // consumo del dia = (conteo inicial + refil) - conteo final - averias
    function calcularexistenciaReal(){
        var tcierreant  = ($("#tcierreant").val().length>0)?  parseInt($("#tcierreant").val())  : 0;
        var existenciaF = ($("#existenciaF").val().length>0)? parseInt($("#existenciaF").val()) : 0;
        var aberia      = ($("#aberia").val().length>0)?      parseInt($("#aberia").val())      : 0;
        var refil       = ($("#refil").val().length>0)?       parseInt($("#refil").val())       : 0;
        var consumo     = (tcierreant + refil) - existenciaF - aberia;
        $("#stockf").val(consumo);
    }
</script>

<script>
$(document).ready(function()
{
 $("#producto").select2({
                            theme: 'bootstrap4',
                            placeholder: "Seleccione un producto",
                            allowClear: true,
                            width: 'resolve',
                         });
});
</script>
