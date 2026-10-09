<?php
defined('BASEPATH') or exit('No direct script access allowed');
//  DETALLE  DE  PRODUCTOS  VENDIDOS
//  filtros :  rango  de  fecha ,  area ,  usuario  y  producto  de  cocina .  Por  defecto  muestra  TODO
$fechaIni  = isset($fechaIni) ? $fechaIni : "" ;
$fechaFin  = isset($fechaFin) ? $fechaFin : "" ;
$areaSel   = isset($areaEstablecimientoID) ? $areaEstablecimientoID : 0 ;
$usuarioSel= isset($usuarioID) ? $usuarioID : 0 ;
$cocinaSel = isset($soloCocina) ? $soloCocina : "" ;
?>
<style>
    /*  bloque  del  total  general  de  las  ventas  */
    .cardTotalVentas{
        background-color:#243458;
        color:#ffffff;
        border-radius:8px;
        padding:12px 18px;
        box-shadow:0 2px 8px rgba(0,0,0,.25);
        margin:10px 0px;
    }
    .lbTotalVentas{
        font-size:26px;
        font-weight:bold;
        display:block;
        margin:0px;
    }
    .lbDetalleVentas{
        font-size:13px;
        display:block;
        color:#D6EAF8;
        margin:0px;
    }
</style>

<div class="container-fluid m-top">
    <div class="row">
        <div class="col-12 text-center">
            <H2 style="color:#5DADE2"> DETALLE DE PRODUCTOS VENDIDOS </H2>
        </div>
    </div>

    <!-- ============  FILTROS  ============ -->
    <div class="row shadow-sm p-3 mb-3 bg-white rounded">
        <div class="col-md-2 col-12">
            <label for="fechaIni" class="col-form-label">Fecha desde:</label>
            <input type="date" class="form-control" id="fechaIni" name="fechaIni" value="<?php echo $fechaIni; ?>">
        </div>
        <div class="col-md-2 col-12">
            <label for="fechaFin" class="col-form-label">Fecha hasta:</label>
            <input type="date" class="form-control" id="fechaFin" name="fechaFin" value="<?php echo $fechaFin; ?>">
        </div>
        <div class="col-md-2 col-12">
            <label for="areaVendidos" class="col-form-label">Area:</label>
            <select name="areaVendidos" id="areaVendidos" class="form-control chosen">
                <option value="0"> TODAS LAS AREAS </option>
                <?php if(isset($listAreasEstablecimiento)){
                        if(!empty($listAreasEstablecimiento)){
                            foreach($listAreasEstablecimiento as $row){ ?>
                            <option value="<?php echo $row->areaEstablecimientoID; ?>"
                                <?php echo ($areaSel == $row->areaEstablecimientoID) ? 'selected' : '' ; ?>>
                                <?php echo strtoupper($row->area); ?>
                            </option>
                <?php   }}} ?>
            </select>
        </div>
        <!-- ====  filtro  por  usuario  ==== -->
        <div class="col-md-2 col-12">
            <label for="usuarioVendidos" class="col-form-label">Usuario:</label>
            <select name="usuarioVendidos" id="usuarioVendidos" class="form-control chosen">
                <option value="0"> TODOS LOS USUARIOS </option>
                <?php if(isset($listUsuariosVentas)){
                        if(!empty($listUsuariosVentas)){
                            foreach($listUsuariosVentas as $row){ ?>
                            <option value="<?php echo $row->usuarioID; ?>"
                                <?php echo ($usuarioSel == $row->usuarioID) ? 'selected' : '' ; ?>>
                                <?php echo $row->usrNombre; ?>
                            </option>
                <?php   }}} ?>
            </select>
        </div>
        <!-- ====  filtro  por  producto  de  cocina  ==== -->
        <div class="col-md-2 col-12">
            <label for="cocinaVendidos" class="col-form-label">Prod. cocina:</label>
            <select name="cocinaVendidos" id="cocinaVendidos" class="form-control chosen">
                <option value=""  <?php echo ($cocinaSel === "")  ? 'selected' : '' ; ?>> TODOS </option>
                <option value="1" <?php echo ($cocinaSel === "1") ? 'selected' : '' ; ?>> SOLO COCINA </option>
                <option value="0" <?php echo ($cocinaSel === "0") ? 'selected' : '' ; ?>> SIN COCINA </option>
            </select>
        </div>
        <div class="col-md-2 col-12">
            <label class="col-form-label">&nbsp;</label>
            <div>
                <button type="button" class="btn btn-primary btn-sm" onclick="buscarProductosVendidos()">
                    <i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="limpiarFiltroProductosVendidos()">
                    <i class="fa fa-eraser" aria-hidden="true"></i> Ver todo</button>
                <!-- ====  descarga  a  Excel  respetando  los  filtros  ==== -->
                <button type="button" class="btn btn-success btn-sm" onclick="exportarProductosVendidos()">
                    <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel</button>
            </div>
        </div>
    </div>

    <!-- ============  CUERPO  DEL  REPORTE  ============ -->
    <div id="cuerpoProductosVendidos" name="cuerpoProductosVendidos">
        <?php $this->load->view('ordenes/cuerpoProductosVendidos'); ?>
    </div>

</div>
