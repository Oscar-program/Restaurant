<script src=" <?php echo  base_url();?>js/funciones_basica.js"></script>
<?php

?>
<!-- 
style= "padding:0; margin:0; height:100%; overflow:hidden;  opacity:2; margin-left:2px; " 
-->


  <div class="ctrlSelectProducto" id="ctrlSelectProducto">
    <?php if(isset($submenu)){
        if(!empty($submenu)){ ?>
            <select  name="selectProd" id="selectProd"  class="form-control chosen"
                    onchange="addVentaProducto1(this)"> 
                    <option value ="0"> Seleccione un producto</option> 
                        <?php foreach($submenu as  $row) {?>
                      

                                <option value="<?php echo $row->productoID; ?>"
                                    data-prodctucocina   = "<?php echo $row->prodctucocina ;?>"
                                    data-famprodid       = "<?php echo $row->famProdID ;?>"
                                    data-detpedid        = "<?php echo $detPedID=0 ;?>"
                                    data-proddescripcion = "<?php echo $row->prodDescripcion?>"
                                    data-precioventa     = "<?php echo $row->precioventa; ?>">
                                      <?php echo   $row->prodDescripcion ."  $". $row->precioventa ; ?> </option>
                        <?php }?>
            </select>        
    <?php }} ?>
  </div>

  <div class="cardProducto" id="cardProducto">
    <?php  if(isset($submenu)){
        if(!empty($submenu)){
            foreach($submenu as  $row){ 
            ?>
            <div  style="float:left; width:25%; margin-left:3px; shadow p-3 mb-5 bg-white rounded" id  =" <?php echo   'familia'.$row->productoID ?>" 
                name  = 'familia' data-value=="<?php echo $row->productoID;?>" onclick="addVentaProducto(<?php echo $row->famProdID ;?>, <?php echo $row->productoID ;?>,  <?php echo $detPedID=0 ;?>, <?php echo "' $row->prodDescripcion '" ;?> ,  <?php echo $row->precioventa ;?>,  <?php echo $row->prodctucocina ;?>)">
                        <!-- small box -->
                        <div class="small-box bg-info btnMenu">
                            <div class="inner btnMenu">
                            <h6> <?php echo '$ '.$row->precioventa ?></h6>

                            <p style = "color:white; font-weight:bold; font-size:10px;"><?php echo $row->prodDescripcion?></p>
                            </div>
                        
                            <a href="#" class="small-box-footer" style = "color:white; font-weight:bold; font-size:10px; background-color:slategray"> <?php echo 'Existencia'. $row->existencia?></a>
                        </div>
                        </div>      
            <?php }}} ?>
  </div>       




<script>
   // $("#familia").on("click", function(){
        
       // var valorid  = 0;
       //  valorid = document.getElementById('familia').dataset.value;
       // valorid      = $("#familia").val();
       // alert("se ha hecho  click"+ valorid  + " capturado");
    
</script>