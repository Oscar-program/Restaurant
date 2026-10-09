<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
var_dump($listBodegaProducto);

  if(isset($listBodegaProducto)){
      if(!empty($listBodegaProducto)){
        $c= 1;
        foreach($listBodegaProducto as  $row) :?>
        								<tr>

                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->bodProdDescripcion; ?></td>
                        <td><?php  echo   $row->estNombre; ?></td>
                                                    
                        <td class="text-right">

                            <a href='#' class="btn-edit" 
                            title="Editar Detalle"                             
                                onclick="get_BodegaProductoID(<?php  echo   $row->bodegaProductoID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                            
                                
                        


                                <a href='#' class="btn-eraser" 
                                 title="Eliminar registro"
                                onclick="delete_BodegaProductoID(<?php  echo   $row->bodegaProductoID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>    

                            


                                
                        </td>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 
