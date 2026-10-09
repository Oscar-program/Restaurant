<?php
defined('BASEPATH') or exit('No direct script access allowed');
//  cuerpo  del  reporte , se  recarga  solo  esta  parte  cuando  se  aplican  los  filtros
$totalGeneral   = 0;
$unidadesTotal  = 0;
$ordenesSet     = array();

//  el  total  general  se  calcula  ANTES  de  dibujar  para  poder  mostrarlo
//  tambien  arriba  de  la  tabla , y  sale  del  mismo  arreglo  que  se  lista ,
//  asi  el  total  siempre  coincide  con  las  filas  visibles.
if(isset($resProductosVendidos) && !empty($resProductosVendidos)){
    foreach($resProductosVendidos as $row){
        $totalGeneral  += (float) $row->total;
        $unidadesTotal += (float) $row->cantidad;
    }
}
//  cantidad  de  ordenes  distintas  del  detalle
if(isset($detProductosVendidos) && !empty($detProductosVendidos)){
    foreach($detProductosVendidos as $row){
        $ordenesSet[$row->ordenPedidoID] = 1;
    }
}
$totalOrdenes = count($ordenesSet);
$totalLineas  = (isset($detProductosVendidos) && !empty($detProductosVendidos)) ? count($detProductosVendidos) : 0 ;
?>

<!-- ============  RESUMEN  POR  PRODUCTO  Y  AREA  ============ -->
<div class="contenedor-tabla">
    <div class="tabla-responsive">
        <table class="tabla tabla-estiloOrdn">
            <thead>
                <tr>
                    <th id="titulos">AREA</th>
                    <th id="titulos">PRODUCTO</th>
                    <th id="titulos">COCINA</th>
                    <th id="titulos" class="text-right">CANTIDAD</th>
                    <th id="titulos" class="text-right">TOTAL</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($resProductosVendidos) && !empty($resProductosVendidos)){
                    foreach($resProductosVendidos as $row){
            ?>
                <tr>
                    <td data-label="Area"><?php echo strtoupper($row->area); ?></td>
                    <td data-label="Producto"><?php echo $row->prodDescripcion; ?></td>
                    <td data-label="Cocina"><?php echo ($row->prodctucocina == 1) ? 'SI' : 'NO' ; ?></td>
                    <td data-label="Cantidad" class="text-right"><?php echo number_format($row->cantidad,0); ?></td>
                    <td data-label="Total" class="text-right"><?php echo '$ '.number_format($row->total,2); ?></td>
                </tr>
            <?php   }
                 }else{ ?>
                <tr><td colspan="5" class="text-center">No se encontraron productos vendidos con los filtros seleccionados.</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ============  TOTAL  GENERAL  DE  LAS  VENTAS  ============ -->
<div class="row">
    <div class="col-12">
        <div style="background-color:#243458; color:#ffffff; border-radius:8px; padding:12px 18px;
                    box-shadow:0 2px 8px rgba(0,0,0,.25); margin:10px 0px;">
            <div class="row">
                <div class="col-md-7 col-12">
                    <label id="lbTotalGeneralVentas" name="lbTotalGeneralVentas"
                           style="font-size:26px; font-weight:bold; display:block; margin:0px;">
                        <?php echo "TOTAL GENERAL DE LAS VENTAS :  $".number_format($totalGeneral,2); ?>
                    </label>
                    <label style="font-size:13px; display:block; color:#D6EAF8; margin:0px;">
                        <?php echo "Unidades vendidas: ".number_format($unidadesTotal,0)
                                  ." | Ordenes: ".$totalOrdenes
                                  ." | Lineas de venta: ".$totalLineas; ?>
                    </label>
                </div>
                <div class="col-md-5 col-12 text-right">
                    <label style="font-size:13px; display:block; color:#D6EAF8; margin:0px;">
                        PROMEDIO POR ORDEN
                    </label>
                    <label style="font-size:20px; font-weight:bold; display:block; margin:0px;">
                        <?php echo '$ '.number_format((($totalOrdenes > 0) ? ($totalGeneral / $totalOrdenes) : 0), 2); ?>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============  DETALLE  LINEA  POR  LINEA  ============ -->
<h5 style="color:#243458; font-weight:bold; margin-top:15px;">DETALLE DE VENTAS</h5>
<div class="contenedor-tabla">
    <div class="tabla-responsive">
        <table class="tabla tabla-estiloOrdn">
            <thead>
                <tr>
                    <th id="titulos">#</th>
                    <th id="titulos">FECHA</th>
                    <th id="titulos">HORA CREACION</th>
                    <th id="titulos">USUARIO CREACION</th>
                    <th id="titulos">HORA DE PAGO</th>
                    <th id="titulos">USUARIO LIQUIDACION</th>
                    <th id="titulos">TIEMPO TOTAL</th>
                    <th id="titulos">AREA</th>
                    <th id="titulos">MESA</th>
                    <th id="titulos">ORDEN #</th>
                    <th id="titulos">PRODUCTO</th>
                    <th id="titulos">FAMILIA</th>                  
                    <th id="titulos">COCINA</th>
                    <th id="titulos" class="text-right">CANT.</th>
                    <th id="titulos" class="text-right">P/U</th>
                    <th id="titulos" class="text-right">TOTAL</th>
                    <th id="titulos">ESTADO</th>
                    <th id="titulos">COMENTARIO</th>
                </tr>
            </thead>
            <tbody>
            <?php $c = 1;
                  if(isset($detProductosVendidos) && !empty($detProductosVendidos)){
                    foreach($detProductosVendidos as $row){
                        $estado = ($row->ordPpenditeCobro == 1) ? "PENDIENTE DE COBRO" : "COBRADO" ;
            ?>
                <tr>
                    <td data-label="#"><?php echo $c; ?></td>
                    <td data-label="Fecha"><?php echo $row->fecha; ?></td>
                    <td data-label="Hora"><?php echo $row->hora; ?></td>
                    <td data-label="Usuario"><?php echo $row->usuario; ?></td>
                     <td data-label="Usuario"><?php echo $row->hora_liqui; ?></td>
                     <td data-label="Usuario"><?php echo $row->usuarioLiquidacion; ?></td>
                      <td data-label="Usuario"><?php echo $row->tiempoTotal; ?></td>
                    <td data-label="Area"><?php echo strtoupper($row->area); ?></td>
                    <td data-label="Mesa"><?php echo strtoupper($row->mesa); ?></td>
                    <td data-label="Orden"><?php echo $row->ordenPedidoID; ?></td>
                    
                    <td data-label="Producto"><?php echo $row->prodDescripcion; ?></td>
                    <td data-label="Producto"><?php echo $row->famProdDescripcion; ?></td> 
                    <td data-label="Cocina"><?php echo ($row->prodctucocina == 1) ? 'SI' : 'NO' ; ?></td>
                    <td data-label="Cantidad" class="text-right"><?php echo number_format($row->cantidad,0); ?></td>
                    <td data-label="Precio" class="text-right"><?php echo '$ '.number_format($row->preciounit,2); ?></td>
                    <td data-label="Total" class="text-right"><?php echo '$ '.number_format($row->dettotal,2); ?></td>
                    <td data-label="Estado"><?php echo $estado; ?></td>
                     <td data-label="Estado"><?php echo str_replace(['Sin%20Comentario','Sin Comentario'],'',$row->ordPcomentario) ; ?></td>
                </tr>
            <?php   $c += 1;
                    }
                 }else{ ?>
                <tr><td colspan="13" class="text-center">No se encontraron productos vendidos con los filtros seleccionados.</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
