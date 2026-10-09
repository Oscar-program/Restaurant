<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
//var_dump($datoEquivalenteProd);

  if(isset($datoEquivalenteProd)){
      if(!empty($datoEquivalenteProd)){
        $c= 1;
        foreach($datoEquivalenteProd as  $row) :?>
        								<tr>

                        <td><?php  echo   $c; ?></td>
                        <td><?php  echo   $row->prodDescripcion; ?></td>
                        <td><?php  echo   $row->presentacionProd; ?></td>
                        <td><?php  echo   $row->unidades; ?></td>
                                                    
                        <td class="text-right">

                            <a href='#' class="btn-edit"
                            title="Editar Detalle"                             
                                onclick="get_EquivalenteProductoID(<?php  echo   $row->prodPresentID; ?>);">
                                <i class="fa fa-pencil" aria-hidden="true"></i> </a>

                            
                                
                        


                                <a href='#' class="btn-eraser" 
                                 title="Eliminar registro"
                                onclick="delete_EquivalenteProductoID(<?php  echo   $row->prodPresentID; ?>);">
                                <i class="fa fa-trash" aria-hidden="true"></i> </a>    

                            


                                
                        </td>
                        </tr> 
        

        <?php  $c+= 1; endforeach ?>
     <?php }
   
  }

 
?> 