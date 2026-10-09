<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
var_dump($datoMedidaPeProd);

  if(isset($datoMedidaPeProd)){
      if(!empty($datoMedidaPeProd)){
        $c= 1;
        foreach($datoMedidaPeProd as  $row) :?>
        								<tr>

                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->medProdDescripcion; ?></td>
                                                    
                        <td class="text-right">

                            <a href='#' class="btn-edit" 
                            title="Editar Detalle"                             
                                onclick="get_MedidadProductoID(<?php  echo   $row->medProdID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                            
                                
                        


                                <a href='#' class="btn-eraser"
                                 title="Eliminar registro"
                                onclick="delete_MedidaProductoID(<?php  echo   $row->medProdID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>    

                            


                                
                        </td>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 