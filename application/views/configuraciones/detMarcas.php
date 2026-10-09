<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
var_dump($datosMArcas);

  if(isset($datosMArcas)){
      if(!empty($datosMArcas)){
        $c= 1;
        foreach($datosMArcas as  $row) :?>
        								<tr>

                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->marcProdDescripcion; ?></td>
                                                    
                        <td class="text-right">
                        <!--       <a href='#' class="btn btn-default btn-sm btn-edit " style="margin:0px; background-color:dodgerblue; color:white;"-->
                            <a href='#' class="btn-edit"
                            title="Editar Detalle"                             
                                onclick="get_marcaxId(<?php  echo   $row->marcProdID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                            
                                
                        


                                <a href='#' class="btn-eraser"
                                 title="Eliminar registro"
                                onclick="DeleteMarcar(<?php  echo   $row->marcProdID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>    

                            


                                
                        </td>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 
