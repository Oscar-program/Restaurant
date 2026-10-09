<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ordenID   = isset($datordenID) ? $datordenID : 0 ;
$mesaID    = isset($mesaID) ? $mesaID : 0 ;
$mesNombre = isset($mesNombre) ? $mesNombre : "" ;
$total     = 0;
$datTotal  = isset($datTotal) ? (float) $datTotal : 0;
//  area  de  la  mesa , con  ella  se  resuelve  el  precio  de  cada  producto
$areaEstablecimientoID = isset($areaEstablecimientoID) ? $areaEstablecimientoID : 0 ;
$area                  = isset($area) ? $area : "" ;
//  1 =  la  lista  de  productos  muestra  solo  los  marcados  como  producto  de  cocina
$soloCocina            = isset($soloCocina) ? $soloCocina : 0 ;
//var_dump($detalleOrden);
$comentario   = (isset($detalleOrden) && $detalleOrden!= NULL ) ? $detalleOrden[0]->ordPcomentario: "" ; 
if(strlen($comentario)==0 ){
    $comentario = "Sin Comentario" ;
}
?>



<div class = "container-fluid">
    <!-- titulo de mesa y numeor de orden -->
    <div class="row">
        <div  class="col-md 12 shadow-sm p-3 mb-1 bg-white rounded text-end">
        <label  id="bannerMesaPedido" name ="bannerMesaPedido">  <?php echo  str_replace("%20" ,  " ", $mesNombre) . "   " . strtoupper($area) . "         ORDEN #" .   strval($ordenID); ?></label>
        <?php if($soloCocina == 1){ ?>
            <span class="badge badge-danger" style="font-size:12px;">SOLO PRODUCTOS DE COCINA</span>
        <?php } ?>
        <button type="button" class="btn btn-sm btn-outline-secondary" style="float:left;"
                onclick="ordenesMesa(<?php echo $mesaID; ?>, '<?php echo str_replace("%20" ," ", $mesNombre); ?>')">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Ordenes de la mesa</button>
        </div>
        <input type="hidden" class="text-left text-warning border-0" name="ordenID" id="ordenID" value="<?php  echo strval($ordenID); ?>" readonly>
        <input type="hidden" class="text-left text-warning border-0" name="ctrlmesaID" id="ctrlmesaID" value="<?php  echo $mesaID; ?>" readonly>
        <input type="hidden" name="ctrlAreaID"     id="ctrlAreaID"     value="<?php echo $areaEstablecimientoID; ?>" readonly>
        <input type="hidden" name="ctrlSoloCocina" id="ctrlSoloCocina" value="<?php echo $soloCocina; ?>" readonly>
        <input type="hidden" name="ComentarioOrden" id="ComentarioOrden" value="<?php echo $soloCocina; ?>" readonly>
    </div>
    <div class="row"> 
          <!-- carga las categorias de los productos style ="width:15%;" -->           
            <div  class="col-md 6 shadow-sm p-3 mb-5 bg-white rounded" > 
                <!-- ponemos un select  -->
                    
                    <div class="ctrlSelectFamilia" id="ctrlSelectFamilia">
                        
                         <?php if(isset($listFamiliaProducto)){
                                if(!empty($listFamiliaProducto)){?>
                                   <select  name="familProd" id="familProd"  class="form-control chosen" onchange="cargar_listaProductos(this)"> 
                                         <option value ="0"> Seleccione familia de producto</option> 
                                            <?php foreach($listFamiliaProducto as  $row) {?>
                                                <option value="<?php echo $row->famProdID; ?>">  <?php echo $row->famProdID. " - " .  $row->famProdDescripcion; ?> </option>
                                               
                                            <?php }?>
                                   </select>        
                                        <?php }} ?>
                     </div>
                <!-- ponemos un select  -->
                <!-- acordiones -->
                    <div class="accordion" id="accordionExample">
                            <?php
                            if(isset($listFamiliaProducto)){
                                if(!empty($listFamiliaProducto)){
                                    $c= 1;
                                    foreach($listFamiliaProducto as  $row) :?>
                                        <div class="card-header" id=" <?php echo 'headin'. $row->famProdID ;?>">
                                            <input type="hidden" id  ="" name  ="">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="<?php echo '#collapse'. $row->famProdID ;?>"
                                                aria-expanded="true" aria-controls="<?php echo 'collapse'. $row->famProdID ;?>" 
                                                id="<?php echo 'btnFam'. $row->famProdID ;?>" 
                                                onclick="cargar_listaProductos1(<?php echo $row->famProdID ;?>)">
                                                <?php  echo   $row->famProdDescripcion; ?>
                                                </button>
                                            </h2>
                                        </div>
                                         <div id="<?php echo 'collapse'. $row->famProdID ;?>" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body"  id  ="<?php echo 'listas'. $row->famProdID ;?>"> </div>
                                        </div>
                                    <?php  $c+= 1; endforeach ?>
                            <?php }}?>   
                    </div>
                <!-- acordiones -->

                      <div id  ="listaProductos"> </div>


                   
            </div>
            <!-- segmento para  cargar el detalle de la orden de pedido -->           
            <div class ="col-md 6 shadow-sm p-3 mb-5 bg-white rounded" style="margin-left: 3px;">
                <form action="" id="formcabpedido"  name="formcabpedido">            
                     <!-- div para cargar el detalle de la orden que se esta tomando -->
                    <div class="contenedor-tabla1">
                        <div class="tabla-responsive1">
                            <table id="tblFamiliaProd" class="tabla-estiloOrdn">
                                <thead>
                                    <tr>
                                        <th  id ="titulos">Cantidad</th>
                                        <th  id ="titulos">Descripcion</th> 
                                        <th  id ="titulos">Total</th>                                      
                                        <th  id ="titulos">ACCIONES</th>                                
                                    </tr>
                                </thead>
                                <tbody  id ="detOrdenesPedido">   
                                 <?php  $this->load->view('inventarios/detalleVenta'); ?>  
                                </tbody>
                            </table>
                            <br>
                            <label id ="lbTotal" > Total a cancelar $<?php echo number_format($datTotal,2) ; ?>   </label>
                    
                            <div> 
                                <textarea class="form-control" name="txAcomentario" id="txAcomentario" cols="30" rows="3"> <?= htmlspecialchars($comentario) ?>
                                </textarea>
                            </div>
                        </div>
                    </div> 
                
                    <div class="container-fluid">
                        <div class="row">
                        <!--  <input type="number"  class="text-right border-0" name="totalOrden" id="totalOrden" value="<?php  //echo  $total;?>" readonly>  -->
                        <button type="button" id="btnDelOrden"  data-title ="Eliminar Orden" class="form-control btn-lg " style="width: 25%; color:lightslategrey ; font-size:40px; font-weight:bold; border-style:dotted; "><i class="fa fa-trash" aria-hidden="true"></i></button>
                        <button type="button" id="btnAddOrden"  data-title ="Agregar  Orden en la mesa" class="form-control  btn-lg" style="width: 25%; color:lightslategrey ; font-size:40px; font-weight:bold; border-style:dotted; " ><i class="fa fa-plus" aria-hidden="true"></i></button>
                        <button type="button" class="form-control   btn-lg" data-title ="Procesar venta" onclick="crear_pdf_ticket()" style="width: 25%; color:lightslategrey ; font-size:40px; font-weight:bold; border-style:dotted;" ><i class="fa fa-print" aria-hidden="true"></i></button>
                    </div>  
                        
                </form>
            </div>  
    </div>
    
 
</div>
<!-- segmento para cargar la modal  para ingresar el detalle del pedido  -->
<div  id = "addVenta">
</div>
<script type="text/javascript">
$(document).ready(function(){

    const btnAdOrden  =  document.getElementById("btnAddOrden");
    const btnDelOrden  =  document.getElementById("btnDelOrden");
   

  btnAdOrden.addEventListener("click", function(){
    var ctrlmesaID  =  document.getElementById("ctrlmesaID").value ;
     console.log("Los datos de la mesa actual   son  "  + ctrlmesaID)
      cargar_addordenes(ctrlmesaID) ;
  });


   btnDelOrden.addEventListener("click", function(){
    //var ctrlmesaID  =  document.getElementById("ctrlmesaID").value ;
     //console.log("Los datos de la mesa actual   son  "  + ctrlmesaID)
      anularOrden();
  });


})
</script>

<script>
     function cargarProductosCategoria(idCategoria){
        console.log("la categoria Cargada es" + idCategoria );
       

     } 
    
    document.getElementById('txAcomentario').addEventListener('focus', function () {
        this.select();
    });

</script>
