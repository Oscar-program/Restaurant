
<?php
$c= 1;
$orden = "";
$ultimo = 0;
//  SUMATORIA  DE  TODAS  LAS  ORDENES  DE  LA  MESA
$mesaNombre   = (isset($infoMesa) && !empty($infoMesa)) ? $infoMesa->mesNombre : "" ;
$mesaArea     = (isset($infoMesa) && !empty($infoMesa)) ? $infoMesa->area      : "" ;
$mesaIdCobro  = (isset($infoMesa) && !empty($infoMesa)) ? $infoMesa->mesaID    : 0 ;
$hayTotal     = (isset($totalMesa) && !empty($totalMesa));
$ordenesMesa  = ($hayTotal) ? (int)   $totalMesa->ordenes      : 0 ;
$prodMesa     = ($hayTotal) ? (float) $totalMesa->cantidadprod : 0 ;
$totalmesa    = ($hayTotal) ? (float) $totalMesa->totalmesa    : 0 ;
$abonomesa    = ($hayTotal) ? (float) $totalMesa->abonomesa    : 0 ;
$acobrarmesa  = ($hayTotal) ? (float) $totalMesa->acobrarmesa  : 0 ;
$saldomesa    = $totalmesa - $abonomesa ;
?>
<style>
    .cardTotalMesa{
        background-color:#243458;
        color:#ffffff;
        border-radius:8px;
        padding:10px 18px;
        box-shadow:0 2px 8px rgba(0,0,0,.25);
        margin-bottom:8px;
    }
    .lbTotalMesa{
        font-size:26px;
        font-weight:bold;
        display:block;
        margin:0px;
    }
    .lbDetalleMesa{
        font-size:13px;
        display:block;
        color:#D6EAF8;
        margin:0px;
    }
    .contador-espera{
        color:red;
        font-weight:bold;
    }
</style>

