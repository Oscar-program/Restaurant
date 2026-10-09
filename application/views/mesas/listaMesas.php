<script src=" <?php echo  base_url();?>js/funciones_basica.js"></script>
<?php

?>
<div style= "padding:0; margin:0; height:100%; overflow:hidden;  opacity:50;">
<?php  if(isset($listaMesas)){
    if(!empty($listaMesas)){
        foreach($listaMesas as  $row){ 
           
        ?>
           <div class="col-lg-2 col-2 justify-content-center mt-1 ml-2  border border-info" style="float:left; text-align:justify; display: flex; align-items: center;height:110px; background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px; box-shadow: 0px 0px 3px #21618C; " id  =" <?php echo   'mesa'.$row->mesaID ?>" 
              name  = 'familia' data-value=="<?php echo $row->mesaID;?>"  onclick="ordenesMesa(<?php  echo   $row->mesaID ; ?>, <?php  echo   "'$row->mesNombre'"  ; ?>);" >
                    <!-- small box   background-color:#043B5F; class="inner"   <img class="animation__shake" src="/BartioFran/img/mesa5.png" alt="AdminLTELogo" height="100" radial-gradient(black, blue) (70deg,#1B2631 , #2196f3)
                    width="100" style="border-radius:5%;"> -->
                    <h4 class="text-center tituloBotones"> <?php echo  ''. $row->mesNombre?> </h4>
                  
                    <div  >
                         
                       
                    </div>

                    
                    </div>

                    
    
                    <?php } ?>
<?php } ?>
<?php } ?>




 <?php //echo  base_url(); ?>     
 
          <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
<div  id = "addVentas">
</div>

<script>
   // $("#familia").on("click", function(){
        
       // var valorid  = 0;
       //  valorid = document.getElementById('familia').dataset.value;
       // valorid      = $("#familia").val();
       // alert("se ha hecho  click"+ valorid  + " capturado");
    
</script>