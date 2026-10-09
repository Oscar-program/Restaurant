<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
// var_dump($ListTmpCompra);
//  class="btn-edit"
// class="btn-eraser"
// style="background-color: #5DADE2 ;  border-color:aliceblue; border-width:1px;"

  if(isset($ListTmpCompra)){
      if(!empty($ListTmpCompra)){
        $c= 1;
        foreach($ListTmpCompra as  $row) :?>
        								<tr style="font-size: 12px; border:1px; border-color:cornflowerblue;">
                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   strval($row->cantidad); ?></td>
                        <td><?php  echo   $row->prodDescripcion; ?></td>                       
                        <td><?php  echo   $row->precUnit; ?></td>
                        <td><?php  echo   $row->impuesto; ?></td>
                        <td><?php  echo   $row->total; ?></td>                      
                                                    
                        <td class="text-right" style="font-size: 18px; text-align:justify;">
                           
                            <a href='#' style="margin-left: 10px;"
                            title="Editar Detalle"                             
                                onclick="get_FamiliaProductoID(<?php  echo   $row->detCompraId; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>
                                
                                <a href='#'  style="margin-left: 10px;" 
                                 title="Eliminar registro"
                                onclick="delete_FamiliaProductoID(<?php  echo   $row->detCompraId; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>    

                            


                                
                        </td>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 