<!-- ============ LABEL  CON  EL  TOTAL  DE  TODA  LA  MESA  +  COBRO  GLOBAL ============ -->
<div class="row">
    <div class="col-12">
        <div class="cardTotalMesa">
            <div class="row">
                <div class="col-md-8 col-12">
                    <label class="lbTotalMesa" id="lbTotalMesaCobro" name="lbTotalMesaCobro">
                        <?php echo "TOTAL MESA ".strtoupper($mesaNombre)." ".strtoupper($mesaArea)." :  $".number_format($totalmesa,2); ?>
                    </label>
                    <label class="lbDetalleMesa">
                        <?php echo "Ordenes pendientes de cobro: ".$ordenesMesa." | Productos: ".number_format($prodMesa,0)
                                  ." | Abonado: $".number_format($abonomesa,2)." | Saldo mesa: $".number_format($saldomesa,2); ?>
                    </label>
                    <label class="lbDetalleMesa">
                        <?php echo "Suma A cobrar de las ordenes: $".number_format($acobrarmesa,2); ?>
                    </label>
                </div>
                <!--  boton para  cobrar  TODAS  las  ordenes  de  la  mesa  de  una  sola  vez -->
                <div class="col-md-4 col-12 d-flex align-items-center justify-content-end">
                    <?php if($ordenesMesa > 0){ ?>
                        <button type="button" class="btn btn-danger btn-block"
                                id="btnCobrarMesa" name="btnCobrarMesa"
                                data-title="Cobrar todas las ordenes de la mesa"
                                onclick="realizarCobroMesa(<?php echo $mesaIdCobro; ?>, '<?php echo number_format($totalmesa,2,'.',''); ?>')">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                            COBRAR TODA LA MESA
                        </button>
                        <button type="button" class="btn btn-info"  onclick="mostrarResumenMesa(<?php echo $mesaIdCobro;?>)"> <i class="fa fa-bars" aria-hidden="true"></i> </button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contenedor-tabla">
<div class="tabla-responsive">
<table  class=" tabla  tabla-estiloOrdn">
   <?php 
      $ultimo = count($lstPendDespCabecera);
    if( isset($lstPendDespCabecera)){
      foreach( $lstPendDespCabecera as  $row){       
             $estado     = "(Despachado)";   
             $comentario = "";
             $nameChek   = "Cobrar" .$c;
             $thCancelar = "total" .$row->ordenPedidoID;
             $acobrar    = (float) $row->ordPtotalcancelar;  
             $ordPAbono   = (float) $row->ordPAbono;

             $acronimo   = " AM"; 
             if(!empty($row->cliente)){
                $comentario = "Comentario :" . str_replace("%20", "", $row->cliente)  ; 
             }
             if( $row->hora>12){
                $acronimo =" PM";
             }
             if ($row->despachar == "0" || $row->despachar== 0){
                $estado ="(Pendiente Despachado)"; 
             }
            ?>
                 <?php  if($orden != $row->ordenPedidoID) {?>                  
                        <thead>
                              <tr>
                                 <th colspan="3">
                                    <?php
                                    //  LEYENDA :  ORDEN # / AREA / MESA / USUARIO / HORA  +  contador  activo  del  tiempo  de  espera  en  rojo
                                    $usuario = isset($row->usuario)    ? $row->usuario    : "SIN USUARIO" ;
                                    $horaped = isset($row->horapedido) ? $row->horapedido : ($row->hora.":".$row->minuto.$acronimo) ;
                                    $mesalbl = isset($row->mesa)       ? strtoupper($row->mesa) : "" ;
                                    echo "ORDEN #".$row->ordenPedidoID." / ".strtoupper($row->area)." / ".$mesalbl." / ".$usuario." / ".$horaped ;
                                    ?>
                                    <span class="contador-espera" style="color:red; font-weight:bold;"
                                          data-segundos="<?php echo isset($row->segundos_espera) ? intval($row->segundos_espera) : 0 ; ?>">00:00:00</span>
                                    <?php echo " ". $comentario ; ?>
                                 </th>
                                 <th colspan="1" id ="<?php  echo  $thCancelar; ?>" name  = "<?php  echo  $thCancelar; ?>"> <?php echo "Abonado $" .   round($ordPAbono,2) .  " A cobrar  $" . round($acobrar,2)   ?></th>
                                 <th colspan="1">
                                     <button type="button" class="form-control   btn-sm" data-title ="Abonar" onclick="mostrarModalAbono(<?php echo $row->ordenPedidoID?>)" style="color:#007bff ;"><i class="fa fa-credit-card" aria-hidden="true"></i></button>
                                 </th>
                                 <th colspan="1">
                                    <button type="button" class="form-control   btn-sm" data-title ="Procesar venta" onclick="realizarCobro(<?php echo $row->ordenPedidoID?>, <?php echo $row->mesaID?>   )" style="color:red ;"><i class="fa fa-calculator" aria-hidden="true"></i></button>
                                 </th>
                              </tr>
                        </thead>
                         <thead>
                              <tr>
                                    <th id ="titulos">Cantidad</th>
                                    <th id ="titulos" colspan="3">DescripciÃ³n</th> 
                                    <th id ="titulos" colspan="2" >Precio</th>
                                    
                              </tr>
                        </thead>                         
                        <tr>
                           <td data-label="Cantidad"><?php echo  $row->catidad; ?></td>
                           <td data-label="DescripciÃ³n" colspan="3" ><?php  echo  strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion) ). " ".$estado;  ?></td>                          
                           <td data-label="Total" colspan="2"><?php echo  $row->dettotal; ?></td>
                          
                        </tr>                
                        <?php  } else { ?> 
                              <tr>
                                 <td data-label="Catidad"><?php echo$row->catidad; ?></td>
                                 <td data-label="DescripciÃ³n" colspan="2"><?php  echo   strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion)) . " ".$estado; ?></td>                           
                                  <td data-label="Total" ></td>
                                 <td data-label="Total" colspan="2"><?php echo  $row->dettotal; ?></td>
                                 
                              </tr> 
                        <?php  }?>
         
       <?php 
         $orden  =   $row->ordenPedidoID;
          $c+=1;
          ?>
          <?php }}?>
           </table>
    </div>
      </div>

      <!-- modal para abonar la cuenta  por cobrar -->
     <div class="modal fade" id="addAbonoPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
		    <div class="modal-content">
			
			  <div class="modal-header text-center">
				<h5 class="modal-title text-center" id="exampleModalLabel">  <?php echo 'Registrar Abono';?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div> 
			  <div class="modal-body">
				<form>
				
					<input type="hidden" class="form-control text-right" id="ordenPedidoID" name="ordenPedidoID" readonly>
                    <div class="form-group">
						<input type="number" class="form-control text-right" id="ordPAbono"  name="ordPAbono"  value ="" step="any">
					  </div> 
					  <div class="form-group text-right">
						 
						  <button type="button" class="btn btn-danger btn-sm btnActionVenta1" data-title ="Procesar venta" onclick="abonarOrden()">
						  <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
					  </div> 
				</form>
			  </div>
			
		    </div> 
		   </div> 
	    </div>
     </div>
     <!-- modal para  resumen de venta   por mesa -->
      <div id="divResumenPorMesa"> </div>
      <!-- modal para  resumen de venta   por mesa --> 

<script>
    //  arranca  el  contador  activo  del  tiempo  de  espera
    iniciarContadoresEspera();
</script>
