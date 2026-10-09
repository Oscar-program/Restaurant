<?php
defined('BASEPATH') or exit('No direct script access allowed');
//  ORDENES  ABIERTAS ( no  cobradas )  DE  LA  MESA
//  desde  aqui  se  agregan  productos  a  una  orden  que  todavia  no  se  ha  cobrado
$mesaID     = isset($mesaID) ? $mesaID : 0 ;
$mesNombre  = isset($mesNombre) ? str_replace("%20", " ", $mesNombre) : "" ;
$area       = (isset($infoMesa) && !empty($infoMesa)) ? $infoMesa->area : "" ;
$areaID     = (isset($infoMesa) && !empty($infoMesa)) ? $infoMesa->areaEstablecimientoID : 0 ;

$hayTotal     = (isset($totalMesa) && !empty($totalMesa));
$ordenes      = ($hayTotal) ? (int)   $totalMesa->ordenes      : 0 ;
$cantidadprod = ($hayTotal) ? (float) $totalMesa->cantidadprod : 0 ;
$totalmesa    = ($hayTotal) ? (float) $totalMesa->totalmesa    : 0 ;
$abonomesa    = ($hayTotal) ? (float) $totalMesa->abonomesa    : 0 ;
$acobrarmesa  = ($hayTotal) ? (float) $totalMesa->acobrarmesa  : 0 ;
$saldomesa    = $totalmesa - $abonomesa ;
$c            = 1;
?>
<style>
    .cardTotalMesa{
        background-color:#243458;
        color:#ffffff;
        border-radius:8px;
        padding:12px 18px;
        box-shadow:0 2px 8px rgba(0,0,0,.25);
    }
    .lbTotalMesa{
        font-size:26px;
        font-weight:bold;
        display:block;
    }
    .lbDetalleMesa{
        font-size:13px;
        display:block;
        color:#D6EAF8;
    }
    .contador-espera{
        color:red;
        font-weight:bold;
    }
    .filaOrden{
        border-bottom:1px solid #dddddd;
    }
</style>

<div class="container-fluid">

    <div class="row mb-2">
        <div class="col-md-7 col-12">
            <h4 style="color:#243458; font-weight:bold;">
                <?php echo strtoupper($mesNombre) . "  /  " . strtoupper($area) ; ?>
            </h4>
            <button type="button" class="btn btn-sm btn-outline-secondary"
                    onclick="listarMesas(<?php echo $areaID; ?>)">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Mesas</button>

            <button type="button" class="btn btn-sm btn-primary"
                    onclick="cargar_addordenes(<?php echo $mesaID; ?>, '<?php echo $mesNombre; ?>')">
                    <i class="fa fa-plus" aria-hidden="true"></i> Nueva orden</button>
        </div>

        <!-- ============ LABEL  CON  EL  TOTAL  DE  TODA  LA  MESA ============ -->
        <div class="col-md-5 col-12">
            <div class="cardTotalMesa text-right">
                <label class="lbTotalMesa" id="lbTotalMesa" name="lbTotalMesa">
                    TOTAL MESA $<?php echo number_format($totalmesa,2); ?>
                </label>
                <label class="lbDetalleMesa">
                    <?php echo "Ordenes abiertas: ".$ordenes." | Productos: ".number_format($cantidadprod,0); ?>
                </label>
                <label class="lbDetalleMesa">
                    <?php echo "Abonado: $".number_format($abonomesa,2)."  |  Saldo: $".number_format($saldomesa,2); ?>
                </label>
                <label class="lbDetalleMesa">
                    <?php echo "Suma A cobrar de las ordenes: $".number_format($acobrarmesa,2); ?>
                </label>
            </div>
        </div>
    </div>

    <div class="contenedor-tabla">
        <div class="tabla-responsive">
            <table class="tabla tabla-estiloOrdn">
                <thead>
                    <tr>
                        <th id="titulos">ORDEN #/AREA/MESA/USUARIO/HORA</th>
                        <th id="titulos">TIEMPO DE ESPERA</th>
                        <th id="titulos">TOTAL PRODUC</th>
                        <th id="titulos">TOTAL</th>
                        <th id="titulos" class="text-right">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(isset($ordenesAbiertas) && !empty($ordenesAbiertas)){
                        foreach($ordenesAbiertas as $row){
                            if($row->cantidadprod> 0){
                                                        $comentario = (!empty($row->cliente)) ? " - " . str_replace("%20", " ", $row->cliente) : "" ;
                                                        $leyenda    = "ORDEN #".$row->ordenPedidoID." / ".strtoupper($row->area)." / ".strtoupper($row->mesa)." / ".$row->usuario." / ".$row->horapedido ;
                    ?>
                                                        <tr class="filaOrden">
                                                            <td data-label="Orden"><?php echo $leyenda . $comentario ; ?></td>
                                                            <td data-label="Tiempo de espera">
                                                                <span class="contador-espera"
                                                                    data-segundos="<?php echo intval($row->segundos_espera); ?>">00:00:00</span>
                                                            </td>
                                                            <td data-label="Productos"><?php echo number_format($row->cantidadprod,0); ?></td>
                                                            <td data-label="Total"><?php echo '$ '.number_format($row->totalorden,2); ?></td>
                                                            <td data-label="Acciones" class="text-right">
                                                                <!-- agrega  productos  de  cocina  ( prodctucocina = 1 ) -->
                                                                <!-- <button type="button" class="btn btn-sm btn-success" data-title="Agregar productos de cocina"
                                                                    onclick="agregarProductosOrden(<?php //echo $row->ordenPedidoID; ?>, <?php //echo $row->mesaID; ?>, 1)">
                                                                    <i class="fa fa-cutlery" aria-hidden="true"></i> Agregar cocina</button> -->

                                                                <!-- agrega  cualquier  producto -->
                                                                <button type="button" class="btn btn-sm btn-info" data-title="Agregar cualquier producto"
                                                                    onclick="agregarProductosOrden(<?php echo $row->ordenPedidoID; ?>, <?php echo $row->mesaID; ?>, 0)">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i> Agregar Producto</button>
                                                            </td>
                                                        </tr>
                <?php  }   $c += 1;
                        }
                     }else{ ?>
                    <tr>
                        <td colspan="5" class="text-center">La mesa no tiene ordenes pendientes de cobro. Use <b>Nueva orden</b> para abrir una.</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    //  arranca  el  contador  activo  del  tiempo  de  espera
    iniciarContadoresEspera();
</script>
