<!-- Creamos la cabecera de las ordenes de despacho  -->

<?php
$c= 1; 
$orden = "";
$ultimo = 0;
?> 
<div class="contenedor-tabla1">
 <div class="tabla-responsive1">
          <table  class="tabla-estiloOrdn">
                
<?php 
   $ultimo = count($lstPendDespCabecera);
  // echo  "el total de items es "  . $ultimo ."<br>";
 if( isset($lstPendDespCabecera)){
   foreach( $lstPendDespCabecera as  $row){          
             $comentario ="";
             $nameChek = "Despachar" .$c;
             $nameChek2 = "Anular" .$c;
             $acronimo =" AM"; 
             if(!empty($row->cliente)){
                $comentario = "Comentario :" . str_replace("%20", "", $row->cliente)  ; 
             }
             if( $row->hora>12){
                $acronimo =" PM";
             }
   
            ?>
                 <?php  if($orden != $row->ordenPedidoID) {?> 
                    
                    <thead>
                        <tr>
                           <th colspan="4">
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
                           <th> 
                             <!-- <button type="button"  class="form-control   btn-sm" data-title ="Procesar" name="procesar" id="procesar" onclick="procesarPedido(<?php //echo $c ?>, <?php //echo $row->ordenPedidoID?> );"  class="form-control btn-sm" style="background-color: #efeff1; color:#243458;">   <i class="fa fa-eye" aria-hidden="true"></i> </button> --> 
                           </th>
                           <th> 
                              <!-- <button type="button"  class="form-control   btn-sm" data-title ="Anular" name="<?php //echo $nameChek; ?>" id="<?php //echo $nameChek; ?>"  onclick="anularOrdenID( <?php //echo $row->ordenPedidoID?>, <?php //echo $row->mesaID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:red; text-align: center;">   <i class="fa fa-trash" aria-hidden="true"></i> </button> -->
                           </th>

                        </tr>
                       <tr >
                        <th id ="titulos">Cantidad</th>
                        <th id ="titulos"  colspan="3" >Descripción</th>                       
                        <th id ="titulos"  colspan="1" style="text-align: right">Despachar</th> 
                        <th id ="titulos"  colspan="1" style="text-align: right">Anular</th>
                       
                    </tr>
                    </thead>                         
                        <tr>
                           <td data-label="Catidad"><?php echo  $row->catidad; ?></td>
                           <td data-label="Descripción"  colspan="3"><?php  echo  strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion) );  ?></td> 
                            
                           <td data-label="Despachar"  colspan="1" style="text-align: right"> 
                               <?php  if($row->despachar == 0) {?>  
                                     <button type="button"  class="form-control   btn-sm" data-title ="Despachar" name="<?php //echo $nameChek; ?>" id="<?php echo $nameChek; ?>"  onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->detPedID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:GREEN; text-align: center;" >   <i class="fa fa-cutlery" aria-hidden="true"></i> </button> 
                              <?php }else {?>                          
                                   <!-- <button type="button"  class="form-control   btn-sm" data-title ="Despachar" name="<?php //echo $nameChek; ?>" id="<?php //echo $nameChek; ?>"  onclick="despacharOrden(<?php //echo $c ?>, <?php //echo $row->detPedID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458; text-align: center;">   <i class="fa fa-cutlery" aria-hidden="true"></i> </button> -->
                            
                              <?php }?>                          
                              
                           </td>
                              

                           <td data-label="Eliminar"  colspan="1" style="text-align: right"> 
                               <?php  if($row->despachar == 0) {?>  
                                     <button type="button"  class="form-control   btn-sm" data-title ="eliminar" name="<?php echo $nameChek2; ?>" id="<?php echo $nameChek2; ?>"  onclick="anularDetalleOrdenIDdet(<?php echo $row->detPedID?>, <?php echo $row->mesaID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458; text-align: center;" >   <i class="fa fa-times" aria-hidden="true"></i> </button> 
                              <?php }else {?>                          
                                <!-- <button type="button"  class="form-control   btn-sm" data-title ="eliminar" name="<?php //echo $nameChek2; ?>" id="<?php //echo $nameChek2; ?>"  onclick="anularDetalleOrdenIDdet(<?php //echo $row->detPedID?>, <?php //echo $row->mesaID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458; text-align: center;">   <i class="fa fa-times" aria-hidden="true"></i> </button> -->
                            
                              <?php }?>                          
                              
                           </td>

                          

                        </tr>    
                        

      
                
                               
                   
               
                  <?php  } else { ?> 
                      <tr>
                           <td data-label="Cantidad"><?php echo$row->catidad; ?></td>
                           <td data-label="Descripción" colspan="3"><?php  echo   strtoupper($row->prodDescripcion . " " . str_replace("OTROS", '', $row->Presentacion)); ?></td>                           
                            
                            <td data-label="Despachar"  colspan="1" style="text-align: right"> 
                              <?php  if($row->despachar == 0) {?>  
                              <button type="button"  class="form-control   btn-sm" data-title ="Despachar" name="<?php echo $nameChek; ?>" id="<?php echo $nameChek; ?>"  onclick="despacharOrden(<?php echo $c ?>, <?php echo $row->detPedID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458;" >   <i class="fa fa-cutlery" aria-hidden="true"></i> </button> 
                              <?php }else {?>                          
                              <!-- <button type="button"  class="form-control   btn-sm" data-title ="Despachar" name="<?php //echo $nameChek; ?>" id="<?php //echo $nameChek; ?>"  onclick="despacharOrden(<?php //echo $c ?>, <?php //echo $row->detPedID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458;">   <i class="fa fa-cutlery" aria-hidden="true"></i> </button> -->
                              
                              <?php }?>
                            

                           
                           </td> 
                           <td data-label="Eliminar"  colspan="1" style="text-align: right"> 
                               <?php  if($row->despachar == 0) {?>  
                                     <button type="button"  class="form-control   btn-sm" data-title ="eliminar" name="<?php echo $nameChek2; ?>" id="<?php echo $nameChek2; ?>"  onclick="anularDetalleOrdenIDdet(<?php echo $row->detPedID?>, <?php echo $row->mesaID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458; text-align: center;" >   <i class="fa fa-times" aria-hidden="true"></i> </button> 
                              <?php }else {?>                          
                                <!-- <button type="button"  class="form-control   btn-sm" data-title ="eliminar" name="<?php //echo $nameChek2; ?>" id="<?php //echo $nameChek; ?>"  onclick="anularDetalleOrdenIDdet(<?php //echo $row->detPedID?>, <?php //echo $row->mesaID?> );"  class="form-control btn-sm" style="background-color: #ffffff; color:#243458; text-align: center;">   <i class="fa fa-times" aria-hidden="true"></i> </button> -->
                            
                              <?php }?>                          
                              
                           </td>

                           

                          
                        </tr> 
                      <?php  }?>
         
 <?php 
         $orden  =   $row->ordenPedidoID;
          $c+=1;
          }?>
           
          
         <?php }?>
           </table>
    </div>
       </div>

<script>
    //  arranca  el  contador  activo  del  tiempo  de  espera
    iniciarContadoresEspera();
</script>


